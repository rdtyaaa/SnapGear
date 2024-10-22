<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // You can fetch data here if needed
        return view('admin.index'); // Make sure you have a corresponding view file
    }

    // Unit CRUD
    public function createUnit()
    {
        $categories = Category::all();
        $units = Unit::with('category')->get(); // Fetch units with their associated categories
        return view('admin.units.create', compact('categories', 'units'));
    }

    public function storeUnit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('images'), $imageName);
            $data['gambar'] = $imageName;
        }

        Unit::create($request->all());
        return redirect()->route('admin.units.create')->with('success', 'Unit created successfully!');

    }

    public function editUnit(Unit $unit)
    {
        $categories = Category::all();
        return view('admin.units.edit', compact('unit', 'categories'));
    }

    public function updateUnit(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);       

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('images'), $imageName);
            $data['gambar'] = $imageName;
        }
    
        $unit->update($request->all());
        return redirect()->route('admin.units.create')->with('success', 'Unit updated successfully!');
    }

    public function destroyUnit(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('admin.units.create')->with('success', 'Unit deleted successfully!');
    }

    // Category CRUD
    public function createCategory()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required']);
        Category::create($request->all());
        return redirect()->route('admin.categories.create')->with('success', 'Category created successfully!');

    }

    public function editCategory(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate(['name' => 'required']);
        $category->update($request->all());
        return redirect()->route('admin.index');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.index');
    }

    // User CRUD
    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        User::create($request->all());
        return redirect()->route('admin.index');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6'
        ]);
        $user->update($request->all());
        return redirect()->route('admin.index');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index');
    }
}