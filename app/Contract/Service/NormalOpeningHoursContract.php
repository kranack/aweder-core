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
}
