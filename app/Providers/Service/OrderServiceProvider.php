<?php

namespace App\Providers\Service;

use App\Contract\Repositories\InventoryContract;
use App\Contract\Repositories\MerchantContract;
use App\Contract\Service\InventoryOptionGroupItemContract;
use App\Contract\Service\OrderContract;
use App\Service\OrderService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;
use App\Contract\Repositories\OrderContract as OrderRepositoryContract;

class OrderServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(OrderContract::class, function (Application $app) {
            $orderRepository = $app->make(OrderRepositoryContract::class);
            $merchantRepository = $app->make(MerchantContract::class);
            $inventoryRepository = $app->make(InventoryContract::class);
            $inventoryOptionGroupItemService = $app->make(InventoryOptionGroupItemContract::class);
            $inventoryOptionGroupItemRepository = $app->make(
                \App\Contract\Repositories\InventoryOptionGroupItemContract::class
            );
            $logger = $app->make(LoggerInterface::class);

            return new OrderService(
                $orderRepository,
                $merchantRepository,
                $inventoryRepository,
                $inventoryOptionGroupItemService,
                $inventoryOptionGroupItemRepository,
                $logger
            );
        });
    }
}
