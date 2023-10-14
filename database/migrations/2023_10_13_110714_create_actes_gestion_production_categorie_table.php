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
        Schema::create('actes_gestion_production_categorie', function (Blueprint $table) {
            $table->id();
            $table->string('categorie_name')->nullable();
            $table->timestamps();
        });
        DB::table('actes_gestion_production_categorie')->insert([
            ['categorie_name' => 'Attestation et Contrat'],
            ['categorie_name' => 'Avenants'],
            ['categorie_name' => 'Consultation'],
            ['categorie_name' => 'BX CNSS, PB & BP'],
            ['categorie_name' => 'DS Maladie'],
            ['categorie_name' => 'Annotation primes, Relance et règlements']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actes_gestion_production_categorie');
    }
};
