<?php

namespace App\Contract\Repositories;

use App\InventoryOptionGroupItem;
use App\OrderItem;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface OrderItemContract
 * @package App\Contract\Repositories
 */
interface OrderItemContract
{
    /**
     * @return Collection|null
     */
    public function getOrderItemsWithMissingVariantIds(): ?Collection;

    /**
     * @param OrderItem $orderItem
     * @param InventoryOptionGroupItem $inventoryOptionGroupItem
     * @return bool
     */
    public function addOptionToOrderItem(
        OrderItem $orderItem,
        InventoryOptionGroupItem $inventoryOptionGroupItem
    ): bool;
}
