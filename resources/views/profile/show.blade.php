<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profiel van {{ $user->display_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Profile Header -->
                    <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6 mb-8">
                        <!-- Profile Photo -->
                        <div class="flex-shrink-0">
                            <img class="h-32 w-32 rounded-full object-cover border-4 border-gray-200" 
                                 src="{{ $user->profile_photo_url }}" 
                                 alt="{{ $user->display_name }}">
                        </div>

                        <!-- User Info -->
                        <div class="flex-1 text-center md:text-left">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $user->display_name }}</h1>
                            
                            @if($user->name !== $user->display_name)
                                <p class="text-gray-600 mb-2">{{ $user->name }}</p>
                            @endif

                            <div class="flex flex-wrap justify-center md:justify-start gap-4 text-sm text-gray-500 mb-4">
                                @if($user->location)
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $user->location }}
                                    </span>
                                @endif

                                @if($user->birthday)
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $user->birthday->format('d M Y') }}
                                        @if($user->age)
                                            ({{ $user->age }} jaar)
                                        @endif
                                    </span>
                                @endif

                                @if($user->website)
                                    <a href="{{ $user->website }}" target="_blank" class="flex items-center text-blue-600 hover:text-blue-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                        </svg>
                                        Website
                                    </a>
                                @endif
                            </div>

                            <!-- Edit Button (alleen voor eigen profiel) -->
                            @auth
                                @if(Auth::user()->id === $user->id)
                                    <a href="{{ route('profiles.edit') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Profiel Bewerken
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>

                    <!-- Bio Section -->
                    @if($user->bio)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Over mij</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 leading-relaxed">{{ $user->bio }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Stats Section -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ $user->created_at->format('M Y') }}</div>
                            <div class="text-sm text-gray-600">Lid sinds</div>
                        </div>
                        
                        <div class="bg-green-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-green-600">
                                @if($user->is_admin)
                                    Admin
                                @else
                                    Gebruiker
                                @endif
                            </div>
                            <div class="text-sm text-gray-600">Status</div>
                        </div>
                        
                        <div class="bg-purple-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-purple-600">
                                {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                            </div>
                            <div class="text-sm text-gray-600">Laatste activiteit</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Profiles -->
            <div class="mt-6 text-center">
                <a href="{{ route('profiles.index') }}" 
                   class="text-blue-600 hover:text-blue-800 font-medium">
                    ← Terug naar alle profielen
                </a>
            </div>
        </div>
    </div>
</x-app-layout>