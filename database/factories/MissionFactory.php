<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Candidate;
use DateTime;
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

        $candidate = Candidate::WithoutActiveMissions()->first();
        $candidate_id = null;
        if($this->isActualDateBetweenMission($startDate, $endDate)){
            $candidate_id = $candidate->id;
        }
        
        return [
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' =>  $endDate->format('Y-m-d'),
            'title' => $this->faker->jobTitle(),
            'candidate_id' => $candidate_id,
        ];
    }

    private function isActualDateBetweenMission(DateTime $startDate,DateTime $endDate): bool
    {
        return Carbon::now()->between($startDate, $endDate);
    }
}
