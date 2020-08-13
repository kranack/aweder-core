<?php

namespace App\Http\Controllers\Api\Merchant;

use App\Http\Controllers\Controller;
use App\Merchant;
use App\Contract\Service\NormalOpeningHoursContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class ShowOpeningHoursController
 * @package App\Http\Controllers\Api\Merchant
 */
class ShowOpeningHoursController extends Controller
{
    /**
     * @param Merchant $merchant
     * @param NormalOpeningHoursContract $hoursService
     * @return JsonResponse
     */
    public function __invoke(
        Merchant $merchant,
        NormalOpeningHoursContract $hoursService
    ): JsonResponse {
        return response()->json($merchant, Response::HTTP_OK);
    }
}
