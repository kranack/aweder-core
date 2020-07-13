<?php

namespace App\Contract\Repositories;

use App\Inventory;
use App\InventoryOptionGroup;

interface InventoryOptionGroupContract
{
    /**
     * @param InventoryOptionGroup $inventoryOptionGroup
     * @param Inventory $inventory
     * @return InventoryOptionGroup
     */
    public function addOptionGroupToInventoryItem(
        InventoryOptionGroup $inventoryOptionGroup,
        Inventory $inventory
    ): InventoryOptionGroup;
}
