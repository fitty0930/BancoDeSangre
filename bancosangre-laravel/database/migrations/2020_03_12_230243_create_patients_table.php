<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    // AGREGAR TELEFONO Y DOMICILIO;
    Schema::create('patients', function (Blueprint $table) {
    $table->increments('patient_id')->unsigned();
    $table->integer('dni');
    $table->text('name');
    $table->text('surname');
    $table->integer('age');
    $table->bigInteger('phone');
    $table->text('adress');
    $table->unsignedInteger('blood_id');
    $table->foreign('blood_id')
    ->references('blood_id')
    ->on('bloodtypes')
    ->onDelete('cascade')
    ->onUpdate('cascade');
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
        Schema::dropIfExists('patients');
        
    }
}
