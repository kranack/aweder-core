<?php

namespace App\Http\Controllers\Api\Order;

use App\Contract\Repositories\OrderItemContract;
use App\Contract\Service\OrderContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\DeleteItemRequest;
use App\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class DeleteItemController
 * @package App\Http\Controllers\Api\Order
 */
class DeleteItemController extends Controller
{
    public function __invoke(
        Order $order,
        DeleteItemRequest $deleteItemRequest,
        OrderContract $orderService,
        OrderItemContract $orderItemRepository,
        int $itemId
    ): JsonResponse {
        $merchant = $deleteItemRequest->getMerchant();

        if (!$merchant) {
            return response()->json([
                'message' => 'Could not delete order item for merchant'
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!$orderService->doesOrderBelongToMerchant($order, $merchant)) {
            response()->json(['message' => 'Error matching Order and Merchant'], Response::HTTP_BAD_REQUEST);
        }

        $orderItem = $orderItemRepository->getOrderItemByOrderAndId($order, $itemId);

        if (!$orderItem) {
            return response()->json([
                'message' => 'Could not find correct Order and Order item'
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!$orderItemRepository->deleteOrderItem($orderItem)) {
            return response()->json([
                'message' => 'Could not delete item'
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['message' => 'Item deleted'], Response::HTTP_OK);
    }
}
