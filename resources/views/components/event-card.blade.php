@props(['event'])

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    @if($event->image)
        <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
    @endif
    <div class="p-4">
        <div class="flex justify-between items-start mb-2">
            <h3 class="text-xl font-semibold">{{ $event->title }}</h3>
            @auth
                @if(auth()->user()->isAdmin())
                    <span class="text-sm {{ $event->is_published ? 'text-green-600' : 'text-red-600' }}">
                        {{ $event->is_published ? 'Gepubliceerd' : 'Niet gepubliceerd' }}
                    </span>
                @endif
            @endauth
        </div>
        <p class="text-gray-600 mb-2">{{ Str::limit($event->description, 100) }}</p>
        <div class="flex justify-between items-center text-sm text-gray-500">
            <span>{{ $event->location }}</span>
            <span>{{ $event->start_date->format('d/m/Y H:i') }}</span>
        </div>
        @if($event->price)
            <div class="mt-2 text-right">
                <span class="text-green-600 font-semibold">€{{ number_format($event->price, 2) }}</span>
            </div>
        @endif
        <div class="mt-4 flex justify-between items-center">
            <a href="{{ route('events.show', $event) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Meer info
            </a>
            @auth
                @if(auth()->user()->isAdmin())
                    <form action="{{ route('admin.events.update', $event) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="title" value="{{ $event->title }}">
                        <input type="hidden" name="description" value="{{ $event->description }}">
                        <input type="hidden" name="location" value="{{ $event->location }}">
                        <input type="hidden" name="start_date" value="{{ $event->start_date->format('Y-m-d\TH:i') }}">
                        <input type="hidden" name="end_date" value="{{ $event->end_date->format('Y-m-d\TH:i') }}">
                        <input type="hidden" name="max_participants" value="{{ $event->max_participants }}">
                        <input type="hidden" name="price" value="{{ $event->price }}">
                        <input type="hidden" name="category" value="{{ $event->category }}">
                        <input type="hidden" name="is_published" value="{{ !$event->is_published }}">
                        <button type="submit" class="text-{{ $event->is_published ? 'red' : 'green' }}-600 hover:text-{{ $event->is_published ? 'red' : 'green' }}-800">
                            {{ $event->is_published ? 'Depubliceren' : 'Publiceren' }}
                        </button>
                    </form>
                    <a href="{{ route('admin.events.edit', $event) }}" class="text-blue-600 hover:text-blue-800 ml-4">
                        Bewerken
                    </a>
                @endif
            @endauth
        </div>
    </div>
</div> 