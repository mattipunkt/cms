<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Booklet extends Model
{
    use hasUuids;
    protected $fillable = [
        'name',
        'path'
    ];
}
