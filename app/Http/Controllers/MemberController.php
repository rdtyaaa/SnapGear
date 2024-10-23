<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Ambil riwayat peminjaman berdasarkan ID pengguna
        $borrowHistory = Transaction::where('id_user', $userId)->get();

        // Kembalikan view dengan data riwayat peminjaman
        return view('user.borrow-history', compact('borrowHistory'));
    }
}
