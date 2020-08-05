<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class ShowController
 * @package App\Http\Controllers\Api\Order
 */
class ShowController extends Controller
{
    /**
     * @param Order $order
     * @param OrderContract $orderService
     * @return JsonResponse
     */
    public function __invoke(Order $order): JsonResponse
    {
        return response()->json($order, Response::HTTP_OK);
    }
}
