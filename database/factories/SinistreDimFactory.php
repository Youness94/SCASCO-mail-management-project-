<?php 
namespace Database\Factories;

use App\Models\ActeGestionDim;
use App\Models\BrancheDim;
use App\Models\ChargeCompteDim;
use App\Models\Compagnie;
use App\Models\SinistreDim;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SinistreDimFactory extends Factory
{
    protected $model = SinistreDim::class;

    public function definition()
    {
        $faker = $this->faker; // Add this line to initialize the Faker instance

        $brancheId = BrancheDim::inRandomOrder()->first()->id;
        $compagnieId = Compagnie::inRandomOrder()->first()->id;
        $actGestionId = ActeGestionDim::inRandomOrder()->first()->id;
        $chargeCompteId = ChargeCompteDim::inRandomOrder()->first()->id;
        $userId = User::inRandomOrder()->first()->id;
        

        return [
            'date_reception' => $faker->date,
            'num_declaration' => $faker->word,
            'nom_assure' => $faker->name,
            'nom_adherent' => $faker->name,
            'branche_dim_id' => $brancheId,
            'compagnie_id' => $compagnieId,
            'acte_gestion_dim_id' => $actGestionId,
            'charge_compte_dim_id' => $chargeCompteId,
            'date_remise' => $faker->date,
            'date_traitement' => $faker->date,
            'delai_traitement' => $faker->numberBetween(1, 30),
            'observation' => $faker->sentence,
            'user_id' => $userId,
        ];
    }

    
}