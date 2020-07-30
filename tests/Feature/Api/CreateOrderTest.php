<?php

namespace Tests\Feature\Api;

use App\Contract\Repositories\InventoryOptionGroupContract;
use App\Contract\Repositories\InventoryOptionGroupItemContract;
use App\Contract\Repositories\InventoryVariantContract;
use App\Contract\Repositories\OrderContract;
use App\Contract\Repositories\OrderItemContract;
use App\Inventory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class CreateOrderTest
 * @package Tests\Feature\Api
 * @group Order
 */
class CreateOrderTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function canCreateOrderForMerchant()
    {
        $merchant = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $this->assertCount(0, $merchant->orders()->get());

        $orderItemPayload = [
            'merchant' => $merchant->url_slug
        ];

        $response = $this->json(
            'POST',
            '/api/v1/order',
            $orderItemPayload
        );

        $response->assertStatus(201);
        $this->assertCount(1, $merchant->orders()->get());
    }
}
