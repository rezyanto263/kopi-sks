@extends('layouts.app')

@section('title', 'Detail Produk Kopi')

@section('content')
    <!-- Dekorasi Background -->
    <div class="absolute -top-20 -left-20 w-96 h-96 bg-amber-100 rounded-full blur-3xl opacity-30 z-0"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-yellow-200 rounded-full blur-2xl opacity-20 z-0"></div>

    <!-- Konten Card Produk -->
    <div class="relative z-10 w-full max-w-6xl mx-auto px-6 py-20">
        <div class="bg-gradient-to-br from-amber-900 via-amber-800 to-amber-700 text-white rounded-3xl shadow-2xl p-10 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            <!-- Gambar Produk -->
            <div>
                <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80"
                     alt="Kopi Arabika Gayo"
                     class="w-full h-auto rounded-3xl shadow-lg ring-2 ring-amber-700">
            </div>

            <!-- Detail Produk -->
            <div>
                <h1 class="text-5xl font-extrabold text-white mb-4 tracking-tight">Kopi Arabika Gayo</h1>

                <span class="inline-block bg-amber-500/20 text-white text-xs uppercase font-semibold px-4 py-1 rounded-full mb-6 tracking-wide">
                    Kopi Arabika
                </span>

                <p class="text-white mb-6 leading-relaxed text-lg">
                    Kopi Arabika Gayo berasal dari dataran tinggi Aceh Tengah. Cita rasanya lembut dan kaya aroma floral,
                    dengan body yang seimbang dan aftertaste yang clean. Cocok untuk penyeduhan manual seperti V60 atau Chemex.
                </p>

                <div class="text-3xl font-bold text-yellow-400 mb-2">
                    Rp 45.000 <span class="text-sm font-normal text-yellow-200">/ 250 gram</span>
                </div>

                <p class="text-sm text-amber-200 mb-6">
                    <strong>Stok:</strong> Tersisa 12 bungkus
                </p>

                <button class="bg-yellow-400 hover:bg-yellow-500 text-amber-950 px-6 py-3 rounded-xl font-semibold transition duration-200 shadow-lg hover:shadow-xl">
                    Beli Sekarang
                </button>
            </div>

        </div>
    </div>
@endsection

