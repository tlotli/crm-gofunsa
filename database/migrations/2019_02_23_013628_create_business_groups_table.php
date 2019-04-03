<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
	        $table->string('business_type')->nullable();
	        $table->unsignedInteger('business_owner_id');
//            $table->string('ceo_name')->nullable();
//            $table->string('address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->boolean('status')->default(0);
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('business_groups');
    }
}
