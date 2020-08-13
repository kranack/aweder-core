<?php

namespace App\Contract\Service;

use App\Merchant;
use App\NormalOpeningHour;
use Illuminate\Support\Collection;

/**
 * Interface NormalOpeningHoursContract
 * @package App\Contract\Service
 */
interface NormalOpeningHoursContract
{
    public function getHoursByTypeAndMerchant(
        Merchant $merchant,
        $type
    ): Collection;
}
