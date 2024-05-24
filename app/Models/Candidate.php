<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Collection, Model};
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Candidate extends Model
{
    use HasFactory;
    
    /**
     * @return \App\Models\Candidate|null
     */
    public static function WithoutMissions(): Candidate|null
    {
        return self::WhereDoesntHave('missions')->inRandomOrder()->first();
    }

    /**
     * @return Collection<int, Candidate>
     */
    public static function WithoutActiveMissions(): Collection
    {
        return self::whereDoesntHave('missions', function (Builder $query) {
            $query->where('end_date', '>=', Carbon::now());
        })->get();
    }


    /**
     * @return HasMany<Mission>
     */
    public function missions(): HasMany
    {
        return $this->hasMany(Mission::class);
    }
}
