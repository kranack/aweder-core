<?php

namespace App\Providers\Repositories;

use App\Contract\Repositories\InventoryOptionGroupItemContract;
use App\InventoryOptionGroupItem;
use App\Repository\InventoryOptionGroupItemRepository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class InventoryOptionGroupItemServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(InventoryOptionGroupItemContract::class, function (Application $app) {
            $model = $app->make(InventoryOptionGroupItem::class);
            $logger = $app->make(LoggerInterface::class);

            return new InventoryOptionGroupItemRepository($model, $logger);
        });
    }
}
