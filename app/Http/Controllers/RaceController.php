<?php

namespace App\Http\Controllers;

use App\Models\Laps;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RaceController extends Controller
{
    public function index(Request $request): View
    {
        // Retrieve all laps
        $lapsQuery = Laps::query();

        // Check if the 'search' parameter is present in the request
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $lapsQuery->where(function ($query) use ($searchTerm) {
                $query->orWhere('lap_id', 'like', "%$searchTerm%")
                    ->orWhere('lap_number', 'like', "%$searchTerm%")
                    ->orWhereHas('allowedLocation', function ($subquery) use ($searchTerm) {
                        $subquery->where('location', 'like', "%$searchTerm%");
                    })
                    ->orWhere('lap_datetime', 'like', "%$searchTerm%");
            });
        }

        // Get unique years of laps for filtering
        $years = Laps::selectRaw('YEAR(lap_datetime) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Filter laps based on the selected year
        $selectedYear = $request->input('year');

        if ($selectedYear) {
            $lapsQuery->whereYear('lap_datetime', '=', $selectedYear);
        }

        $laps = $lapsQuery->get();

        return view('races.index', [
            'laps' => $laps,
            'search' => $request->input('search'),
            'years' => $years,
            'selectedYear' => $selectedYear,
        ]);
    }
}
