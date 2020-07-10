<?php

namespace App\Providers\Repositories;

use App\Contract\Repositories\InventoryOptionGroupContract;
use App\InventoryOptionGroup;
use App\Repository\InventoryOptionGroupRepository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class InventoryOptionGroupServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(InventoryOptionGroupContract::class, function (Application $app) {
            $model = $app->make(InventoryOptionGroup::class);
            $logger = $app->make(LoggerInterface::class);

            return new InventoryOptionGroupRepository($model, $logger);
        });
    }
}
