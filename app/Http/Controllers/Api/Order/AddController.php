<?php

namespace App\Http\Controllers\Api\Order;

use App\Contract\Service\OrderContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\ApiAddItemToOrderRequest;
use App\Merchant;
use App\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class AddController
 * @package App\Http\Controllers\Api\Order
 */
class AddController extends Controller
{
    /**
     * @param Order $order
     * @param ApiAddItemToOrderRequest $request
     * @param OrderContract $orderService
     * @return JsonResponse
     */
    public function __invoke(Order $order, ApiAddItemToOrderRequest $request, OrderContract $orderService): JsonResponse
    {
        $apiPayload = $request->validated();
        $merchant = Merchant::whereUrlSlug($apiPayload['merchant'])->first();

        if (!$merchant) {
            return response()->json([
                'message' => 'This store does not exist.'
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!$orderService->doesItemBelongToMerchant($merchant->id, $apiPayload['inventory_id'])) {
            return response()->json([
                'message' => 'The item you appear to be adding doesn\'t belong to this store.'
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($orderService->addOrderItemToOrderFromApiPayload($order, $apiPayload)) {
            $orderService->updateOrderTotal($order);
            return response()->json($order, Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'There was an error adding the item to your order'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
