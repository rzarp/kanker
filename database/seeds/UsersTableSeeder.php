<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'phone_number' => '01',
            'password' => Hash::make('admin'),
            'role' => 'ADMIN'
        ]);


        User::create([
            'name' => 'Dokter',
            'phone_number' => '02',
            'password' => Hash::make('dokter'),
            'role' => 'DOKTER'
        ]);
    }
}
