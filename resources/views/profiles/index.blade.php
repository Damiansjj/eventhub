<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alle Profielen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold mb-2">Ontdek onze community</h3>
                        <p class="text-gray-600">Bekijk de profielen van andere gebruikers en leer meer over onze community.</p>
                    </div>

                    @if($users->count() > 0)
                        <!-- Profile Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach($users as $user)
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                    <div class="p-6">
                                        <!-- Profile Photo -->
                                        <div class="flex justify-center mb-4">
                                            <img class="h-20 w-20 rounded-full object-cover border-2 border-gray-200" 
                                                 src="{{ $user->profile_photo_url }}" 
                                                 alt="{{ $user->display_name }}">
                                        </div>

                                        <!-- User Info -->
                                        <div class="text-center">
                                            <h4 class="text-lg font-semibold text-gray-900 mb-1">
                                                {{ $user->display_name }}
                                            </h4>
                                            
                                            @if($user->name !== $user->display_name)
                                                <p class="text-sm text-gray-500 mb-2">{{ $user->name }}</p>
                                            @endif

                                            @if($user->location)
                                                <p class="text-sm text-gray-500 mb-3 flex items-center justify-center">
                                                    <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    {{ $user->location }}
                                                </p>
                                            @endif

                                            @if($user->bio)
                                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                                    {{ Str::limit($user->bio, 80) }}
                                                </p>
                                            @endif

                                            <!-- View Profile Button -->
                                            <a href="{{ route('profiles.show', $user->username ?: $user->id) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Profiel Bekijken
                                            </a>
                                        </div>

                                        <!-- User Stats -->
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <div class="flex justify-between text-xs text-gray-500">
                                                <span>
                                                    @if($user->is_admin)
                                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Admin</span>
                                                    @else
                                                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded">Gebruiker</span>
                                                    @endif
                                                </span>
                                                <span>
                                                    Lid sinds {{ $user->created_at->format('M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $users->links() }}
                        </div>

                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Geen profielen gevonden</h3>
                            <p class="mt-1 text-sm text-gray-500">Er zijn nog geen gebruikers met een publiek profiel.</p>
                            
                            @auth
                                <div class="mt-6">
                                    <a href="{{ route('profiles.edit') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Maak je profiel aan
                                    </a>
                                </div>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>