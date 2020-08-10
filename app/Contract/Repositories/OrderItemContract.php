<?php

namespace App\Contract\Repositories;

use App\InventoryOptionGroupItem;
use App\Order;
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

    /**
     * @param Order $order
     * @param int $itemId
     * @return OrderItem|null
     */
    public function getOrderItemByOrderAndId(Order $order, int $itemId): ?OrderItem;

    /**
     * @param OrderItem $orderItem
     * @return bool
     */
    public function deleteOrderItem(OrderItem $orderItem): bool;
}
