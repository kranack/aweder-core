<?php

namespace App\Http\Controllers\Api\Order;

use App\Contract\Service\OrderContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\ApiCreateOrderRequest;
use App\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class CreateController
 * @package App\Http\Controllers\Api\Order
 */
class CreateController extends Controller
{
    public function __invoke(ApiCreateOrderRequest $request, OrderContract $orderService): JsonResponse
    {
        $merchant = $request->getMerchant();
        $payload = $request->validated();

        if (!$merchant) {
            return response()->json([
                'message' => 'Could not create order for merchant'
            ], Response::HTTP_BAD_REQUEST);
        }

        $order = $orderService->createNewOrderForMerchant($merchant);

        if (isset($payload['is_table_service'])) {
            if ($payload['is_table_service'] === true) {
                $order->setTableService();
            }
        }

        if (isset($payload['table_number']) && !$order->isTableService()) {
            return response()->json([
                'message' => 'Cannot create order with table number unless Order is Table Service.'
            ], Response::HTTP_BAD_REQUEST);
        }

        if (isset($payload['table_number']) && $order->isTableService()) {
            $orderService->setTableNumberOnOrder($order, $payload['table_number']);
        }

        if ($order instanceof Order) {
            return response()->json($order->fresh(), Response::HTTP_CREATED);
        }

        return response()->json([
            'message' => 'Could not create order for merchant.'
        ], Response::HTTP_BAD_REQUEST);
    }
}
