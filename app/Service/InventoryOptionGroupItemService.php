<?php

namespace App\Service;

use App\Contract\Repositories\InventoryOptionGroupItemContract as InventoryOptionGroupItemRepository;
use App\Contract\Service\InventoryOptionGroupItemContract;
use App\Merchant;
use Illuminate\Support\Collection;
use Psr\Log\LoggerInterface;

class InventoryOptionGroupItemService implements InventoryOptionGroupItemContract
{
    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var InventoryOptionGroupItemRepository
     */
    protected InventoryOptionGroupItemRepository $inventoryOptionGroupItemRepository;

    public function __construct(
        InventoryOptionGroupItemRepository $inventoryOptionGroupItemRepository,
        LoggerInterface $logger
    ) {
        $this->inventoryOptionGroupItemRepository = $inventoryOptionGroupItemRepository;
        $this->logger = $logger;
    }

    public function validateOrderItemsBelongToMerchant(Merchant $merchant, Collection $inventoryOptions): bool
    {
        return $inventoryOptions->count() === $this->
            inventoryOptionGroupItemRepository
                ->getItemCountByIdForMerchant($merchant, $inventoryOptions);
    }

    public function getItemsFromIdArray(array $ids): ?Collection
    {
        return $this->inventoryOptionGroupItemRepository->getItemsFromIdArray($ids);
    }
}
