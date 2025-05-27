<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welkom bij EventHub') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @foreach ($news as $item)
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-xl font-bold">{{ $item->title }}</h3>
                <p>{{ $item->content }}</p>
                @if ($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="Nieuwsafbeelding" class="mt-4 w-48">
                @endif
                <p class="text-sm text-gray-500 mt-2">Gepubliceerd op {{ $item->published_at->format('d/m/Y') }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
