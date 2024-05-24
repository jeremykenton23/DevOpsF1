<?php

namespace App\Http\Controllers;

use App\Models\AllowedLocation;
use App\Models\Laps;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the list of allowed locations
        $locations = AllowedLocation::all();

        // Retrieve the selected location filter from the request
        $selectedLocation = $request->input('location_filter');

        // If no location filter is provided in the request, set it to the first allowed location's ID
        if (empty($selectedLocation) && $locations->count() > 0) {
            $selectedLocation = $locations->first()->id;
        }

        // Fetch validated lap data based on the selected location filter
        $lapsQuery = Laps::where('validated', true);

        if (!empty($selectedLocation)) {
            $lapsQuery->where('location_id', $selectedLocation);
        }

        $laps = $lapsQuery->orderBy('lap_time', 'asc')
            ->take(5)
            ->get();

        // Initialize a rank counter
        $rank = 1;

        // Create an array to store the formatted leaderboard data
        $leaderboardData = [];

        // Assign ranks and format lap data
        foreach ($laps as $lap) {
            $leaderboardData[] = [
                'rank' => $rank,
                'lap_id' => $lap->lap_id,
                'lap_time' => $lap->lap_time,
                'username' => $lap->user->username,
                'lap_number'=> $lap->lap_number,
                'lap_datetime' => $lap->lap_datetime ? \Carbon\Carbon::parse($lap->lap_datetime)->format('d-m-Y H:i') : 'N/A',
            ];

            $rank++;
        }

        // Retrieve the selected location's name
        $selectedLocationName = $selectedLocation ? AllowedLocation::find($selectedLocation)->location : null;

        return view('leaderboard.index', [
            'leaderboardData' => $leaderboardData,
            'selectedLocation' => $selectedLocation, // Pass the selected location ID to the view
            'selectedLocationName' => $selectedLocationName, // Pass the selected location's name to the view
            'locations' => $locations, // Pass the list of allowed locations to the view
        ]);
    }
}
