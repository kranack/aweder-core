<?php

namespace Tests\Feature\Admin\Order;

use App\Mail\Customer\OrderAccepted as CustomerAccepted;
use App\Mail\Merchant\OrderAccepted as MerchantOrderAccepted;
use App\Mail\Merchant\RejectedOrderToCustomer;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/**
 * Class AcceptOrderControllerTest
 * @package Tests\Feature\Admin\Order
 * @coversDefaultClass \App\Http\Controllers\Admin\Order\AcceptOrderController
 * @group Order
 */
class AcceptOrderControllerTest extends TestCase
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

        $response = $this->post(route('admin.accept-order', $order->url_slug));

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

        $response = $this->post(
            route('admin.accept-order', $order->url_slug),
            [
                'time_minutes' => Carbon::now()->addHour()->minute,
                'time_hours' => Carbon::now()->addHour()->hour,
            ]
        );

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertRedirect(route('register.contact-details'));
    }

    /**
     * @test
     */
    public function merchant_cant_accept_other_merchants_orders_for_them(): void
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

        $rejectionReason = $this->faker->sentence;

        $response = $this->post(
            route('admin.accept-order', $order->url_slug),
            ['merchant_rejection_reason' => $rejectionReason]
        );

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
    public function merchant_can_accept_their_own_order(): void
    {
        Mail::fake();

        // Assert that no mailables were sent...
        Mail::assertNothingSent();

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

        $acceptNote = $this->faker->sentence;

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'status' => 'purchased',
            ]
        );

        $response = $this->post(
            route('admin.accept-order', $order->url_slug),
            [
                'merchant_note' => $acceptNote,
                'time_minutes' => Carbon::now()->addHour()->minute,
                'time_hours' => Carbon::now()->addHour()->hour,
            ]
        );

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'status' => 'acknowledged',
                'merchant_note' => $acceptNote,
            ]
        );

        Mail::assertSent(MerchantOrderAccepted::class);

        Mail::assertSent(CustomerAccepted::class);
    }

    /**
     * @test
     * this makes sure the status cant be changed
     */
    public function merchant_cant_accept_an_order_thats_been_rejected(): void
    {
        Mail::fake();

        // Assert that no mailables were sent...
        Mail::assertNothingSent();

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

        $acceptNote = $this->faker->sentence;

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'status' => 'rejected',
            ]
        );

        $response = $this->from(route('admin.view-order', $order->url_slug))->post(
            route('admin.reject-order', $order->url_slug),
            [
                'merchant_note' => $acceptNote,
                'time_minutes' => Carbon::now()->addHour()->minute,
                'time_hours' => Carbon::now()->addHour()->hour,
            ]
        );

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertRedirect(route('admin.view-order', $order->url_slug));

        $this->assertDatabaseHas(
            'orders',
            [
                'id' => $order->id,
                'status' => 'rejected',
            ]
        );

        Mail::assertNothingSent();
    }
}
