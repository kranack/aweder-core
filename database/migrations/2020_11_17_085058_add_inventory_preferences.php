<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInventoryPreferences extends Migration
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
                if (!Schema::hasColumn('inventories', 'is_vegan')) {
                    $table->boolean('is_vegan')->default(0)->after('allergy');
                }
                if (!Schema::hasColumn('inventories', 'is_vegetarian')) {
                    $table->boolean('is_vegetarian')->default(0)->after('is_vegan');
                }
                if (!Schema::hasColumn('inventories', 'is_gluten_free')) {
                    $table->boolean('is_gluten_free')->default(0)->after('is_vegetarian');
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
        if (Schema::hasTable('inventories')) {
            Schema::table('inventories', function (Blueprint $table) {
                if (!Schema::hasColumn('inventories', 'is_vegan')) {
                    $table->dropColumn('is_vegan');
                }
                if (!Schema::hasColumn('inventories', 'is_vegetarian')) {
                    $table->dropColumn('is_vegetarian');
                }
                if (!Schema::hasColumn('inventories', 'is_gluten_free')) {
                    $table->dropColumn('is_gluten_free');
                }
            });
        }
    }
}
