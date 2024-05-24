<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Candidate;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mission>
 */
class MissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $endDate = $this->faker->dateTimeBetween($startDate, '+2 years');

        return [
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' =>  $endDate->format('Y-m-d'),
            'title' => $this->faker->jobTitle()
        ];
    }
}
