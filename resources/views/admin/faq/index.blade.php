<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('FAQ Beheer') }}
            </h2>
            <a href="{{ route('admin.faq-categories.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                Nieuwe Categorie
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($categories->count() > 0)
                        @foreach($categories as $category)
                            <div class="mb-8 border-b pb-6">
                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-800">{{ $category->name }}</h3>
                                        @if($category->description)
                                            <p class="text-gray-600 mt-1">{{ $category->description }}</p>
                                        @endif
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.faq-categories.edit', $category) }}" 
                                           class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                            Bewerk Categorie
                                        </a>
                                        <a href="{{ route('admin.faq-categories.create-item', $category) }}"
                                           class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                            Vraag Toevoegen
                                        </a>
                                        <form action="{{ route('admin.faq-categories.destroy', $category) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Weet je zeker dat je deze categorie wilt verwijderen?')"
                                                    class="inline-flex items-center px-3 py-2 border border-red-300 rounded-md text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                                                Verwijder
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                @if($category->faqItems->count() > 0)
                                    <div class="space-y-4 mt-4">
                                        @foreach($category->faqItems as $item)
                                            <div class="border rounded-lg p-4">
                                                <div class="flex justify-between items-start">
                                                    <div class="flex-1">
                                                        <h4 class="text-lg font-semibold text-gray-800">{{ $item->question }}</h4>
                                                        <p class="text-gray-600 mt-2">{{ $item->answer }}</p>
                                                    </div>
                                                    <div class="flex space-x-2 ml-4">
                                                        <a href="{{ route('admin.faq-items.edit', $item) }}"
                                                           class="inline-flex items-center px-2 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                                            Bewerk
                                                        </a>
                                                        <form action="{{ route('admin.faq-items.destroy', $item) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Weet je zeker dat je deze vraag wilt verwijderen?')"
                                                                    class="inline-flex items-center px-2 py-1 border border-red-300 rounded-md text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                                                                Verwijder
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 italic">Geen vragen beschikbaar in deze categorie.</p>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-8">
                            <h3 class="text-xl text-gray-600">Geen FAQ categorieën beschikbaar</h3>
                            <p class="text-gray-500 mt-2">Maak een nieuwe categorie aan om te beginnen.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 