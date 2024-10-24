<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionUnit;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = TransactionUnit::with(['transaction', 'unit'])
            ->where('status', 'Borrowed')
            ->get()
            ->map(function ($transaction) {
                $remainingDays = now()->diffInDays($transaction->return_agreement ?? now(), false);
                $transaction->remaining_days = round($remainingDays);
                $transaction->fine = round($remainingDays) * 50000;
                return $transaction;
            });

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction unit.
     */
    public function create()
    {
        // Ambil data transaction dan unit untuk form
        $transactionId = 'TRX' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        $units = Unit::all();
        $users = User::all();

        return view('admin.transactions.create', compact('transactionId', 'units', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'unit_id.*' => 'exists:units,id',
            'date_borrowed' => 'required|date',
            'date_returned.*' => 'nullable|date',
        ]);

        $borrowedUnitsCount = TransactionUnit::where('status', 'Borrowed')
            ->whereIn('transaction_code', function ($query) use ($request) {
                $query
                    ->select('transaction_code')
                    ->from('transactions')
                    ->where('user_id', $request->user_id);
            })
            ->count();

        if ($borrowedUnitsCount >= 2) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'No more than 2 units may be borrowed.']);
        }

        $transaction = Transaction::updateOrCreate([
            'transaction_code' => $request->transaction_id,
            'user_id' => $request->user_id,
        ]);

        foreach ($request->unit_id as $index => $unitId) {
            $dateBorrowed = \Carbon\Carbon::parse($request->date_borrowed);
            $dateReturned = \Carbon\Carbon::parse($request->date_returned[$index]);
            if (abs(round($dateReturned->diffInDays($dateBorrowed))) > 5) {
                return redirect()
                    ->back()
                    ->withErrors(['error' => 'Return date cannot be more than 5 days from the borrowed date.']);
            }
            TransactionUnit::updateOrCreate([
                'transaction_code' => $transaction->transaction_code,
                'unit_id' => $unitId,
                'date_borrowed' => $request->date_borrowed,
                'return_agreement' => $request->date_returned[$index] ?? null,
                'status' => 'Pending',
            ]);
        }

        $unit = Unit::find($unitId);
        if ($unit->stok <= 0) {
            return redirect()
                ->back()
                ->withErrors(['error' => "Insufficient stock for unit {$unit->name}."]);
        }
        $unit->stok -= 1;
        $unit->save();

        return redirect()
            ->route('transactions.detail', $transaction->transaction_code)
            ->with('success', 'Transaction created/updated successfully.');
    }

    public function returnForm($transaction_code, $unit_id)
    {
        $transactionUnit = TransactionUnit::with(['transaction', 'unit'])
            ->where('transaction_code', $transaction_code)
            ->where('unit_id', $unit_id)
            ->firstOrFail();

        $remainingDays = now()->diffInDays($transactionUnit->return_agreement ?? now(), false);
        $transactionUnit->fine = abs(round($remainingDays) * 50000);

        return view('admin.transactions.returns', compact('transactionUnit', 'remainingDays'));
    }

    public function processReturn(Request $request, $transaction_code, $unit_id)
    {
        $request->validate([
            'date_returned' => 'required|date|after_or_equal:date_borrowed',
        ]);

        $transactionUnit = TransactionUnit::where('transaction_code', $transaction_code)->where('unit_id', $unit_id)->firstOrFail();

        $transactionUnit->update([
            'date_returned' => $request->date_returned,
            'status' => 'Returned',
        ]);

        $unit = Unit::find($unit_id);
        if ($unit) {
            $unit->stok += 1;
            $unit->save();
        }

        return redirect()->route('transactions.index')->with('success', 'Unit returned successfully.');
    }

    public function view($transaction_code, $unit_id)
    {
        // Ambil data transaksi dan unit yang spesifik
        $transactionUnit = TransactionUnit::where('transaction_code', $transaction_code)->where('unit_id', $unit_id)->firstOrFail();

        return view('admin.transactions.view-units', compact('transactionUnit'));
    }

    public function show($transaction_code)
    {
        $transaction = Transaction::with('units')->where('transaction_code', $transaction_code)->firstOrFail();

        $itemsWithPrices = [];
        $totalPrice = 0;
        foreach ($transaction->units as $unit) {
            $dateBorrowed = \Carbon\Carbon::parse($unit->date_borrowed);
            $dateReturned = $unit->return_agreement ? \Carbon\Carbon::parse($unit->return_agreement) : now();
            $daysRented = round($dateBorrowed->diffInDays($dateReturned));
            $itemPrice = $daysRented * $unit->unit->harga;

            $itemsWithPrices[] = [
                'name' => $unit->unit->name,
                'price_per_day' => $unit->unit->harga,
                'days_rented' => $daysRented,
                'item_price' => $itemPrice,
            ];
            $totalPrice += $itemPrice;
        }

        return view('admin.transactions.detail-transactions', compact('transaction', 'itemsWithPrices', 'totalPrice'));
    }

    public function updateStatus(Request $request, $transaction_code)
    {
        $transactionUnits = TransactionUnit::where('transaction_code', $transaction_code)->get();

        foreach ($transactionUnits as $transactionUnit) {
            $transactionUnit->status = 'Borrowed';

            $dateBorrowed = \Carbon\Carbon::parse($transactionUnit->date_borrowed);
            $dateReturned = $transactionUnit->date_returned ? \Carbon\Carbon::parse($transactionUnit->date_returned) : now();
            $daysRented = abs(round($dateBorrowed->diffInDays($dateReturned)));

            $unit = $transactionUnit->unit;
            $itemPrice = $daysRented * $unit->harga;
            $transactionUnit->price = $itemPrice;

            $transactionUnit->save();
        }

        return redirect()->route('transactions.index', $transaction_code)->with('success', 'Transaction unit status updated to Borrowed successfully.');
    }
}
