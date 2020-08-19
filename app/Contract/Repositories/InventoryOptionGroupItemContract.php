<?php

namespace App\Contract\Repositories;

use App\InventoryOptionGroup;
use App\InventoryOptionGroupItem;
use App\Merchant;
use Illuminate\Support\Collection;

interface InventoryOptionGroupItemContract
{
    /**
     * @param InventoryOptionGroup $inventoryOptionGroupOptionGroup
     * @param InventoryOptionGroupItem $inventoryOptionGroupItemItem
     * @return InventoryOptionGroupItem
     */
    public function addItemToOptionGroup(
        InventoryOptionGroup $inventoryOptionGroupOptionGroup,
        InventoryOptionGroupItem $inventoryOptionGroupItemItem
    ): InventoryOptionGroupItem;

    /**
     * @param Merchant $merchant
     * @param Collection $itemIds
     * @return int
     */
    public function getItemCountByIdForMerchant(
        Merchant $merchant,
        Collection $itemIds
    ): int;

    /**
     * @param array $ids
     * @return Collection|null
     */
    public function getItemsFromIdArray(array $ids): Collection;
}
