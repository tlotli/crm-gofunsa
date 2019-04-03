<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_visited');
            $table->unsignedInteger('visisted_by');
//            $table->string('reason_for_visit');
            $table->unsignedInteger('site_id');
            $table->text('notes');
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
	    if (Schema::hasColumn('reason_for_visit'))
	    {
		    Schema::table('visitations', function (Blueprint $table)
		    {
			    $table->dropColumn('reason_for_visit');
		    });
	    }

    }
}
