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
    public function getOrderItemsWithMissingVariantIds(): ?Collection;

    public function addOptionToOrderItem(
        OrderItem $orderItem,
        InventoryOptionGroupItem $inventoryOptionGroupItem
    ): OrderItem;
}
