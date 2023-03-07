<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialOrdenDeAbastecimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_orden_de_abastecimiento', function (Blueprint $table) {
                $table->increments('ID');
                $table->integer('Material_ID')->unsigned()->nullable();;
                $table->integer('Orden_ID')->unsigned()->nullable();;
                $table->integer('cantidad');
    
    
                $table->foreign('Material_ID')->references('ID')->on('material')->onDelete('cascade');
                $table->foreign('Orden_ID')->references('ID')->on('ordendeabastecimiento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_orden_de_abastecimiento');
    }
}
