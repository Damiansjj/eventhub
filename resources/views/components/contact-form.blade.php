@props(['submitLabel' => 'Verstuur'])

<form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
    @csrf
    
    <div>
        <x-input-label for="name" value="Naam" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="email" value="E-mailadres" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="subject" value="Onderwerp" />
        <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full" required />
        <x-input-error :messages="$errors->get('subject')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="message" value="Bericht" />
        <textarea id="message" name="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
        <x-input-error :messages="$errors->get('message')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end">
        <x-primary-button>{{ $submitLabel }}</x-primary-button>
    </div>
</form> 