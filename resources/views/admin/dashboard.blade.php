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
                    <p class="text-3xl">{{ $stats['users'] }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Nieuws</h3>
                    <p class="text-3xl">{{ $stats['news'] }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Evenementen</h3>
                    <p class="text-3xl">{{ $stats['events'] }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Berichten</h3>
                    <p class="text-3xl">{{ $stats['messages'] }}</p>
                </div>
            </div>

            <!-- Laatste activiteiten -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Laatste gebruikers -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Laatste gebruikers</h3>
                    <div class="space-y-4">
                        @foreach($latestUsers as $user)
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                </div>
                                <span class="text-sm text-gray-500">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Laatste berichten -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Laatste berichten</h3>
                    <div class="space-y-4">
                        @foreach($latestMessages as $message)
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">{{ $message->subject }}</p>
                                    <p class="text-sm text-gray-500">Van: {{ $message->name }}</p>
                                </div>
                                <span class="text-sm text-gray-500">
                                    {{ $message->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>