@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="card bg-base-100 mx-auto w-full max-w-md shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Return Unit</h2>

                <form
                    action="{{ route('transactions.processReturn', ['transaction_code' => $transactionUnit->transaction_code, 'unit_id' => $transactionUnit->unit_id]) }}"
                    method="POST">
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Transaction Code</span>
                        </label>
                        <input type="text" name="transaction_code" value="{{ $transactionUnit->transaction_code }}"
                            class="input input-bordered w-full" readonly>
                    </div>

                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text">Unit</span>
                        </label>
                        <input type="text" name="unit_name" value="{{ $transactionUnit->unit->name }}"
                            class="input input-bordered w-full" readonly>
                    </div>

                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text">Date Borrowed</span>
                        </label>
                        <input type="date" name="date_borrowed" value="{{ $transactionUnit->date_borrowed }}"
                            class="input input-bordered w-full" readonly>
                    </div>

                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text">Return Agreement</span>
                        </label>
                        <input type="date" name="return_agreement" value="{{ $transactionUnit->return_agreement }}"
                            class="input input-bordered w-full" readonly>
                    </div>

                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text ">Fine</span>
                        </label>
                        <input type="text" name="fine" value="{{ $transactionUnit->fine }}"
                            class="input input-bordered w-full text-red-500" readonly>
                    </div>

                    <div class="form-control mt-4">
                        <label class="label">
                            <span class="label-text">Date Returned</span>
                        </label>
                        <input type="date" name="date_returned" value="{{ now()->toDateString() }}"
                            class="input input-bordered w-full" readonly>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary">Confirm Return</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
