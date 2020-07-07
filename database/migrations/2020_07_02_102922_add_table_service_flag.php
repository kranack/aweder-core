<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableServiceFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('merchants')) {
            Schema::table('merchants', function (Blueprint $table) {
                $table->boolean('allow_table_service')->default(0)->after('allow_collection');
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
        if (Schema::hasTable('merchants')) {
            Schema::table('merchants', function (Blueprint $table) {
                $table->dropColumn('allow_table_service');
            });
        }
    }
}
