<!-- resources/views/units/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="flex">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <div class="ml-80 flex-1 p-6">
            <div class="container mx-auto mt-10">
                <div class="mx-auto max-w-7xl rounded-md p-5 shadow-sm">
                    <h1 class="mb-5 text-2xl font-bold">Units List</h1>

                    @if (session('success'))
                        <div class="relative mb-4 rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <span class="absolute bottom-0 right-0 top-0 px-4 py-3">
                                <svg class="h-6 w-6 fill-current text-green-500" role="button"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path
                                        d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934-2.934a1 1 0 000-1.414z" />
                                </svg>
                            </span>
                        </div>
                    @endif

                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('units.create') }}" class="btn btn-primary"><svg class="h-6 w-6"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5" d="M5 12h14m-7 7V5" />
                            </svg>Create New Unit</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table-zebra table w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">ID</th>
                                    <th class="px-4 py-2">Name</th>
                                    <th class="px-4 py-2">Category</th>
                                    <th class="px-4 py-2">Image</th>
                                    <th class="px-4 py-2">Price</th>
                                    <th class="px-4 py-2">Stock</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($units as $unit)
                                    <tr>
                                        <td>{{ $unit->id }}</td>
                                        <td>{{ $unit->name }}</td>
                                        <td>
                                            @if ($unit->categories->isEmpty())
                                                No Category
                                            @else
                                                @foreach ($unit->categories as $category)
                                                    {{ $category->name }}@if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if ($unit->gambar)
                                                <img src="{{ asset('images/' . $unit->gambar) }}" alt="{{ $unit->name }}"
                                                    class="h-16 w-16 object-cover">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>Rp. {{ number_format($unit->harga, 0, ',', '.') }}</td>
                                        <td>{{ $unit->stok }}</td>
                                        <td>
                                            <a href="{{ route('units.edit', $unit->id) }}"
                                                class="btn btn-sm btn-primary"><svg
                                                    class="h-6 w-6" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                                        clip-rule="evenodd" />
                                                    <path fill-rule="evenodd"
                                                        d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Edit</a>
                                            <form action="{{ route('units.destroy', $unit->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-error text-white"><svg
                                                        class="h-6 w-6" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
@endsection
