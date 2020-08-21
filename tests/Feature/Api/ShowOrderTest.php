<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class CreateOrderTest
 * @package Tests\Feature\Api
 * @group Order
 */
class ShowOrderTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function can_view_order(): void
    {
        $order = $this->createAndReturnOrderForStatus('Fulfilled');

        $response = $this->json(
            'GET',
            'api/v1/order/' . $order->url_slug
        );

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment([$order->url_slug]);
    }

    /**
     * @test
     */
    public function cannot_view_order(): void
    {
        $order = $this->createAndReturnOrderForStatus('Fulfilled');

        $response = $this->json(
            'GET',
            'api/v1/order/' . $this->faker->name
        );

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
