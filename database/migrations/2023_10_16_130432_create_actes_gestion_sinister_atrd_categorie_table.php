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
        Schema::create('actes_gestion_sinister_atrd_categorie', function (Blueprint $table) {
            $table->id();
            $table->string('categorie_name')->nullable();
            $table->timestamps();
        });
        DB::table('actes_gestion_sinister_atrd_categorie')->insert([
            ['categorie_name' => 'Certificats médicaux et rapports'],
            ['categorie_name' => 'Déclaration de sinistre'],
            ['categorie_name' => 'Chèques et quittances de règlement'],
            ['categorie_name' => 'Attestations de salaire et documents administratifs'],
            
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actes_gestion_sinister_atrd_categorie');
    }
};
