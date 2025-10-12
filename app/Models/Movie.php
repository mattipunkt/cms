<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'title',
        'year',
        'director',
        'actors',
        'genre',
        'country',
        'description',
        'image',
        'trailer_url',
        'runtime',
        'tmdb_id',
        'backdrop'
    ];

    public function showtimes(): HasMany
    {
        return $this->hasMany(Showtime::class);
    }

    public function upcomingShowtimes(): HasMany
    {
        return $this->showtimes()->upcoming();
    }

    public function pastShowtimes(): HasMany
    {
        return $this->showtimes()->past();
    }

}
