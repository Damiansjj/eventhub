<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="mt-4">
    <a href="{{ route('news.create') }}" class="text-blue-500 underline">Nieuw nieuwsbericht toevoegen</a>
</div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                  <h1 class="text-2xl font-bold mb-4">{{ $user->username ?? $user->name }}</h1>

@if($user->profile_picture)
    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profielfoto" class="w-32 h-32 rounded-full mb-4">
@endif

<p><strong>Verjaardag:</strong> {{ $user->birthday ?? 'Niet ingevuld' }}</p>
<p><strong>Over mij:</strong> {{ $user->about_me ?? 'Niet ingevuld' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
