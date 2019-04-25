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

	        $table->string('name')->nullable();
	        $table->string('gofun_bc')->nullable();
	        $table->string('retail_group_bc')->nullable();
	        $table->string('retailer')->nullable();
	        $table->string('retailer_name')->nullable();
	        $table->string('retailer_contact_no')->nullable();
	        $table->string('manager_1')->nullable();
	        $table->string('manager_2')->nullable();
	        $table->string('address')->nullable();
	        $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('surburb')->nullable();
	        $table->string('landline')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('alternative')->nullable();
            $table->string('email_1')->nullable();
            $table->string('email_2')->nullable();
			$table->unsignedInteger('franchise_id');

	        $table->text('notes')->nullable();
			$table->string('user_id')->nullable();
            $table->boolean('status')->default(0);
	        $table->double('address_latitude')->nullable();
	        $table->double('address_longitude')->nullable();

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
