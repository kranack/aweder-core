<?php

namespace Tests\Unit\Repository;

use App\Category;
use App\Contract\Repositories\CategoryContract;
use App\Inventory;
use App\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

/**
 * Class CategoriesRepository
 * @package Tests\Unit\Repository
 * @group Categories
 */
class CategoriesRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var CategoryContract
     */
    protected CategoryContract $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = app()->make(CategoryContract::class);
    }

    /**
     * @test
     */
    public function createCategoriesWithValidData(): void
    {
        $merchant_id = 123;

        factory(Merchant::class)->create([
            'id' => $merchant_id
        ]);

        $categories = [
            'breakfast',
            'lunch',
            'dinner',
            'dessert'
        ];

        $response = $this->repository->createCategories($categories, $merchant_id);

        $this->assertInstanceOf(Collection::class, $response);

        foreach ($response as $category) {
            $this->assertDatabaseHas('categories', [
                'merchant_id' => $merchant_id,
                'order' => $category->order,
                'title' => $category->title
            ]);
        }
    }
    /**
     * @test
     */
    public function createCategoriesWithSomeNullFields(): void
    {
        $merchant_id = 123;

        factory(Merchant::class)->create([
            'id' => $merchant_id
        ]);

        $categories = [
            'breakfast',
            null,
            'dinner',
            null
        ];
        $response = $this->repository->createCategories($categories, $merchant_id);

        $this->assertInstanceOf(Collection::class, $response);

        foreach ($response as $category) {
            $this->assertDatabaseHas('categories', [
                'merchant_id' => $merchant_id,
                'order' => $category->order,
                'title' => $category->title
            ]);
        }
    }
    /**
     * @test
     */
    public function createEmptyCategories(): void
    {
        $merchant_id = 123;

        factory(Merchant::class)->create([
            'id' => $merchant_id
        ]);

        $response = $this->repository->createEmptyCategories($merchant_id);

        $this->assertInstanceOf(Collection::class, $response);

        foreach ($response as $category) {
            $this->assertDatabaseHas('categories', [
                'merchant_id' => $merchant_id,
                'order' => $category->order,
                'title' => ''
            ]);
        }
    }
    /**
     * @test
     */
    public function getCategoriesAndInventoryWithMultipleCategoriesOnMerchant(): void
    {
        $merchant_id = 123;

        factory(Merchant::class)->create([
            'id' => $merchant_id
        ]);

        for ($i = 0; $i < 5; $i++) {
            $category = factory(Category::class)->create([
                'merchant_id' => $merchant_id
            ]);
            factory(Inventory::class)->create([
                'merchant_id' => $merchant_id,
                'category_id' => $category->id
            ]);
        }

        $collection = $this->repository->getCategoryAndInventoryListForUser($merchant_id);

        $this->assertInstanceOf(Collection::class, $collection);

        $arrayOfCategories = $collection->all();

        $this->assertCount(5, $arrayOfCategories);

        foreach ($arrayOfCategories as $category) {
            $this->assertInstanceOf(Collection::class, $category->inventories);
            foreach ($category->inventories as $inventory) {
                $this->assertInstanceOf(Inventory::class, $inventory);
            }
        }
    }
    /**
     * @test
     */
    public function getCategoriesAndInventoryWithMultipleCategoriesOnMerchantWithNoInventory(): void
    {
        $merchant_id = 123;

        factory(Merchant::class)->create([
            'id' => $merchant_id
        ]);

        factory(Category::class)->times(5)->create([
            'merchant_id' => $merchant_id
        ]);

        $collection = $this->repository->getCategoryAndInventoryListForUser($merchant_id);

        $this->assertInstanceOf(Collection::class, $collection);

        $arrayOfCategories = $collection->all();

        $this->assertCount(5, $arrayOfCategories);

        foreach ($arrayOfCategories as $category) {
            $this->assertInstanceOf(Collection::class, $category->inventories);
            $this->assertTrue($category->inventories->isEmpty());
        }
    }
    /**
     * @test
     */
    public function updateCategoriesWithValidData(): void
    {
        $merchant_id = 123;

        factory(Merchant::class)->create([
            'id' => $merchant_id
        ]);

        for ($i = 1; $i < 4; $i++) {
            factory(Category::class)->create([
                'merchant_id' => $merchant_id,
                'id' => $i
            ]);
        }

        $categories = [
            1 => 'breakfast',
            2 => 'lunch',
            3 => 'dinner'
        ];

        foreach ($categories as $category) {
            $this->assertDatabaseMissing('categories', [
                'title' => $category
            ]);
        }

        $this->assertTrue($this->repository->updateCategories($categories, $merchant_id));

        foreach ($categories as $category) {
            $this->assertDatabaseHas('categories', [
                'title' => $category
            ]);
        }
    }

    /**
     * @test
     */
    public function updateCategoriesWithInvalidKeys(): void
    {
        $merchant_id = 123;

        factory(Merchant::class)->create([
            'id' => $merchant_id
        ]);

        for ($i = 1; $i < 4; $i++) {
            factory(Category::class)->create([
                'merchant_id' => $merchant_id,
                'id' => $i
            ]);
        }

        $categories = [
            'test' => 'breakfast',
            'test2' => 'lunch',
            'test3' => 'dinner'
        ];

        foreach ($categories as $category) {
            $this->assertDatabaseMissing('categories', [
                'title' => $category
            ]);
        }

        $this->assertTrue($this->repository->updateCategories($categories, $merchant_id));

        foreach ($categories as $category) {
            $this->assertDatabaseMissing('categories', [
                'title' => $category
            ]);
        }
    }

    /**
     * @test
     */
    public function canAddCategoryToMerchant()
    {
        $merchant = $this->createAndReturnMerchant();
        $this->assertCount(1, $merchant->categories()->get());

        $category = $this->createAndReturnCategory();
        $this->repository->addCategoryToMerchant($merchant, $category);
        $this->assertCount(2, $merchant->categories()->get());
    }

    /**
     * @test
     */
    public function canAddSubCategoryToMerchant()
    {
        $merchant = $this->createAndReturnMerchant();
        $this->assertCount(1, $merchant->categories()->get());

        $category = $this->createAndReturnCategory(['merchant_id' => $merchant->id]);
        $subCategory = $this->createAndReturnCategory(['title' => 'Blurnsball']);

        $this->repository->addSubCategoryToCategory($category, $subCategory);
        $relatedCategory = $merchant->categories()->where('id', $category->id)->get()->first();
        $this->assertEquals(
            'Blurnsball',
            $relatedCategory->subcategories()->first()->title
        );
    }

    /**
     * @test
     */
    public function canRemoveSubCategoryForMerchantButStillViewItems()
    {
        $merchant = $this->createAndReturnMerchant();
        $this->assertCount(1, $merchant->categories()->get());

        $category = $this->createAndReturnCategory(['merchant_id' => $merchant->id]);
        $subCategory = $this->createAndReturnCategory(['title' => 'Blurnsball']);

        $this->repository->addSubCategoryToCategory($category, $subCategory);
        $relatedCategory = $merchant->categories()->where('id', $category->id)->get()->first();
        $this->assertEquals(
            'Blurnsball',
            $relatedCategory->subcategories()->first()->title
        );

        $inventoryItem = $this->createAndReturnInventoryItem(
            [
                'merchant_id' => $merchant->id,
                'category_id' => $subCategory->id,
                'title' => 'Blurnsball'
            ]
        );

        $this->assertEquals('Blurnsball', $subCategory->inventories()->first()->title);
        $this->repository->deleteCategory($subCategory);

        $this->assertDatabaseMissing(
            'categories',
            [
                'id' => $subCategory->id,
                'deleted_at' => null
            ]
        );

        $this->assertEquals(
            'Blurnsball',
            $merchant->inventories()->where('title', '=', 'Blurnsball')->get()->first()->title
        );
    }

    public function cascadeDeleteSubCategoriesWhenDeletingCategory()
    {

    }
}
