<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionBlocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_blocs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
            $table->string('name');
            $table->foreignId('parent_id')->nullable()->constrained('production_blocs');
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
        Schema::dropIfExists('production_blocs');
    }
}
