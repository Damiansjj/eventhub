<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('EventHub - Ontdek Geweldige Evenementen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Featured Events Section -->
            <div class="mb-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-900">Aankomende Evenementen</h2>
                    <a href="{{ route('events.index') }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Bekijk alle evenementen →</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($events as $event)
                        <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">
                            @if($event->image)
                                <img class="h-56 w-full object-cover" 
                                     src="{{ asset('storage/' . $event->image) }}" 
                                     alt="{{ $event->title }}">
                            @else
                                <div class="h-56 w-full bg-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <h3 class="text-2xl font-semibold text-gray-900 mb-3">
                                    <a href="{{ route('events.show', $event) }}" class="hover:text-indigo-600">
                                        {{ $event->title }}
                                    </a>
                                </h3>
                                
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $event->start_date->format('d M Y H:i') }}
                                </div>
                                
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $event->location }}
                                </div>

                                <a href="{{ route('events.show', $event) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                    Meer info
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Latest News Section -->
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Laatste Updates</h2>
                    <a href="{{ route('news.index') }}" class="text-gray-600 hover:text-gray-900">Bekijk alle updates →</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($news as $article)
                        <div class="bg-white overflow-hidden shadow rounded-lg hover:shadow-lg transition-shadow duration-300">
                            <img class="h-40 w-full object-cover" 
                                 src="{{ $article->featured_image_url }}" 
                                 alt="{{ $article->title }}">
                            
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">
                                    <a href="{{ route('news.show', $article->slug) }}" class="hover:text-indigo-600">
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-4">
                                    {{ Str::limit($article->excerpt, 100) }}
                                </p>
                                
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <span>{{ $article->published_at->format('d M Y') }}</span>
                                    <span>{{ $article->views }} views</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 