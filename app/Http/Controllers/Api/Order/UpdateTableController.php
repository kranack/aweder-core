<?php

namespace App\Http\Controllers\Api\Order;

use App\Contract\Service\OrderContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\ChangeTableRequest;
use App\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class CreateController
 * @package App\Http\Controllers\Api\Order
 */
class UpdateTableController extends Controller
{
    public function __invoke(Order $order, ChangeTableRequest $request, OrderContract $orderService): JsonResponse
    {
        $merchant = $request->getMerchant();

        if (!$merchant) {
            return response()->json([
                'message' => 'Could not update table number.'
            ], Response::HTTP_BAD_REQUEST);
        }

        if (!$orderService->setTableNumberOnOrder($order, $request->get('table_number'))) {
            return response()->json([
                'message' => 'Could not update table number.'
            ], Response::HTTP_NOT_ACCEPTABLE);
        }

        return response()->json($order, Response::HTTP_OK);
    }
}
