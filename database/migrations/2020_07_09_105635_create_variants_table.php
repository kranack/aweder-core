<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('inventory_variants')) {
            Schema::create('inventory_variants', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->foreignId('inventory_id')->index('inventory_id_variants')->constrained()->onDelete('RESTRICT');
                $table->string('name');
                $table->integer('price');
                $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('inventory_variants');
    }
}
