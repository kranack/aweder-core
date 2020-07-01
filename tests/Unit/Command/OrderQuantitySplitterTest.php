<?php

namespace Tests\Unit\Command;

use App\Inventory;
use App\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class RetrospectiveOrderQuantitySplitter
 * @package Tests\Unit\Command
 * @group UtilityCommands
 */
class OrderQuantitySplitterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function checkCommandSplitsRecords(): void
    {
        $inventory = factory(Inventory::class)->create();
        $randomQuantity = random_int(0, 20);

        $orderItem = factory(OrderItem::class)->create([
            'quantity' => $randomQuantity,
            'inventory_id' => $inventory->id,
            'price' => 65
        ]);

        $this->assertDatabaseHas('order_items', ['id' => $orderItem->id]);
        $this->assertCount(1, $inventory->orderItems()->get());
        $this->artisan('db:order-quantity-split-hotfix');
        $this->assertCount($randomQuantity, $inventory->orderItems()->get());

        foreach ($inventory->orderItems() as $orderItem) {
            $this->assertEquals(1, $orderItem->quantity);
            $this->assertEquals(65, $orderItem->price);
        }
    }
}
