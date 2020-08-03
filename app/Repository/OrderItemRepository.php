<?php

namespace App\Repository;

use App\Contract\Repositories\OrderItemContract;
use App\InventoryOptionGroupItem;
use App\OrderItem;
use Illuminate\Database\Eloquent\Collection;
use Psr\Log\LoggerInterface;

/**
 * Class OrderItemRepository
 * @package App\Repository
 */
class OrderItemRepository implements OrderItemContract
{
    protected OrderItem $model;

    protected LoggerInterface $logger;

    /**
     * OrderItemRepository constructor.
     * @param \App\OrderItem $model
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(OrderItem $model, LoggerInterface $logger)
    {
        $this->model = $model;

        $this->logger = $logger;
    }

    public function getModel(): OrderItem
    {
        return $this->model;
    }

    public function getOrderItemsWithMissingVariantIds(): ?Collection
    {
        return $this->getModel()
            ->where('variant_id', '=', null)
            ->get();
    }

    public function addOptionToOrderItem(
        OrderItem $orderItem,
        InventoryOptionGroupItem $inventoryOptionGroupItem
    ): bool {
        $return = $orderItem->inventoryOptions()->save($inventoryOptionGroupItem);

        return $return instanceof InventoryOptionGroupItem;
    }
}
