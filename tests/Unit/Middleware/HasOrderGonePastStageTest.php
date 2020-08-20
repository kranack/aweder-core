<?php

namespace Tests\Unit\Middleware;

use App\Contract\Service\OrderContract;
use App\Http\Middleware\HasOrderGonePastStageMiddleware;
use App\Merchant;
use App\Order;
use App\Service\OrderService;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

/**
 * Class HasOrderGonePastStageTest
 * @package Tests\Unit\Middleware
 * @coversDefaultClass \App\Http\Middleware\HasOrderGonePastStageMiddleware
 * @group Middleware
 */
class HasOrderGonePastStageTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @dataProvider hasNotGonePastStageProvider
     * @test
     */
    public function will_pass_through_middleware_when_user_has_not_gone_past_order_stage(array $providedData): void
    {
        $user = factory(User::class)->create();

        $merchant = factory(Merchant::class)->create();

        $user->merchants()->attach($merchant->id);

        $order = factory(Order::class)->create([
            'status' => $providedData['status'],
            'merchant_id' => $merchant->id
        ]);

        $this->actingAs($user);

        $request = Request::create($providedData['route'], 'POST', ['order' => $order]);

        $orderService = $this->app->make(OrderContract::class);

        $middleware = new HasOrderGonePastStageMiddleware($orderService);

        $response = $middleware->handle(
            $request,
            function () {
            },
            $providedData['statusToCheck']
        );

        $this->assertNull($response);
    }

    public function has_not_gone_past_stage_provider(): array
    {
        return [
            'User can accept order that is not already accepted' => [
                [
                    'route' => 'accept',
                    'status' => 'purchased',
                    'statusToCheck' => 'accepted'
                ]
            ],
            'User can reject order that is not already rejected' => [
                [
                    'route' => 'reject',
                    'status' => 'purchased',
                    'statusToCheck' => 'rejected'
                ]
            ]
        ];
    }

    /**
     * @dataProvider hasAlreadyGonePastStageProvider
     * @test
     */
    public function will_redirect_user_if_order_has_already_gone_past_stage(array $providedData): void
    {
        $user = factory(User::class)->create();

        $merchant = factory(Merchant::class)->create(['registration_stage' => 0]);

        $user->merchants()->attach($merchant->id);

        $order = factory(Order::class)->create([
            'status' => $providedData['status'],
            'merchant_id' => $merchant->id
        ]);

        $response = $this->actingAs($user)->post('admin/view-order/' . $order->url_slug . '/' . $providedData['route']);

        $response->assertStatus(Response::HTTP_FOUND);

        $response->assertSessionHas(['error' => 'You\'ve already dealt with this']);

        $response->assertRedirect('/');
    }

    public function hasAlreadyGonePastStageProvider(): array
    {
        return [
            'order is rejected and user tries to reject again' => [
                [
                    'route' => 'reject',
                    'status' => 'rejected'
                ]
            ],
            'order is acknowledged and user tries to reject it' => [
                [
                    'route' => 'reject',
                    'status' => 'acknowledged'
                ]
            ],
            'order is unacknowledged and user tries to reject it' => [
                [
                    'route' => 'reject',
                    'status' => 'unacknowledged'
                ]
            ],
            'order is rejected and user tries to accept it' => [
                [
                    'route' => 'accept',
                    'status' => 'rejected'
                ]
            ],
            'order is acknowledged and user tries to accept it' => [
                [
                    'route' => 'accept',
                    'status' => 'acknowledged'
                ]
            ],
            'order is unacknowledged and user tries to accept it' => [
                [
                    'route' => 'accept',
                    'status' => 'unacknowledged'
                ]
            ],
        ];
    }
}
