<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AddVariantIdToOrderItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:add-variants-to-order-items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds the variant ID and required fields to the new order items table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
