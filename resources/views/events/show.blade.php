<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $event->title }}
            </h2>
            @auth
                @if(auth()->user()->isAdmin())
                    <div class="space-x-2">
                        <a href="{{ route('admin.events.edit', $event) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                            Bewerken
                        </a>
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="return confirm('Weet je zeker dat je dit evenement wilt verwijderen?')">
                                Verwijderen
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($event->image)
                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="w-full h-96 object-cover">
                @endif
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2">
                            <h1 class="text-3xl font-bold mb-4">{{ $event->title }}</h1>
                            <div class="prose max-w-none">
                                {!! nl2br(e($event->description)) !!}
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4">Evenement Details</h3>
                            <div class="space-y-3">
                                <div>
                                    <span class="text-gray-600">Locatie:</span>
                                    <p class="font-medium">{{ $event->location }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-600">Start datum:</span>
                                    <p class="font-medium">{{ $event->start_date->format('d/m/Y H:i') }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-600">Eind datum:</span>
                                    <p class="font-medium">{{ $event->end_date->format('d/m/Y H:i') }}</p>
                                </div>
                                @if($event->max_participants)
                                    <div>
                                        <span class="text-gray-600">Maximum deelnemers:</span>
                                        <p class="font-medium">{{ $event->max_participants }}</p>
                                    </div>
                                @endif
                                @if($event->price)
                                    <div>
                                        <span class="text-gray-600">Prijs:</span>
                                        <p class="font-medium text-green-600">€{{ number_format($event->price, 2) }}</p>
                                    </div>
                                @endif
                                <div>
                                    <span class="text-gray-600">Categorie:</span>
                                    <p class="font-medium">{{ $event->category }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 