<div class="block mt-4 relative">
    <select id="location_filter" name="location_filter" onchange="location.href = this.value;" class="block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200 rounded-md focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <!-- Remove or comment out the "All Locations" option -->
        {{-- <option value="{{ route('leaderboard.index') }}">All Locations</option> --}}
        @foreach ($locations as $location)
            <option value="{{ route('leaderboard.index', ['location_filter' => $location->id]) }}" {{ $selectedLocation == $location->id ? 'selected' : '' }}>{{ $location->location }}</option>
        @endforeach
    </select>
</div>
