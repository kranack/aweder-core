<?php

namespace Tests\Unit\Model;

use App\Inventory;
use App\Order;
use App\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use phpDocumentor\Reflection\Types\This;
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
    protected $model;

    public function setUp(): void
    {
        parent::setUp();

        $this->model = app()->make(OrderItem::class);
    }

    /**
     * @test
     */
    public function checkQuantityScope(): void
    {
        $inventory1 = factory(Inventory::class)->create();
        $inventory2 = factory(Inventory::class)->create();

        $orderItem1 = factory($this->model)->create([
            'quantity' => 2,
            'inventory_id' => $inventory1->id
        ]);

        $orderItem2 = factory($this->model)->create([
            'quantity' => 1,
            'inventory_id' => $inventory2->id
        ]);

        $this->assertDatabaseHas('order_items', ['id' => $orderItem1->id]);
        $this->assertDatabaseHas('order_items', ['id' => $orderItem2->id]);
        $this->assertCount(1, $inventory1->orderItems()->get());
        $this->assertCount(1, $inventory2->orderItems()->get());

        $this->assertCount(1, $this->model::multipleQuantity()->get());
    }
}
