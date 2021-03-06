<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::create('bloodtypes', function (Blueprint $table) {
        $table->increments('blood_id')->unsigned();
        $table->char('group', 2);
        $table->char('factor', 1);
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
        Schema::dropIfExists('bloodtypes');
    }
}
