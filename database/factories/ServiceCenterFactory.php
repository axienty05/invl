<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceCenter>
 */
class ServiceCenterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_service' => $this->faker->company,
            'no_telp' => $this->faker->phoneNumber,
            'alamat' => $this->faker->address,
            'cp' => $this->faker->name,
            'no_hp' => $this->faker->phoneNumber,
            'keterangan' => $this->faker->sentence,
        ];
    }
}