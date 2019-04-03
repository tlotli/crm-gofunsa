<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->text('notes')->nullable();
            $table->date('date_invoiced')->nullable();
            $table->string('who_invoiced')->nullable();
            $table->string('vat')->nullable();
            $table->integer('quantity')->nullable();
            $table->boolean('status')->nullable();
            $table->unsignedInteger('site_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->text('invoice_attachment')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
