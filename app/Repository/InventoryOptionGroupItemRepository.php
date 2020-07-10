<?php

namespace App\Repository;

use App\Contract\Repositories\InventoryOptionGroupItemContract;
use App\InventoryOptionGroup;
use App\InventoryOptionGroupItem;
use App\Traits\HelperTrait;
use Psr\Log\LoggerInterface;

class InventoryOptionGroupItemRepository implements InventoryOptionGroupItemContract
{
    use HelperTrait;

    /**
     * @var InventoryOptionGroupItem
     */
    protected $model;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(InventoryOptionGroupItem $model, LoggerInterface $logger)
    {
        $this->model = $model;

        $this->logger = $logger;
    }

    protected function getModel(): InventoryOptionGroupItem
    {
        return $this->model;
    }

    public function addItemToOptionGroup(
        InventoryOptionGroupItem $inventoryOptionGroupItem,
        InventoryOptionGroup $inventoryOptionGroup
    ): InventoryOptionGroupItem {
        $inventoryOptionGroup->items()->save($inventoryOptionGroupItem);

        return $inventoryOptionGroupItem;
    }
}
