<?php

namespace App\Repository;

use App\Contract\Repositories\InventoryOptionGroupItemContract;
use App\InventoryOptionGroup;
use App\InventoryOptionGroupItem;
use App\Merchant;
use App\Traits\HelperTrait;
use Illuminate\Support\Collection;
use Psr\Log\LoggerInterface;

class InventoryOptionGroupItemRepository implements InventoryOptionGroupItemContract
{
    use HelperTrait;

    /**
     * @var InventoryOptionGroupItem
     */
    protected InventoryOptionGroupItem $model;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

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

    /**
     * @param array $inventoryOptions
     * @return Collection|null
     */
    public function getItemsFromIdArray(array $inventoryOptions): ?Collection
    {
        return $this->getModel()
            ->whereIn('id', $inventoryOptions)
            ->get();
    }

    public function getItemCountByIdForMerchant(Collection $itemIds, Merchant $merchant): int
    {
        return $this->getModel()
            ->join(
                'inventory_option_groups',
                'inventory_option_groups.id',
                '=',
                'inventory_option_group_items.inventory_option_group_id'
            )
            ->join(
                'inventories',
                'inventories.id',
                '=',
                'inventory_option_groups.inventory_id'
            )
            ->where('inventories.merchant_id', $merchant->id)
            ->whereIn('inventory_option_group_items.id', $itemIds)
            ->count();
    }
}
