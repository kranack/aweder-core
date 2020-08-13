<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class UpdateTableNumberTest
 * @package Tests\Feature\Api
 * @group Order
 */
class UpdateTableNumberTest extends TestCase
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
    public function canUpdateTableNumber(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $originalTableNumber = $this->faker->numberBetween(0, 35);
        $order = $this->createAndReturnOrderForStatus(
            'Purchased Order',
            [
                'merchant_id' => $merchant->id,
                'is_table_service' => true,
                'table_number' => $originalTableNumber
            ]
        );

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'table_number' => $originalTableNumber
        ]);

        $newTableNumber = $this->faker->numberBetween(0, 35);
        $response = $this->json(
            'POST',
            '/api/v1/order/' . $order->url_slug . '/table',
            [
                'merchant' => $merchant->url_slug,
                'table_number' => $newTableNumber,
            ]
        );

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'table_number' => $newTableNumber
        ]);
    }

    /**
     * @test
     */
    public function cannotUpdateTableNumberWithoutMerchant(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $originalTableNumber = $this->faker->numberBetween(0, 35);
        $order = $this->createAndReturnOrderForStatus(
            'Purchased Order',
            [
                'merchant_id' => $merchant->id,
                'table_number' => $originalTableNumber,
                'is_table_service' => true
            ]
        );

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'table_number' => $originalTableNumber
        ]);

        $newTableNumber = $this->faker->numberBetween(0, 35);

        $response = $this->json(
            'POST',
            '/api/v1/order/' . $order->url_slug . '/table',
            [
                'table_number' => $newTableNumber,
            ]
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'table_number' => $originalTableNumber
        ]);
    }

    /**
     * @test
     */
    public function cannotUpdateTableNumberWithString(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $originalTableNumber = $this->faker->numberBetween(0, 35);
        $order = $this->createAndReturnOrderForStatus(
            'Purchased Order',
            [
                'merchant_id' => $merchant->id,
                'table_number' => $originalTableNumber,
                'is_table_service' => true
            ]
        );

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'table_number' => $originalTableNumber
        ]);

        $newTableNumber = $this->faker->numberBetween(0, 35);

        $response = $this->json(
            'POST',
            '/api/v1/order/' . $order->url_slug . '/table',
            [
                'merchant' => $merchant->url_slug,
                'table_number' => 'boo!',
            ]
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'table_number' => $originalTableNumber
        ]);
    }

    /**
     * @test
     */
    public function cannotUpdateOrderWithoutTableService(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $originalTableNumber = $this->faker->numberBetween(0, 35);
        $order = $this->createAndReturnOrderForStatus(
            'Purchased Order',
            [
                'merchant_id' => $merchant->id,
                'table_number' => null,
                'is_table_service' => false,
            ]
        );

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
        ]);

        $newTableNumber = $this->faker->numberBetween(0, 35);

        $response = $this->json(
            'POST',
            '/api/v1/order/' . $order->url_slug . '/table',
            [
                'merchant' => $merchant->url_slug,
                'table_number' => 21,
            ]
        );

        $response->assertStatus(Response::HTTP_NOT_ACCEPTABLE);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'table_number' => null
        ]);
    }
}
