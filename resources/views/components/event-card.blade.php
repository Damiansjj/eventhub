@props(['event'])

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    @if($event->image)
        <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
    @endif
    <div class="p-4">
        <h3 class="text-xl font-semibold mb-2">{{ $event->title }}</h3>
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
        <div class="mt-4">
            <a href="{{ route('events.show', $event) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Meer info
            </a>
        </div>
    </div>
</div> 