<?php

namespace App\Contract\Repositories;

use App\InventoryOptionGroup;
use App\InventoryOptionGroupItem;
use App\Merchant;
use Illuminate\Support\Collection;

interface InventoryOptionGroupItemContract
{
    /**
     * @param InventoryOptionGroupItem $inventoryOptionGroupItemItem
     * @param InventoryOptionGroup $inventoryOptionGroupOptionGroup
     * @return InventoryOptionGroupItem
     */
    public function addItemToOptionGroup(
        InventoryOptionGroupItem $inventoryOptionGroupItemItem,
        InventoryOptionGroup $inventoryOptionGroupOptionGroup
    ): InventoryOptionGroupItem;

    public function getItemCountByIdForMerchant(
        Collection $itemIds,
        Merchant $merchant
    ): ?Collection;
}
