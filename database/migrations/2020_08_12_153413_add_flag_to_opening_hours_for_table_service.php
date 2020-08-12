<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlagToOpeningHoursForTableService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('normal_opening_hours', 'is_delivery_hours')) {
            Schema::table('normal_opening_hours', function (Blueprint $table) {
                $table->boolean('is_delivery_hours')->default(1);
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
        if (Schema::hasColumn('normal_opening_hours', 'is_delivery_hours')) {
            Schema::table('normal_opening_hours', function (Blueprint $table) {
                $table->dropColumn('is_delivery_hours');
            });
        }
    }
}
