<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Candidate;

class CandidateTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_candidate_model_and_table_exist(): void
    {
        $seedCandidate = [
			'name' => 'Maxim',
            'surname' => 'Iangaev'
		];

        $candidate = Candidate::factory()->create($seedCandidate);

        $this->assertModelExists($candidate);
        $this->assertDatabaseHas('candidates', $seedCandidate);
    }
}
