@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-24">
        <div class="container mx-auto mt-24">
            <div class="form-control no-print mb-4">
                <a href="{{ url('/dashboard') }}"
                    class="btn inline-flex justify-start border-0 bg-transparent hover:bg-transparent">
                    <svg class="mr-2 h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M5 12h14M5 12l4-4m-4 4 4 4" />
                    </svg>
                    Back
                </a>
            </div>
            <h2 class="mb-8 text-xl font-bold">Riwayat Peminjaman</h2>
            <table class="table-zebra table w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Transaction Code</th>
                        <th class="px-4 py-2">Product</th>
                        <th class="px-4 py-2">Return Agreement</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($borrowedUnits->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">Data is Empty</td>
                        </tr>
                    @else
                        @foreach ($borrowedUnits as $unit)
                            <tr>
                                <td class="px-4 py-2">{{ $unit->transaction_code }}</td>
                                <td class="px-4 py-2">{{ $unit->unit->name }}</td>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($unit->return_agreement)->locale('id_ID')->translatedFormat('l, d F Y') }}
                                </td>
                                <td class="px-4 py-2">{{ $unit->status }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('transactions.view', ['transaction_code' => $unit->transaction_code, 'unit_id' => $unit->unit_id]) }}"
                                        class="btn btn-primary"><svg class="h-6 w-6" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                                clip-rule="evenodd" />
                                        </svg>View</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
