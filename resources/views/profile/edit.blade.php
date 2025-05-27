<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Publiek profiel van {{ $user->username ?? $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($user->profile_picture)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profielfoto van {{ $user->username }}" class="w-32 h-32 object-cover rounded-full">
                    </div>
                @endif

                <p><strong>Gebruikersnaam:</strong> {{ $user->username ?? 'Geen naam opgegeven' }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Verjaardag:</strong> {{ $user->birthday ?? 'Niet opgegeven' }}</p>
                <p><strong>Over mij:</strong></p>
                <p>{{ $user->about_me ?? 'Nog geen beschrijving' }}</p>
            </div>
        </div>
    </div>
</x-app-layout>