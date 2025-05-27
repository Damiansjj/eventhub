<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}'s Profiel
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row">
                        <!-- Profile Photo -->
                        <div class="md:w-1/3 flex flex-col items-center">
                            <img class="w-48 h-48 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                            <h1 class="text-2xl font-bold mt-4">{{ $user->name }}</h1>
                            @if($user->username)
                                <p class="text-gray-600">{{ '@' . $user->username }}</p>
                            @endif
                        </div>

                        <!-- Profile Info -->
                        <div class="md:w-2/3 mt-6 md:mt-0">
                            @if($user->about_me)
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold mb-2">Over mij</h3>
                                    <p class="text-gray-600">{{ $user->about_me }}</p>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if($user->location)
                                    <div>
                                        <h3 class="font-semibold">Locatie</h3>
                                        <p class="text-gray-600">{{ $user->location }}</p>
                                    </div>
                                @endif

                                @if($user->website)
                                    <div>
                                        <h3 class="font-semibold">Website</h3>
                                        <a href="{{ $user->website }}" class="text-blue-600 hover:underline" target="_blank" rel="noopener noreferrer">
                                            {{ $user->website }}
                                        </a>
                                    </div>
                                @endif

                                @if($user->birthday)
                                    <div>
                                        <h3 class="font-semibold">Leeftijd</h3>
                                        <p class="text-gray-600">{{ $user->age }} jaar</p>
                                    </div>
                                @endif

                                <div>
                                    <h3 class="font-semibold">Lid sinds</h3>
                                    <p class="text-gray-600">{{ $user->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>

                            @if(Auth::id() === $user->id)
                                <div class="mt-6">
                                    <a href="{{ route('profiles.edit') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                                        Profiel bewerken
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 