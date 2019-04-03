<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockOnHandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_on_hands', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('captured_by');
            $table->unsignedInteger('site_id');
            $table->date('date_captured');
            $table->text('notes')->nullable();
            $table->integer('soh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_on_hands');
    }
}
