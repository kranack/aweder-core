<?php

namespace App\Console\Commands;

use App\Contract\Service\InventoryContract;
use Illuminate\Console\Command;

class CreateInventoryVariantsFromCurrentInventoryItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inventory:create_inventory_variants_from_current_inventory';

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
     * @return mixed
     */
    public function handle(InventoryContract $inventoryRepository)
    {
        $inventoryItems = $inventoryRepository->getInventoryItemsWithoutVariants();
    }
}
