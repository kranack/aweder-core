<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryOptionGroupItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('inventory_option_group_items')) {
            Schema::create('inventory_option_group_items', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->foreignId('inventory_option_group_id')
                    ->index('inventory_option_group_items_id')
                    ->constrained()
                    ->onDelete('RESTRICT');
                $table->string('name');
                $table->integer('price_modified');
                $table->dateTime('deleted_at');
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
        Schema::dropIfExists('inventory_option_group_items');
    }
}
