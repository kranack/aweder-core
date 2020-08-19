<?php

namespace App\Providers\Repositories;

use App\Contract\Repositories\OrderItemContract;
use App\OrderItem;
use App\Repository\OrderItemRepository;
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
        $this->app->bind(OrderItemContract::class, function (Application $app) {
            $model = $app->make(OrderItem::class);
            $logger = $app->make(LoggerInterface::class);

            return new OrderItemRepository($model, $logger);
        });
    }
}
