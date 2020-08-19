<?php

namespace App\Http\Controllers\Api\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Resources\NormalOpeningHourResource;
use App\Merchant;
use App\Contract\Service\NormalOpeningHoursContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ShowOpeningHoursController
 * @package App\Http\Controllers\Api\Merchant
 */
class ShowOpeningHoursController extends Controller
{
    /**
     * @param Merchant $merchant
     * @param Request $request
     * @param NormalOpeningHoursContract $hoursService
     * @return JsonResponse
     */
    public function __invoke(
        Merchant $merchant,
        Request $request,
        NormalOpeningHoursContract $hoursService
    ): JsonResponse {
        $openingHours = $hoursService->getHoursByTypeAndMerchant($merchant, $request->get('type'));

        return response()->json(NormalOpeningHourResource::collection($openingHours), Response::HTTP_OK);
    }
}
