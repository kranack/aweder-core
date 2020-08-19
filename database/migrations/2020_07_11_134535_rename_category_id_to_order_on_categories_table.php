<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCategoryIdToOrderOnCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('categories', 'category_id')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->renameColumn('category_id', 'order');
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
        if (Schema::hasColumn('categories', 'order')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->renameColumn('order', 'category_id');
            });
        }
    }
}
