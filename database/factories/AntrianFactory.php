<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Antrian>
 */
class AntrianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_layanan' => fake()->words(2, true),
            'kode' => fake()->randomLetter() . fake()->randomDigitNotNull(),
            'deskripsi' => fake()->sentence(),
            'persyaratan' => fake()->paragraph(),
            'kuota' => fake()->numberBetween(10, 100),
            'slug' => fake()->slug(),
            'user_id' => User::factory(),
        ];
    }
}
