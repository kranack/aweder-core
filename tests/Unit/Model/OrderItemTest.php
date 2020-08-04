<?php

namespace Tests\Unit\Model;

use App\Contract\Repositories\OrderItemContract;
use App\Inventory;
use App\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class OrderItemTest
 * @package Tests\Unit\Model
 * @group Order
 * @group OrderItemModel
 * @coversDefaultClass \App\OrderItem
 */
class OrderItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var OrderItem
     */
    protected OrderItem $model;

    /**
     * @var OrderItemContract
     */
    private OrderItemContract $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->model = app()->make(OrderItem::class);
        $this->repository = app()->make(OrderItemContract::class);
    }

    /**
     * @test
     */
    public function canFindOrderItemsWithMissingVariantIds(): void
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
    public function cannotFindMissingVariantIdInOrderItems(): void
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
    public function canGetItemByOrderAndId(): void
    {

    }

    /**
     * @test
     */
    public function checkQuantityScope(): void
    {
        $inventory1 = factory(Inventory::class)->create();
        $inventory2 = factory(Inventory::class)->create();

        $orderItem1 = factory(OrderItem::class)->create([
            'quantity' => 2,
            'inventory_id' => $inventory1->id
        ]);

        $orderItem2 = factory(OrderItem::class)->create([
            'quantity' => 1,
            'inventory_id' => $inventory2->id
        ]);

        $this->assertDatabaseHas('order_items', ['id' => $orderItem1->id]);
        $this->assertDatabaseHas('order_items', ['id' => $orderItem2->id]);
        $this->assertCount(1, $inventory1->orderItems()->get());
        $this->assertCount(1, $inventory2->orderItems()->get());

        $this->assertCount(1, OrderItem::multipleQuantity()->get());
    }
}
