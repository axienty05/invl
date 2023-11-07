<?php

namespace Database\Factories;

use App\Enums\Kategori;
use App\Models\Pemakai;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'm_pemakai_id' => Pemakai::factory(),
            'kode_barang' => $this->faker->unique()->randomNumber(),
            'nama_barang' => $this->faker->word,
            'serial_number' => $this->faker->unique()->randomNumber(),
            'kategori' => $this->faker->randomElement([
                Kategori::Keyboard,
                Kategori::License,
                Kategori::Memory,
                Kategori::Mainboard,
                Kategori::Monitor,
                Kategori::Printer,
                Kategori::Mouse,
                Kategori::Scanner
            ]),
            'harga' => $this->faker->numberBetween(100, 1000),
            'keterangan' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['aktif', 'tidak_aktif', 'sedang_service']),
        ];
    }
}