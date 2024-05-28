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
     * @param Carbon $date
     * @return Collection<int, Candidate>
     */
    public static function withMissionEndingOn(Carbon $date): Collection
    {
        return self::whereHas('missions', function (Builder $query) use ($date) {
            $query->whereDate('end_date', '=', $date);
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
