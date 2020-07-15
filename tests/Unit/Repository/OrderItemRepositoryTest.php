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
     * @var OrderContract
     */
    protected $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->app->make(OrderItemContract::class);
    }

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
}
