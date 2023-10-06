<?php

namespace Database\Factories;

use App\Models\Production;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Branche;
use App\Models\Compagnie;
use App\Models\ActGestion;
use App\Models\ChargeCompte;
use App\Models\User;

class ProductionFactory extends Factory
{
    protected $model = Production::class;

    public function definition()
    {
        $faker = $this->faker; // Add this line to initialize the Faker instance

        $brancheId = Branche::inRandomOrder()->first()->id;
        $compagnieId = Compagnie::inRandomOrder()->first()->id;
        $actGestionId = ActGestion::inRandomOrder()->first()->id;
        $chargeCompteId = ChargeCompte::inRandomOrder()->first()->id;
        $userId = User::inRandomOrder()->first()->id;

        return [
            'date_reception' => $faker->date,
            'nom_police' => $faker->word,
            'nom_assure' => $faker->name,
            'branche_id' => $brancheId,
            'compagnie_id' => $compagnieId,
            'act_gestion_id' => $actGestionId,
            'charge_compte_id' => $chargeCompteId,
            'date_remise' => $faker->date,
            'date_traitement' => $faker->date,
            'delai_traitement' => $faker->numberBetween(1, 30),
            'observation' => $faker->sentence,
            'user_id' => $userId,
        ];
    }
}