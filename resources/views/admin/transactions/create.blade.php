@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="card bg-base-100 mx-auto w-full max-w-md shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Create Transaction Unit</h2>

                @if ($errors->has('error'))
                    <div class="relative mb-4 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ $errors->first('error') }}</span>
                        <span class="absolute bottom-0 right-0 top-0 px-4 py-3">
                            <svg class="h-6 w-6 fill-current text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                            </svg>
                        </span>
                    </div>
                @endif


                <form action="{{ route('transactions.store') }}" method="POST" id="transaction-form">
                    @csrf

                    <div class="form-control">
                        <label for="transaction_id" class="label">
                            <span class="label-text">Transaction Code</span>
                        </label>
                        <input type="text" name="transaction_id" id="transaction_id" value="{{ $transactionId }}"
                            class="input input-bordered w-full" readonly>
                    </div>

                    <div class="form-control mt-4">
                        <label for="date_borrowed" class="label">
                            <span class="label-text">Date Borrowed</span>
                        </label>
                        <input type="date" name="date_borrowed" class="input input-bordered w-full"
                            value="{{ now()->toDateString() }}" readonly>
                        @error('date_borrowed')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control mt-4">
                        <label for="user_id" class="label">
                            <span class="label-text">User</span>
                        </label>
                        <select name="user_id" id="user_id" class="select select-bordered w-full" required>
                            <option value="">Select a User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div id="units-container" class="mt-4">
                        <h3 class="text-lg font-semibold">Units to Borrow</h3>
                        <div class="unit-entry mt-2">
                            <div class="form-control">
                                <label for="unit_id" class="label">
                                    <span class="label-text">Unit</span>
                                </label>
                                <select name="unit_id[]" class="select select-bordered w-full" required>
                                    <option value="">Select a Unit</option>
                                    @foreach ($units as $unit)
                                        <option
                                            value="{{ $unit->id }}  {{ in_array($unit->id, old('unit_id', [])) ? 'selected' : '' }}">
                                            {{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_id.*')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-control mt-4">
                                <label for="date_returned" class="label">
                                    <span class="label-text">Date Returned (Optional)</span>
                                </label>
                                <input type="date" name="date_returned[]" class="input input-bordered w-full">
                                @error('date_returned.*')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="button"
                                class="btn btn-danger remove-unit ms-auto mt-4 block border-0 bg-transparent">
                                <svg class="h-6 w-6 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>


                        </div>
                    </div>

                    <button type="button" id="add-unit" class="btn btn-secondary mt-4">Add Another Unit</button>

                    <!-- Submit Button -->
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary">View Detail</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-unit').addEventListener('click', function() {
            const unitsContainer = document.getElementById('units-container');
            const unitEntry = document.createElement('div');
            unitEntry.className = 'unit-entry mt-2';
            unitEntry.innerHTML = `
            <div class="form-control">
                <label for="unit_id" class="label">
                    <span class="label-text">Unit</span>
                </label>
                <select name="unit_id[]" class="select select-bordered w-full" required>
                    <option value="">Select a Unit</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-control mt-4">
                <label for="date_returned" class="label">
                    <span class="label-text">Date Returned (Optional)</span>
                </label>
                <input type="date" name="date_returned[]" class="input input-bordered w-full">
            </div>
            <button type="button" class="btn btn-danger bg-transparent border-0 remove-unit ms-auto mt-4 block">
                <svg class="w-6 h-6 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                </svg>
            </button>

        `;
            unitsContainer.appendChild(unitEntry);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-unit')) {
                e.target.closest('.unit-entry').remove();
            }
        });
    </script>
@endsection
