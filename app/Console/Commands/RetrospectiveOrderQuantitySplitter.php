<?php

namespace App\Console\Commands;

use App;
use Illuminate\Console\Command;

class RetrospectiveOrderQuantitySplitter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:order-quantity-split-hotfix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A utility command to split out orders with a quantity of >1';

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
        $run = true;
        if (App::environment() === 'production') {
            $userResponse = $this->ask(
                'WARNING! This app is in production. This command manipulates orders in the db.
                Are you sure you want to run it? [Y/N]'
            );
            $run = strtolower($userResponse) !== 'n';
        }

        if (!$run) {
            return;
        }

        $orderItems = App\OrderItem::all();
        $orderItems->each(function ($orderItem) {
            if ($orderItem->quantity > 0) {
                for ($i = 1; $i <= $orderItem->quantity; $i++) {
                    $newOrderItem = $orderItem->replicate();
                    $newOrderItem->quantity = 1;
                    $newOrderItem->save();
                }
                $orderItem->delete();
            }
        });
    }
}
