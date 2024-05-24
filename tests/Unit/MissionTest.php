<?php
declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{Mission, Candidate};
use Domain\Candidate\{Name, Surname};
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
}
