<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Profiel Informatie -->
                        <div>
                            <h2 class="text-2xl font-bold mb-4">Welkom {{ Auth::user()->name }}!</h2>
                            
                            <div class="mb-6">
                                @if(Auth::user()->profile_photo)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" 
                                         alt="Profielfoto" 
                                         class="w-32 h-32 rounded-full object-cover">
                                @else
                                    <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-4xl text-gray-500">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="space-y-3">
                                <p><strong>E-mail:</strong> {{ Auth::user()->email }}</p>
                                <p><strong>Lid sinds:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                                <p><strong>Rol:</strong> 
                                    @if(Auth::user()->is_admin)
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">Admin</span>
                                    @else
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">Gebruiker</span>
                                    @endif
                                </p>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('profile.edit') }}" 
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                    Profiel bewerken
                                </a>
                            </div>
                        </div>

                        <!-- Recente Activiteit -->
                        <div>
                            <h2 class="text-2xl font-bold mb-4">Recente Activiteit</h2>
                            <div class="space-y-4">
                                <!-- Hier kunnen we later activiteiten toevoegen -->
                                <p class="text-gray-600">Nog geen recente activiteiten.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
