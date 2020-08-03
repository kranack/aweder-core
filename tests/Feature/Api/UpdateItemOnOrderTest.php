<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class UpdateItemOnOrderTest
 * @package Tests\Feature\Api
 * @group Order
 */
class UpdateItemOnOrderTest extends TestCase
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
    public function willUpdateItemOnOrder(): void
    {
        $order = $this->createAndReturnOrderForStatus('Purchased Order');
        $inventoryVariant = $this->createAndReturnInventoryVariant();
        $originalPrice = $this->faker->numberBetween(0, 6000);

        $orderItem1 = $this->createAndReturnOrderItem([
            'order_id' => $order->id,
            'price' => $originalPrice,
            'variant_id' => $inventoryVariant->id
        ]);

        $this->assertDatabaseHas(
            'order_items',
            [
                'order_id' => $order->id,
                'price' => $originalPrice
            ]
        );

        $newPrice = $originalPrice + $this->faker->numberBetween(0, 200);

        $response = $this->json(
            'PATCH',
            '/api/v1/order/' . $order->url_slug . '/item/' . $orderItem1->id,
            [
                'price' => $newPrice
            ]
        );

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['price' => $newPrice]);

        $this->assertDatabaseHas(
            'order_items',
            [
                'order_id' => $order->id,
                'price' => $newPrice
            ]
        );
    }

    /**
     *
     */
    public function willNotUpdateNonExistingItemOnOrder(): void
    {

    }

    /**
     *
     */
    public function willNotUpdateNonExistingOrder(): void
    {

    }
}
