<!DOCTYPE html>
<html lang="en" data-theme='light'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <title>Homepage</title>
</head>

<body>
    <!-- navbar -->
    <div class="navbar bg-orange-600">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl text-white">SnapGear</a>
        </div>
        <div class="flex-none gap-2">
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Profile Avatar"
                            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                    </div>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                    <li><a class="justify-between" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full justify-between text-left">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- navbar end -->

    <div class="container mx-auto mt-10 p-8">
        <!-- Search Form -->
        <div class="flex w-full">
            <form action="{{ route('dashboard') }}" method="GET" class="mb-6 w-full justify-center">
                <div class="flex max-w-2xl items-center">
                    <input id="search-input" type="text" name="search" placeholder="Search units..."
                        class="input input-bordered w-full">
                    <button type="submit" class="btn ml-2 bg-orange-600 text-white">Search</button>
                </div>
            </form>
            <a href="{{ route('user.history') }}">
                <button type="button" class="btn bg-primary ms-auto text-white">History</button>
            </a>
        </div>

        <!-- Results Section -->
        <div id="units-list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($units as $unit)
                <div class="card bg-base-100 w-80 shadow-xl">
                    <figure>
                        <img src="{{ asset('images/' . $unit->gambar) }}" alt="{{ $unit->name }}" />
                    </figure>
                    <div class="card-body">
                        <h1 class="card-title text-3xl">{{ $unit->name }}</h1>

                        <div class="badge">Category:
                            @if ($unit->categories->isEmpty())
                                No Category
                            @else
                                @foreach ($unit->categories as $category)
                                    {{ $category->name }}@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <h3 class="">Harga: {{ number_format($unit->harga, 0, ',', '.') }}</h3>
                        <h3 class="">Stok: {{ $unit->stok }}</h3>

                    </div>
                </div>
            @endforeach
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
                            <div class="card bg-base-100 w-96 shadow-xl">
                                <figure>
                                    <img src="/images/${unit.gambar}" alt="${unit.name}" />
                                </figure>
                                <div class="card-body">
                                    <h2 class="card-title">${unit.name}</h2>

                                    <div class="badge">Category: ${
                                        unit.categories.length > 0
                                            ? unit.categories.map(cat => cat.name).join(', ')
                                            : 'No Category'
                                    }</div>



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
</body>

</html>
