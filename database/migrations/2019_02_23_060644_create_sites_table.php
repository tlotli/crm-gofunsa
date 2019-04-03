<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('province');
            $table->unsignedInteger('business_group_id')->nullable();
            $table->unsignedInteger('franchise_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->boolean('status')->default(0);
	        $table->text('address');
	        $table->string('city');
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
        Schema::dropIfExists('sites');
    }
}
