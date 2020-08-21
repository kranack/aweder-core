<?php

namespace Tests\Feature\Admin\Order;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

/**
 * Class MarkOrderAsFulfilledControllerTest
 * @package Tests\Feature\Admin\Order
 * @coversDefaultClass \App\Http\Controllers\Admin\Order\MarkOrderAsFulfilledController
 * @group MarkAsFilled
 */
class MarkOrderAsFulfilledControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;


    /**
     * checks that a unauthenticated user cant view the route
     * @test
     */
    public function unauthenticated_user_cant_reject_an_order(): void
    {

        $order = $this->createAndReturnOrderForStatus('Purchased Order');

        $response = $this->get(route('admin.order-fulfilled', $order->url_slug));

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function merchant_who_hasnt_finished_registration_cant_accept_order(): void
    {
        $user = factory(User::class)->create();

        $merchantOne = $this->createAndReturnMerchant(['registration_stage' => 3]);

        $user->merchants()->attach($merchantOne->id);

        $order = $this->createAndReturnOrderForStatus('Purchased Order', ['merchant_id' => $merchantOne->id]);

        $this->actingAs($user);

        $response = $this->get(route('admin.order-fulfilled', $order->url_slug));

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertRedirect(route('register.contact-details'));
    }

    /**
     * @test
     */
    public function merchant_cant_mark_order_as_fulfilled_if_they_dont_own_it(): void
    {
        $user = factory(User::class)->create();

        $merchantOne = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $user->merchants()->attach($merchantOne->id);

        $merchantTwo = $this->createAndReturnMerchant();

        $order = $this->createAndReturnOrderForStatus('Purchased Order', ['merchant_id' => $merchantTwo->id]);

        $this->actingAs($user);

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'status' => 'purchased',
            ]
        );

        $response = $this->get(route('admin.order-fulfilled', $order->url_slug));

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'status' => 'purchased',
            ]
        );
    }


    /**
     * @test
     * @group OwnOrder
     * This test covers the rejection of an order.
     */
    public function merchant_can_mark_their_own_order_as_fulffiled(): void
    {
        $user = factory(User::class)->create();

        $merchantOne = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $user->merchants()->attach($merchantOne->id);

        $order = $this->createAndReturnOrderForStatus(
            'Acknowledged Order',
            [
                'merchant_id' => $merchantOne->id
            ]
        );

        $this->actingAs($user);

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'status' => 'acknowledged',
            ]
        );

        $response = $this->from(route('admin.dashboard'))
            ->get(route('admin.order-fulfilled', $order->url_slug));

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertRedirect(route('admin.dashboard'));

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'status' => 'fulfilled',
            ]
        );
    }

    /**
     * @test
     * this makes sure the status cant be changed
     */
    public function merchant_cant_fulfill_an_order_thats_been_rejected(): void
    {
        $user = factory(User::class)->create();

        $merchantOne = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $user->merchants()->attach($merchantOne->id);

        $order = $this->createAndReturnOrderForStatus(
            'Rejected Order',
            [
                'merchant_id' => $merchantOne->id
            ]
        );

        $this->actingAs($user);

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'status' => 'rejected',
            ]
        );

        $response = $this->from(route('admin.dashboard'))
            ->get(route('admin.order-fulfilled', $order->url_slug));

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'status' => 'rejected',
            ]
        );
    }

    /**
     * @test
     */
    public function merchant_cant_mark_a_item_as_fulfilled_without_it_being_accepted_first(): void
    {
        $user = factory(User::class)->create();

        $merchantOne = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $user->merchants()->attach($merchantOne->id);

        $order = $this->createAndReturnOrderForStatus(
            'Purchased Order',
            [
                'merchant_id' => $merchantOne->id
            ]
        );

        $this->actingAs($user);

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'status' => 'purchased',
            ]
        );

        $response = $this->from(route('admin.dashboard'))
            ->get(route('admin.order-fulfilled', $order->url_slug));

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertRedirect(route('admin.dashboard'));

        $response->assertSessionHas('error', 'The order needs to be accepted first');

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'status' => 'purchased',
            ]
        );
    }

    /**
     * @test
     */
    public function cant_mark_an_order_as_fulfilled_without_being_purchased(): void
    {
        $user = factory(User::class)->create();

        $merchantOne = $this->createAndReturnMerchant(['registration_stage' => 0]);

        $user->merchants()->attach($merchantOne->id);

        $order = $this->createAndReturnOrderForStatus(
            'Incomplete Order',
            [
                'merchant_id' => $merchantOne->id
            ]
        );

        $this->actingAs($user);

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'status' => 'incomplete',
            ]
        );

        $response = $this->from(route('admin.dashboard'))
            ->get(route('admin.order-fulfilled', $order->url_slug));

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertRedirect(route('admin.dashboard'));

        $response->assertSessionHas('error', 'The order needs to be accepted first');

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'status' => 'incomplete',
            ]
        );
    }
}
