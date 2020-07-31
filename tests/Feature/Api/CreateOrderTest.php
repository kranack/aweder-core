<?php

namespace Tests\Feature\Api;

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
    public function cannotCreateOrderForMerchantWithoutMerchantId()
    {
        $merchant = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $this->assertCount(0, $merchant->orders()->get());

        $orderItemPayload = [];

        $response = $this->json(
            'POST',
            '/api/v1/order',
            $orderItemPayload
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment(['The merchant field is required.']);
        $this->assertCount(0, $merchant->orders()->get());
    }

    /**
     * @test
     */
    public function cannotCreateOrderForMerchantWithInvalidMerchantId()
    {
        $merchant = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $this->assertCount(0, $merchant->orders()->get());

        $orderItemPayload = [
            'merchant' => 'rubbish'
        ];

        $response = $this->json(
            'POST',
            '/api/v1/order',
            $orderItemPayload
        );

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJsonFragment(['Could not create order for merchant']);
        $this->assertCount(0, $merchant->orders()->get());
    }

    /**
     * @test
     */
    public function canCreateOrderForMerchant()
    {
        $merchant = $this->createAndReturnMerchant(['registration_stage' => 0]);
        $this->assertCount(0, $merchant->orders()->get());

        $orderItemPayload = [
            'merchant' => $merchant->url_slug,
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
