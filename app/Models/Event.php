<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasUuids;

    protected $fillable = [
        'name'
    ];

    public function showtimes(): HasMany
    {
        return $this->hasMany(Showtime::class);
    }
}
