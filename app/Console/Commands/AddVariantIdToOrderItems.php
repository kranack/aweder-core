<?php

namespace App\Console\Commands;

use App\Contract\Repositories\OrderContract;
use App\Order;
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
    protected $description = 'Adds the variant ID and required fields to the order items table';

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
     * @param OrderContract $orderRepository
     * @return void
     */
    public function handle(OrderContract $orderRepository): void
    {
        $this->info('Starting command to update order items by adding variant id and title');

        $ordersToUpdate = $orderRepository->getOrdersWithOrderItemsThatNeedDefaultVariantId();

        if ($ordersToUpdate->isEmpty()) {
            $this->info('No order items to update');
            return;
        }

        $this->info('Adding default variant to ' . $ordersToUpdate->count() . ' Order(s)');

        $bar = $this->output->createProgressBar($ordersToUpdate->count());

        $bar->start();

        $ordersToUpdate->each(function (Order $order) use ($bar) {
            $items = $order->items()
                ->where('variant_id', '=', null)
                ->with(['orderInventory', 'orderInventory.variants'])
                ->get();

            foreach ($items as $item) {
                $defaultVariant = $item->orderInventory->variants->first() ?? null;

                if ($defaultVariant !== null) {
                    $item->variant_id = $defaultVariant->id;
                    $item->title = $defaultVariant->name;
                    $item->save();
                }
            }
            $bar->advance();
        });

        $bar->finish();

        return;
    }
}
