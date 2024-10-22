<?php

namespace App\Http\Controllers;

use App\Models\Member; // Pastikan untuk mengimpor model Member
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        // You can fetch data here if needed
        return view('user.borrow-history'); // Make sure you have a corresponding view file
    }
}
