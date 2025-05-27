<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Artikel bewerken') }}
            </h2>
            <a href="{{ route('admin.news.index') }}" 
               class="text-gray-600 hover:text-gray-900">
                ← Terug naar overzicht
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title', $news->title) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Excerpt -->
                        <div class="mb-6">
                            <label for="excerpt" class="block text-sm font-medium text-gray-700">Samenvatting</label>
                            <textarea name="excerpt" 
                                      id="excerpt" 
                                      rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt', $news->excerpt) }}</textarea>
                            @error('excerpt')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700">Inhoud</label>
                            <textarea name="content" 
                                      id="content" 
                                      rows="10"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                      required>{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Featured Image -->
                        @if($news->featured_image)
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700">Huidige afbeelding</label>
                                <img src="{{ Storage::url($news->featured_image) }}" 
                                     alt="Huidige uitgelichte afbeelding"
                                     class="mt-2 h-48 w-auto object-cover">
                            </div>
                        @endif

                        <!-- Featured Image -->
                        <div class="mb-6">
                            <label for="featured_image" class="block text-sm font-medium text-gray-700">
                                {{ $news->featured_image ? 'Nieuwe uitgelichte afbeelding' : 'Uitgelichte afbeelding' }}
                            </label>
                            <input type="file" 
                                   name="featured_image" 
                                   id="featured_image"
                                   accept="image/*"
                                   class="mt-1 block w-full">
                            @error('featured_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Publication Status -->
                        <div class="mb-6">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       name="is_published" 
                                       id="is_published" 
                                       value="1"
                                       {{ old('is_published', $news->is_published) ? 'checked' : '' }}
                                       class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <label for="is_published" class="ml-2 block text-sm text-gray-700">Gepubliceerd</label>
                            </div>
                        </div>

                        <!-- Publication Date -->
                        <div class="mb-6">
                            <label for="published_at" class="block text-sm font-medium text-gray-700">Publicatiedatum</label>
                            <input type="datetime-local" 
                                   name="published_at" 
                                   id="published_at" 
                                   value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}"
                                   class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('published_at')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('news.show', $news) }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Bekijken
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                Wijzigingen opslaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 