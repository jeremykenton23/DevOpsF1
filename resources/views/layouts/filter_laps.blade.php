<div class=" sm:flex sm:items-center sm:ms-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <div>{{ $currentSortLabel }}</div>

                <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">
            <a href="{{ route('laps.index', ['sort' => 'lap_datetime', 'direction' => ($currentSort === 'lap_datetime' && $currentDirection === 'asc') ? 'desc' : 'asc']) }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-400 focus:bg-gray-100 dark:focus:bg-gray-700 focus:text-gray-900 dark:focus:text-gray-400">{{ __('Date and Time') }} ({{ $currentSort === 'lap_datetime' ? ($currentDirection === 'asc' ? 'Asc' : 'Desc') : 'Asc' }})</a>
            <a href="{{ route('laps.index', ['sort' => 'location_id', 'direction' => ($currentSort === 'location_id' && $currentDirection === 'asc') ? 'desc' : 'asc']) }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-400 focus:bg-gray-100 dark:focus:bg-gray-700 focus:text-gray-900 dark:focus:text-gray-400">{{ __('Location Name') }} ({{ $currentSort === 'location_id' ? ($currentDirection === 'asc' ? 'Asc' : 'Desc') : 'Asc' }})</a>
            <a href="{{ route('laps.index', ['sort' => 'lap_number', 'direction' => ($currentSort === 'lap_number' && $currentDirection === 'asc') ? 'desc' : 'asc']) }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-400 focus:bg-gray-100 dark:focus:bg-gray-700 focus:text-gray-900 dark:focus:text-gray-400">{{ __('Lap') }} ({{ $currentSort === 'lap_number' ? ($currentDirection === 'asc' ? 'Asc' : 'Desc') : 'Asc' }})</a>
            <a href="{{ route('laps.index', ['sort' => 'validated', 'direction' => ($currentSort === 'validated' && $currentDirection === 'asc') ? 'desc' : 'asc']) }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-400 focus:bg-gray-100 dark:focus:bg-gray-700 focus:text-gray-900 dark:focus:text-gray-400">{{ __('Validation Status') }} ({{ $currentSort === 'validated' ? ($currentDirection === 'asc' ? 'Asc' : 'Desc') : 'Asc' }})</a>
        </x-slot>
    </x-dropdown>
</div>
