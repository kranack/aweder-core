<?php

namespace Tests\Unit\Model;

use App\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class OrderTest
 * @package Tests\Unit\Model
 * @group Order
 * @group OrderModel
 * @coversDefaultClass \App\Order
 */
class OrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Order
     */
    protected $model;

    public function setUp(): void
    {
        parent::setUp();

        $this->model = app()->make(Order::class);
    }

    /**
     * @test
     * @dataProvider deliveryOrCollectionProvider
     * @param bool $bool
     * @param string $type
     */
    public function get_is_delivery_or_collection_with_valid_types(bool $bool, string $type): void
    {
        $this->model->setAttribute('is_delivery', $bool);

        $value = $this->model->getIsDeliveryOrCollection();

        $this->assertEquals($type, $value);
    }

    /**
     * @test
     */
    public function table_service_set_to_false_returns_false(): void
    {
        $this->model->setAttribute('is_table_service', false);
        $this->assertFalse($this->model->isTableService());
    }

    /**
     * @test
     */
    public function table_service_set_to_true_returns_true(): void
    {
        $this->model->setAttribute('is_table_service', true);
        $this->assertTrue($this->model->isTableService());
    }

    /**
     * @test
     */
    public function table_service_set_to_null_returns_false(): void
    {
        $this->model->setAttribute('is_table_service', null);
        $this->assertFalse($this->model->isTableService());
    }

    /**
     * @test
     */
    public function table_service_set_to_1_returns_true(): void
    {
        $this->model->setAttribute('is_table_service', 1);
        $this->assertTrue($this->model->isTableService());
    }

    /**
     * @test
     */
    public function table_service_set_to_0_returns_true(): void
    {
        $this->model->setAttribute('is_table_service', 0);
        $this->assertFalse($this->model->isTableService());
    }

    /**
     * @test
     */
    public function can_identify_delivery_type(): void
    {
        $this->model->setAttribute('is_delivery', 1);
        $this->assertEquals('delivery', $this->model->orderType());
    }

    /**
     * @test
     */
    public function can_identify_collection_type(): void
    {
        $this->model->setAttribute('is_collection', 1);
        $this->assertEquals('collection', $this->model->orderType());
    }

    /**
     * @test
     */
    public function can_identify_table_service_type(): void
    {
        $this->model->setAttribute('is_table_service', 1);
        $this->assertEquals('table_service', $this->model->orderType());
    }

    /**
     * @test
     */
    public function can_identify_as_unassigned_order_type(): void
    {
        $this->assertEquals('unassigned', $this->model->orderType());
    }

    /**
     * @test
     */
    public function time_since_created_with_created_at_older_than20_minutes(): void
    {
        $now = Carbon::create(2020, 03, 26, 10, 37, 35);
        Carbon::setTestNow($now);
        $this->model->__set('order_submitted', Carbon::create(2020, 03, 26, 10, 17, 35));
        $response = $this->model->getTimeSinceCreatedAndIfTheOrderIsOlderThan20Minutes();
        $this->assertIsArray($response);
        $this->assertTrue($response['old']);
        $this->assertEquals('20:00', $response['time']);
        $this->assertEquals('20', $response['time_to_display']);
    }

    /**
     * @test
     */
    public function time_since_created_with_created_at_less_than20_minutes(): void
    {
        $now = Carbon::create(2020, 03, 26, 10, 37, 35);
        Carbon::setTestNow($now);
        $this->model->__set('order_submitted', Carbon::create(2020, 03, 26, 10, 32, 35));
        $response = $this->model->getTimeSinceCreatedAndIfTheOrderIsOlderThan20Minutes();
        $this->assertIsArray($response);
        $this->assertFalse($response['old']);
        $this->assertEquals('05:00', $response['time']);
        $this->assertEquals('05', $response['time_to_display']);
    }

    public function deliveryOrCollectionProvider(): array
    {
        return [
            [true, 'Delivery'],
            [false, 'Collection'],
        ];
    }

    /**
     * @param string $statusToSet
     * @param string $expectedFrontEndStatus
     * @test
     * @dataProvider frontendStatuses
     */
    public function frontend_status_results(string $statusToSet, string $expectedFrontEndStatus): void
    {
        $order = $this->createAndReturnOrderForStatus('Unprocessed Order', ['status' => $statusToSet]);

        $this->assertSame($expectedFrontEndStatus, $order->getNiceFrontendStatus());
    }


    /**
     * @return array|array[]
     */
    public function frontendStatuses(): array
    {
        return [
            'Acknowledged' => [
                'acknowledged',
                'Processing',
            ],
            'Processing' => [
                'processing',
                'Processing',
            ],
            'Purchased' => [
                'purchased',
                'New Order',
            ],
            'Fulfilled' => [
                'fulfilled',
                'Completed',
            ],
            'Rejected' => [
                'rejected',
                'Rejected',
            ],
        ];
    }
}
