<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->title(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    /**
     * Configure the model factory.
     */

    public function configure(): static {
        return $this->afterCreating(function (Group $group) {
            // Assign users to groups
            $attached_user = User::all()->random(rand(1, 3))->pluck('id')->toArray();
            $group->users()->attach($attached_user);
        });
    }
}
