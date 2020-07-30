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
        $order = $orderService->createNewOrderForMerchant($merchant);

        if ($order instanceof Order) {
            return response()->json($order, Response::HTTP_CREATED);
        }

        return response()->json(['message' => 'Could not create order for merchant.'], Response::HTTP_BAD_REQUEST);
    }
}
