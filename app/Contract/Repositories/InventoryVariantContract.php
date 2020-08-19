<?php

namespace App\Contract\Repositories;

use App\Inventory;
use App\InventoryVariant;

interface InventoryVariantContract
{
    /**
     * @param Inventory $inventory
     * @param InventoryVariant $inventoryVariant
     * @return InventoryVariant
     */
    public function addVariantToInventoryItem(
        Inventory $inventory,
        InventoryVariant $inventoryVariant
    ): InventoryVariant;
}
