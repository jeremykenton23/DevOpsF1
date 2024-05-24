<?php

namespace App\Http\Controllers;

use App\Models\AllowedLocation;
use App\Models\Laps;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class LapsController extends Controller
{

    public function index(Request $request): View
    {
        // Check if the authenticated user is an admin
        $isAdmin = $request->user()->isAdmin();

        // Retrieve all laps or laps associated with the authenticated user
        $lapsQuery = $isAdmin ? Laps::query() : $request->user()->laps();

        // Apply filters if provided in the request
        if ($request->filled('location')) {
            $lapsQuery->where('location_id', $request->input('location'));
        }

        // Define the current sorting criteria and direction based on query parameters
        $currentSort = $request->get('sort', 'lap_datetime');
        $currentDirection = $request->get('direction', 'asc');
        $currentSortLabel = '';
        if ($currentSort === 'lap_number') {
            $currentSortLabel = $currentDirection === 'asc' ? 'First Lap ' : 'Last Lap ';
        } elseif ($currentSort === 'lap_datetime') {
            $currentSortLabel = $currentDirection === 'asc' ? 'Oldest First' : 'Newest First';
        } elseif ($currentSort === 'location_id') {
            $currentSortLabel = $currentDirection === 'asc' ? 'Location Name (A-Z)' : 'Location Name (Z-A)';
        } elseif ($currentSort === 'validated') {
            $currentSortLabel = $currentDirection === 'asc' ? 'To Be Validated' : 'To Be Unvalidated';
        }

        // Apply sorting to the query
        $lapsQuery->orderBy($currentSort, $currentDirection);

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $lapsQuery->where(function ($query) use ($searchTerm) {
                $query->where('lap_id', 'LIKE', "%$searchTerm%")
                    ->orWhere('lap_number', 'LIKE', "%$searchTerm%")
                    ->orWhere('lap_datetime', 'LIKE', "%$searchTerm%")
                    ->orWhereHas('allowedLocation', function ($subquery) use ($searchTerm) {
                        $subquery->where('location', 'LIKE', "%$searchTerm%");
                    });
            });
        }

        // Use the `get` method with the arguments to retrieve the laps
        $laps = $lapsQuery->get();

        // Retrieve a list of allowed locations from the database
        $allowedLocations = AllowedLocation::all();

        return view('laps.index', [
            'laps' => $laps,
            'currentSort' => $currentSort,
            'currentDirection' => $currentDirection,
            'currentSortLabel' => $currentSortLabel,
            'allowedLocations' => $allowedLocations,
        ]);
    }

    public function create()
    {
        // Retrieve a list of allowed locations from the database
        $allowedLocations = AllowedLocation::all();

        return view('laps.create', [
            'allowedLocations' => $allowedLocations,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'location_id' => 'required|exists:allowed_locations,id',
            'lap_datetime' => 'required|date',
            'lap_time' => 'required|regex:/^\d{2}:\d{2},\d{2}$/',
            'lap_number' => 'required|integer|between:1,99',
        ]);

        // Parse lap time
        $lapTime = Carbon::createFromFormat('i:s,u', $request->input('lap_time') . '00');


        // Create the lap
        $lap = $request->user()->laps()->create([
            'location_id' => $request->input('location_id'),
            'lap_datetime' => $request->input('lap_datetime'),
            'lap_time' => $request->input('lap_time'), // Store as MM:SS.u
            'lap_number' => $request->input('lap_number'),
        ]);

        return redirect()->route('laps.index')->with('success', 'Lap created successfully!');
    }

    public function edit( Laps $lap)
    {
        // Retrieve a list of allowed locations from the database
        $allowedLocations = AllowedLocation::all();

        return view('laps.edit', [
            'lap' => $lap,
            'allowedLocations' => $allowedLocations,

        ]);

    }

    public function update(Request $request, Laps $lap)
    {
        $request->validate([
            'location_id' => 'required|exists:allowed_locations,id',
            'lap_datetime' => 'required|date',
            'lap_time' => 'required|regex:/^\d{2}:\d{2},\d{2}$/',
            'lap_number' => 'required|integer|between:1,99',
        ]);
        $lap->update([
            'location_id' => $request->input('location_id'),
            'lap_datetime' => $request->input('lap_datetime'),
            'lap_time' => $request->input('lap_time'),
            'lap_number' => $request->input('lap_number'),
        ]);

        return redirect()->route('laps.index')->with('success', 'Lap updated successfully!');
    }

    public function ajaxValidate(Request $request, Laps $lap)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['error' => 'You do not have permission to validate this lap.'], 403);
        }

        // Update the lap's validation status to true
        $lap->validated = true;
        $lap->save();

        return response()->json(['message' => 'Lap validated successfully.']);
    }

    public function ajaxUnvalidate(Request $request, Laps $lap)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['error' => 'You do not have permission to unvalidate this lap.'], 403);
        }

        // Update the lap's validation status to false
        $lap->validated = false;
        $lap->save();

        return response()->json(['message' => 'Lap unvalidated successfully.']);
    }

    public function destroy(Request $request)
    {
        $lap = $request->user()->laps()->find($request->input('lap_id'));

        if ($lap) {
            $lap->delete();
            return redirect()->route('laps.index')->with('success', 'Lap deleted successfully!');
        } else {
            return redirect()->route('laps.index')->with('error', 'Lap not found.');
        }
    }
}
