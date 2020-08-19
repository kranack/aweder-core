<?php

namespace App\Providers\Repositories;

use App\Contract\Repositories\InventoryVariantContract;
use App\InventoryVariant;
use App\Repository\InventoryVariantRepository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class InventoryVariantServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(InventoryVariantContract::class, function (Application $app) {
            $model = $app->make(InventoryVariant::class);
            $logger = $app->make(LoggerInterface::class);

            return new InventoryVariantRepository($model, $logger);
        });
    }
}
