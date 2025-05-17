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
        // Insert security settings
        DB::table('security_settings')->insert([
            'max_login_attempts' => 5,
            'login_timeout_minutes' => 15,
            'password_expiry_days' => 90,
            'session_timeout_minutes' => 30,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Insert secret code with strong hash
        DB::table('secret_code')->insert([
            'secretCode' => Hash::make('default_secret_code'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Insert superadmin with secure password
        DB::table('users')->insert([
            'name' => 'System Administrator',
            'email' => 'admin@example.com',
            'role' => 'superadmin',
            'departement' => 'administration',
            'password' => Hash::make('default_password'),
            'password_changed_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
