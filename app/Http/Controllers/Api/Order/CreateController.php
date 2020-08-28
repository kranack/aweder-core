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

        if (!$merchant) {
            return response()->json([
                'message' => 'Could not create order for merchant'
            ], Response::HTTP_BAD_REQUEST);
        }

        $order = $orderService->createNewOrderForMerchant($merchant);

        if ($request->has('table_number')) {
            $orderService->setTableNumberOnOrder($order, $request->get('table_number'));
        }

        if (!$order instanceof Order) {
            return response()->json([
                'message' => 'Could not create order for merchant.'
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json($order->fresh(), Response::HTTP_CREATED);
    }
}
