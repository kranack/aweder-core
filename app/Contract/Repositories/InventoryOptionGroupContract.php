<?php

namespace App\Contract\Repositories;

use App\Inventory;
use App\InventoryOptionGroup;

interface InventoryOptionGroupContract
{
    /**
     * @param Inventory $inventory
     * @param InventoryOptionGroup $inventoryOptionGroup
     * @return InventoryOptionGroup
     */
    public function addOptionGroupToInventoryItem(
        Inventory $inventory,
        InventoryOptionGroup $inventoryOptionGroup
    ): InventoryOptionGroup;
}
