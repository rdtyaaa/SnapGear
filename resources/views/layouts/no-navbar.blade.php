<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html data-theme="light" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }
    </style>
    <div class="bg-base-200 min-h-screen">
        <nav class="no-print fixed z-10 w-full">
            <div class="container mx-auto">
                <div class="flex items-center justify-between">
                    <div class="form-control no-print mb-4">
                        <a href="{{ request()->routeIs('transactions.create') ? route('transactions.index') : url()->previous() }}"
                            class="btn inline-flex justify-start border-0 bg-transparent hover:bg-transparent">
                            <svg class="mr-2 h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                            </svg>
                            Back
                        </a>
                    </div>

                    <label class="me-4 grid cursor-pointer place-items-center">
                        <input type="checkbox" value="dark"
                            class="toggle theme-controller bg-base-content col-span-2 col-start-1 row-start-1" />
                        <svg class="stroke-base-100 fill-base-100 col-start-1 row-start-1"
                            xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                        <svg class="stroke-base-100 fill-base-100 col-start-2 row-start-1"
                            xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="5" />
                            <path
                                d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4" />
                        </svg>
                    </label>
                </div>
            </div>
        </nav>
        <main class="py-10">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
