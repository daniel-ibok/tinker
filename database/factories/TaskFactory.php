<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\TaskStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uuid = str()->uuid();
        return [
            'uuid' => (string) str()->uuid(),
            'title' => $this->faker->sentence(3),
            'email' => $this->faker->email(),
            'description' => $this->faker->paragraph(3),
            'status' => collect(['pending', 'completed', 'incompleted'])->random()
        ];
    }
}
