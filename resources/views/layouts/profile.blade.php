<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html data-theme="light" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.0/dist/full.css" rel="stylesheet">
</head>
<body>
    <div class="min-h-screen bg-gray-100">
        <main class="py-10">
            @yield('content')
        </main>
    </div>
<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
