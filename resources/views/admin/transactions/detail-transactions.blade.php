@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="card bg-base-100 mx-auto w-full max-w-md shadow-xl">
            <div class="card-body">
                <div class="form-control no-print mt-4">
                    <a href="{{ route('transactions.index') }}"
                        class="btn inline-flex justify-start border-0 bg-transparent text-gray-800 hover:bg-transparent">
                        <svg class="mr-2 h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14M5 12l4-4m-4 4 4 4" />
                        </svg>
                        Back
                    </a>
                </div>
                <h2 class="text-xl font-bold">Transaction Detail</h2>
                <form action="{{ route('transactions.updateStatus', $transaction->transaction_code) }}" method="POST" id="transaction-form">
                    @csrf
                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text">Transaction Code</span>
                        </label>
                        <input type="text" value="{{ $transaction->transaction_code }}"
                            class="input input-bordered w-full" readonly>
                    </div>

                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text">User</span>
                        </label>
                        <input type="text" value="{{ $transaction->user->name }}" class="input input-bordered w-full"
                            readonly>
                    </div>

                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text">Items</span>
                        </label>
                        <ul>
                            @foreach ($itemsWithPrices as $item)
                                <li>
                                    <p class="text-base">{{ $item['name'] }}</p>
                                    <p class="text-sm">Rp. {{ number_format($item['price_per_day'], 0, ',', '.') }} x
                                        {{ $item['days_rented'] }} Days</p>
                                    <p class="flex justify-end text-sm">Rp.
                                        {{ number_format($item['item_price'], 0, ',', '.') }}</p>
                                </li>
                            @endforeach
                            <hr class="border-1 my-4 border-gray-500">
                            <p class="flex justify-end font-semibold">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</p>
                        </ul>
                    </div>

                    <button type="button" onclick="window.print()" class="no-print btn btn-secondary mt-4 w-full">
                        <!-- SVG Icon -->
                        <svg class="mr-2 h-6 w-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z" />
                        </svg>
                        Print
                    </button>
                    <div class="form-control mt-2">
                        <button type="submit" class="no-print btn btn-primary">Create Transaction</button>
                    </div>
                </form>
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
