@props(['category'])

<div class="mb-8">
    <h3 class="text-lg font-semibold mb-4">{{ $category->name }}</h3>
    <div class="space-y-4">
        @foreach($category->faqItems as $item)
            <div class="bg-white rounded-lg shadow p-4">
                <h4 class="font-medium text-gray-900 mb-2">{{ $item->question }}</h4>
                <p class="text-gray-600">{{ $item->answer }}</p>
            </div>
        @endforeach
    </div>
</div> 