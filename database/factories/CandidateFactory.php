<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Domain\Candidate\ValueObjects\{Name, Surname};


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => (new Name($this->faker->firstName))->display(),
            'surname' => (new Surname($this->faker->lastName))->display(),
        ];
    }
}
