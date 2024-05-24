<?php
declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{Mission, Candidate};
use Illuminate\Support\Carbon;

class MissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_mission_model_and_table_exist(): void
    {
        $seedMission = [
			'start_date' => '2024-06-01',
            'end_date' => '2024-06-30',
            'title' => 'Apollo'
		];

        $mission = Mission::factory()->create($seedMission);

        $this->assertModelExists($mission);
        $this->assertDatabaseHas('missions', $seedMission);
    }

    public function test_that_factory_is_seeding_with_valid_relationship()
    {
        $this->seed();

        foreach(Mission::all() as $mission){
            if($this->isActualDateBetweenMission($mission)){
                $this->assertNotNull($mission->candidate_id);
            }
        }
    }

    private function isActualDateBetweenMission(Mission $mission): bool
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $mission->start_date);
        $endDate = Carbon::createFromFormat('Y-m-d', $mission->end_date);
        
        return Carbon::now()->between($startDate, $endDate);
    }
}
