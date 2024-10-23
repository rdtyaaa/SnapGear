<!-- resources/views/units/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="flex">
        @include('partials.sidebar')

        <div class="ml-80 flex-1 p-6">
            <div class="container mx-auto mt-10">
                <div class="mx-auto max-w-7xl rounded-md bg-white p-5 shadow-sm">
                    <h1 class="mb-5 text-2xl font-bold text-black">Transactions List</h1>

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
                                        d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                                </svg>
                            </span>
                        </div>
                    @endif

                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('transactions.create') }}" class="btn btn-primary">Create New Transactions</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table-zebra table w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Transaction Code</th>
                                    <th class="px-4 py-2">Product</th>
                                    <th class="px-4 py-2">Customer</th>
                                    <th class="px-4 py-2">Date</th>
                                    <th class="px-4 py-2">Remaining</th>
                                    <th class="px-4 py-2">Price (Fine)</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($transactions->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada Data</td>
                                    </tr>
                                @else
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->transaction->transaction_code }}</td>
                                            <td>{{ $transaction->unit->name }}</td>
                                            <td>{{ $transaction->transaction->user->name }}</td>
                                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($transaction->date_borrowed)->locale('id_ID')->translatedFormat('l, d F Y') }}</td>
                                            <td>
                                                @if ($transaction->remaining_days < 0)
                                                    <span class="text-red-500">Over {{ abs($transaction->remaining_days) }}
                                                        days</span>
                                                @else
                                                    {{ $transaction->remaining_days }} days
                                                @endif
                                            </td>
                                            <td>
                                                @if ($transaction->remaining_days < 0)
                                                    <span class="text-red-500">{{ abs($transaction->fine) }}</span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('transactions.view', ['transaction_code' => $transaction->transaction_code, 'unit_id' => $transaction->unit_id]) }}"
                                                    class="btn btn-sm btn-info">View</a>
                                                <a href="{{ route('transactions.return', ['transaction_code' => $transaction->transaction_code, 'unit_id' => $transaction->unit_id]) }}"
                                                    class="btn btn-sm btn-primary">Return</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
