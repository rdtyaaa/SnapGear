<!-- resources/views/partials/sidebar.blade.php -->
<div class="drawer-side fixed h-full">
    <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
    <ul class="menu bg-base-200 text-base-content h-full w-80 p-4">
        <!-- Sidebar content here -->
        <div class="flex justify-center">
            <img src="{{ asset('images/logo-panjang.png') }}" alt="SnapGear Logo" class="w-1/2 h-20">
        </div>
      
        <li>
            <a href="{{ route('units.index') }}" class="{{ request()->routeIs('units.index') ? 'bg-orange-600 text-white' : 'hover:bg-orange-600 hover:text-white' }}">Unit</a>
        </li>    
        <li>
            <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.index') ? 'bg-orange-600 text-white' : 'hover:bg-orange-600 hover:text-white' }}">Category</a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.index') ? 'bg-orange-600 text-white' : 'hover:bg-orange-600 hover:text-white' }}">User</a>
        </li>
    </ul>
</div>