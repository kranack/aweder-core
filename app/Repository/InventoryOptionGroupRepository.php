<?php

namespace App\Repository;

use App\Contract\Repositories\InventoryOptionGroupContract;
use App\Inventory;
use App\InventoryOptionGroup;
use App\Traits\HelperTrait;
use Psr\Log\LoggerInterface;

class InventoryOptionGroupRepository implements InventoryOptionGroupContract
{
    use HelperTrait;

    /**
     * @var InventoryOptionGroup
     */
    protected InventoryOptionGroup $model;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    public function __construct(InventoryOptionGroup $model, LoggerInterface $logger)
    {
        $this->model = $model;

        $this->logger = $logger;
    }

    protected function getModel(): InventoryOptionGroup
    {
        return $this->model;
    }

    public function addOptionGroupToInventoryItem(
        Inventory $inventory,
        InventoryOptionGroup $inventoryOptionGroup
    ): InventoryOptionGroup {
        $inventory->optionGroups()->save($inventoryOptionGroup);

        return $inventoryOptionGroup;
    }
}
