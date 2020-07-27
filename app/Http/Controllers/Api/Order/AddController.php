<?php

namespace App\Http\Controllers\Api\Order;

use App\Contract\Service\OrderContract;
use App\Http\Controllers\Controller;
use App\Order;
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
     */
    public function __invoke(Order $order, Request $request, OrderContract $orderService)
    {
        $merchant = $request->merchant;

        // @TODO Refactor this to JSON responses & appropriate http status codes
        if (!$orderService->doesItemBelongToMerchant($merchant->id, $request->get('inventory_id'))) {
            $request->session()->flash('error', 'The item you appear to be adding doesnt belong to this store.');

            return redirect()->route('store.menu.view', [$merchant->url_slug]);
        }

        // @TODO refactor this to change the service to enable orderitems with inventory variants & options
        if ($orderService->addItemToOrder($order, $merchant, $request->get('item'))) {
            $orderService->updateOrderTotal($order);

            $request->session()->flash('success', 'The item has been added to your order');
        } else {
            $request->session()->flash('error', 'There was an error adding the item to your order');
        }
        return response('WIP Order add item endpoint');
    }
}
