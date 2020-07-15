<?php

namespace App;

use MadWeb\Initializer\Contracts\Runner;

class Install
{
    public function production(Runner $run)
    {
        $run->external('composer', 'install', '--no-dev', '--prefer-dist', '--optimize-autoloader')
            ->artisan('key:generate', ['--force' => true])
            ->artisan('migrate', ['--force' => true])
            ->artisan('inventory:create_default_inventory_variants_from_current_inventory', ['--force' => true])
            ->artisan('orders:add-variants-to-order-items', ['--force' => true])
            ->artisan('storage:link')
            ->artisan('route:cache')
            ->artisan('config:cache')
            ->artisan('event:cache');
    }

    public function testing(Runner $run)
    {
        $run->external('composer', 'install')
            ->artisan('key:generate')
            ->artisan('migrate')
            ->artisan('inventory:create_default_inventory_variants_from_current_inventory')
            ->artisan('orders:add-variants-to-order-items')
            ->artisan('storage:link')
            ->artisan('cache:clear');
    }

    public function local(Runner $run)
    {
        $run->external('composer', 'install')
            ->artisan('key:generate')
            ->artisan('migrate')
            ->artisan('db:seed')
            ->artisan('inventory:create_default_inventory_variants_from_current_inventory')
            ->artisan('orders:add-variants-to-order-items')
            ->artisan('storage:link')
            ->artisan('cache:clear');
    }
}
