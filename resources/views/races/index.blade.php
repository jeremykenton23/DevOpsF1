<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Historical Races') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Year Filter -->
                    <div class="mb-4">
                        @include('layouts.filter_races', ['search' => $search, 'years' => $years, 'selectedYear' => $selectedYear])
                    </div>

                    <!-- Search Form -->
                    <form action="{{ route('races.index') }}" method="GET" class="mb-4 flex">
                        <input type="text" name="search" placeholder="Search races" value="{{ $search }}" class="w-full p-2 rounded border border-gray-300 dark:border-gray-700">
                        <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Search</button>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                            <tr>
                                <th class="px-4 py-2 md:px-6 md:py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs md:text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    ID
                                </th>
                                <th class="px-4 py-2 md:px-6 md:py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs md:text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Lap
                                </th>
                                <th class="px-4 py-2 md:px-6 md:py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs md:text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Location
                                </th>
                                <th class="px-4 py-2 md:px-6 md:py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs md:text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Date and Time
                                </th>
                                <th class="px-4 py-2 md:px-6 md:py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs md:text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Lap Time
                                </th>
                                <th class="px-4 py-2 md:px-6 md:py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs md:text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">

                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($laps as $lap)
                                <tr>
                                    <td class="px-4 py-2 md:px-6 md:py-4 whitespace-no-wrap">
                                        {{ $lap->lap_id }}
                                    </td>
                                    <td class="px-4 py-2 md:px-6 md:py-4 whitespace-no-wrap">
                                        {{ $lap->lap_number }}
                                    </td>
                                    <td class="px-4 py-2 md:px-6 md:py-4 whitespace-no-wrap">
                                        {{ $lap->allowedLocation->location }}
                                    </td>
                                    <td class="px-4 py-2 md:px-6 md:py-4 whitespace-no-wrap">
                                        @if ($lap->lap_datetime)
                                            {{ \Carbon\Carbon::parse($lap->lap_datetime)->format('d-m-Y H:i') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 md:px-6 md:py-4 whitespace-no-wrap">
                                        {{ $lap->lap_time ?? '' }}
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
