<?php

namespace Database\Factories;

use App\Enums\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemakai>
 */
class PemakaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name,
            'department' => fake()->randomElement(
                [
                    Department::EXIM,
                    Department::RND,
                    Department::HRD,
                    Department::ISO,
                    Department::IT,
                    Department::LAB
                ]
            ),
        ];
    }
}