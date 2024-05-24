<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Leaderboard') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8"> <!-- Adjust padding for small screens -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 sm:p-6 lg:p-8"> <!-- Adjust padding for small screens -->
                @include('layouts.filter_leaderboard', ['locations' => $locations, 'selectedLocation' => $selectedLocation])
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 mt-4 sm:mt-8 border border-gray-300 dark:border-gray-600">
                        <thead>
                        <tr>
                            <th class="px-4 sm:px-6 py-3 sm:py-4 bg-gray-50 dark:bg-gray-800 text-left text-xs sm:text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Ranking
                            </th>
                            <th class="px-4 sm:px-6 py-3 sm:py-4 bg-gray-50 dark:bg-gray-800 text-left text-xs sm:text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-4 sm:px-6 py-3 sm:py-4 bg-gray-50 dark:bg-gray-800 text-left text-xs sm:text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Lap
                            </th>
                            <th class="px-4 sm:px-6 py-3 sm:py-4 bg-gray-50 dark:bg-gray-800 text-left text-xs sm:text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Lap Time
                            </th>
                            <th class="px-4 sm:px-6 py-3 sm:py-4 bg-gray-50 dark:bg-gray-800 text-left text-xs sm:text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Username
                            </th>
                            <th class="px-4 sm:px-6 py-3 sm:py-4 bg-gray-50 dark:bg-gray-800 text-left text-xs sm:text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Date and Time
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($leaderboardData as $lap)
                            <tr>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-no-wrap border-b border-gray-300 dark:border-gray-600">
                                    {{ $lap['rank'] }}
                                </td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-no-wrap border-b border-gray-300 dark:border-gray-600">
                                    {{ $lap['lap_id'] }}
                                </td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-no-wrap border-b border-gray-300 dark:border-gray-600">
                                    {{ $lap['lap_number'] }}
                                </td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-no-wrap border-b border-gray-300 dark:border-gray-600">
                                    {{ $lap['lap_time'] }}
                                </td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-no-wrap border-b border-gray-300 dark:border-gray-600">
                                    {{ $lap['username'] }}
                                </td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-no-wrap">
                                    @if ($lap['lap_datetime'])
                                        {{ $lap['lap_datetime'] }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
