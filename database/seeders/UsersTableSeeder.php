<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();
        DB::table('users')->insert([
            // Admin
            [
            
                'name'=>'Support informatique',
                'email'=> 'supportinformatique@gmail.com',
                'password' => Hash::make('1234567890'),
                'role_name' => 'Super Admin',
                'status' => 'Active',
                
            ],
            
             
             
            
        ]);
    }
}
