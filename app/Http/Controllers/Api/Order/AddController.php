<?php

namespace App\Http\Controllers\Api\Order;

use App\Contract\Service\OrderContract;
use App\Http\Controllers\Controller;
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
     * @param Request $request
     * @param OrderContract $orderService
     * @return JsonResponse
     */
    public function __invoke(Order $order, Request $request, OrderContract $orderService): JsonResponse
    {
        $merchant = $request->merchant;

        if (!$orderService->doesItemBelongToMerchant($merchant->id, $request->get('inventory_id'))) {
            return response()->json([
                'message' => 'The item you appear to be adding doesn\'t belong to this store.'
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($orderService->addOrderItemToOrderFromApiPayload($order, $request->input())) {
            $orderService->updateOrderTotal($order);
            return response()->json($order, Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'There was an error adding the item to your order'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
