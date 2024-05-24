<?php

namespace App\Http\Controllers;

use App\Models\Laps;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        // Retrieve the last 5 laps from the database in chronological order
        $laps = Laps::latest()->take(5)->get();

        return view('statistics.index', compact('laps'));
    }
}
