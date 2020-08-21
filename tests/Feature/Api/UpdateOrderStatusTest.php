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
    public function can_update_order_status(): void
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
    public function cannot_update_order_status_without_merchant(): void
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
    public function cannot_update_status_with_invalid_merchant(): void
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
    public function cannot_update_order_status_with_invalid_status(): void
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

    /**
     * @test
     */
    public function cannot_update_order_that_belongs_to_different_merchant(): void
    {
        $merchant1 = $this->createAndReturnMerchant();
        $merchant2 = $this->createAndReturnMerchant();
        $order = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchant1->id]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'merchant_id' => $merchant1->id,
            'status' => 'fulfilled'
        ]);

        $order2 = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchant2->id]);

        $this->assertDatabaseHas('orders', [
            'id' => $order2->id,
            'merchant_id' => $merchant2->id,
            'status' => 'fulfilled'
        ]);

        $response = $this->json(
            'POST',
            'api/v1/order/' . $order->url_slug . '/status',
            [
                'merchant' => $merchant2->url_slug,
                'status' => 'processing'
            ]
        );

        $response->assertStatus(Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @test
     */
    public function cannot_update_deleted_order(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $order = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchant->id]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'merchant_id' => $merchant->id,
            'status' => 'fulfilled'
        ]);

        $order->delete();

        $response = $this->json(
            'POST',
            'api/v1/order/' . $order->url_slug . '/status',
            [
                'merchant' => $merchant->url_slug,
                'status' => 'processing'
            ]
        );

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @test
     */
    public function cannot_update_order_that_does_not_exist(): void
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
            'api/v1/order/' . $this->faker->word . '/status',
            [
                'merchant' => $merchant->url_slug,
                'status' => 'processing'
            ]
        );

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
