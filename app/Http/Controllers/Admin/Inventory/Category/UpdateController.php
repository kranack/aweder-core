<?php

namespace App\Http\Controllers\Admin\Inventory\Category;

use App\Contract\Repositories\InventoryContract;
use App\Http\Controllers\Controller;

class UpdateController extends Controller
{
    public function __invoke($request, InventoryContract $inventoryRepo)
    {
        return redirect()->to(route('admin.inventory'));
    }
}
