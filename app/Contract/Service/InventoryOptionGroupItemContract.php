<?php

namespace App\Contract\Service;

use App\Merchant;
use Illuminate\Support\Collection;

interface InventoryOptionGroupItemContract
{
    /**
     * Uses a count query to check that the given IDs belong to the merchant
     * @param Merchant $merchant
     * @param Collection $inventoryOptions
     * @return bool
     */
    public function validateOrderItemsBelongToMerchant(Merchant $merchant, Collection $inventoryOptions): bool;

    /**
     * @param array $ids
     * @return Collection|null
     */
    public function getItemsFromIdArray(array $ids): ?Collection;
}
