<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableNumberToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('orders', 'table_number')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->integer('table_number')->nullable()->default(null);
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
        if (Schema::hasColumn('orders', 'table_number')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->drop('table_number');
            });
        }
    }
}
