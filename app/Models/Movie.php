<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

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
    ];

    public function showtimes(): Movie|HasMany
    {
        return $this->hasMany(Showtime::class);
    }
}
