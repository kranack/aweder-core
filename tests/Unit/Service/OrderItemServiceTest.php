<?php

namespace Tests\Unit\Service;

use App\Service\OrderItemService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class OrderItemServiceTest
 * @package Tests\Services
 * @coversDefaultClass \App\Service\OrderItemService
 */
class OrderItemServiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @var OrderItemService
     */
    protected $orderItemService;

    public function setUp(): void
    {
        parent::setUp();
        $this->orderItemService = $this->app->make(OrderItemService::class);
    }

    /**
     * @test
     */
    public function canUpdateOrderItemOptions(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $order = $this->createAndReturnOrderForStatus('Fulfilled', [
            'merchant_id' => $merchant->id
        ]);

        $orderItem = $this->createAndReturnOrderItem([
            'order_id' => $order->id
        ]);

        $this->assertCount(0, $orderItem->inventoryOptions()->get());

        $inventory = $this->createAndReturnInventoryItem([
            'merchant_id' => $merchant->id
        ]);

        $inventoryOptionGroup = $this->createAndReturnInventoryOptionGroup(
            [
                'inventory_id' => $inventory->id
            ]
        );

        $option1 = $this->createAndReturnInventoryOptionGroupItem(
            [
                'inventory_option_group_id' => $inventoryOptionGroup->id
            ]
        );

        $option2 = $this->createAndReturnInventoryOptionGroupItem(
            [
                'inventory_option_group_id' => $inventoryOptionGroup->id
            ]
        );

        $this->orderItemService->updateOrderItemOptions($orderItem, collect([$option1->id, $option2->id]));
        $orderItem = $orderItem->fresh();
        $this->assertCount(2, $orderItem->inventoryOptions()->get());
    }

    /**
     * @test
     */
    public function cannotUpdateOrderItemOptionsWithInvalidOption(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $order = $this->createAndReturnOrderForStatus('Fulfilled', [
            'merchant_id' => $merchant->id
        ]);

        $orderItem = $this->createAndReturnOrderItem([
            'order_id' => $order->id
        ]);

        $this->assertCount(0, $orderItem->inventoryOptions()->get());

        $inventory = $this->createAndReturnInventoryItem([
            'merchant_id' => $merchant->id
        ]);

        $inventoryOptionGroup = $this->createAndReturnInventoryOptionGroup(
            [
                'inventory_id' => $inventory->id
            ]
        );

        $option1 = $this->createAndReturnInventoryOptionGroupItem(
            [
                'inventory_option_group_id' => $inventoryOptionGroup->id
            ]
        );

        $option2 = $this->createAndReturnInventoryOptionGroupItem(
            [
                'inventory_option_group_id' => $inventoryOptionGroup->id
            ]
        );

        $this->orderItemService->updateOrderItemOptions($orderItem, collect([39]));
        $orderItem = $orderItem->fresh();
        $this->assertCount(0, $orderItem->inventoryOptions()->get()->toArray());
    }
}
