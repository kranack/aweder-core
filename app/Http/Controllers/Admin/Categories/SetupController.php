<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Contract\Repositories\CategoryContract;
use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Response;

class SetupController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param AuthManager $auth
     * @param CategoryContract $categoryRepository
     * @return Response
     */
    public function __invoke(AuthManager $auth, CategoryContract $categoryRepository): Response
    {
        $merchant = $auth->user()->merchants()->first();

        $categories = $categoryRepository->getCategoryAndInventoryListForUser($merchant->id);

        if ($categories->isEmpty()) {
            $categories = $categoryRepository->createEmptyCategory($merchant->id);
        }

        return response()->view(
            'admin.categories.index',
            [
                'merchant' => $merchant,
                'categories' => $categories,
            ]
        );
    }
}
