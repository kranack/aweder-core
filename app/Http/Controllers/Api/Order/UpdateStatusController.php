<?php

namespace App\Http\Controllers\Api\Order;

use App\Contract\Repositories\OrderContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\OrderStatusUpdateRequest;
use App\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class UpdateStatusController
 * @package App\Http\Controllers\Api\Order
 */
class UpdateStatusController extends Controller
{
    public function __invoke(
        Order $order,
        OrderStatusUpdateRequest $request,
        OrderContract $orderRepository
    ): JsonResponse {
        if (!$request->getMerchant()) {
            return response()->json(['message' => 'Merchant does not exist'], Response::HTTP_BAD_REQUEST);
        }

        if (!$orderRepository->updateOrderStatus($order, $request->get('status'))) {
            return response()->json(
                [
                    'message' => 'There was an error updating the order.'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        return response()->json(['message' => 'Updated order status.'], Response::HTTP_OK);
    }
}
