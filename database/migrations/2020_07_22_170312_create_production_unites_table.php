<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionUnitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_unites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained('recipes');
            $table->foreignId('production_bloc_id')->constrained('production_blocs');
            $table->foreignId('building_id')->constrained('buildings');
            $table->string('name');
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
        Schema::dropIfExists('production_unites');
    }
}
