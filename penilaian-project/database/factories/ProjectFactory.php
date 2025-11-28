<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => $this->faker->numberBetween(1, 2),
            'nama_project' => $this->faker->sentence(3),
            'deskripsi_project' => $this->faker->paragraph(5),
            'file_project' => 'files/' . $this->faker->uuid . '.jpg',
            'nilai' => $this->faker->numberBetween(60, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
