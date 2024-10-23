<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <title>Admin Dashboard</title>
    <style>
        .drawer-side {
            height: 100vh; /* Full height */
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col items-center justify-center">
            <!-- Page content here -->
            <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">
                Open drawer
            </label>
        </div>
        @include('partials.sidebar')
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>