<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Production;

class SinistreDimSeeder extends Seeder
{
    public function run()
    {
        \App\Models\SinistreDim::factory(50)->create();
        // This will create 50 fake Production records
    }
}