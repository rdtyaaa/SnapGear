<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // General admin dashboard or overview
        return view('admin.index');
    }
}
