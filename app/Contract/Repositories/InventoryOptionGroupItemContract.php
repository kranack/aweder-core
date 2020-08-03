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

    /**
     * @param Collection $itemIds
     * @param Merchant $merchant
     * @return mixed
     */
    public function getItemCountByIdForMerchant(
        Collection $itemIds,
        Merchant $merchant
    );

    /**
     * @param array $ids
     * @return Collection|null
     */
    public function getItemsFromIdArray(array $ids): ?Collection;
}
