<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProprieteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propriete', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_copropriete');
            $table->bigInteger('num_propriete')->nullable();
            $table->string('type_copropriete')->nullable();
            $table->string('Batiment')->nullable();
            $table->string('etage')->nullable();
            $table->string('num_titre')->nullable();
            $table->string('surface')->nullable();
            $table->float('quote_par_terrain')->nullable();
            $table->float('pt_indivision')->nullable();
            $table->string('voix')->nullable();
            $table->string('taux_tantiem')->nullable();
            $table->string('commentaire')->nullable();
            $table->string('type_utilisation')->nullable();
            $table->float('n_tourne')->nullable();
            $table->string('police_eau')->nullable();
            $table->string('police_electricite')->nullable();
            $table->string('article_impot')->nullable();
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
        Schema::dropIfExists('propriete');
    }
}
