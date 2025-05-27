<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Evenementen') }}
            </h2>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.events.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Nieuw evenement
                    </a>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <x-event-card :event="$event" />
                @endforeach
            </div>

            <div class="mt-6">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 