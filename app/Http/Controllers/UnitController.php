<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Category;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::with('categories')->get();
        return view('units.index', compact('units'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $units = Unit::with('categories')
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->get();

        // Jika request dari Fetch API, kembalikan JSON
        if ($request->ajax()) {
            return response()->json([
                'units' => $units
            ]);
        }

        // Jika bukan AJAX, kembalikan view biasa
        return view('dashboard', compact('units'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('units.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:units,name',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required|numeric',
            'stok' => 'required|integer'
        ], [
            'name.unique' => 'Nama unit sudah ada.',
        ]);

        $data = $request->except('category_id');

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('images'), $imageName);
            $data['gambar'] = $imageName;
        }

        $unit = Unit::create($data);
        $unit->categories()->attach($request->category_id);

        return redirect()->route('units.index')->with('success', 'Unit created successfully!');
    }

    public function edit(Unit $unit)
    {
        $categories = Category::all();
        return view('units.edit', compact('unit', 'categories'));
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => 'required|unique:units,name,' . $unit->id,
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required|numeric',
            'stok' => 'required|integer'
        ], [
            'name.unique' => 'Nama unit sudah ada.',
        ]);

        $data = $request->except('category_id');

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('images'), $imageName);
            $data['gambar'] = $imageName;
        }

        $unit->update($data);
        $unit->categories()->sync($request->category_id);

        return redirect()->route('units.index')->with('success', 'Unit updated successfully!');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('units.index')->with('success', 'Unit deleted successfully!');
    }
}