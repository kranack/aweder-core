<?php

namespace Tests\Unit\Repository;

use App\Category;
use App\Contract\Repositories\InventoryContract;
use App\Traits\HelperTrait;
use App\Inventory;
use App\Merchant;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class InventoryRepositoryTest
 * @package Tests\Unit\Repository
 * @group Inventory
 * @coversDefaultClass
 */
class InventoryRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use HelperTrait;

    /**
     * @var InventoryContract $repository
     */
    protected InventoryContract $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->app->make(InventoryContract::class);
    }

    /**
     * @test
     */
    public function merchant_owns_item(): void
    {
        $merchant = factory(Merchant::class)->create();

        $inventory = factory(Inventory::class)->create(['merchant_id' => $merchant->id]);

        $result = $this->repository->doesMerchantOwnItem($merchant->id, $inventory->id);

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function merchant_doesnt_own_item(): void
    {
        $merchant = factory(Merchant::class)->create();

        $merchantTwo = factory(Merchant::class)->create();

        $inventory = factory(Inventory::class)->create(['merchant_id' => $merchantTwo->id]);

        $result = $this->repository->doesMerchantOwnItem($merchant->id, $inventory->id);

        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function saves_correct_inventory_data(): void
    {
        $merchant = factory(Merchant::class)->create();

        $category = factory(Category::class)->create();

        $inventoryData = [
            'category-id' => $category->id,
            'title' => 'inventory-item',
            'description' => 'inventory-description',
            'amount' => 5,
            'available' => true
        ];

        $this->repository->createNewInventoryItemForMerchant(
            $merchant->id,
            $inventoryData
        );

        $this->assertDatabaseHas('inventories', [
            'category_id' => $inventoryData['category-id'],
            'title' => $inventoryData['title'],
            'description' => $inventoryData['description'],
            'price' => $this->convertToPence($inventoryData['amount']),
            'available' => $inventoryData['available']
        ]);
    }

    /**
     * @test
     */
    public function doesnt_save_with_invalid_data(): void
    {
        $this->expectException(ErrorException::class);
        $this->expectExceptionMessage('A non-numeric value encountered');

        $merchant = factory(Merchant::class)->create();

        $category = factory(Category::class)->create();

        $inventoryData = [
            'category-id' => $category->id,
            'title' => 'inventory-item',
            'description' => 'inventory-description',
            'amount' => 'doggo',
            'available' => true
        ];

        $this->repository->createNewInventoryItemForMerchant(
            $merchant->id,
            $inventoryData
        );

        $this->assertDatabaseMissing('inventories', [
            'category_id' => $inventoryData['category-id'],
            'title' => $inventoryData['title'],
            'description' => $inventoryData['description'],
            'price' => $inventoryData['amount'],
            'available' => $inventoryData['available']
        ]);
    }

    /**
     * @test
     * @group Inv
     */
    public function inventory_items_returned_when_they_have_no_variants(): void
    {
        factory(Inventory::class)->create();

        $result = $this->repository->getInventoryItemsWithoutVariants();

        $this->assertTrue($result->count() === 1);
    }

    /**
     * @test
     * @group Inv
     */
    public function inventory_items_not_returned_when_they_have_variants(): void
    {
        factory(Inventory::class)->state('variants')->create();

        $result = $this->repository->getInventoryItemsWithoutVariants();

        $this->assertSame(0, $result->count());
    }

    /**
     * @test
     */
    public function correct_inventory_item_count_is_returned_when_a_combinations_is_created(): void
    {
        factory(Inventory::class)->create();

        factory(Inventory::class)->state('variants')->create();

        $result = $this->repository->getInventoryItemsWithoutVariants();

        $this->assertSame(1, $result->count());
    }
}
