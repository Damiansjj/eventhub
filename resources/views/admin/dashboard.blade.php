<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistieken -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Gebruikers</h3>
                    <p class="text-3xl text-blue-600">{{ $stats['users'] }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Nieuws</h3>
                    <p class="text-3xl text-green-600">{{ $stats['news'] }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Evenementen</h3>
                    <p class="text-3xl text-purple-600">{{ $stats['events'] }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Berichten</h3>
                    <div class="flex items-center">
                        <p class="text-3xl text-orange-600">{{ $stats['messages'] }}</p>
                        @if($unreadMessages > 0)
                            <span class="ml-3 bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                {{ $unreadMessages }} ongelezen
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Content Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Recente Gebruikers -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Recente Gebruikers</h3>
                    <div class="space-y-4">
                        @foreach($latestUsers as $user)
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                </div>
                                <span class="text-xs text-gray-500">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                        Alle gebruikers →
                    </a>
                </div>

                <!-- Recent Nieuws -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Recent Nieuws</h3>
                    <div class="space-y-4">
                        @foreach($latestNews as $news)
                            <div>
                                <p class="font-medium">{{ $news->title }}</p>
                                <div class="flex justify-between text-sm text-gray-500">
                                    <span>{{ $news->author->name }}</span>
                                    <span>{{ $news->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('admin.news.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                        Alle nieuws →
                    </a>
                </div>

                <!-- Recente Evenementen -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Recente Evenementen</h3>
                    <div class="space-y-4">
                        @foreach($latestEvents as $event)
                            <div>
                                <p class="font-medium">{{ $event->title }}</p>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">{{ $event->start_date->format('d/m/Y') }}</span>
                                    <span class="{{ $event->is_published ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $event->is_published ? 'Gepubliceerd' : 'Concept' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('admin.events.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                        Alle evenementen →
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 