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
    public function merchantOwnsItem(): void
    {
        $merchant = factory(Merchant::class)->create();

        $inventory = factory(Inventory::class)->create(['merchant_id' => $merchant->id]);

        $result = $this->repository->doesMerchantOwnItem($merchant->id, $inventory->id);

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function merchantDoesntOwnItem(): void
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
    public function savesCorrectInventoryData(): void
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
    public function doesntSaveWithInvalidData(): void
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
    public function inventoryItemsReturnedWhenTheyHaveNoVariants()
    {
        factory(Inventory::class)->create();

        $result = $this->repository->getInventoryItemsWithoutVariants();

        $this->assertTrue($result->count() === 1);
    }

    /**
     * @test
     * @group Inv
     */
    public function inventoryItemsNotReturnedWhenTheyHaveVariants()
    {
        factory(Inventory::class)->state('variants')->create();

        $result = $this->repository->getInventoryItemsWithoutVariants();

        $this->assertSame(0, $result->count());
    }

    /**
     * @test
     */
    public function correctInventoryItemCountIsReturnedWhenACombinationsIsCreated()
    {
        factory(Inventory::class)->create();

        factory(Inventory::class)->state('variants')->create();

        $result = $this->repository->getInventoryItemsWithoutVariants();

        $this->assertSame(1, $result->count());
    }
}
