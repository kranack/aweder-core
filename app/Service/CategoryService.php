<?php

namespace App\Service;

use App\Category;
use App\Contract\Repositories\CategoryContract as CategoryRepository;
use App\Contract\Service\CategoryContract;
use App\Merchant;

class CategoryService implements CategoryContract
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    public function addCategoriesAndSubCategoriesToMerchantFromPayload(Merchant $merchant, array $payload): bool
    {
        $order = $this->categoryRepository->getCategoryMaxOrderForMerchant($merchant);

        $category = new Category([
            'title' => $payload['title'],
            'visible' => (bool) $payload['visible'],
            'image' => $payload['image']
        ]);

        if ($this->categoryRepository->addCategoryToMerchant($merchant, $category)) {
            return false;
        }

        $subcategories = explode(',', $payload['subCategories']);

        foreach ($subcategories as $subcategoryTitle) {
            $subcategory = new Category([
                'title' => $subcategoryTitle
            ]);

            if ($this->categoryRepository->addSubCategoryToCategory($category, $subcategory)) {
                return false;
            }
        }
        return true;
    }
}
