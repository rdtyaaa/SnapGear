<!DOCTYPE html>
<html lang="en" data-theme='light'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <title>Homepage</title>
</head>

<body>
    <!-- navbar -->
    <div class="navbar bg-orange-600">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl text-white">SnapGear</a>
        </div>
        <div class="flex-none gap-2">
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Profile Avatar"
                            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                    </div>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                    <li><a class="justify-between" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full justify-between text-left">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- navbar end -->

    <div class="container mx-auto ps-8">
        <div class="container mx-auto mt-8">
            <h2 class="mb-8 text-xl font-bold">Riwayat Peminjaman</h2>
            <table class="table-zebra table w-full">
                <thead class="text-base text-gray-800">
                    <tr>
                        <th class="px-4 py-2">Transaction Code</th>
                        <th class="px-4 py-2">Product</th>
                        <th class="px-4 py-2">Return Agreement</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($borrowedUnits->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">Data is Empty</td>
                        </tr>
                    @else
                        @foreach ($borrowedUnits as $unit)
                            <tr>
                                <td class="px-4 py-2">{{ $unit->transaction_code }}</td>
                                <td class="px-4 py-2">{{ $unit->unit->name }}</td>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($unit->return_agreement)->locale('id_ID')->translatedFormat('l, d F Y') }}
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('transactions.view', ['transaction_code' => $unit->transaction_code, 'unit_id' => $unit->unit_id]) }}"
                                        class="btn btn-link">View</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
