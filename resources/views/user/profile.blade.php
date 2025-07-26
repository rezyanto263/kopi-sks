@extends('layout.app')

@section('title', 'Profil Pengguna')

@section('content')
    {{-- Dekorasi Background --}}
    <div class="absolute -top-20 -left-20 w-96 h-96 bg-amber-100 rounded-full blur-3xl opacity-30 z-0"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-yellow-200 rounded-full blur-2xl opacity-20 z-0"></div>

    <!-- Konten Card -->
    <div class="relative z-10 w-full max-w-4xl mx-auto px-6 py-20">
        <div
            class="bg-gradient-to-br from-amber-900 via-amber-800 to-amber-700 text-white rounded-3xl shadow-2xl p-10 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <!-- Foto Profil -->
            <div class="flex flex-col items-center gap-6">
                @php
                    $name = $user['name'];
                    $picture = $user['picture'] ?? "https://ui-avatars.com/api/?name=$name&background=random&color=fff";
                @endphp
                <img class="rounded-full h-40 w-40 border-4 border-yellow-400 shadow-xl object-cover"
                    src="{{ $picture }}" alt="User Avatar">

                <!-- Email & Role -->
                <div class="text-center">
                    <p class="text-xl font-semibold">{{ $user['email'] }}</p>
                    <p class="text-sm uppercase tracking-wider text-yellow-300 font-medium">
                        {{ $user['role'] === 'admin' ? 'Administrator' : 'Customer' }}
                    </p>
                </div>
            </div>

            <!-- Form Edit -->
            <div>
                <form id="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-yellow-100">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user['name']) }}"
                            class="w-full px-4 py-2 rounded-lg bg-white text-amber-900 border border-yellow-300 focus:ring-2 focus:ring-yellow-400 shadow-md"
                            required>
                        @error('name')
                            <small class="text-red-800 block">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Upload Foto  -->
                    <div>
                        <label for="picture" class="block mb-2 text-sm font-medium text-yellow-100">Ubah Foto
                            Profil</label>
                        <input type="file" name="picture" accept="image/*"
                            class="w-full px-4 py-2 bg-white text-amber-800 border border-yellow-300 rounded-lg focus:ring-2 focus:ring-yellow-400 shadow">
                        @error('picture')
                            <small class="text-red-800 block">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="flex flex-wrap gap-4 pt-6">
                        <button type="submit"
                            class="bg-yellow-400 hover:bg-yellow-300 text-amber-900 font-semibold px-6 py-2 rounded-full shadow-md transition transform hover:scale-105">
                            Simpan
                        </button>
                </form>

                <form id="card-logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-500 text-white font-semibold px-6 py-2 rounded-full shadow-md transition transform hover:scale-105">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Konfirmasi Simpan Profil
            const profileForm = document.getElementById('profile-form');
            profileForm.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Simpan Perubahan?',
                    text: "Apakah Anda yakin ingin menyimpan perubahan profil?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#facc15',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        profileForm.submit();
                    }
                });
            });

            // Konfirmasi Logout
            const logoutForm = document.getElementById('card-logout-form');
            logoutForm.addEventListener('submit', function(e) {
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

            // Notifikasi sukses
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonColor: '#22c55e'
                });
            @endif
        });
    </script>
@endsection
