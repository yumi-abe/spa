<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        $user_id = $this->faker->numberBetween(1, 3);
        return [
            'title' => $this->faker->realText(rand(15,40)),
            'is_done' => $this->faker->boolean(50),
            'user_id' => $user_id,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
