<?php

namespace App\Http\Controllers\Api\Order;

use App\Contract\Repositories\OrderItemContract;
use App\Http\Controllers\Controller;
use App\Order;
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
     * @return JsonResponse
     */
    public function __invoke(Order $order, int $itemId, OrderItemContract $orderItemRepository): JsonResponse
    {
        // get the order item
        $orderItem = $orderItemRepository->getItemByOrderAndId($order, $itemId);

        if (!$orderItem) {
            response()->json(['message' => 'Could not find correct Order and Order item'], Response::HTTP_BAD_REQUEST);
        }

        // make sure the order item belongs to the order
        // update the order using the respository
        // profit
        return response()->json($order, Response::HTTP_OK);
    }
}
