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
                        <h3 class="text-2xl font-bold mb-4">Neem contact met ons op</h3>
                        <p class="text-gray-600 mb-6">
                            Heb je vragen, opmerkingen of suggesties? We horen graag van je! 
                            Vul het onderstaande formulier in en we nemen zo snel mogelijk contact met je op.
                        </p>

                        <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                            @csrf

                            <!-- Naam -->
                            <div>
                                <label for="name" class="block font-medium text-sm text-gray-700">
                                    Naam *
                                </label>
                                <input id="name" name="name" type="text" 
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                       value="{{ old('name') }}" required>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block font-medium text-sm text-gray-700">
                                    Email *
                                </label>
                                <input id="email" name="email" type="email" 
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                       value="{{ old('email') }}" required>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Onderwerp -->
                            <div>
                                <label for="subject" class="block font-medium text-sm text-gray-700">
                                    Onderwerp *
                                </label>
                                <input id="subject" name="subject" type="text" 
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                       value="{{ old('subject') }}" required>
                                @error('subject')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Bericht -->
                            <div>
                                <label for="message" class="block font-medium text-sm text-gray-700">
                                    Bericht *
                                </label>
                                <textarea id="message" name="message" rows="5" 
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                                          required>{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit button -->
                            <div>
                                <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Bericht Versturen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>