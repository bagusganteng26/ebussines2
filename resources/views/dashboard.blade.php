<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 min-h-screen">

    {{-- NAV --}}
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-gray-700">User Dashboard 👋</h1>

        <div class="flex items-center gap-4">
            <span class="text-gray-600">Hi, {{ auth()->user()->name }}</span>

            {{-- TOMBOL ADMIN (MUNCUL HANYA KALO ADMIN) --}}
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" 
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 duration-150">
                    Admin Panel 🚀
                </a>
            @endif

            {{-- LOGOUT --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <div class="p-6">

        {{-- WELCOME BANNER --}}
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-gray-700">Selamat datang, {{ auth()->user()->name }}! 😎</h2>
            <p class="text-gray-600 mt-2">
                Ini halaman dashboard user. Silakan jelajahi fitur yang tersedia.
            </p>
        </div>

        {{-- CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

            <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg duration-150">
                <h3 class="text-lg font-semibold text-gray-700">Status Akun</h3>
                <p class="mt-2 text-gray-600">Role: 
                    <span class="font-bold capitalize">{{ auth()->user()->role }}</span>
                </p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg duration-150">
                <h3 class="text-lg font-semibold text-gray-700">Email</h3>
                <p class="mt-2 text-gray-600">{{ auth()->user()->email }}</p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg duration-150">
                <h3 class="text-lg font-semibold text-gray-700">Terakhir login</h3>
                <p class="mt-2 text-gray-600">
                    {{ now()->format('d M Y, H:i') }}
                </p>
            </div>

        </div>

    </div>

</body>
</html>
