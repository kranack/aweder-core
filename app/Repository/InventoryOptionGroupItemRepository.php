<?php

namespace App\Repository;

use App\Contract\Repositories\InventoryOptionGroupItemContract;
use App\InventoryOptionGroup;
use App\InventoryOptionGroupItem;
use App\Merchant;
use App\Traits\HelperTrait;
use Illuminate\Support\Collection;
use Psr\Log\LoggerInterface;
use DB;

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

    public function getItemCountByIdForMerchant(Collection $itemIds, Merchant $merchant): ?Collection
    {
        return $this->getModel()
            ->select('name', DB::raw('count(*) count'))
            ->where('merchant_id', $merchant->id)
            ->whereIn('id', $itemIds)
            ->groupBy('name')
            ->get();
    }
}
