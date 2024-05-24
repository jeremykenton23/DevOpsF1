<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

    public function leaderboard()
    {
        $locations = AllowedLocation::with(['laps' => function ($query) {
            $query->orderBy('lap_time', 'asc')
                ->take(5);
        }])->get();

        return view('leaderboard.index', compact('locations'));
    }
    protected $fillable = [
        'user_id',
        'location_id',
        'lap_datetime',
        'lap_time',
];

    protected $dates = [
        'lap_datetime',
    ];
}
