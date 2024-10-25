<!-- resources/views/categories/create.blade.php -->
@extends('layouts.no-navbar')

@section('content')
<div class="container mx-auto mt-10">
    <div class="max-w-md mx-auto bg-base-100 p-5 rounded-md shadow-sm">
        <h1 class="text-2xl font-bold mb-5">Create Category</h1>

        @if (session('success'))
            <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/></svg>
                </span>
            </div>
        @endif

        @if ($errors->any())
            <div id="error-alert" class="bg-red-100 border border-red-400 text-error px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-error" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934-2.934a1 1 0 000-1.414z"/></svg>
                </span>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 bg-base-100 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('name')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex">
                <button type="submit" class="bg-primary text-base-100 w-full px-4 py-2 rounded-md">Create</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            let successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.classList.add('fade-out');
            }

            let errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                errorAlert.classList.add('fade-out');
            }
        }, 500); // 3 detik
    });
</script>

<style>
    .fade-out {
        opacity: 0;
        transition: opacity 1s ease-out;
    }
</style>
@endsection
