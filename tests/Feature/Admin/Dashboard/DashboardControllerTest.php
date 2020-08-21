<?php

namespace Tests\Feature\Admin\Dashboard;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

/**
 * Class DashboardControllerTest
 * @package Tests\Feature\Admin\Dashboard
 * @coversDefaultClass \App\Http\Controllers\Admin\Dashboard\DashboardController
 * @group Dashboard
 */
class DashboardControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_cant_access_dashboard_without_being_logged_in(): void
    {
        $order = $this->createAndReturnOrderForStatus('Purchased Order');

        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function authorised_user_can_view_empty_dashboard(): void
    {
        $user = factory(User::class)->create();

        $merchantOne = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $user->merchants()->attach($merchantOne->id);

        $this->actingAs($user);

        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertSeeText('Dashboard');

        $response->assertDontSee('Ordered');
    }

    /**
     * @test
     */
    public function authorised_user_cant_view_other_merchants_orders(): void
    {
        $user = factory(User::class)->create();

        $merchantOne = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $merchantTwo = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $order = $this->createAndReturnOrderForStatus('Purchased Order', ['merchant_id' => $merchantTwo->id]);

        $user->merchants()->attach($merchantOne->id);

        $this->actingAs($user);

        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertSeeText('Dashboard');

        $response->assertDontSee('Ordered');
    }

    /**
     * @test
     */
    public function authorised_user_can_view_orders_that_belongs_to_them(): void
    {
        $user = factory(User::class)->create();

        $merchantOne = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $this->createAndReturnOrderForStatus('Purchased Order', ['merchant_id' => $merchantOne->id]);

        $user->merchants()->attach($merchantOne->id);

        $this->actingAs($user);

        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertSeeText('Dashboard');

        $response->assertSeeText('Ordered');
    }

    /**
     * @test
     */
    public function filtered_orders_only_show_filtered_items(): void
    {
        $user = factory(User::class)->create();

        $merchantOne = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $order = $this->createAndReturnOrderForStatus('Rejected Order', ['merchant_id' => $merchantOne->id]);

        $orderTwo = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchantOne->id]);

        $user->merchants()->attach($merchantOne->id);

        $this->actingAs($user);

        $response = $this->get(route('admin.dashboard', ['status' => 'Completed']));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertSeeText('Dashboard');

        $response->assertSee('href="' . route('admin.view-order', $orderTwo->url_slug) . '"', false);

        $response->assertDontSee('href="' . route('admin.view-order', $order->url_slug) . '"', false);
    }

    /**
     * @test
     */
    public function all_items_come_back_on_incorrect_filter(): void
    {
        $user = factory(User::class)->create();

        $merchantOne = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $order = $this->createAndReturnOrderForStatus('Purchased Order', ['merchant_id' => $merchantOne->id]);

        $orderTwo = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchantOne->id]);

        $user->merchants()->attach($merchantOne->id);

        $this->actingAs($user);

        $response = $this->get(route('admin.dashboard', ['status' => 'fulfilled']));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertSeeText('Dashboard');

        $response->assertSee('href="' . route('admin.view-order', $orderTwo->url_slug) . '"', false);

        $response->assertSee('href="' . route('admin.view-order', $order->url_slug) . '"', false);
    }
}
