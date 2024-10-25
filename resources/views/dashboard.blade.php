@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10 p-8 bg-base-200 -my-10">
        <!-- Search Form -->
        <div class="flex w-full">
            <form action="{{ route('dashboard') }}" method="GET" class="mb-6 w-full justify-center">
                <div class="flex max-w-2xl items-center">
                    <input id="search-input" type="text" name="search" placeholder="Search units..."
                        class="input input-bordered w-full">
                    <button type="submit" class="btn bg-accent ml-2 text-black"><svg class="h-6 w-6" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                        Search</button>
                </div>
            </form>
            <a href="{{ route('user.history') }}" class="flex">
                <button type="button" class="btn bg-secondary ms-auto text-black"><svg class="h-6 w-6" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                            clip-rule="evenodd" />
                    </svg>
                    History</button>
            </a>
        </div>

        <!-- Results Section -->
        <h1 class="mb-8 mt-16 block text-2xl font-bold justify-center flex">Available Products</h1>
        <div class="center flex w-full">
            <div id="units-list" class="mx-auto grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($units as $unit)
                    <div class="card bg-base-100 w-96 shadow-lg">
                        <figure class="h-64 object-cover">
                            <img src="{{ asset('images/' . $unit->gambar) }}" alt="{{ $unit->name }}" />
                        </figure>
                        <div class="card-body">

                            <h1 class="card-title my-auto text-xl">{{ $unit->name }}</h1>
                            <h3 class="text-sm">Stock: {{ $unit->stok }}</h3>
                            <div class="flex">
                                @if ($unit->categories->isEmpty())
                                    <div class="badge badge-accent my-auto me-2 h-fit">
                                            No Category
                                        </div>
                                @else
                                @foreach ($unit->categories as $category)
                                        <div class="badge badge-accent my-auto me-2 h-fit">
                                            {{ $category->name }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <h3 class="text-primary flex justify-end text-lg font-semibold">Rp.
                                {{ number_format($unit->harga, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('search-input');
            const unitsList = document.getElementById('units-list');

            // Add event listener for the search input
            searchInput.addEventListener('input', function() {
                const query = searchInput.value;

                // Fetch the search results dynamically
                fetch(`/dashboard?search=${query}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest' // Important for Laravel AJAX detection
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Clear the current units
                        unitsList.innerHTML = '';

                        // Iterate over the fetched data and display units dynamically
                        data.units.forEach(unit => {
                            const unitCard = `
                                <div class="card bg-base-100 w-80 shadow-xl">
                                    <figure>
                                        <img src="/images/${unit.gambar}" alt="${unit.name}" />
                                    </figure>
                                    <div class="card-body">
                                        <h1 class="card-title text-3xl">${unit.name}</h1>

                                        <div class="badge badge-accent">Category: ${
                                            unit.categories.length > 0
                                                ? unit.categories.map(cat => cat.name).join(', ')
                                                : 'No Category'
                                        }</div>

                                        <h3 class="">Price: ${new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR'
                                        }).format(unit.harga)}</h3>

                                        <h3 class="">Stock: ${unit.stok}</h3>
                                    </div>
                                </div>`;
                            unitsList.insertAdjacentHTML('beforeend', unitCard);
                        });

                    })
                    .catch(error => {
                        console.error('Error fetching units:', error);
                    });
            });
        });
    </script>
@endsection
