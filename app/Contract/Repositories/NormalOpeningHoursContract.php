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
    public function getBusinessHoursForMerchant(int $merchantId): Collection;

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
     * @param Merchant $merchant
     * @param Collection $hours
     * @return bool
     */
    public function updateBusinessOpeningHoursByMerchant(Merchant $merchant, Collection $hours): bool;

    /**
     * @param Merchant $merchant
     * @param Collection $hours
     * @return bool
     */
    public function updateTableServiceHoursByMerchant(Merchant $merchant, Collection $hours): bool;
}
