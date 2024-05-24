<?php
declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Candidate;
use Domain\Candidate\{Name, Surname};
use Domain\Candidate\Exceptions\InvalidNameException;

class CandidateTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_candidate_model_and_table_exist(): void
    {
        $seedCandidate = [
			'name' => (new Name('Maxim'))->display(),
            'surname' => (new Surname('Iangaev'))->display(),
		];

        $candidate = Candidate::factory()->create($seedCandidate);

        $this->assertModelExists($candidate);
        $this->assertDatabaseHas('candidates', $seedCandidate);
    }

    public static function invalidNames(): array
    {
        return [
            ['Maxim 9'],
            ['a@'],
            ['123'],
            ['jean-{']
        ];
    }

    /**
     * @dataProvider invalidNames
     */
    public function test_throws_an_exception_for_invalid_names(string $input): void
    {
        $this->expectException(InvalidNameException::class);
        new Name($input);
    }
}
