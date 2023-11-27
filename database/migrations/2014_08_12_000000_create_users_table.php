<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('user_id')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('join_date')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('status')->nullable()->default('Active');
            $table->string('role_name')->nullable();
            $table->string('photo')->nullable();
            $table->string('position')->nullable();
            $table->string('department')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert([
            'name' => 'Support',
            'user_id' =>  Str::uuid(),
            'email' => 'support@gmail.com',
            'join_date' => now(),
            'phone_number' => null,
            'status' => 'Active',
            'role_name' => 'Super Admin',
            'photo' => null,
            'position' => null,
            'department' => null,
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
