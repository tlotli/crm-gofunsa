<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantitySoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantity_solds', function (Blueprint $table) {
            $table->increments('id');

	        $table->unsignedInteger('captured_by');
	        $table->unsignedInteger('site_id');
	        $table->date('date_captured');
	        $table->text('notes')->nullable();
	        $table->integer('quantity_sold');
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
        Schema::dropIfExists('quantity_solds');
    }
}
