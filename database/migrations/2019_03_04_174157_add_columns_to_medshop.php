<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToMedshop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medshop', function (Blueprint $table) {

            $table->string('add1');
            $table->string('add2');
            $table->double('add_lat');
            $table->double('add_lng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medshop', function (Blueprint $table) {
            $table->dropColumn('add1');
            $table->dropColumn('add2');
            $table->dropColumn('add_lat');
            $table->dropColumn('add_lng');
        });
    }
}
