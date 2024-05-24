<?php
declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Candidate;
use Domain\Candidate\Name;
use Domain\Candidate\Exceptions\InvalidNameException;

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

    public function test_that_name_is_valid(): void
    {
        $name = new Name('Maxim');
        $this->assertSame('Maxim', $name->display());

        $this->expectException(InvalidNameException::class);
        new Name('Maxim 6');
    }
}
