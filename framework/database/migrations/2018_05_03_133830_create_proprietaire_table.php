<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProprietaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proprietaire', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_propriete')->nullable();
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('cin')->nullable();
            $table->string('profession')->nullable();
            $table->string('titre')->nullable();
            $table->string('ville')->nullable();
            $table->string('adresse_1')->nullable();
            $table->string('adresse_2')->nullable();
            $table->string('email_1')->nullable();
            $table->string('email_2')->nullable();
            $table->string('tel_1')->nullable();
            $table->string('tel_2')->nullable();
            $table->string('code_postale')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('proprietaire');
    }
}
