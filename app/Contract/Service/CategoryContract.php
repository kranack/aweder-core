<?php

namespace App\Contract\Service;

use App\Merchant;

interface CategoryContract
{
    /**
     * @param Merchant $merchant
     * @param array $payload
     * @return bool
     */
    public function addCategoriesAndSubCategoriesToMerchantFromPayload(Merchant $merchant, array $payload): bool;
}
