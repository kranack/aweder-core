<?php

namespace App\Contract\Service;

use App\Merchant;
use Illuminate\Support\Collection;

/**
 * Interface NormalOpeningHoursContract
 * @package App\Contract\Service
 */
interface NormalOpeningHoursContract
{
    /**
     * Service wrapper to call the correct repository method
     * @param Merchant $merchant
     * @param $type
     * @return Collection
     */
    public function getHoursByTypeAndMerchant(
        Merchant $merchant,
        $type
    ): Collection;

    /**
     * Update the Merchant's hours from an array and by type
     * @param array $hours
     * @param string $type
     * @param Merchant $merchant
     * @return bool
     */
    public function updateHoursByTypeAndMerchant(
        array $hours,
        string $type,
        Merchant $merchant
    ): bool;
}
