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
            'name' => 'Dokter',
            'phone_number' => '01',
            'password' => Hash::make('dokter'),
            'role' => 'ADMIN'
        ]);


        User::create([
            'name' => 'Pasien',
            'phone_number' => '02',
            'password' => Hash::make('pasien'),
            'role' => 'PASIEN'
        ]);
    }
}
