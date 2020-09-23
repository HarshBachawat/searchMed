<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id')->default(0);
            $table->string('client_name');
            $table->integer('mob_no');
            $table->string('medicine');
            $table->integer('quantity');
            $table->integer('price');
            $table->unsignedInteger('med_id');

            $table->foreign('med_id')->references('id')->on('medshop')->onDelete('cascade');
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
        Schema::dropIfExists('invoice');
    }
}
