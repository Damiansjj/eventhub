<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profiel bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('profiles.update') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <!-- Profile Photo -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                Profielfoto
                            </label>
                            
                            <div class="mt-2 flex items-center">
                                <img class="w-20 h-20 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                
                                <div class="ml-4">
                                    <input type="file" name="profile_photo" accept="image/*" class="block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-blue-50 file:text-blue-700
                                        hover:file:bg-blue-100">
                                    
                                    @if($user->profile_photo)
                                        <a href="{{ route('profiles.remove-photo') }}" 
                                           onclick="event.preventDefault(); document.getElementById('remove-photo-form').submit();"
                                           class="text-red-600 hover:text-red-800 text-sm mt-2 inline-block">
                                            Verwijder foto
                                        </a>
                                    @endif
                                </div>
                            </div>
                            
                            @error('profile_photo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" value="Naam" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- Username -->
                        <div>
                            <x-input-label for="username" value="Gebruikersnaam" />
                            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" />
                            <x-input-error class="mt-2" :messages="$errors->get('username')" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" value="E-mailadres" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <!-- Birthday -->
                        <div>
                            <x-input-label for="birthday" value="Geboortedatum" />
                            <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" :value="old('birthday', optional($user->birthday)->format('Y-m-d'))" />
                            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
                        </div>

                        <!-- About Me -->
                        <div>
                            <x-input-label for="about_me" value="Over mij" />
                            <textarea id="about_me" name="about_me" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="4">{{ old('about_me', $user->about_me) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('about_me')" />
                        </div>

                        <!-- Location -->
                        <div>
                            <x-input-label for="location" value="Locatie" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $user->location)" />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>

                        <!-- Website -->
                        <div>
                            <x-input-label for="website" value="Website" />
                            <x-text-input id="website" name="website" type="url" class="mt-1 block w-full" :value="old('website', $user->website)" />
                            <x-input-error class="mt-2" :messages="$errors->get('website')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Opslaan') }}</x-primary-button>
                        </div>
                    </form>

                    @if($user->profile_photo)
                        <form id="remove-photo-form" action="{{ route('profiles.remove-photo') }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 