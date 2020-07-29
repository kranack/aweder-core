<?php

namespace App\Http\Middleware\Api;

use App\Merchant;
use Closure;
use Illuminate\Http\Response;

class ApiWithMerchant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $merchant = Merchant::whereUrlSlug($request->merchant)->first();

        if (!$merchant) {
            return response()->json(['message' => 'No merchant found'], Response::HTTP_BAD_REQUEST);
        }

        $request->merchant = $merchant;

        return $next($request);
    }
}
