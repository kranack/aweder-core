<?php

namespace App\Http\Controllers\Api\Order;

use App\Contract\Service\OrderContract;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AddController
 * @package App\Http\Controllers\Api\Order
 */
class AddController extends Controller
{
    /**
     * @param Order $order
     * @param Request $request
     * @param OrderContract $orderService
     * @return JsonResponse
     */
    public function __invoke(Order $order, Request $request, OrderContract $orderService): JsonResponse
    {
        $merchant = $request->merchant;

        if (!$orderService->doesItemBelongToMerchant($merchant->id, $request->get('inventory_id'))) {
            return response()->json([
                'message' => 'The item you appear to be adding doesnt belong to this store.'
            ], 400);
        }

        $apiPayload = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        try {
            $orderService->addOrderItemToOrderFromApiPayload($order, $apiPayload);
            $orderService->updateOrderTotal($order);
            return response()->json($order, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'There was an error adding the item to your order'
            ], 422);
        }
    }
}
