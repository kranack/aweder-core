<?php

namespace App\Http\Controllers\Api\Order;

use App\Contract\Repositories\OrderItemContract;
use App\Contract\Service\OrderContract;
use App\Contract\Service\OrderItemServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\UpdateOrderItemRequest;
use App\Order;
use App\Service\InventoryOptionGroupItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class UpdateItemController
 * @package App\Http\Controllers\Api\Order
 */
class UpdateItemController extends Controller
{
    /**
     * @param Order $order
     * @param int $itemId
     * @param UpdateOrderItemRequest $request
     * @param OrderItemContract $orderItemRepository
     * @param OrderItemServiceContract $orderItemService
     * @param OrderContract $orderService
     * @return JsonResponse
     */
    public function __invoke(
        Order $order,
        int $itemId,
        UpdateOrderItemRequest $request,
        OrderItemContract $orderItemRepository,
        OrderItemServiceContract $orderItemService,
        OrderContract $orderService
    ): JsonResponse {
        $merchant = $request->getMerchant();

        if (!$merchant) {
            response()->json(['message' => 'Merchant does not exist'], Response::HTTP_BAD_REQUEST);
        }

        if (!$orderService->doesOrderBelongToMerchant($order, $merchant)) {
            response()->json(['message' => 'Error matching Order and Merchant'], Response::HTTP_BAD_REQUEST);
        }

        $orderItem = $orderItemRepository->getOrderItemByOrderAndId($order, $itemId);

        if (!$orderItem) {
            return response()->json(['message' => 'Could not find correct Order and Order item'], Response::HTTP_BAD_REQUEST);
        }

        if ($orderItemService->updateOrderItemWithPayload($orderItem, collect($request->validated()))) {
            return response()->json($orderItem->fresh(), Response::HTTP_OK);
        }

//        return response()->json($orderItem, Response::HTTP_OK);
    }
}
