<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string("libelle");
            $table->date("date_reservation");
            $table->dateTime("date_debut");
            $table->dateTime("date_fin");
            $table->unsignedBigInteger("materiel_id");
            $table->unsignedBigInteger("user_id");
            
            $table->foreign("materiel_id")->references("id")->on("materiels");
            $table->foreign("user_id")->references("id")->on("users");
            
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
        Schema::dropIfExists('reservations');
    }
};