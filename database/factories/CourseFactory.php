<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape([
        'title' => "string",
        'section' => "string",
        'code' => "string",
        'description' => "string",
        'user_id' => "int",
        'created_at' => "\Illuminate\Support\Carbon",
        'updated_at' => "\Illuminate\Support\Carbon",
    ])
    ] public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'section' => $this->faker->languageCode(),
            'code' => $this->faker->shuffleString,
            'description' => $this->faker->paragraph(),
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
