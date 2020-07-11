<?php

use App\Traits\MigrationHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVariantIdFieldToOrderItemsTable extends Migration
{
    use MigrationHelper;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('order_items')) {
            Schema::table('order_items', function (Blueprint $table) {
                if (!Schema::hasColumn('order_items', 'variant_id')) {
                    $table->foreignId('variant_id')
                        ->constrained('inventory_variants')
                        ->onUpdate('CASCADE')
                        ->onDelete('CASCADE');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('order_items')) {
            Schema::table('order_items', function (Blueprint $table) {
                if (Schema::hasColumn('order_items', 'variant_id')) {
                   $table->dropForeign(['variant_id']);
                }
            });
        }
    }


}
