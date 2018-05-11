<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_propriete');
            $table->string('num_facture')->nullable();
            $table->date('date_facture')->nullable();
            $table->string('prestation')->nullable();
            $table->float('n_piece')->nullable();
            $table->string('libelle')->nullable();
            $table->float('montant_facture')->nullable();
            $table->float('montant_penalite')->nullable();
            $table->string('piece_jointe')->nullable();
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
        Schema::dropIfExists('facture');
    }
}
