<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVisibleFlagToCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('categories', 'visible')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('visible')->default(1)->index('visible_categories_index');
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
        if (Schema::hasColumn('categories', 'visible')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn('visible');
            });
        }
    }
}
