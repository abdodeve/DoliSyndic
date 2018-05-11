<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSyndicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syndic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_syndic')->nullable();
            $table->string('nom_syndic')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone_1')->nullable();
            $table->string('telephone_2')->nullable();
            $table->string('adresse')->nullable();
            $table->string('code_postale')->nullable(); 
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
            $table->string('rc')->nullable();
            $table->string('patente')->nullable();
            $table->string('carte_professionel')->nullable();
            $table->string('capitale')->nullable();
            $table->text('description')->nullable();
            $table->text('logo')->nullable();
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
        Schema::dropIfExists('syndic');
    }
}
