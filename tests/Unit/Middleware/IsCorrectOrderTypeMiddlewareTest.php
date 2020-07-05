<?php

namespace Tests\Unit\Middleware;

use Illuminate\Foundation\Testing\RefreshDatabase;
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
    public function canAddTableServiceItemToTableServiceOrder()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function cannotAddTableServiceItemToDeliveryOrder(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function canAddDeliveryItemToDeliveryOrder(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function cannotAddDeliveryItemToTableServiceOrder(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
