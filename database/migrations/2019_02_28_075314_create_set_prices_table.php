<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price')->default(0)->nullable();
            $table->boolean('status')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('last_updated_by')->nullable();
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
        Schema::dropIfExists('set_prices');
    }
}
