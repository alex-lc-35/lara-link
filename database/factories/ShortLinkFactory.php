<?php

namespace Database\Factories;

use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ShortLink>
 */
class ShortLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = rtrim($this->faker->sentence(3), '.');

        return [
            'user_id' => User::factory(),
            'name' => $name,
            'link' => Str::slug($name),
            'url' => $this->faker->url(),
            'clicks' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
