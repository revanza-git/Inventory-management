<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SecretCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('secret_code')->insert([
            'secretCode' => Hash::make('Nusantara08*Regas'),
        ]);
        DB::table('users')->insert([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'role'=>'superadmin',
            'departement'=>'procurement',
            'password'=> Hash::make('Nusantara1;')
        ]);
    }
}
