<?php

namespace Tests\Unit\Model;

use App\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class MerchantTest
 * @package Tests\Unit\Model
 * @coversDefaultClass \App\Merchant
 * @group MerchantModel
 */
class MerchantTest extends TestCase
{
    use RefreshDatabase;

    protected Merchant $model;

    public function setUp(): void
    {
        parent::setUp();

        $this->model = app()->make(Merchant::class);
    }

    /**
     * @test
     * @dataProvider acceptableOrderTypeDataProvider
     */
    public function merchant_accetable_orders_contains_correct_data(
        array $factoryArrayDetails,
        array $expectedArray
    ): void {
        $merchant = factory(Merchant::class)->create(
            $factoryArrayDetails
        );

        $this->assertEmpty(array_diff($expectedArray, $merchant->getMerchantAcceptableOrderTypes()));
    }

    public function acceptable_order_type_data_provider(): array
    {
        return [
            'collection only' => [
                [
                    'allow_collection' => 1,
                    'allow_delivery' => 0,
                    'allow_table_service' => 0,
                ],
                [
                    'collection'
                ]
            ],
            'delivery only' => [
                [
                    'allow_collection' => 0,
                    'allow_delivery' => 1,
                    'allow_table_service' => 0,
                ],
                [
                    'delivery'
                ]
            ],
            'table only' => [
                [
                    'allow_collection' => 0,
                    'allow_delivery' => 0,
                    'allow_table_service' => 1,
                ],
                [
                    'table'
                ]
            ],
            'table and delivery' => [
                [
                    'allow_collection' => 0,
                    'allow_delivery' => 1,
                    'allow_table_service' => 1,
                ],
                [
                    'table',
                    'delivery',
                ]
            ],
            'table and collection' => [
                [
                    'allow_collection' => 1,
                    'allow_delivery' => 0,
                    'allow_table_service' => 1,
                ],
                [
                    'collection',
                    'table',
                ]
            ],
            'all' => [
                [
                    'allow_collection' => 1,
                    'allow_delivery' => 1,
                    'allow_table_service' => 1,
                ],
                [
                    'collection',
                    'table',
                    'delivery',
                ]
            ],
        ];
    }
}
