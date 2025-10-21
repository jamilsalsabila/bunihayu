<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nama" => $this->faker->unique()->sentence(3),
            "deskripsi" => $this->faker->paragraphs(3, true),
            "harga" => $this->faker->numberBetween(49999, 599999),
            "kapasitas" => $this->faker->numberBetween(2, 5),
            "fasilitas" => implode(",", $this->faker->randomElements(["wifi", "toilet", "air bersih", "a", "b", "c", "d", "e", "f"], 3)),
            //"foto" => $this->faker->filePath(),
        ];
    }
}
