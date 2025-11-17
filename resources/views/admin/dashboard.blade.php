<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-700">
            Admin Panel 🚀
        </h1>
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" 
                class="px-4 py-2 rounded-lg bg-gray-700 text-white hover:bg-gray-800 duration-150">
                Ke User Dashboard 👈
            </a>
            <span class="text-gray-600">Hi, {{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 duration-150">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <div class="p-6">

        {{-- GRID CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- CARD 1 --}}
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg duration-150">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">
                    Total User
                </h2>
                <p class="text-3xl font-bold text-blue-600">
                    128
                </p>
            </div>

            {{-- CARD 2 --}}
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg duration-150">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">
                    Pendapatan Hari Ini
                </h2>
                <p class="text-3xl font-bold text-green-600">
                    Rp 2.450.000
                </p>
            </div>

            {{-- CARD 3 --}}
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg duration-150">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">
                    Pesanan Pending
                </h2>
                <p class="text-3xl font-bold text-orange-500">
                    14
                </p>
            </div>
        </div>

        {{-- SECTION TABLE --}}
        <div class="mt-8 bg-white p-6 rounded-xl shadow">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Data User</h2>

            <table class="w-full border-collapse">
                <thead>
                    <tr class="text-left bg-gray-100">
                        <th class="p-3">Nama</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Role</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach(\App\Models\User::limit(5)->get() as $user)
                        <tr class="border-b hover:bg-gray-50 duration-150">
                            <td class="p-3">{{ $user->name }}</td>
                            <td class="p-3">{{ $user->email }}</td>
                            <td class="p-3 capitalize">
                                <span class="px-3 py-1 rounded-full text-white text-sm 
                                    {{ $user->role == 'admin' ? 'bg-blue-600' : 'bg-gray-500' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</body>
</html>
