<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaiementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_facture');
            $table->string('num_paiement')->nullable();
            $table->date('date_paiement')->nullable();
            $table->string('mode_paiement')->nullable();
            $table->string('affectation_paiement')->nullable();
            $table->float('montant')->nullable();
            $table->string('n_piece')->nullable();
            $table->text('piece_jointe')->nullable();
            $table->string('libelle')->nullable();
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
        Schema::dropIfExists('paiement');
    }
}
