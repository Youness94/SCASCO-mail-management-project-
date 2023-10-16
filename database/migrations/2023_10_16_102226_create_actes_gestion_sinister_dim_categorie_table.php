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
        Schema::create('actes_gestion_sinister_dim_categorie', function (Blueprint $table) {
            $table->id();
            $table->string('categorie_name')->nullable();
            $table->timestamps();
            
        });
        DB::table('actes_gestion_sinister_dim_categorie')->insert([
            ['categorie_name' => 'Bulletin d\'adhésion'],
            ['categorie_name' => 'Certificats médicaux et rapports'],
            ['categorie_name' => 'Demande d\'accord et PEC'],
            ['categorie_name' => 'Rejet et complément d\'information'],
            ['categorie_name' => 'Réclamation'],
            ['categorie_name' => 'Changement RIB et Situation'],
            ['categorie_name' => 'Décompte et cheque de règlement'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actes_gestion_sinister_dim_categorie');
    }
};
