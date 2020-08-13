<?php

namespace Tests\Unit\Service;

use App\NormalOpeningHour;
use App\Contract\Service\NormalOpeningHoursContract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class NormalOpeningHoursServiceTest
 * @package Tests\Services
 * @coversDefaultClass \App\Service\NormalOpeningHoursService
 */
class NormalOpeningHoursServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var NormalOpeningHoursContract
     */
    protected NormalOpeningHoursContract $openingHoursService;

    public function setUp(): void
    {
        parent::setUp();
        $this->openingHoursService = $this->app->make(NormalOpeningHoursContract::class);
    }

    /**
     * @test
     */
    public function canGetOpeningHoursForMerchant(): void
    {
        $merchant = $this->createAndReturnMerchant();

        factory(NormalOpeningHour::class)->create(
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 2,
                'open_time' => '09:00',
                'close_time' => '18:00',
                'is_delivery_hours' => 1
            ]
        );

        factory(NormalOpeningHour::class)->create(
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 3,
                'open_time' => '09:00',
                'close_time' => '18:00',
                'is_delivery_hours' => 0
            ]
        );

        $openingHours = $this->openingHoursService->getHoursByTypeAndMerchant(
            NormalOpeningHour::BUSINESS_HOURS_TYPE,
            $merchant
        );

        // [SIDE EFFECT] create merchant creates a default opening hour record, hence 2 not 3
        $this->assertCount(2, $openingHours);
    }

    /**
     * @test
     */
    public function canGetTableServiceHoursForMerchant(): void
    {
        $merchant = $this->createAndReturnMerchant();

        factory(NormalOpeningHour::class)->create(
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 2,
                'open_time' => '09:00',
                'close_time' => '18:00',
                'is_delivery_hours' => 1
            ]
        );

        factory(NormalOpeningHour::class)->create(
            [
                'merchant_id' => $merchant->id,
                'day_of_week' => 3,
                'open_time' => '09:00',
                'close_time' => '18:00',
                'is_delivery_hours' => 0
            ]
        );

        $openingHours = $this->openingHoursService->getHoursByTypeAndMerchant(
            NormalOpeningHour::TABLE_SERVICE_HOURS_TYPE,
            $merchant
        );

        $this->assertCount(1, $openingHours);
    }
}
