<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evenement bewerken') }}: {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <x-input-label for="title" :value="__('Titel')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $event->title)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Beschrijving')" />
                            <textarea id="description" name="description" rows="5" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('description', $event->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="location" :value="__('Locatie')" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $event->location)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="start_date" :value="__('Start datum')" />
                                <x-text-input id="start_date" name="start_date" type="datetime-local" class="mt-1 block w-full" :value="old('start_date', $event->start_date->format('Y-m-d\TH:i'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                            </div>

                            <div>
                                <x-input-label for="end_date" :value="__('Eind datum')" />
                                <x-text-input id="end_date" name="end_date" type="datetime-local" class="mt-1 block w-full" :value="old('end_date', $event->end_date->format('Y-m-d\TH:i'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="image" :value="__('Afbeelding')" />
                            @if($event->image)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="w-32 h-32 object-cover rounded">
                                </div>
                            @endif
                            <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="max_participants" :value="__('Maximum deelnemers')" />
                                <x-text-input id="max_participants" name="max_participants" type="number" class="mt-1 block w-full" :value="old('max_participants', $event->max_participants)" min="1" />
                                <x-input-error class="mt-2" :messages="$errors->get('max_participants')" />
                            </div>

                            <div>
                                <x-input-label for="price" :value="__('Prijs')" />
                                <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" :value="old('price', $event->price)" min="0" />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="category" :value="__('Categorie')" />
                            <select id="category" name="category" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Selecteer een categorie</option>
                                <option value="Technology" {{ old('category', $event->category) == 'Technology' ? 'selected' : '' }}>Technology</option>
                                <option value="Music" {{ old('category', $event->category) == 'Music' ? 'selected' : '' }}>Music</option>
                                <option value="Art" {{ old('category', $event->category) == 'Art' ? 'selected' : '' }}>Art</option>
                                <option value="Sport" {{ old('category', $event->category) == 'Sport' ? 'selected' : '' }}>Sport</option>
                                <option value="Food" {{ old('category', $event->category) == 'Food' ? 'selected' : '' }}>Food</option>
                                <option value="Business" {{ old('category', $event->category) == 'Business' ? 'selected' : '' }}>Business</option>
                                <option value="Other" {{ old('category', $event->category) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category')" />
                        </div>

                        <div>
                            <label for="is_published" class="inline-flex items-center">
                                <input id="is_published" name="is_published" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" {{ $event->is_published ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Publiceren') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Evenement bijwerken') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 