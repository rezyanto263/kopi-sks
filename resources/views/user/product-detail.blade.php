@extends('layout.app')

@section('title', 'Detail Produk Kopi')

@section('content')
    <!-- Dekorasi Background -->
    <div class="absolute -top-20 -left-20 w-96 h-96 bg-amber-100 rounded-full blur-3xl opacity-30 z-0"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-yellow-200 rounded-full blur-2xl opacity-20 z-0"></div>

    <!-- Konten Card Produk -->
    <div class="z-5 w-full max-w-6xl mx-auto px-6 py-20">
        <div class="bg-gradient-to-br from-amber-900 via-amber-800 to-amber-700 text-white rounded-3xl shadow-2xl p-10 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            <!-- Gambar Produk -->
            <div>
                <img src="{{ asset('storage/' . $product['image']) }}"
                     alt="{{ $product['name'] }}"
                     class="w-full h-auto rounded-3xl shadow-lg ring-2 ring-amber-700">
            </div>

            <!-- Detail Produk -->
            <div>
                <h1 class="text-5xl font-extrabold text-white mb-4 tracking-tight">{{ $product['name'] }}</h1>

                <span class="inline-block bg-amber-500/20 text-white text-xs uppercase font-semibold px-4 py-1 rounded-full mb-6 tracking-wide">
                    {{ $product['status'] }}
                </span>

                <p class="text-white mb-6 leading-relaxed text-lg">
                    {{ $product['description'] }}
                </p>

                <div class="text-3xl font-bold text-yellow-400 mb-2">
                    Rp {{ number_format($product['price']) }}
                </div>

                <p class="text-sm text-amber-200 mb-6">
                    <strong>Stok:</strong> Tersisa {{ $product['stock'] }} bungkus
                </p>

                <a href="https://www.google.com" target="__blank" class="bg-yellow-400 hover:bg-yellow-500 text-amber-950 px-6 py-3 rounded-xl font-semibold transition duration-200 shadow-lg hover:shadow-xl">
                    Beli Sekarang
                </a>
            </div>

        </div>
    </div>
@endsection
