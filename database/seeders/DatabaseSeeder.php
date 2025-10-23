<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\Comments;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);

        Produk::factory(5)->create();

        User::create([
            "name" => "admin",
            "email" => "admin@bunihayu.com",
            "password" => bcrypt("Dede1234."),
            'isadmin' => true,
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@bunihayu.com',
            'password' => bcrypt('Aa2222..'),
            'isadmin' => false,
        ]);

        //Comments::factory(10)->create();
    }
}
