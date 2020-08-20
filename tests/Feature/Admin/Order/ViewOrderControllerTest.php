<?php

namespace Tests\Feature\Admin\Order;

use App\Merchant;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

/**
 * Class ViewOrderControllerTest
 * @package Tests\Feature\Admin\Order
 * @coversDefaultClass \App\Http\Controllers\Admin\Order\ViewOrderController
 * @group Order
 *
 */
class ViewOrderControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * checks that a unauthenticated user cant view the route
     * @test
     */
    public function unauthenticated_user_cant_see_admin_order(): void
    {
        $order = $this->createAndReturnOrderForStatus('Purchased Order');

        $response = $this->get(route('admin.view-order', $order->url_slug));

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function authenticated_user_cant_view_other_merchants_orders(): void
    {
        $user = factory(User::class)->create();

        $merchantOne = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $user->merchants()->attach($merchantOne->id);

        $merchantTwo = $this->createAndReturnMerchant();

        $order = $this->createAndReturnOrderForStatus('Purchased Order', ['merchant_id' => $merchantTwo->id]);

        $this->actingAs($user);

        $response = $this->get(route('admin.view-order', $order->url_slug));

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertRedirect(route('admin.dashboard'));
    }

    /**
     * @test
     */
    public function authenticated_user_can_view_own_merchant_order(): void
    {
        $user = factory(User::class)->create();

        $merchantOne = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $user->merchants()->attach($merchantOne->id);

        $order = $this->createAndReturnOrderForStatus('Purchased Order', ['merchant_id' => $merchantOne->id]);

        $this->actingAs($user);

        $response = $this->get(route('admin.view-order', $order->url_slug));

        $response->assertStatus(Response::HTTP_OK);
    }
}
