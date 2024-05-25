<?php
declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{Mission, Candidate};
use Illuminate\Support\Carbon;
use App\Monads\Maybe;

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

    public function test_that_factory_is_seeding_with_valid_candidate_id(): void
    {
        $this->seed();

        foreach(Mission::all() as $mission){
            $this->validateCandidateId($mission);
        }
    }

    private function validateCandidateId(Mission $mission): void
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $mission->start_date);
        $endDate = Carbon::createFromFormat('Y-m-d', $mission->end_date);

        if ($this->isActualDateSameAsMissionBeggining($startDate) ||
            $this->isActualDateBetweenMission($startDate, $endDate) ||
            $this->isActualDateAfterMission($endDate)) {
            $this->assertNotNull($mission->candidate_id);
        }

        if ($this->isActualDateBeforeMission($startDate)) {
            $this->assertNull($mission->candidate_id);
        }
    } 

    private function isActualDateSameAsMissionBeggining(?Carbon $startDate): bool
    {
        /** @phpstan-ignore-next-line */
        return Carbon::now()->isSameDay($startDate);
    }

    private function isActualDateBetweenMission(?Carbon $startDate, ?Carbon $endDate): bool
    {
        /** @phpstan-ignore-next-line */
        return Carbon::now()->between($startDate, $endDate);
    }

    private function isActualDateAfterMission(?Carbon $endDate): bool
    {
        /** @phpstan-ignore-next-line */
        return Carbon::now()->isAfter($endDate);
    }

    private function isActualDateBeforeMission(?Carbon $startDate): bool
    {  
        /** @phpstan-ignore-next-line */
        return Carbon::now()->isBefore($startDate);
    }
}
