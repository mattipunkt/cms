<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
