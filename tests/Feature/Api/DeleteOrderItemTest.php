<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class DeleteOrderItemTest
 * @package Tests\Feature\Api
 * @group Order
 */
class DeleteOrderItemTest extends TestCase
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
    public function canDeleteItemFromOrder(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $order = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchant->id]);
        $orderItem = $this->createAndReturnOrderItem(['order_id' => $order->id]);

        $this->assertCount(1, $order->items()->get());

        $response = $this->json(
            'DELETE',
            '/api/v1/order/' . $order->url_slug . '/item/' . $orderItem->id,
            [
                'merchant' => $merchant->url_slug,
            ]
        );

        $response->assertStatus(Response::HTTP_OK);
        $this->assertCount(0, $order->fresh()->items()->get());
    }

    /**
     * @test
     */
    public function cannotDeleteItemIdOnDifferentOrder()
    {
        $merchant = $this->createAndReturnMerchant();
        $order = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchant->id]);
        $orderItem = $this->createAndReturnOrderItem(['order_id' => $order->id]);

        $this->assertCount(1, $order->items()->get());

        $merchant2 = $this->createAndReturnMerchant();
        $order2 = $this->createAndReturnOrderForStatus('Fulfilled', ['merchant_id' => $merchant2->id]);
        $orderItem2 = $this->createAndReturnOrderItem(['order_id' => $order2->id]);

        $this->assertCount(1, $order2->items()->get());

        $response = $this->json(
            'DELETE',
            '/api/v1/order/' . $order->url_slug . '/item/' . $orderItem2->id,
            [
                'merchant' => $merchant->url_slug,
            ]
        );

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->assertCount(1, $order->fresh()->items()->get());
        $this->assertCount(1, $order2->fresh()->items()->get());
    }
}
