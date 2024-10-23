<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $units = Unit::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->get();

        return view('dashboard', compact('units'));
    }
}