<div class="block mt-4 relative">
    <select id="year_filter" name="year" onchange="location.href = this.value;" class="block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200 rounded-md focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <option value="{{ route('races.index') }}">All Years</option>
        @foreach ($years as $year)
            <option value="{{ route('races.index', ['year' => $year]) }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
        @endforeach
    </select>
</div>
