<?php

namespace Database\Seeders;

use App\Models\GalleryModel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\Comments;
use Illuminate\Support\Facades\Storage;

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

        $produk1 = 'Glamping 100000';

        Produk::create([
            'nama' => $produk1,
            'deskripsi' => 'glamping adalah ',
            'fasilitas' => 'a,b,c',
            'harga' => 500000,
            'kapasitas' => 2,

        ]);

        Storage::disk('s3')->makeDirectory("images/$produk1");
        Storage::disk('s3')->copy('images/No_Image_Available.jpg', "images/$produk1/No_Image_Available.jpg");

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

        GalleryModel::create([
            'nama' => 'No_Image_Available.jpg',
            'idproduk' => $produk1,
            'foto' => 'No_Image_Available.jpg',
        ]);

    }
}
