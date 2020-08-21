<?php

namespace App\Contract\Repositories;

use App\Category;
use App\Merchant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

/**
 * Interface CategoryContract
 * @package App\Contract\Repositories
 */
interface CategoryContract
{
    /**
     * Creates a single empty category for the merchant to build out their inventory
     * @param int $merchantId
     * @return SupportCollection
     */
    public function createEmptyCategory(int $merchantId): SupportCollection;

    /**
     * Creates categories in the db
     *
     * @param array $categories
     * @param int $merchantId
     *
     * @return mixed
     */
    public function createCategories(array $categories, int $merchantId): SupportCollection;

    /**
     * @param array $categories
     * @param int $merchantId
     * @return bool
     */
    public function updateCategories(array $categories, int $merchantId): bool;

    /**
     * @param int $merchantId
     * @return Collection
     */
    public function getCategoryAndInventoryListForUser(int $merchantId): Collection;

    /**
     * @param Merchant $merchant
     * @param Category $category
     * @return bool
     */
    public function addCategoryToMerchant(Merchant $merchant, Category $category): bool;

    /**
     * @param Category $category
     * @param Category $subCategory
     * @return bool
     */
    public function addSubCategoryToCategory(Category $category, Category $subCategory): bool;

    /**
     * @param Category $category
     * @return bool
     */
    public function deleteCategory(Category $category): bool;
}
