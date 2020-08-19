<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInventoryPriceToAllowNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('inventories')) {
            Schema::table('inventories', function (Blueprint $table) {
                if (Schema::hasColumn('inventories', 'price')) {
                    $table->integer('price')->nullable()->change();
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
    }
}
