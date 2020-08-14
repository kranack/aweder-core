<?php

namespace App\Http\Controllers\Api\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Merchant\UpdateOpeningHoursRequest;
use App\Merchant;
use App\Contract\Service\NormalOpeningHoursContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class ShowOpeningHoursController
 * @package App\Http\Controllers\Api\Merchant
 */
class UpdateOpeningHoursController extends Controller
{
    /**
     * @param Merchant $merchant
     * @param UpdateOpeningHoursRequest $request
     * @param NormalOpeningHoursContract $hoursService
     * @return JsonResponse
     */
    public function __invoke(
        Merchant $merchant,
        UpdateOpeningHoursRequest $request,
        NormalOpeningHoursContract $hoursService
    ): JsonResponse {
        $payload = $request->validated();
        $return = $hoursService->updateHoursByTypeAndMerchant($merchant, $payload['opening_hours'], $payload['type']);

        if (!$return) {
            return response()->json(['message' => 'Error updating hours'], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['message' => 'Updated Merchant hours'], Response::HTTP_OK);
    }
}
