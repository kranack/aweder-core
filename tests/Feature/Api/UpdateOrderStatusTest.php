<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class UpdateOrderStatusTest
 * @package Tests\Feature\Api
 * @group Order
 */
class UpdateOrderStatusTest extends TestCase
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
    public function canUpdateOrderStatus(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $order = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchant->id]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'merchant_id' => $merchant->id,
            'status' => 'fulfilled'
        ]);

        $response = $this->json(
            'POST',
            'api/v1/order/' . $order->url_slug . '/status',
            [
                'merchant' => $merchant->url_slug,
                'status' => 'purchased'
            ]
        );

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'merchant_id' => $merchant->id,
            'status' => 'purchased'
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => 'Updated order status.']);
    }

    /**
     * @test
     */
    public function cannotUpdateOrderStatusWithoutMerchant(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $order = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchant->id]);

        $response = $this->json(
            'POST',
            'api/v1/order/' . $order->url_slug . '/status',
            [
                'status' => 'Processing'
            ]
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment(['The given data was invalid.']);
    }

    /**
     * @test
     */
    public function cannotUpdateStatusWithInvalidMerchant(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $order = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchant->id]);

        $response = $this->json(
            'POST',
            'api/v1/order/' . $order->url_slug . '/status',
            [
                'merchant' => 'Blurnsball',
                'status' => 'processing'
            ]
        );

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJsonFragment(['Merchant does not exist']);
    }

    /**
     * @test
     */
    public function cannotUpdateOrderStatusWithInvalidStatus(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $order = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchant->id]);

        $response = $this->json(
            'POST',
            'api/v1/order/' . $order->url_slug . '/status',
            [
                'merchant' => $merchant->url_slug,
                'status' => 'Blurnsball'
            ]
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment(['The selected status is invalid.']);
    }
}
