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
        Schema::create('reservation', function (Blueprint $table) {
            $table->id();
            $table->string("libelle");
            $table->date("date_reservation");
            $table->dateTime("date_debut");
            $table->dateTime("date_fin");
            $table->unsignedBigInteger("materiel_id");
            $table->unsignedBigInteger("utilisateur_id");
            
            $table->foreign("materiel_id")->references("id")->on("materiel");
            $table->foreign("utilisateur_id")->references("id")->on("utilisateur");
            
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