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
     * @param string $type
     * @param Merchant $merchant
     * @return Collection
     */
    public function getHoursByTypeAndMerchant(string $type, Merchant $merchant): Collection;
}
