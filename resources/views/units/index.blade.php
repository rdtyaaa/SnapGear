<!-- resources/views/units/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content -->
    <div class="flex-1 ml-80 p-6">
        <div class="container mx-auto mt-10">
            <div class="max-w-7xl mx-auto bg-white p-5 rounded-md shadow-sm">
                <h1 class="text-2xl font-bold mb-5">Units List</h1>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934-2.934a1 1 0 000-1.414z"/></svg>
                        </span>
                    </div>
                @endif

                <div class="flex justify-end mb-4">
                    <a href="{{ route('units.create') }}" class="btn btn-primary">Create New Unit</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-200">
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
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $unit->id }}</td>
                                    <td class="px-4 py-2">{{ $unit->name }}</td>
                                    <td class="px-4 py-2">
                                        @if ($unit->categories->isEmpty())
                                            No Category
                                        @else
                                            @foreach ($unit->categories as $category)
                                                {{ $category->name }}@if (!$loop->last), @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        @if ($unit->gambar)
                                            <img src="{{ asset('images/' . $unit->gambar) }}" alt="{{ $unit->name }}" class="w-16 h-16 object-cover">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $unit->harga }}</td>
                                    <td class="px-4 py-2">{{ $unit->stok }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('units.destroy', $unit->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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