<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SinistreAtRdSeeder extends Seeder
{
    public function run()
    {
        \Database\Factories\SinistreAtRdFactory::new()->count(30)->create();
    }
}