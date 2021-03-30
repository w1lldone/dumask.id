<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::truncate();

        User::create([
            'name' => 'administrator',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'is_superadmin' => 1,
        ]);

        User::factory(20)->create();
        
    }
}
