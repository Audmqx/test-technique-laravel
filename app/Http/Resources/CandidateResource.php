<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use App\Monads\Maybe;

class CandidateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        return [
            /** @phpstan-ignore-next-line */
            'id' => $this->id,
            /** @phpstan-ignore-next-line */
            'name' => $this->name,
            /** @phpstan-ignore-next-line */
            'surname' => $this->surname,
            /** @phpstan-ignore-next-line */
            'current_mission' => Maybe::just($this->missions()->where('start_date', '<=', Carbon::now())->where('end_date', '>=', Carbon::now())->first())->getOrElse('-'),
            /** @phpstan-ignore-next-line */
            'total_missions' => $this->missions()->count()
        ];
    }
}
