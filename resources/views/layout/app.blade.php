<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'KOPI SKS')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="webicon" href="{{ asset('storage/images/logo.jpg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative bg-gradient-to-br from-amber-50 via-white to-amber-100 min-h-screen text-[#5e2400] font-sans overflow-x-hidden">

    {{-- Dekorasi Latar --}}
    <div class="absolute -top-20 -left-20 w-96 h-96 bg-yellow-100 rounded-full blur-3xl opacity-20 z-0"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-amber-100 rounded-full blur-2xl opacity-20 z-0"></div>

    {{-- Navbar --}}
    <nav class="bg-white shadow-sm sticky top-0 z-11 w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 w-full">
                <div class="text-2xl font-bold tracking-wide text-amber-900">KOPI SKS</div>
                <div class="space-x-4">
                    <a href="{{ route('home') }}" class="text-[#5e2400] hover:text-yellow-600 font-medium transition">Home</a>
                    @guest
                    <a href="{{ route('login') }}" class="text-[#5e2400] hover:text-yellow-600 font-medium transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="text-[#5e2400] hover:text-yellow-600 font-medium transition">
                        Register
                    </a>
                    @endguest
                    @auth
                    <a href="{{ route('profile.show') }}" class="text-[#5e2400] hover:text-yellow-600 font-medium transition">Profil</a>
                    {{-- Tombol Logout dengan SweetAlert --}}
                    <button id="logout-button" class="text-[#5e2400] hover:text-red-600 font-medium transition">
                        Logout
                    </button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Form Logout tersembunyi --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    {{-- Konten Utama --}}
    <main class="py-10 z-10">
        @yield('content')
    </main>

    <footer class="bg-white text-center p-4 text-sm text-gray-500 mt-10 shadow-inner">
        &copy; {{ date('Y') }} KOPI SKS. All rights reserved.
    </footer>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Script Logout --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const logoutBtn = document.getElementById('logout-button');
            const logoutForm = document.getElementById('logout-form');

            logoutBtn?.addEventListener('click', (e) => {
                e.preventDefault();
                Swal.fire({
                    title: 'Keluar?',
                    text: "Anda yakin ingin logout?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Logout',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        logoutForm.submit();
                    }
                });
            });
        });
    </script>

    {{-- Tambahan Script Page --}}
    @yield('scripts')
</body>
</html>
