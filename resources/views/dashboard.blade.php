<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>

                <div class="py-4">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('laps.index') }}" class="w-full sm:w-1/3 h-20 flex items-center justify-center rounded-md border border-black bg-white dark:bg-gray-800 p-2 text-black dark:text-white hover:bg-gray-600 dark:hover:bg-gray-600 hover:text-white dark:hover:text-white">Laps</a>
                            <a href="{{ route('leaderboard.index') }}" class="w-full sm:w-1/3 h-20 flex items-center justify-center rounded-md border border-black bg-white dark:bg-gray-800 p-2 text-black dark:text-white hover:bg-gray-600 dark:hover:bg-gray-600 hover:text-white dark:hover:text-white">Leaderboard</a>
                            <a href="{{ route('races.index') }}" class="w-full sm:w-1/3 h-20 flex items-center justify-center rounded-md border border-black bg-white dark:bg-gray-800 p-2 text-black dark:text-white hover:bg-gray-600 dark:hover:bg-gray-600 hover:text-white dark:hover:text-white">Historical Races</a>
                            <a href="{{ route('statistics.index') }}" class="w-full sm:w-1/3 h-20 flex items-center justify-center rounded-md border border-black bg-white dark:bg-gray-800 p-2 text-black dark:text-white hover:bg-gray-600 dark:hover:bg-gray-600 hover:text-white dark:hover:text-white">Statistics</a>
                            <a href="{{ route('prizes.index') }}" class="w-full sm:w-1/3 h-20 flex items-center justify-center rounded-md border border-black bg-white dark:bg-gray-800 p-2 text-black dark:text-white hover:bg-gray-600 dark:hover:bg-gray-600 hover:text-white dark:hover:text-white">Prizes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
