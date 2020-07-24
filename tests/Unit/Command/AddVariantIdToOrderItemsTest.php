<?php

namespace Tests\Unit\Command;

use App\Contract\Repositories\OrderContract;
use App\OrderItem;
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
     * @var OrderContract
     */
    private OrderContract $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = app()->make(OrderContract::class);
    }

    /**
     * @test
     */
    public function noVariantIdsToAdd(): void
    {
        $this->artisan('orders:add-variants-to-order-items')
            ->expectsOutput('No order items to update')
            ->assertExitCode(0);
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

        $this->assertCount(1, $this->repository->getOrdersWithOrderItemsThatNeedDefaultVariantId()->toArray());

        $this->artisan('orders:add-variants-to-order-items')
            ->expectsOutput('Adding default variant to 1 Order(s)')
            ->assertExitCode(0);

        $this->assertCount(0, $this->repository->getOrdersWithOrderItemsThatNeedDefaultVariantId()->toArray());
        $modifiedOrderItem = OrderItem::find($orderItem1->id);
        $this->assertEquals(1, $modifiedOrderItem->variant_id);
    }
}
