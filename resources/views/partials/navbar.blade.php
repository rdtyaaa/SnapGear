<!-- resources/views/partials/navbar.blade.php -->
<nav class="no-print bg-orange-600">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            <div>
                <a href="{{ route('admin.index') }}" class="text-lg font-semibold text-white">Admin Dashboard</a>
            </div>
            <a class="text-white" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
    </div>
</nav>
