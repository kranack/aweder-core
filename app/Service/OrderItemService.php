<?php

namespace App\Service;

use App\Contract\Service\OrderItemServiceContract;
use App\OrderItem;
use Illuminate\Support\Collection;
use Psr\Log\LoggerInterface;

class OrderItemService implements OrderItemServiceContract
{
    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var InventoryOptionGroupItemService
     */
    protected InventoryOptionGroupItemService $inventoryOptionGroupItemService;

    public function __construct(
        InventoryOptionGroupItemService $inventoryOptionGroupItemService,
        LoggerInterface $logger
    ) {
        $this->inventoryOptionGroupItemService = $inventoryOptionGroupItemService;
        $this->logger = $logger;
    }

    public function updateOrderItemOptions(OrderItem $orderItem, Collection $inventoryOptions): bool
    {
        $isUpdateValid = $this->inventoryOptionGroupItemService->validateOrderItemsBelongToMerchant(
            $orderItem->getMerchant(),
            $inventoryOptions
        );

        if (!$isUpdateValid) {
            return false;
        }

        if (!$orderItem->inventoryOptions()->sync($inventoryOptions->toArray())) {
            return false;
        }

        return true;
    }

    public function updateOrderItemWithPayload(OrderItem $orderItem, Collection $payload): bool
    {
        $orderItem->fill($payload->toArray());

        if (isset($payload['inventory_options'])) {
            if (!$this->updateOrderItemOptions($orderItem, collect($payload['inventory_options']))) {
                return false;
            }
        }

        return $orderItem->save();
    }
}
