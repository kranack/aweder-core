<?php

namespace App\Traits;

use App\Merchant;

trait RequestGetMerchantTrait
{
    /**
     * @return Merchant|null
     */
    public function getMerchant(): ?Merchant
    {
        return Merchant::whereUrlSlug($this->merchant)->first();
    }
}
