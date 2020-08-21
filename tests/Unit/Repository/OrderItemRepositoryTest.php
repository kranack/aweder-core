<?php

namespace Tests\Unit\Repository;

use App\Contract\Repositories\OrderContract;
use App\Contract\Repositories\OrderItemContract;
use App\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class OrderRepositoryTest
 * @package Tests\Unit\Repository
 * @coversDefaultClass \App\Repository\OrderItemRepository;
 * @group Order
 */
class OrderItemRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @var OrderItemContract
     */
    protected OrderItemContract $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->app->make(OrderItemContract::class);
    }

    public function can_find_order_items_with_missing_variant_ids(): void
    {
        $order = $this->createAndReturnOrderForStatus('Purchased Order');
        $orderItem1 = $this->createAndReturnOrderItem([
            'order_id' => $order,
            'variant_id' => null
        ]);
        $orderItem2 = $this->createAndReturnOrderItem([
            'order_id' => $order,
        ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
        ]);

        $this->assertCount(1, $this->repository->getOrderItemsWithMissingVariantIds());
    }

    /**
     * @test
     */
    public function cannot_find_missing_variant_id_in_order_items(): void
    {
        $order = $this->createAndReturnOrderForStatus('Purchased Order');
        $inventoryVariant = $this->createAndReturnInventoryVariant();

        $orderItem1 = $this->createAndReturnOrderItem([
            'order_id' => $order->id,
            'variant_id' => $inventoryVariant->id
        ]);

        $orderItem2 = $this->createAndReturnOrderItem([
            'order_id' => $order->id,
            'variant_id' => $inventoryVariant->id
        ]);

        $this->assertCount(0, $this->repository->getOrderItemsWithMissingVariantIds());
    }

    /**
     * @test
     */
    public function can_get_order_item_by_order_and_id(): void
    {
        $order1 = $this->createAndReturnOrderForStatus('Fulfilled');
        $order2 = $this->createAndReturnOrderForStatus('Fulfilled');
        $recordToPullOutName = $this->faker->name;

        $orderItem1 = $this->createAndReturnOrderItem(
            [
                'order_id' => $order1->id,
                'title' => 'Not Me 1'
            ]
        );

        $orderItem2 = $this->createAndReturnOrderItem(
            [
                'order_id' => $order1->id,
                'title' => 'Not Me 2'
            ]
        );

        $orderItem3 = $this->createAndReturnOrderItem(
            [
                'order_id' => $order2->id,
                'title' => $recordToPullOutName
            ]
        );

        $orderItem4 = $this->createAndReturnOrderItem(
            [
                'order_id' => $order2->id,
                'title' => 'Not Me 3'
            ]
        );

        $orderItemReceived = $this->repository->getOrderItemByOrderAndId($order2, $orderItem3->id);
        $this->assertEquals($recordToPullOutName, $orderItemReceived->title);
    }
}
