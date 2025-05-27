<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Frequently Asked Questions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($categories->count() > 0)
                        @foreach($categories as $category)
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $category->name }}</h3>
                                
                                @if($category->description)
                                    <p class="text-gray-600 mb-6">{{ $category->description }}</p>
                                @endif

                                @if($category->faqItems->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($category->faqItems as $item)
                                            <div class="border-b border-gray-200 pb-4">
                                                <button class="w-full text-left focus:outline-none faq-question" onclick="toggleAnswer({{ $item->id }})">
                                                    <h4 class="text-lg font-semibold text-gray-800 hover:text-blue-600 flex justify-between items-center">
                                                        {{ $item->question }}
                                                        <span class="text-2xl faq-icon-{{ $item->id }}">+</span>
                                                    </h4>
                                                </button>
                                                <div id="answer-{{ $item->id }}" class="hidden mt-3 text-gray-600">
                                                    {!! nl2br(e($item->answer)) !!}
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
                            <h3 class="text-xl text-gray-600">Geen FAQ items beschikbaar</h3>
                            <p class="text-gray-500 mt-2">Er zijn momenteel geen veelgestelde vragen beschikbaar.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAnswer(id) {
            const answer = document.getElementById('answer-' + id);
            const icon = document.querySelector('.faq-icon-' + id);
            
            if (answer.classList.contains('hidden')) {
                answer.classList.remove('hidden');
                icon.textContent = '-';
            } else {
                answer.classList.add('hidden');
                icon.textContent = '+';
            }
        }
    </script>
</x-app-layout>