<?php 
namespace Database\Factories;

use App\Models\ActeDeGestionSinistresAtRd;
use App\Models\Branche;
use App\Models\BranchSinistresAtRd;
use App\Models\ChargeCompteSinistres;
use App\Models\Compagnie;
use App\Models\Sinistre;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SinistreAtRdFactory extends Factory
{
    protected $model = Sinistre::class;

    public function definition()
    {
        $faker = $this->faker; // Add this line to initialize the Faker instance

        $brancheId = BranchSinistresAtRd::inRandomOrder()->first()->id;
        $compagnieId = Compagnie::inRandomOrder()->first()->id;
        $actGestionId = ActeDeGestionSinistresAtRd::inRandomOrder()->first()->id;
        $chargeCompteId = ChargeCompteSinistres::inRandomOrder()->first()->id;
        $userId = User::inRandomOrder()->first()->id;
        
        return [
            'date_reception' => $faker->date,
            'nom_police' => $faker->sentence,
            'nom_assure' => $faker->name,
            'num_sinistre' => $faker->unique()->numerify('###-###-###'),
            'nom_victime' => $faker->name,
            'branche_sinistre_id' => $brancheId,
            'compagnie_id' => $compagnieId,
            'acte_de_gestion_sinistre_id' => $actGestionId,
            'charge_compte_sinistre_id' => $chargeCompteId,
            'date_remise' => $faker->date,
            'date_traitement' => $faker->date,
            'delai_traitement' => $faker->numberBetween(1, 30),
            'observation' => $faker->text,
            'user_id' => $userId,
        ];
        
    }

    
}