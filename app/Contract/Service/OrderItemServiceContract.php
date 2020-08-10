<?php

namespace App\Contract\Service;

use App\OrderItem;
use Illuminate\Support\Collection;

interface OrderItemServiceContract
{
    /**
     * Removes all options then readds them to the OrderItem from Collection of IDs
     * @param OrderItem $orderItem
     * @param Collection $inventoryOptions
     * @return bool
     */
    public function updateOrderItemOptions(OrderItem $orderItem, Collection $inventoryOptions): bool;

    /**
     * @param OrderItem $orderItem
     * @param Collection $payload
     * @return bool
     */
    public function updateOrderItemWithPayload(OrderItem $orderItem, Collection $payload): bool;
}
