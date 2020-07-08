<?php

namespace App\Http\Middleware;

use App\Order;
use Closure;
use Route;

class IsCorrectOrderTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = Route::currentRouteName();
        $order = Order::whereUrlSlug($request->order_no)->first();

        if (!$order instanceof Order) {
            return $next($request);
        }

        if ($order->orderType() === Order::ORDER_TYPE_TABLE_SERVICE && $route !== 'store.table-order.order.add') {
            $request->session()->flash('error', 'Cannot add takeaway menu item to Table Service Order');

            return redirect()->back();
        }

        return $next($request);
    }
}
