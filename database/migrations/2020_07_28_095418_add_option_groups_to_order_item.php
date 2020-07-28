<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOptionGroupsToOrderItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('inventory_option_group_item_order_item')) {
            Schema::create('inventory_option_group_item_order_item', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_item_id')->index('order_items_options_index');
                $table->foreignId('inventory_option_group_item_id');
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
        Schema::dropIfExists('inventory_option_group_item_order_item');
    }
}
