<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <title>Homepage</title>
</head>
<body>
    @include('partials.navbar')
<div class="container mx-auto mt-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($units as $unit)
            <div class="card bg-base-100 w-96 shadow-xl">
                <figure>
                    <img src="{{ asset('images/' . $unit->gambar) }}" alt="{{ $unit->name }}" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">{{ $unit->name }}</h2>
                    <div class="badge ">Category: 
                        @if ($unit->categories->isEmpty())
                            No Category
                        @else
                            @foreach ($unit->categories as $category)
                                {{ $category->name }}@if (!$loop->last), @endif
                            @endforeach
                        @endif
                    </div>
                    <p>Price: Rp {{ number_format($unit->harga, 2) }}</p>
                    <p>Stock: {{ $unit->stok }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>