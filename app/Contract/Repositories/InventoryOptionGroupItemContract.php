<?php

namespace App\Contract\Repositories;

use App\InventoryOptionGroup;
use App\InventoryOptionGroupItem;

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
}
