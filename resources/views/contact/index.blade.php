<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="max-w-2xl">
                        <h3 class="text-2xl font-bold mb-4">{{ __('Contact EventsHub') }}</h3>
                        <p class="text-gray-600 mb-6">
                            {{ __('Heb je vragen over een evenement of andere opmerkingen? We staan voor je klaar! Vul het onderstaande formulier in en we nemen zo snel mogelijk contact met je op.') }}
                        </p>

                        <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                            @csrf

                            <!-- Naam -->
                            <div>
                                <x-input-label for="name" :value="__('Naam')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Gerelateerd Evenement -->
                            <div>
                                <x-input-label for="related_event_id" :value="__('Gerelateerd Evenement (Optioneel)')" />
                                <select id="related_event_id" name="related_event_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">{{ __('Selecteer een evenement') }}</option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}" {{ old('related_event_id') == $event->id ? 'selected' : '' }}>
                                            {{ $event->name }} ({{ $event->start_date->format('d/m/Y') }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('related_event_id')" class="mt-2" />
                            </div>

                            <!-- Onderwerp -->
                            <div>
                                <x-input-label for="subject" :value="__('Onderwerp')" />
                                <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full" :value="old('subject')" required />
                                <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                            </div>

                            <!-- Bericht -->
                            <div>
                                <x-input-label for="message" :value="__('Bericht')" />
                                <textarea id="message" name="message" rows="5" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                    required>{{ old('message') }}</textarea>
                                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Verstuur Bericht') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>