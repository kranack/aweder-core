<?php

namespace Tests\Unit\Service;

use App\Service\OrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class OrderServiceTest
 * @package Tests\Services
 * @coversDefaultClass \App\Service\OrderService
 */
class OrderServiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @var OrderService
     */
    protected OrderService $orderService;

    public function setUp(): void
    {
        parent::setUp();
        $this->orderService = $this->app->make(OrderService::class);
    }

    /**
     * @test
     */
    public function canUpdateTableNumber(): void
    {
        $order = $this->createAndReturnOrderForStatus('Purchased Order', ['is_table_service' => true]);

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'table_number' => null
            ]
        );

        $newTableNumber = $this->faker->numberBetween(0, 30);
        $return = $this->orderService->setTableNumberOnOrder($order, $newTableNumber);
        $this->assertTrue($return);

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'table_number' => $newTableNumber
            ]
        );
    }

    /**
     * @test
     */
    public function cannotUpdateTableNumberWithString(): void
    {
        $order = $this->createAndReturnOrderForStatus('Purchased Order', ['is_table_service' => true]);

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'table_number' => null
            ]
        );

        $this->expectException(\TypeError::class);
        $return = $this->orderService->setTableNumberOnOrder($order, 'boo!');
        $this->assertFalse($return);

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'table_number' => null
            ]
        );
    }

    /**
     * @test
     */
    public function cannotUpdateTableNumberWithoutTableService(): void
    {
        $order = $this->createAndReturnOrderForStatus('Purchased Order', ['is_table_service' => false]);

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'table_number' => null
            ]
        );

        $tableNumber = $this->faker->numberBetween(0, 20);
        $return = $this->orderService->setTableNumberOnOrder($order, $tableNumber);
        $this->assertFalse($return);

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'table_number' => null
            ]
        );
    }
}
