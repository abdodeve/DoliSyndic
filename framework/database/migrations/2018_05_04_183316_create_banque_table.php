<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banque', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom_banque')->nullable();
            $table->string('cle_rib')->nullable();
            $table->string('titulaire')->nullable();
            $table->string('code_banque')->nullable();
            $table->string('domiciliation')->nullable();
            $table->string('code_postale')->nullable();
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
        Schema::dropIfExists('banque');
    }
}
