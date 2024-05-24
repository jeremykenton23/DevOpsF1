<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($user)
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" width="100">
                        @else
                            <p>{{ __('No profile picture available.') }}</p>
                        @endif

                        <p>{{ __('Username: ') }} {{ $user->username }}</p>

                        @if($user->trophies > 0)
                            <p>{{ __('Trophies: ') }} {{ $user->trophies }}</p>
                        @else
                            <p>{{ __('No trophies earned yet.') }}</p>
                        @endif

                    @else
                        <p>{{ __('No profile information found.') }}</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
