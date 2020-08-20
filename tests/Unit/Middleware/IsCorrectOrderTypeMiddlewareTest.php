<?php

namespace Tests\Unit\Middleware;

use App\Merchant;
use App\Order;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Tests\TestCase;

/**
 * Class IsCorrectOrderTypeMiddlewareTest
 * @package Tests\Unit\Middleware
 * @coversDefaultClass \App\Http\Middleware\IsCorrectOrderTypeMiddlewareTest
 * @group Middleware
 */
class IsCorrectOrderTypeMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_add_table_service_item_to_table_service_order(): void
    {
        $user = factory(User::class)->create();
        $merchant = factory(Merchant::class)->create();
        $user->merchants()->attach($merchant->id);

        $order = factory(Order::class)->create([
            'status' => 'purchased',
            'is_table_service' => 1,
            'is_delivery' => 0,
            'is_collection' => 0,
            'merchant_id' => $merchant->id
        ]);

        $this->assertCount(0, $order->items()->get());

        $inventoryItem = $this->createAndReturnInventoryItem(['merchant_id' => $merchant->id]);

        $postData = [
            'order_no' => $order->url_slug,
            'item' => $inventoryItem->id
        ];

        $storeRoute = route('store.menu.view', $merchant->url_slug);
        $postRoute = route('store.table-order.order.add', $merchant->url_slug);
        $response = $this->from($storeRoute)->post($postRoute, $postData);

        $response->assertSessionHas('success', 'The item has been added to your order');
        $response->assertStatus(SymfonyResponse::HTTP_FOUND);
        $this->assertCount(1, $order->items()->get());
    }

    /**
     * @test
     */
    public function cannot_add_delivery_to_table_service_order(): void
    {
        $user = factory(User::class)->create();
        $merchant = factory(Merchant::class)->create();
        $user->merchants()->attach($merchant->id);

        $order = factory(Order::class)->create([
            'status' => 'purchased',
            'is_table_service' => 1,
            'is_delivery' => 0,
            'merchant_id' => $merchant->id
        ]);

        $this->assertCount(0, $order->items()->get());

        $inventoryItem = $this->createAndReturnInventoryItem(['merchant_id' => $merchant->id]);

        $postData = [
            'order_no' => $order->url_slug,
            'item' => $inventoryItem->id
        ];

        $storeRoute = route('store.menu.view', $merchant->url_slug);
        $postRoute = route('store.order.add', $merchant->url_slug);

        $response = $this->from($storeRoute)->post($postRoute, $postData);

        $response->assertSessionHas('error', 'Cannot add takeaway menu item to Table Service Order');
        $this->assertCount(0, $order->items()->get());
        $response->assertRedirect($storeRoute);
    }
}
