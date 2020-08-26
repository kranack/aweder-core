<?php

namespace Tests\Unit\Service;

use App\Contract\Service\CategoryContract;
use App\Service\CategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

    public function can_add_category_by_payload_without_image(): void
    {

    }

    public function can_add_category_by_payload_with_image(): void
    {

    }

    public function cannot_add_category_from_payload_without_title(): void
    {

    }

    public function can_add_category_with_subcategories_by_payload(): void
    {

    }

    public function cannot_add_category_and_subcategories_with_invalid_subcategory_name(): void
    {

    }
}
