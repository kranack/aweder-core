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
        $merchant = $this->createAndReturnMerchant();
        $order = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchant->id]);
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
                'merchant' => $merchant->url_slug,
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
     * @test
     */
    public function willNotUpdateNonExistingItemOnOrder(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $order = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchant->id]);
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
            '/api/v1/order/' . $order->url_slug . '/item/234123',
            [
                'merchant' => $merchant->url_slug,
                'price' => $newPrice
            ]
        );

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    /**
     * @test
     */
    public function willNotUpdateNonExistingOrder(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $order = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchant->id]);
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
            '/api/v1/order/monkeynuts/item/' . $orderItem1->id,
            [
                'merchant' => $merchant->url_slug,
                'price' => $newPrice
            ]
        );

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @test
     */
    public function willNotUpdateOrderItemWithoutMerchant(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $order = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchant->id]);
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

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
