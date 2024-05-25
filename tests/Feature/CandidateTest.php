<?php
declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Candidate;

class CandidateTest  extends TestCase
{
    use RefreshDatabase;

    public function test_that_it_returns_a_list_of_candidates(): void
    {
        Candidate::factory(50)->create();

        $response = $this->getJson('/api/candidates');
        $response->assertStatus(200);
        $response->assertJsonCount(50, 'data');
    }
}
