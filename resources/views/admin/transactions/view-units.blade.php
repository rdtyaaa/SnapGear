@extends('layouts.no-navbar')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="card bg-base-100 mx-auto w-full max-w-md shadow-xl">
            <div class="card-body relative">
                <div class="flex flex-wrap items-center">
                    <p class="card-title">Transaction Detail</p>
                    <button onclick="window.print()" class="no-print btn btn-secondary ms-auto">
                        <!-- SVG Icon -->
                        <svg class="mr-2 h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="1.5"
                                d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z" />
                        </svg>
                        Print
                    </button>
                </div>
                <!-- Transaction details start here -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Transaction Code</span>

                    </label>
                    <input type="text" value="{{ $transactionUnit->transaction_code }}"
                        class="input input-bordered w-full" readonly>
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Unit</span>
                    </label>
                    <input type="text" value="{{ $transactionUnit->unit->name }}" class="input input-bordered w-full"
                        readonly>
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">User</span>
                    </label>
                    <input type="text" value="{{ $transactionUnit->transaction->user->name }}"
                        class="input input-bordered w-full" readonly>
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Date Borrowed</span>
                    </label>
                    <input type="text"
                        value="{{ \Carbon\Carbon::parse($transactionUnit->date_borrowed)->locale('id_ID')->translatedFormat('l, d F Y') ?? 'Not Returned Yet' }}"
                        class="input input-bordered w-full" readonly>
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Return Agreement</span>
                    </label>
                    <input type="text"
                        value="{{ \Carbon\Carbon::parse($transactionUnit->return_agreement)->locale('id_ID')->translatedFormat('l, d F Y') ?? 'Not Returned Yet' }}"
                        class="input input-bordered w-full" readonly>
                </div>

                <div class="form-control mt-4">
                    <label class="label">
                        <span class="label-text">Status</span>
                    </label>
                    <input type="text" value="{{ $transactionUnit->status }}" class="input input-bordered w-full"
                        readonly>
                </div>

                <div class="form-control mt-6">
                    <a href="{{ url()->previous() }}" class="no-print btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
@endsection
