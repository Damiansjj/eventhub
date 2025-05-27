@props(['news'])

<article class="bg-white rounded-lg shadow-md overflow-hidden">
    @if($news->image)
        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-48 object-cover">
    @endif
    <div class="p-6">
        <h2 class="text-xl font-semibold mb-2">{{ $news->title }}</h2>
        <div class="text-gray-600 mb-4">
            <time datetime="{{ $news->created_at->format('Y-m-d') }}">
                {{ $news->created_at->format('d M Y') }}
            </time>
        </div>
        <p class="text-gray-600 mb-4">{{ Str::limit($news->content, 150) }}</p>
        <a href="{{ route('news.show', $news) }}" class="text-blue-600 hover:text-blue-800">
            Lees meer
        </a>
    </div>
</article> 