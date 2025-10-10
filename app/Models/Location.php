<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
        'address',
    ];

    public function showtimes(): HasMany
    {
        return $this->hasMany(Showtime::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (Location $location) {
            // Ensure related showtimes are removed when a location is deleted
            $location->showtimes()->delete();
        });
    }
}
