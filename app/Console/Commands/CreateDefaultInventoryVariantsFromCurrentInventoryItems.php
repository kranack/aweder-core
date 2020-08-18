<?php

namespace App\Console\Commands;

use App;
use App\Contract\Repositories\InventoryContract;
use App\Contract\Repositories\InventoryVariantContract;
use App\Inventory;
use App\InventoryVariant;
use Illuminate\Console\Command;

class CreateDefaultInventoryVariantsFromCurrentInventoryItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inventory:create_default_inventory_variants_from_current_inventory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command takes the current inventory items and creates the default variants for them';

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
     * @param InventoryContract $inventoryRepository
     * @param InventoryVariantContract $inventoryVariantRepository
     * @return mixed
     */
    public function handle(
        InventoryContract $inventoryRepository,
        InventoryVariantContract $inventoryVariantRepository
    ) {
        $run = true;
        if (App::isProduction()) {
            $run = $this->confirm(
                'WARNING! This app is in production. This command manipulates inventory items in the db.'
                . ' Are you sure you want to run it? [Y/N]'
            );
        }

        if (!$run) {
            $this->info('Command Not Run');
            return;
        }

        $inventoryItems = $inventoryRepository->getInventoryItemsWithoutVariants();

        if ($inventoryItems->isEmpty()) {
            $this->info('No items to update');
            return;
        }

        $this->info($inventoryItems->count() . ' Found and will have singular variants created for them.');

        $bar = $this->output->createProgressBar($inventoryItems->count());

        $bar->start();

        $inventoryItems->each(function (Inventory $inventory, $key) use ($inventoryVariantRepository, $bar) {
            $variant = new InventoryVariant(
                [
                    'name' => $inventory->title,
                    'price' => $inventory->price,
                ]
            );

            if (!$inventoryVariantRepository->addVariantToInventoryItem($inventory, $variant)) {
                $this->error('There was an error creating a variant for item ' . $inventory->id);
            } else {
                $inventory->update(['price' => null]);
            }

            $bar->advance();
        });

        $bar->finish();

        return;
    }
}
