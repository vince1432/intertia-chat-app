<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = Carbon::now()->subSeconds(rand(1,604800));
        $messageable = $this->messageable();

        return [
            'message' => fake()->paragraph(3),
            'sender_id' => User::all()->random()->id,
            'messageable_type' => $messageable,
            'messageable_id' => $messageable::all()->random()->id,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }

    public function messageable()
    {
        return $this->faker->randomElement([
            User::class,
            Group::class,
        ]);
    }
}
