<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_registros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('registro_id');
            $table->string('SO');
            $table->string('SO_version');
            $table->string('device');
            $table->string('browser');
            $table->string('ip');
            $table->string('tipo_device');
            $table->string('pais');
            $table->string('Departamento');
            $table->string('ciudad');
            $table->string('lat');
            $table->string('lon');
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
        Schema::drop('device_registros');
    }
}
