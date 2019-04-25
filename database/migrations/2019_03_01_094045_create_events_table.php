<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('title');
	        $table->datetime('start_date');
	        $table->datetime('end_date');
	        $table->unsignedInteger('user_id');
	        $table->text('notes')->nullable();
	        $table->unsignedInteger('site_id')->nullable();
	        $table->string('event_type')->nullable();
//	        $table->string('location')->change();
//	        $table->text('notes')->change();
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
        Schema::dropIfExists('events');
    }
}
