<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>403 Unauthorized</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-error">403</h1>
        <p class="text-xl mt-4">Unauthorized Access</p>
        <p class="text-gray-500 mt-2">You do not have permission to access this page.</p>
        <a href="{{ url('/login') }}" class="mt-6 inline-block bg-blue-500 text-white py-2 px-4 rounded">
            Login
        </a>
        <a href="{{ url('/') }}" class="mt-6 inline-block bg-blue-500 text-white py-2 px-4 rounded">
            Go to Home
        </a>
    </div>
</body>
</html>
