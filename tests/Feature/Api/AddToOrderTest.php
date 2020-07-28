<?php

namespace Tests\Feature\Api;

use App\Contract\Repositories\InventoryOptionGroupContract;
use App\Contract\Repositories\InventoryOptionGroupItemContract;
use App\Contract\Repositories\InventoryVariantContract;
use App\Contract\Repositories\OrderContract;
use App\Contract\Repositories\OrderItemContract;
use App\Inventory;
use App\Order;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class AddToOrderTest
 * @package Tests\Feature\Api
 * @group Order
 */
class AddToOrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var OrderContract
     */
    protected $orderRepository;

    /**
     * @var InventoryOptionGroupContract
     */
    protected $inventoryOptionGroupRepository;

    /**
     * @var InventoryOptionGroupItemContract
     */
    protected $inventoryOptionGroupItemRepository;

    /**
     * @var InventoryVariantContract
     */
    protected $inventoryVariantRepository;

    /**
     * @var OrderItemContract
     */
    protected $orderItemRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->orderRepository = $this->app->make(OrderContract::class);
        $this->inventoryOptionGroupRepository = $this->app->make(InventoryOptionGroupContract::class);
        $this->inventoryOptionGroupItemRepository = $this->app->make(InventoryOptionGroupItemContract::class);
        $this->inventoryVariantRepository = $this->app->make(InventoryVariantContract::class);
        $this->orderItemRepository = $this->app->make(OrderItemContract::class);
    }

    /**
     * @test
     */
    public function canAddItemToOrder()
    {
        $merchant = $this->createAndReturnMerchant(['registration_stage' => 0]);
        $order = $this->createAndReturnOrderForStatus('Purchased Order', ['merchant_id' => $merchant->id]);
        $inventory = factory(Inventory::class)->create(['merchant_id' => $merchant->id]);
        $inventoryOptionGroup = $this->createAndReturnInventoryOptionGroup(
            ['name' => 'Extras']
        );

        $inventoryOptionGroupItem = $this->createAndReturnInventoryOptionGroupItem(
            ['name' => 'Go Faster Stripes']
        );

        $this->inventoryOptionGroupItemRepository->addItemToOptionGroup(
            $inventoryOptionGroupItem,
            $inventoryOptionGroup
        );

        $this->inventoryOptionGroupRepository->addOptionGroupToInventoryItem($inventoryOptionGroup, $inventory);
        $inventoryVariantName = 'Electric Blue Keyboard';

        $inventoryVariant = $this->createAndReturnInventoryVariant(
            ['name' => $inventoryVariantName]
        );

        $this->inventoryVariantRepository->addVariantToInventoryItem($inventoryVariant, $inventory);

        $orderItemPayload = [
            'merchant' => $merchant->url_slug,
            'variant_id' => $inventoryVariant->id,
            'inventory_id' => $inventory->id,
        ];

        $this->assertCount(0, $order->items()->get());

        $response = $this->json(
            'POST',
            '/api/v1/order/' . $order->url_slug . '/item',
            $orderItemPayload
        );
        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $order->id]);

        $refreshedOrder = Order::find($order->id);
        $this->assertCount(1, $refreshedOrder->items()->get());
    }
}
