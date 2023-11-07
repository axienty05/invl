<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\Pemakai;
use App\Models\ServiceCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_sj' => $this->faker->unique()->numerify('SJ#####'),
            'm_pemakai_id' => Pemakai::factory(),
            'm_barang_id' => Barang::factory(),
            'm_service_center_id' => ServiceCenter::factory(),
            'tgl_service' => $this->faker->date(),
            'tgl_selesai' => $this->faker->optional()->date(),
            'biaya' => $this->faker->randomFloat(2, 100, 1000),
            'kerusakan' => $this->faker->sentence,
            'analisa' => $this->faker->paragraph,
            'solusi' => $this->faker->paragraph,
        ];
    }
}