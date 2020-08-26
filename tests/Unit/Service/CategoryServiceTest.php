<?php

namespace Tests\Unit\Service;

use App\Contract\Service\CategoryContract;
use App\Service\CategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Class CategoryServiceTest
 * @package Tests\Services
 * @coversDefaultClass \App\Service\OrderService
 */
class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @var CategoryContract|mixed
     */
    private $categoryService;

    public function setUp(): void
    {
        parent::setUp();
        $this->categoryService = $this->app->make(CategoryContract::class);
    }

    /**
     * @test
     */
    public function can_add_category_by_payload_without_image(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $payload = [
            'title' => 'Blurnsball',
            'visible' => 'true',
            'order' => 2,
        ];

        $this->assertCount(1, $merchant->categories()->get());

        $this->categoryService->addCategoriesAndSubCategoriesToMerchantFromPayload($merchant, $payload);
        $this->assertDatabaseHas('categories', [
            'title' => 'Blurnsball',
            'visible' => true,
            'order' => 2,
            'merchant_id' => $merchant->id
        ]);
    }

    /**
     * @test
     */
    public function can_add_category_by_payload_with_image(): void
    {
        Storage::fake('s3');

        $merchant = $this->createAndReturnMerchant();
        $image = UploadedFile::fake()->image('testimage.png', 100, 100)->size(100);

        $payload = [
            'title' => 'Blurnsball',
            'visible' => 'true',
            'order' => 2,
            'image' => $image
        ];

        $this->assertCount(1, $merchant->categories()->get());

        $this->categoryService->addCategoriesAndSubCategoriesToMerchantFromPayload($merchant, $payload);

        $this->assertDatabaseHas('categories', [
            'title' => 'Blurnsball',
            'visible' => true,
            'order' => 2,
            'merchant_id' => $merchant->id,
        ]);

        $this->assertDatabaseMissing('categories', [
            'title' => 'Blurnsball',
            'visible' => true,
            'order' => 2,
            'merchant_id' => $merchant->id,
            'image' => null
        ]);
    }

    public function cannot_add_category_from_payload_without_title(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $payload = [
            'title' => null,
            'visible' => 'true',
            'order' => 2,
        ];

        $this->assertCount(1, $merchant->categories()->get());

        $return = $this->categoryService->addCategoriesAndSubCategoriesToMerchantFromPayload($merchant, $payload);
        $this->assertFalse($return);
        $this->assertCount(1, $merchant->categories()->get());
    }

    /**
     * @test
     */
    public function can_add_category_with_subcategories_by_payload(): void
    {
        $merchant = $this->createAndReturnMerchant();
        $subcategoryString = 'Person,Woman,Man,Camera,TV';

        $payload = [
            'title' => 'Blurnsball',
            'visible' => 'true',
            'order' => 2,
            'subCategories' => $subcategoryString
        ];

        $this->assertCount(1, $merchant->categories()->get());

        $this->categoryService->addCategoriesAndSubCategoriesToMerchantFromPayload($merchant, $payload);

        $this->assertDatabaseHas('categories', [
            'title' => 'Blurnsball',
            'visible' => true,
            'order' => 2,
            'merchant_id' => $merchant->id,
        ]);

        $this->assertCount(2, $merchant->categories()->get());
        $parentCategory = $merchant->categories()->where('title', 'Blurnsball')->first();
        $i = 0;

        $unpackedSubcategories = explode(',' , $subcategoryString);

        foreach ($parentCategory->subcategories() as $subcategory) {
            $this->assertEquals($unpackedSubcategories[$i], $subcategory->title);
            $i++;
        }
    }
}
