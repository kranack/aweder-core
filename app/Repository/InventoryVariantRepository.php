<?php

namespace App\Repository;

use App\Contract\Repositories\InventoryVariantContract;
use App\Inventory;
use App\InventoryVariant;
use App\Traits\HelperTrait;
use Psr\Log\LoggerInterface;

class InventoryVariantRepository implements InventoryVariantContract
{
    use HelperTrait;

    /**
     * @var InventoryVariant
     */
    protected InventoryVariant $model;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    public function __construct(InventoryVariant $model, LoggerInterface $logger)
    {
        $this->model = $model;

        $this->logger = $logger;
    }

    protected function getModel(): InventoryVariant
    {
        return $this->model;
    }

    public function addVariantToInventoryItem(
        Inventory $inventory,
        InventoryVariant $inventoryVariant
    ): InventoryVariant {
        $inventory->variants()->save($inventoryVariant);

        return $inventoryVariant;
    }
}
