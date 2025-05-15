<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            'name' => "admin",
            'description' => "admin role"
        ]);

        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => "ABDELKEBIR HADOUI",
                'email' => "admin@admin.com",
                'password' => Hash::make("admin_admin"),
                'role_id' => 1,
            ]);
        }
    }
}
