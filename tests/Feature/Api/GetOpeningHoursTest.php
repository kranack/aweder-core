<?php

namespace Tests\Feature\Api;

use App\NormalOpeningHour;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class GetOpeningHoursTest
 * @package Tests\Feature\Api
 * @group Order
 */
class GetOpeningHoursTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function canViewOpeningHours(): void
    {
        $merchant = $this->createAndReturnMerchant();

        factory(NormalOpeningHour::class)->create(
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 2,
                'open_time' => '10:00',
                'close_time' => '21:00',
                'is_delivery_hours' => 1
            ]
        );

        factory(NormalOpeningHour::class)->create(
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 3,
                'open_time' => '10:00',
                'close_time' => '21:00',
                'is_delivery_hours' => 1
            ]
        );

        factory(NormalOpeningHour::class)->create(
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 4,
                'open_time' => '10:00',
                'close_time' => '21:00',
                'is_delivery_hours' => 0
            ]
        );

        $response = $this->json(
            'GET',
            'api/v1/merchant/' . $merchant->url_slug . '/openinghours?type=business_hours'
        );

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['day_of_week' => 2]);
        $response->assertJsonFragment(['day_of_week' => 3]);
        $response->assertJsonMissing(['day_of_week' => 5]);
    }

    /**
     * @test
     */
    public function canGetDefaultOpeningHours(): void
    {
        $merchant = $this->createAndReturnMerchant();

        factory(NormalOpeningHour::class)->create(
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 2,
                'open_time' => '10:00',
                'close_time' => '21:00',
                'is_delivery_hours' => 1
            ]
        );

        factory(NormalOpeningHour::class)->create(
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 3,
                'open_time' => '10:00',
                'close_time' => '21:00',
                'is_delivery_hours' => 1
            ]
        );

        factory(NormalOpeningHour::class)->create(
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 4,
                'open_time' => '10:00',
                'close_time' => '21:00',
                'is_delivery_hours' => 0
            ]
        );

        $response = $this->json(
            'GET',
            'api/v1/merchant/' . $merchant->url_slug . '/openinghours'
        );

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['day_of_week' => 2]);
        $response->assertJsonFragment(['day_of_week' => 3]);
        $response->assertJsonMissing(['day_of_week' => 5]);
    }

    /**
     * @test
     */
    public function canViewTableServiceHours(): void
    {
        $merchant = $this->createAndReturnMerchant();

        factory(NormalOpeningHour::class)->create(
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 2,
                'open_time' => '10:00',
                'close_time' => '21:00',
                'is_delivery_hours' => 1
            ]
        );

        factory(NormalOpeningHour::class)->create(
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 3,
                'open_time' => '10:00',
                'close_time' => '21:00',
                'is_delivery_hours' => 1
            ]
        );

        factory(NormalOpeningHour::class)->create(
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 4,
                'open_time' => '10:00',
                'close_time' => '21:00',
                'is_delivery_hours' => 0
            ]
        );

        $response = $this->json(
            'GET',
            'api/v1/merchant/' . $merchant->url_slug . '/openinghours?type=table_service'
        );

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['day_of_week' => 4]);
        $response->assertJsonMissing(['day_of_week' => 3]);
        $response->assertJsonMissing(['day_of_week' => 2]);
    }
}
