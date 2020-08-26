<?php

namespace App\Contract\Service;

use App\Category;
use App\Merchant;
use Illuminate\Http\UploadedFile;

interface CategoryContract
{
    /**
     * @param Merchant $merchant
     * @param array $payload
     * @return bool
     */
    public function addCategoriesAndSubCategoriesToMerchantFromPayload(Merchant $merchant, array $payload): bool;

    /**
     * @param Category $category
     * @param UploadedFile $imageFile
     * @return bool
     */
    public function addImageToCategory(Category $category, UploadedFile $imageFile): bool;
}
