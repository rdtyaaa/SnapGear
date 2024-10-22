<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
                @forelse ($units as $unit)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset('images/' . $unit->gambar) }}" alt="{{ $unit->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $unit->name }}</h3>
                            <form action="{{ route('units.borrow', $unit->id) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="btn btn-primary w-full">Pinjam</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>No units available.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>