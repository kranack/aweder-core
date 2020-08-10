<?php

namespace App\Providers\Service;

use App\Contract\Service\OrderItemServiceContract;
use App\Service\InventoryOptionGroupItemService;
use App\Service\OrderItemService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class OrderItemServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(OrderItemServiceContract::class, function (Application $app) {
            $logger = $app->make(LoggerInterface::class);
            $inventoryOptionGroupItemService = $app->make(InventoryOptionGroupItemService::class);

            return new OrderItemService(
                $inventoryOptionGroupItemService,
                $logger
            );
        });
    }
}
