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
        Schema::create('sinistres_dim', function (Blueprint $table) {
            $table->id();
            $table->date('date_reception');
            $table->string('num_declaration');
            $table->string('nom_assure');
            $table->string('nom_adherent');

            $table->foreignId('charge_compte_dim_id')->constrained('charges_comptes_dim');
            $table->foreignId('compagnie_id')->constrained('compagnies');
            $table->foreignId('acte_gestion_dim_id')->constrained('acte_gestions_dim');
            $table->foreignId('branche_dim_id')->constrained('branches_dim');

            $table->date('date_remise');
            $table->date('date_traitement');
            $table->integer('delai_traitement')->nullable();
            $table->text('observation');

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
        Schema::dropIfExists('sinistres_dim');
    }
};
