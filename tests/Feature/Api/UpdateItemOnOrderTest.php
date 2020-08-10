<?php

namespace Tests\Feature\Api;

use App\Contract\Repositories\OrderItemContract;
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

    /**
     * @var OrderItemContract
     */
    protected $orderItemRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->orderItemRepository = $this->app->make(OrderItemContract::class);
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

    /**
     * @test
     */
    public function canUpdateOptionsOnOrderItem(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $inventory = $this->createAndReturnInventoryItem(['merchant_id' => $merchant->id]);

        $optionGroup = $this->createAndReturnInventoryOptionGroup(
            [
                'inventory_id' => $inventory
            ]
        );

        $option1 = $this->createAndReturnInventoryOptionGroupItem([
            'inventory_option_group_id' => $optionGroup->id,
            'name' => 'Option1'
        ]);

        $option2 = $this->createAndReturnInventoryOptionGroupItem([
            'inventory_option_group_id' => $optionGroup->id,
            'name' => 'Option2'
        ]);

        $option3 = $this->createAndReturnInventoryOptionGroupItem([
            'inventory_option_group_id' => $optionGroup->id,
            'name' => 'Option3'
        ]);

        $order = $this->createAndReturnOrderForStatus('Fulfilled', [
            'merchant_id' => $merchant->id
        ]);

        $orderItem = $this->createAndReturnOrderItem(['order_id' => $order->id]);

        $this->orderItemRepository->addOptionToOrderItem($orderItem, $option1);
        $this->orderItemRepository->addOptionToOrderItem($orderItem, $option2);

        $this->assertCount(2, $orderItem->inventoryOptions()->get());

        $response = $this->json(
            'PATCH',
            '/api/v1/order/' . $order->url_slug . '/item/' . $orderItem->id,
            [
                'price' => 3255,
                'merchant' => $merchant->url_slug,
                'inventory_options' => [
                    $option3->id
                ]
            ]
        );

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $orderItem->fresh();
        $this->assertEquals('Option3', $orderItem->inventoryOptions()->first()->name);
    }
}
