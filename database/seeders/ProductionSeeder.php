<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Production;

class ProductionSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Production::factory(50)->create();
        // This will create 50 fake Production records
    }
}