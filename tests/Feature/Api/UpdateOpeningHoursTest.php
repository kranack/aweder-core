<?php

namespace Tests\Feature\Api;

use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class UpdateOpeningHoursTest
 * @package Tests\Feature\Api
 * @group Merchant
 */
class UpdateOpeningHoursTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function canApiUpdateOpeningHours(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $existingOpeningHour = $merchant->openingHours()->get()->first();
        $existingOpeningHour->day_of_week = 5;
        $existingOpeningHour->save();

        // Times are default, set by factory
        $this->assertDatabaseHas(
            'normal_opening_hours',
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 5,
                'open_time' => '09:00:00',
                'close_time' => '17:00:00',
                'is_delivery_hours' => 1
            ]
        );

        $response = $this->postJson(
            'api/v1/merchant/' . $merchant->url_slug . '/openinghours',
            [
                'type' => 'business_hours',
                'opening_hours' => [
                    [
                        'day_of_week' => 5,
                        'open_time' => '09:00',
                        'close_time' => '16:00'
                    ],
                    [
                        'day_of_week' => 6,
                        'open_time' => '10:00',
                        'close_time' => '17:00'
                    ],
                    [
                        'day_of_week' => 7,
                        'open_time' => '11:00',
                        'close_time' => '18:00'
                    ]
                ]
            ]
        );
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas(
            'normal_opening_hours',
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 5,
                'open_time' => '09:00:00',
                'close_time' => '16:00:00',
                'is_delivery_hours' => 1
            ]
        );
        $this->assertDatabaseHas(
            'normal_opening_hours',
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 6,
                'open_time' => '10:00:00',
                'close_time' => '17:00:00',
                'is_delivery_hours' => 1
            ]
        );
        $this->assertDatabaseHas(
            'normal_opening_hours',
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 7,
                'open_time' => '11:00:00',
                'close_time' => '18:00:00',
                'is_delivery_hours' => 1
            ]
        );
    }

    /**
     * @test
     */
    public function canApiUpdateTableServiceHours(): void
    {
        $merchant = $this->createAndReturnMerchant();

        $response = $this->postJson(
            'api/v1/merchant/' . $merchant->url_slug . '/openinghours',
            [
                'type' => 'table_service',
                'opening_hours' => [
                    [
                        'day_of_week' => 5,
                        'open_time' => '09:00',
                        'close_time' => '16:00'
                    ],
                    [
                        'day_of_week' => 6,
                        'open_time' => '10:00',
                        'close_time' => '17:00',
                    ],
                    [
                        'day_of_week' => 7,
                        'open_time' => '11:00',
                        'close_time' => '18:00'
                    ]
                ]
            ]
        );

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas(
            'normal_opening_hours',
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 5,
                'open_time' => '09:00:00',
                'close_time' => '16:00:00',
                'is_delivery_hours' => 0
            ]
        );
        $this->assertDatabaseHas(
            'normal_opening_hours',
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 6,
                'open_time' => '10:00:00',
                'close_time' => '17:00:00',
                'is_delivery_hours' => 0
            ]
        );
        $this->assertDatabaseHas(
            'normal_opening_hours',
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 7,
                'open_time' => '11:00:00',
                'close_time' => '18:00:00',
                'is_delivery_hours' => 0
            ]
        );
    }

    /**
     * @test
     */
    public function cannotUpdateOpeningHoursWithUndefinedType(): void
    {
        $merchant = $this->createAndReturnMerchant();

        $response = $this->postJson(
            'api/v1/merchant/' . $merchant->url_slug . '/openinghours',
            [
                'type' => 'blurnsball',
                'opening_hours' => [
                    [
                        'day_of_week' => 5,
                        'open_time' => '09:00',
                        'close_time' => '16:00'
                    ],
                    [
                        'day_of_week' => 6,
                        'open_time' => '10:00',
                        'close_time' => '17:00',
                    ],
                    [
                        'day_of_week' => 7,
                        'open_time' => '11:00',
                        'close_time' => '18:00'
                    ]
                ]
            ]
        );

        $response->assertStatus(Response::HTTP_BAD_REQUEST);

        $this->assertDatabaseMissing(
            'normal_opening_hours',
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 5,
                'open_time' => '09:00:00',
                'close_time' => '16:00:00',
                'is_delivery_hours' => 0
            ]
        );
        $this->assertDatabaseMissing(
            'normal_opening_hours',
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 6,
                'open_time' => '10:00:00',
                'close_time' => '17:00:00',
                'is_delivery_hours' => 0
            ]
        );
        $this->assertDatabaseMissing(
            'normal_opening_hours',
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 7,
                'open_time' => '11:00:00',
                'close_time' => '18:00:00',
                'is_delivery_hours' => 0
            ]
        );
    }
}
