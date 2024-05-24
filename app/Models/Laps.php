<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Testing\Fluent\Concerns\Has;

class Laps extends Model
{
    use HasFactory;

    protected $table = 'laps';
    protected $primaryKey = 'lap_id';
    protected $fillable = [
        'user_id',
        'location_id',
        'lap_datetime',
        'lap_time',
        'lap_number',
        'validated',
    ];
    protected $dates = [
        'lap_datetime',
    ];

    public function allowedLocation()
    {
        return $this->belongsTo(AllowedLocation::class, 'location_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
