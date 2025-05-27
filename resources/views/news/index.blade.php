<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laatste Nieuwtjes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($news->count() > 0)
                <!-- Featured Article (First Article) -->
                @if($news->first())
                    <div class="mb-12">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="md:flex">
                                <div class="md:flex-shrink-0 md:w-1/2">
                                    <img class="h-64 w-full object-cover md:h-full" 
                                         src="{{ $news->first()->featured_image_url }}" 
                                         alt="{{ $news->first()->title }}">
                                </div>
                                <div class="p-8 md:w-1/2">
                                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold mb-2">
                                        Uitgelicht
                                    </div>
                                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                                        <a href="{{ route('news.show', $news->first()->slug) }}" class="hover:text-indigo-600">
                                            {{ $news->first()->title }}
                                        </a>
                                    </h1>
                                    <p class="text-gray-600 mb-4 leading-relaxed">
                                        {{ $news->first()->excerpt }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <span>Door {{ $news->first()->author->name }}</span>
                                            <span class="mx-2">•</span>
                                            <span>{{ $news->first()->published_at->format('d M Y') }}</span>
                                            <span class="mx-2">•</span>
                                            <span>{{ $news->first()->views }} views</span>
                                        </div>
                                        <a href="{{ route('news.show', $news->first()->slug) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Lees Meer
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Other Articles Grid -->
                @if($news->count() > 1)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                        @foreach($news->skip(1) as $article)
                            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg hover:shadow-xl transition-shadow duration-300">
                                <img class="h-48 w-full object-cover" 
                                     src="{{ $article->featured_image_url }}" 
                                     alt="{{ $article->title }}">
                                
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                                        <a href="{{ route('news.show', $article->slug) }}" class="hover:text-indigo-600">
                                            {{ $article->title }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 mb-4">
                                        {{ Str::limit($article->excerpt, 120) }}
                                    </p>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm text-gray-500">
                                            <p>{{ $article->author->name }}</p>
                                            <p>{{ $article->published_at->format('d M Y') }}</p>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            {{ $article->views }}
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <a href="{{ route('news.show', $article->slug) }}" 
                                           class="text-indigo-600 hover:text-indigo-900 font-medium">
                                            Lees meer →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $news->links() }}
                </div>

            @else
                <!-- Empty State -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Geen nieuws beschikbaar</h3>
                        <p class="mt-1 text-sm text-gray-500">Er zijn momenteel geen gepubliceerde nieuwsartikelen.</p>
                        
                        @auth
                            @if(Auth::user()->isAdmin())
                                <div class="mt-6">
                                    <a href="{{ route('admin.news.create') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Eerste artikel aanmaken
                                    </a>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>