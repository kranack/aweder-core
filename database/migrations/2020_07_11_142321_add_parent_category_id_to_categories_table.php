<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentCategoryIdToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('categories', 'parent_category_id')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->bigInteger('parent_category_id')->nullable(true)->default(null)->after('merchant_id');
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
        if (Schema::hasColumn('categories', 'parent_category_id')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn('parent_category_id');
            });
        }
    }
}
