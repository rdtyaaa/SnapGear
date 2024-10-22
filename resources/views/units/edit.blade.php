<!-- resources/views/units/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="max-w-md mx-auto bg-white p-5 rounded-md shadow-sm">
        <h1 class="text-2xl font-bold mb-5">Edit Unit</h1>
        
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/></svg>
                </span>
            </div>
        @endif

        <form action="{{ route('units.update', $unit->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ $unit->name }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <div id="category-buttons" class="flex flex-wrap">
                    @foreach ($categories as $category)
                        <button type="button" class="category-button mt-1 mr-2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $unit->categories->contains($category->id) ? 'bg-indigo-500 text-white' : '' }}" data-id="{{ $category->id }}">{{ $category->name }}</button>
                    @endforeach
                </div>
                @error('category_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div id="selected-categories">
                @foreach ($unit->categories as $category)
                    <input type="hidden" name="category_id[]" value="{{ $category->id }}" id="category-{{ $category->id }}">
                @endforeach
            </div>
            <div class="mb-4">
                <label for="gambar" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="gambar" id="gambar" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('gambar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="harga" id="harga" value="{{ $unit->harga }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('harga')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="stok" class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" name="stok" id="stok" value="{{ $unit->stok }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('stok')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryButtons = document.querySelectorAll('.category-button');
        const selectedCategories = document.getElementById('selected-categories');

        categoryButtons.forEach(button => {
            button.addEventListener('click', function () {
                const categoryId = this.getAttribute('data-id');
                this.classList.toggle('bg-indigo-500');
                this.classList.toggle('text-white');

                if (this.classList.contains('bg-indigo-500')) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'category_id[]';
                    input.value = categoryId;
                    input.id = `category-${categoryId}`;
                    selectedCategories.appendChild(input);
                } else {
                    const input = document.getElementById(`category-${categoryId}`);
                    if (input) {
                        selectedCategories.removeChild(input);
                    }
                }
            });
        });
    });
</script>

<style>
    .category-button.bg-indigo-500 {
        background-color: #6366F1;
        color: white;
    }
</style>
@endsection