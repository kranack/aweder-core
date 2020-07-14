<?php

namespace Tests\Unit\Command;

use App\Contract\Repositories\OrderItemContract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class AddVariantIdToOrderItemsTest
 * @package Tests\Unit\Command
 * @coversDefaultClass \App\Console\Commands\AddVariantIdToOrderItems
 * @group OrderItems
 */
class AddVariantIdToOrderItemsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @var mixed
     */
    private OrderItemContract $repository;

    public function setUp(): void
    {
        parent::setUp();
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
    public function addsVariantIdToOrderItem(): void
    {
        $inventory = $this->createAndReturnInventoryItem();
        $inventoryVariant = $this->createAndReturnInventoryVariant(['inventory_id' => $inventory->id]);

        $order = $this->createAndReturnOrderForStatus('Purchased Order');

        $orderItem1 = $this->createAndReturnOrderItem([
            'order_id' => $order->id,
            'inventory_id' => $inventory->id,
            'variant_id' => null
        ]);

        $this->assertCount(1, $this->repository->getOrderItemsWithMissingVariantIds());

        $this->artisan('orders:add-variants-to-order-items');

        $this->assertCount(1, $this->repository->getOrderItemsWithMissingVariantIds());
        $this->assertEquals($inventoryVariant->id, $orderItem1->variant_id);
    }
}
