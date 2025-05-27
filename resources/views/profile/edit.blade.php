<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profiel Bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Profiel Informatie') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Werk je profiel informatie bij.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div>
                                <x-input-label for="name" :value="__('Naam')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="username" :value="__('Gebruikersnaam')" />
                                <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('username')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="birthday" :value="__('Geboortedatum')" />
                                <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" :value="old('birthday', optional($user->birthday)->format('Y-m-d'))" />
                                <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
                            </div>

                            <div>
                                <x-input-label for="about_me" :value="__('Over mij')" />
                                <textarea id="about_me" name="about_me" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="4">{{ old('about_me', $user->about_me) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('about_me')" />
                            </div>

                            <div>
                                <x-input-label for="profile_photo" :value="__('Profielfoto')" />
                                @if($user->profile_photo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Huidige profielfoto" class="w-32 h-32 rounded-full object-cover">
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ route('profiles.remove-photo') }}" 
                                           onclick="event.preventDefault(); document.getElementById('remove-photo-form').submit();"
                                           class="text-red-600 hover:text-red-900">
                                            {{ __('Verwijder foto') }}
                                        </a>
                                    </div>
                                @endif
                                <input type="file" id="profile_photo" name="profile_photo" class="mt-1 block w-full" accept="image/*">
                                <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Opslaan') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Opgeslagen.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Account Verwijderen') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Als je je account verwijdert, worden al je gegevens permanent verwijderd.') }}
                            </p>
                        </header>

                        <x-danger-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                        >{{ __('Account verwijderen') }}</x-danger-button>

                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Weet je zeker dat je je account wilt verwijderen?') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Als je je account verwijdert, worden al je gegevens permanent verwijderd. Voer je wachtwoord in om te bevestigen dat je je account definitief wilt verwijderen.') }}
                                </p>

                                <div class="mt-6">
                                    <x-input-label for="password" value="{{ __('Wachtwoord') }}" class="sr-only" />

                                    <x-text-input
                                        id="password"
                                        name="password"
                                        type="password"
                                        class="mt-1 block w-3/4"
                                        placeholder="{{ __('Wachtwoord') }}"
                                    />

                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Annuleren') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ml-3">
                                        {{ __('Account verwijderen') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <form id="remove-photo-form" action="{{ route('profiles.remove-photo') }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</x-app-layout>