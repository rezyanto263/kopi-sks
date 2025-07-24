@extends('layouts.app')

@section('title', 'Profil Pengguna')
@section('header', '')

@section('content')
<div class="h-screen flex items-center justify-center bg-[#963C00] bg-gradient-to-br from-[#963C00] to-[#5c2400]">
    <div class="w-full max-w-2xl bg-white/70 backdrop-blur-lg rounded-2xl shadow-2xl p-10 text-center border border-yellow-100">
        <div class="space-y-6">

            {{-- Foto Profil --}}
            <div class="flex justify-center">
                <img class="rounded-full h-40 w-40 border-4 border-yellow-300 shadow-lg object-cover"
                     src="{{ $user['profile_photo'] ?? 'https://thispersondoesnotexist.com/image' }}"
                     alt="User Avatar">
            </div>

            {{-- Form Edit Nama & Foto --}}
            <form id="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div>
                    <input type="text" name="name" value="{{ old('name', $user['name']) }}"
                        class="text-center w-full text-3xl font-bold bg-transparent border-b-2 border-yellow-500 text-[#3d2b1f] placeholder-gray-400 
                        focus:outline-none focus:ring-2 focus:ring-yellow-400 transition duration-300"
                        required>
                </div>

                {{-- Upload Foto --}}
                <div class="text-left text-[#3d2b1f]">
                    <label class="block mb-2 font-medium">Ubah Foto Profil:</label>
                    <input type="file" name="profile_photo" accept="image/*"
                        class="w-full px-4 py-2 bg-yellow-50 border border-yellow-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-300">
                </div>

                {{-- Email dan Role --}}
                <div class="text-[#3d2b1f]">
                    <p class="text-lg font-medium">{{ $user['email'] }}</p>
                    <p class="text-sm uppercase tracking-wider text-yellow-900 font-semibold">
                        {{ $user['role'] === 'admin' ? 'Administrator' : 'Customer' }}
                    </p>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-center gap-4 pt-4">
                    <button type="submit"
                        class="bg-yellow-500 hover:bg-yellow-400 text-[#3d2b1f] font-bold px-6 py-2 rounded-full shadow-lg transition duration-300 transform hover:scale-105">
                        Simpan
                    </button>
            </form>

            <form id="card-logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="bg-red-600 hover:bg-red-500 text-white font-bold px-6 py-2 rounded-full shadow-lg transition duration-300 transform hover:scale-105">
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
    document.addEventListener("DOMContentLoaded", function () {

        // Konfirmasi Simpan Profil
        const profileForm = document.getElementById('profile-form');
        profileForm.addEventListener('submit', function (e) {
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

        // Konfirmasi Logout di Card
        const cardLogoutForm = document.getElementById('card-logout-form');
        cardLogoutForm.addEventListener('submit', function (e) {
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
                    cardLogoutForm.submit();
                }
            });
        });

        // Notifikasi sukses
        @if(session('success'))
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