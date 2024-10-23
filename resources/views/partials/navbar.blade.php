<!-- resources/views/partials/navbar.blade.php -->
<nav class="no-print bg-orange-600 ">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div>
                <a href="{{ route('admin.index') }}" class="text-lg font-semibold text-white">Admin Dashboard</a>
            </div>
            <div>
                <a href="{{ route('logout') }}" class="text-sm text-gray-700">Logout</a>
            </div>
        </div>
    </div>
</nav>
