<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_supplier' => $this->faker->company,
            'alamat' => $this->faker->address,
            'email' => $this->faker->email,
            'no_telp' => $this->faker->phoneNumber,
            'cp' => $this->faker->name,
            'no_hp' => $this->faker->phoneNumber,
            'keterangan' => $this->faker->sentence,
        ];
    }
}