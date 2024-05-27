<?php
declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Candidate;
use Illuminate\Testing\TestResponse;

class CandidateTest  extends TestCase
{
    use RefreshDatabase;

    public function test_that_it_returns_a_list_of_candidates(): void
    {
        $this->seed();
        
        $response = $this->getJson('/api/candidates');
        $response->assertStatus(200);
        $responseData = $response->json('data');
        
        if (!is_array($responseData)) {
            $this->fail('Response data is not an array');
        }

        foreach ($responseData as $candidate) {
            $this->assertThatCandidateIsMissionless($candidate, $response);
    
            if($candidate['current_mission'] != '-'){
                $this->assertThatCandidateHasMission($candidate['current_mission'], $response);
            }
        }
    }

    /**
     * @param array{id: int, name: string, surname: string, total_missions: int, current_mission: mixed} $candidate
     */
    private function assertThatCandidateIsMissionless(array $candidate,TestResponse  $response): void
    {
        $response->assertJsonFragment([
            'id' => $candidate['id'],
            'name' => $candidate['name'],
            'surname' => $candidate['surname'],
            'total_missions' => $candidate['total_missions']
        ]);
    }
    
    /**
     * @param array{id: int, title: string, start_date: string, end_date: string} $mission
     */
    private function assertThatCandidateHasMission(array $mission,TestResponse  $response): void
    {
            $response->assertJsonFragment([
                'id' => $mission['id'],
                'title' => $mission['title'],
                'start_date' => $mission['start_date'],
                'end_date' => $mission['end_date'],
            ]);
    }
}
