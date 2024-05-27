<?php
declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Candidate;
use Domain\Candidate\ValueObjects\{Name, Surname};
use Domain\Candidate\Exceptions\InvalidNameException;
use App\Http\Resources\CandidateResource;

class CandidateTest extends TestCase
{
    use RefreshDatabase;

    /** @var array<mixed> */
    private array $seedCandidate;
    private Candidate $candidate;

    public function setUp(): void
    {
        parent::setUp();
        $this->seedCandidate = [
            'name' => (new Name('Maxim'))->display(),
            'surname' => (new Surname('Iangaev'))->display(),
        ];
        $this->candidate = Candidate::factory()->create($this->seedCandidate);
    }

    /** @phpstan-ignore-next-line */
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

    public function test_that_transforms_candidate_model_to_json(): void
    {
        $resource = new CandidateResource($this->candidate);

        $expectedJson = [
            'id' => $this->candidate->id,
            'name' => 'Maxim',
            'surname' => 'Iangaev',
            'current_mission' => '-',
            'total_missions' => 0
        ];

        $this->assertSame($expectedJson, $resource->toArray(request()));
    }
}
