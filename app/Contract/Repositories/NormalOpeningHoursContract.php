<?php

namespace App\Contract\Repositories;

use App\Merchant;
use App\NormalOpeningHour;
use Illuminate\Database\Eloquent\Collection;

interface NormalOpeningHoursContract
{
    /**
     * @param int $merchantId
     * @return Collection
     */
    public function createDefaultOpeningHoursForMerchant(int $merchantId): Collection;

    /**
     * @param int $merchantId
     * @return void
     */
    public function clearCurrentOpeningHoursForMerchant(int $merchantId): void;

    /**
     * @param array $days
     * @param int $merchantId
     * @return NormalOpeningHour|null
     */
    public function createNormalOpeningHours(array $days, int $merchantId): ?NormalOpeningHour;

    /**
     * returns the opening hours for the current merchant
     * @param int $merchantId
     * @return Collection
     */
    public function getOpeningHoursForMerchant(int $merchantId): Collection;

    /**
     * returns an array in a format that is useable on the frontend
     * @param Collection $openingHours
     * @return array
     */
    public function formatOpeningHoursForForm(Collection $openingHours): array;

    /**
     * Table service hours are worked out by is_delivery_hours being set to 0
     * @param Merchant $merchant
     * @return Collection
     */
    public function getTableServiceHoursForMerchant(Merchant $merchant): Collection;

    /**
     * @param Collection $hours
     * @param Merchant $merchant
     * @return bool
     */
    public function updateOpeningHoursByMerchant(Collection $hours, Merchant $merchant): bool;

    /**
     * @param Collection $hours
     * @param Merchant $merchant
     * @return bool
     */
    public function updateTableServiceHoursByMerchant(Collection $hours, Merchant $merchant): bool;
}
