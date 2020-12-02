<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Contract\Repositories\InventoryContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class VegetarianController
 * @package App\Http\Controllers\Admin\Inventory
 */
class VegetarianController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @param InventoryContract $inventoryRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, int $id, InventoryContract $inventoryRepository): RedirectResponse
    {
        $inventoryRepository->toggleVegetarianById($id);

        return redirect()->to(route('admin.inventory'));
    }
}
