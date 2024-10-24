<?php

namespace App\Http\Controllers;

use App\Models\TransactionUnit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

{
    public function index()
    {
        $userId = Auth::id();

        $borrowedUnits = TransactionUnit::whereHas('transaction', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->with('unit')
            ->get();

        return view('history', compact('borrowedUnits'));
    }
}
