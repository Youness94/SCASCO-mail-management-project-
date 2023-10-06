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
        Schema::create('sinistres', function (Blueprint $table) {
            $table->id();
            $table->date('date_reception');
            $table->string('nom_police');
            $table->string('nom_assure');
            $table->string('num_sinistre');
            $table->string('nom_victime');

            $table->foreignId('branche_sinistre_id')->constrained('branches_sinistres_at_rd');
            $table->foreignId('compagnie_id')->constrained('compagnies');
            $table->foreignId('acte_de_gestion_sinistre_id')->constrained('acte_de_gestion_sinistres_at_rd');
            $table->foreignId('charge_compte_sinistre_id')->constrained('charge_compte_sinistres_at_rd');

            $table->date('date_remise');
            $table->date('date_traitement');
            $table->integer('delai_traitement')->nullable();
            $table->text('observation')->nullable();;

            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('sinistres');
    }
};
