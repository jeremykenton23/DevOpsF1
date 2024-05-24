<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laps') }}
        </h2>
    </x-slot>
    <div class="py-6 px-4 md:py-12 md:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 md:p-6 text-gray-900 dark:text-gray-100">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-4">
                    <a href="{{ route('laps.create') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-600">
                        Create Lap
                    </a>
                </div>
                <div class="mb-4">
                    <form action="{{ route('laps.index') }}" method="GET">
                        <input type="text" name="search" placeholder="Search laps" value="{{ old('search', $search ?? '') }}">
                        <button type="submit">Search</button>
                    </form>
                </div>
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
                                Actions
                            </th>
                            <th class="px-4 py-2 md:px-6 md:py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs md:text-sm leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                @include('layouts.filter_laps')
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
                                <td class="px-4 py-2 md:px-6 md:py-4 whitespace-no-wrap">
                                    <a href="{{ route('laps.edit', ['lap' => $lap->lap_id]) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-600">
                                        Edit
                                    </a>
                                    <form method="post" action="{{ route('laps.destroy', ['lap_id' => $lap]) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this lap?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-2 md:px-6 md:py-4 whitespace-no-wrap">
                                    @can('validate-lap', $lap)
                                        @if ($lap->validated)
                                            <form class="inline" id="unvalidate-form-{{ $lap->lap_id }}">
                                                @csrf
                                                <button type="button" class="unvalidate-button text-orange-600 dark:text-orange-400 hover:text-orange-900 dark:hover:text-orange-600">
                                                    Unvalidate
                                                </button>
                                            </form>
                                        @else
                                            <form class="inline" id="validate-form-{{ $lap->lap_id }}">
                                                @csrf
                                                <button type="button" class="validate-button text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-600">
                                                    Validate
                                                </button>
                                            </form>
                                        @endif
                                    @endcan
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".validate-button, .unvalidate-button").click(function() {
            var lapId = $(this).closest("form").attr("id").split("-")[2];
            var isValidateAction = $(this).hasClass("validate-button");
            var button = $(this); // Store a reference to the button

            $.ajax({
                type: "POST",
                url: isValidateAction ? `/laps/ajax-validate/${lapId}` : `/laps/ajax-unvalidate/${lapId}`,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "_method": "PUT",
                },
                success: function(response) {
                    if (isValidateAction) {
                        button.text("Unvalidate"); // Update button text
                        button.removeClass("validate-button").addClass("unvalidate-button"); // Update button class
                        button.css("color", "orange"); // Change text color to orange
                    } else {
                        button.text("Validate"); // Update button text
                        button.removeClass("unvalidate-button").addClass("validate-button"); // Update button class
                        button.css("color", "green"); // Change text color to green
                    }
                },
                error: function(response) {
                    // Handle errors if necessary
                }
            });
        });
    });
</script>
