<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoproprietePrimaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copropriete_primaire', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom')->nullable();
            $table->string('slug')->nullable();
            $table->string('ville')->nullable();
            $table->text('description')->nullable();
            $table->string('code_postale')->nullable();
            $table->string('pays')->nullable();
            $table->date('date_reprise')->nullable(); 
            $table->string('type_copropriete')->nullable();
            $table->string('plan')->nullable();
            $table->text('designation_plan')->nullable(); 
            $table->string('titre_foncier')->nullable();
            $table->float('surface_totale')->nullable(); 
            $table->float('total_tantieme')->nullable();
            $table->float('penalite_taux')->nullable();
            $table->boolean('is_penalite_exist')->nullable();
            $table->string('adresse')->nullable();
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
        Schema::dropIfExists('copropriete_primaire');
    }
}
