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
    protected $model;

    /**
     * @var LoggerInterface
     */
    protected $logger;

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
        InventoryOptionGroup $inventoryOptionGroup,
        Inventory $inventory
    ): InventoryOptionGroup {
        $inventory->optionGroups()->save($inventoryOptionGroup);

        return $inventoryOptionGroup;
    }
}
