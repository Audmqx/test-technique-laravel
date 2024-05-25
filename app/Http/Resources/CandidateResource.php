<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'surname' => $this->surname
        ];
    }
}
