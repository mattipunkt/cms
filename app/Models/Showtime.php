<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Showtime extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'time',
        'location_id',
        'event_id',
        'movie_id',
        'language',
    ];

    protected $casts = [
        'time' => 'datetime',
    ];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('time', '>', Carbon::now());
    }

    public function scopePast(Builder $query): Builder
    {
        return $query->where('time', '<', Carbon::now());
    }

    public function scopeToday(Builder $query): Builder
    {
        return $query->where('time', '<', Carbon::tomorrow())->where('time', '>', Carbon::now())->orderBy('time');
    }
}
