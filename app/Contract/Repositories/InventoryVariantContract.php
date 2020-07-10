<?php

namespace App\Contract\Repositories;

use App\Inventory;
use App\InventoryVariant;

interface InventoryVariantContract
{
    /**
     * @param InventoryVariant $inventoryVariant
     * @param Inventory $inventory
     * @return InventoryVariant
     */
    public function addVariantToInventoryItem(
        InventoryVariant $inventoryVariant,
        Inventory $inventory
    ): InventoryVariant;
}
