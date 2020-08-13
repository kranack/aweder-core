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
    public function getHoursByTypeAndMerchant(
        Merchant $merchant,
        $type
    ): Collection;
}
