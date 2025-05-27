<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('FAQ Vraag Bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.faq-items.update', $faqItem) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="question" :value="__('Vraag')" />
                            <x-text-input id="question" name="question" type="text" class="mt-1 block w-full" :value="old('question', $faqItem->question)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('question')" />
                        </div>

                        <div>
                            <x-input-label for="answer" :value="__('Antwoord')" />
                            <textarea id="answer" name="answer" 
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                rows="5" required>{{ old('answer', $faqItem->answer) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('answer')" />
                        </div>

                        <div>
                            <x-input-label for="sort_order" :value="__('Volgorde')" />
                            <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full" :value="old('sort_order', $faqItem->sort_order)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('sort_order')" />
                        </div>

                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" {{ old('is_active', $faqItem->is_active) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Actief') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Wijzigingen Opslaan') }}</x-primary-button>
                            <a href="{{ route('admin.faq-categories.index') }}" class="text-gray-600 hover:text-gray-900">Annuleren</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 