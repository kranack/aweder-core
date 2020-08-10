<?php

namespace App\Service;

use App\Contract\Repositories\InventoryContract;
use App\Contract\Repositories\MerchantContract;
use App\Contract\Service\InventoryOptionGroupItemContract;
use App\Contract\Service\OrderContract;
use App\Contract\Repositories\OrderContract as OrderRepositoryContract;
use App\Contract\Repositories\InventoryOptionGroupItemContract as InventoryOptionsRepository;
use App\Merchant;
use App\Order;
use App\OrderItem;
use Psr\Log\LoggerInterface;
use DB;

class OrderService implements OrderContract
{
    /**
     * @var OrderRepositoryContract
     */
    protected $orderRepository;

    /**
     * @var MerchantContract
     */
    protected $merchantRepository;

    /**
     * @var InventoryContract
     *
     */
    protected InventoryContract $inventoryRepository;

    /**
     * @var InventoryOptionGroupItemContract
     */
    protected InventoryOptionGroupItemContract $inventoryOptionGroupItemService;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var InventoryOptionsRepository
     */
    private InventoryOptionsRepository $inventoryOptionGroupItemRepository;

    public function __construct(
        OrderRepositoryContract $orderRepository,
        MerchantContract $merchantRepository,
        InventoryContract $inventoryRepository,
        InventoryOptionGroupItemContract $inventoryOptionGroupItemService,
        LoggerInterface $logger
    ) {
        $this->orderRepository = $orderRepository;
        $this->merchantRepository = $merchantRepository;
        $this->inventoryRepository = $inventoryRepository;
        $this->inventoryOptionGroupItemService = $inventoryOptionGroupItemService;
        $this->logger = $logger;
    }

    public function doesItemBelongToMerchant(int $merchantId, int $itemId): bool
    {
        return $this->inventoryRepository->doesMerchantOwnItem($merchantId, $itemId);
    }

    public function createNewOrderForMerchant(Merchant $merchant): Order
    {
        return $this->orderRepository->createEmptyOrderWithStatus($merchant->id, 'incomplete');
    }

    public function retrieveCurrentOrderForMerchant(Merchant $merchant, string $orderNo): Order
    {
        return $this->orderRepository->retrieveOrderForMerchantByOrderNo($merchant->id, $orderNo);
    }

    public function addItemToOrder(Order $order, Merchant $merchant, int $itemId): bool
    {
        if (!$this->doesOrderAlreadyContainItem($order, $itemId)) {
            $inventoryItem = $this->inventoryRepository->getItemById($itemId);

            if ($inventoryItem->merchant_id === $merchant->id) {
                return $this->orderRepository->addInventoryItemToOrder($order, $inventoryItem, 1);
            }

            return false;
        }

        return $this->orderRepository->updateQuantityOnItemInOrder($order, $itemId);
    }

    public function removeItemFromOrder(Order $order, Merchant $merchant, int $itemId): bool
    {
        $inventoryItem = $this->inventoryRepository->getItemById($itemId);

        if ($inventoryItem->merchant_id === $merchant->id) {
            return $this->orderRepository->removeItemFromOrder($order, $itemId);
        }

        return false;
    }

    public function doesOrderAlreadyContainItem(Order $order, int $itemId): bool
    {
        $order->load('items');

        if ($order->items->isEmpty()) {
            return false;
        }

        $found = false;

        foreach ($order->items as $item) {
            if ($itemId === $item->inventory_id) {
                $found = true;
            }
        }

        return $found;
    }

    public function updateOrderTotal(Order $order): void
    {
        $total = 0;

        $order->load(['items']);

        foreach ($order->items as $item) {
            $total += $item->price * $item->quantity;
        }

        $order->total_cost = $total;

        $order->save();
    }

    public function hasOrderBeenPreviouslySubmitted(Order $order): bool
    {
        return $this->orderRepository->hasOrderBeenPreviouslySubmitted($order);
    }

    public function hasOrderGonePastStage(Order $order, string $newStatusToChangeTo): bool
    {
        return $this->orderRepository->hasOrderGonePastStage($order, $newStatusToChangeTo);
    }

    public function updateOrderStatus(Order $order, string $orderStatus): bool
    {
        return $this->orderRepository->updateOrderStatus($order, $orderStatus);
    }

    public function attachCustomerNoteToOrder(Order $order, string $customerNote): void
    {
        $this->orderRepository->attachNoteToOrder($order, 'customer_note', $customerNote);
    }

    public function attachMerchantNoteToOrder(Order $order, string $rejectReason): bool
    {
        return $this->orderRepository->attachNoteToOrder($order, 'merchant_note', $rejectReason);
    }

    public function storeCustomerDetailsOnOrder(Order $order, array $customerDetails = []): bool
    {
        return $this->orderRepository->storeCustomerDetailsOnOrder($order, $customerDetails);
    }

    public function doesOrderBelongToMerchant(Order $order, Merchant $merchant): bool
    {
        return $order->merchant_id === $merchant->id;
    }

    public function addOrderItemToOrderFromApiPayload(Order $order, array $apiPayload): bool
    {
        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->fill($apiPayload);

        if (isset($apiPayload['inventory_options'])) {
            $belongsToMerchant = $this->inventoryOptionGroupItemService->validateOrderItemsBelongToMerchant(
                collect($apiPayload['inventory_options']),
                $order->merchant()->first()
            );

            if (!$belongsToMerchant) {
                return false;
            }
        }

        DB::beginTransaction();

        if (!$this->orderRepository->addOrderItemToOrder($order, $orderItem)) {
            // Nothing to rollback yet, so not required here.
            return false;
        }

        if (isset($apiPayload['inventory_options'])) {
            if (!$orderItem->inventoryOptions()->sync($apiPayload['inventory_options'])) {
                DB::rollBack();
                return false;
            }
        }

        DB::commit();

        return true;
    }
}
