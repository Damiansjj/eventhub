<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nieuws') }}
            </h2>
            <a href="{{ route('news.index') }}" 
               class="text-indigo-600 hover:text-indigo-900 font-medium">
                ← Terug naar overzicht
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Article -->
            <article class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <!-- Featured Image -->
                <div class="h-64 md:h-96 overflow-hidden">
                    <img class="w-full h-full object-cover" 
                         src="{{ $news->featured_image_url }}" 
                         alt="{{ $news->title }}">
                </div>

                <div class="p-8">
                    <!-- Article Meta -->
                    <div class="flex items-center justify-between mb-6 pb-6 border-b border-gray-200">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Door <strong>{{ $news->author->name }}</strong>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $news->published_at->format('d F Y \o\m H:i') }}
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ $news->views }} weergaven
                            </div>
                        </div>

                        @auth
                            @if($news->canEdit(Auth::user()))
                                <a href="{{ route('admin.news.edit', $news) }}" 
                                   class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Bewerken
                                </a>
                            @endif
                        @endauth
                    </div>

                    <!-- Article Title -->
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                        {{ $news->title }}
                    </h1>

                    <!-- Article Excerpt -->
                    @if($news->excerpt)
                        <div class="text-xl text-gray-600 mb-8 font-light leading-relaxed">
                            {{ $news->excerpt }}
                        </div>
                    @endif

                    <!-- Article Content -->
                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($news->content)) !!}
                    </div>

                    <!-- Article Footer -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500">
                                Laatst bijgewerkt: {{ $news->updated_at->format('d F Y \o\m H:i') }}
                            </div>
                            <div class="flex space-x-4">
                                <!-- Share buttons could go here -->
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Related Articles -->
            @if($relatedNews->count() > 0)
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Gerelateerd nieuws</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($relatedNews as $related)
                                <div class="group">
                                    <img class="h-32 w-full object-cover rounded-lg mb-3" 
                                         src="{{ $related->featured_image_url }}" 
                                         alt="{{ $related->title }}">
                                    
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-indigo-600">
                                        <a href="{{ route('news.show', $related->slug) }}">
                                            {{ Str::limit($related->title, 60) }}
                                        </a>
                                    </h4>
                                    
                                    <p class="text-sm text-gray-600 mb-2">
                                        {{ Str::limit($related->excerpt, 100) }}
                                    </p>
                                    
                                    <div class="text-xs text-gray-500">
                                        {{ $related->published_at->format('d M Y') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>