<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Showtime extends Model
{
    use HasUuids;

    protected $fillable = [
        'time',
        'location_id',
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
        return $query->where('time', '<', Carbon::tomorrow())->where('time', '>', Carbon::now());
    }
}
