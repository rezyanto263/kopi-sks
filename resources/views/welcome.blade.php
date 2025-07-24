<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kopi SKS - Kopi Nusantara Asli</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#fdfcfb] text-gray-800 font-sans">

    {{-- NAVBAR --}}
    <header class="bg-[#4E342E] shadow-md p-4 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white">Kopi SKS</h1>
            <nav class="hidden md:flex space-x-6">
                <a href="#produk" class="text-white hover:text-yellow-300">Produk</a>
                <a href="#tentang" class="text-white hover:text-yellow-300">Tentang</a>
                <a href="#kontak" class="text-white hover:text-yellow-300">Kontak</a>
            </nav>
            @guest
            <a href="{{ route('login') }}" class="bg-yellow-400 hover:bg-yellow-500 text-[#4E342E] font-semibold px-5 py-2 rounded-full shadow">
                Login
            </a>
            @endguest
        </div>
    </header>

    {{-- HERO SECTION --}}
<section class="relative h-[90vh] flex items-center justify-center bg-cover bg-center" style="background-image: url('/images/heropage.jpg');">
    <div class="absolute inset-0 bg-black opacity-60"></div>
    <div class="z-10 text-center text-white px-4">
        <h2 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
            Nikmati Rasa Kopi Sejati
        </h2>
        <p class="text-lg md:text-xl mb-6 max-w-2xl mx-auto">
            Langsung dari petani lokal. Tanpa perantara, tanpa bahan tambahan. Murni dan nikmat!
        </p>
        <a href="#produk" class="bg-yellow-500 hover:bg-yellow-600 text-[#4E342E] font-semibold px-8 py-3 rounded-full text-lg shadow-lg">
            Lihat Produk
        </a>
    </div>
</section>

    {{--PRODUK --}}
    <section id="produk" class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-12 text-[#4E342E]">Produk Kami</h3>
            <div class="grid md:grid-cols-3 gap-10">
                @foreach ([
                    ['nama' => 'Kopi Arabika', 'harga' => 'Rp45.000', 'foto' => 'kopi1.jpg', 'desc' => 'Aroma floral & rasa ringan'],
                    ['nama' => 'Kopi Robusta', 'harga' => 'Rp40.000', 'foto' => 'kopi2.jpg', 'desc' => 'Rasa kuat & pahit'],
                    ['nama' => 'Kopi Blend', 'harga' => 'Rp48.000', 'foto' => 'kopi3.jpg', 'desc' => 'Campuran Arabika & Robusta']
                ] as $kopi)
                    <div class="bg-[#fdf6f0] rounded-xl shadow hover:shadow-lg p-6 text-center transition">
                        <img src="/images/{{ $kopi['foto'] }}" alt="{{ $kopi['nama'] }}" class="w-full h-48 object-cover rounded-md mb-4">
                        <h4 class="text-xl font-bold text-[#4E342E] mb-2">{{ $kopi['nama'] }}</h4>
                        <p class="text-gray-700 mb-1">{{ $kopi['desc'] }}</p>
                        <p class="font-semibold text-[#4E342E] mb-4">{{ $kopi['harga'] }} / 250g</p>
                        <button class="bg-[#4E342E] text-white px-5 py-2 rounded-full hover:bg-[#3e2a22] transition">
                            Pesan Sekarang
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{--TENTANG --}}
    <section id="tentang" class="py-16 bg-[#f8f5f2]">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold text-[#4E342E] mb-6">Tentang Kami</h3>
            <p class="text-gray-700 text-lg">
                Kami adalah komunitas petani kopi dari pegunungan Indonesia yang berkomitmen menghadirkan kopi terbaik langsung ke tangan konsumen. Tanpa perantara, tanpa bahan tambahan. Hanya kopi murni berkualitas.
            </p>
        </div>
    </section>

    {{-- KONTAK --}}
    <section id="kontak" class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold text-[#4E342E] mb-6">Hubungi Kami</h3>
            <p class="text-gray-700 mb-2">Ingin kerja sama, reseller, atau tanya-tanya?</p>
            <p class="font-semibold">📞 0812-3456-7890</p>
            <p class="font-semibold">📧 kopi@kopisks.com</p>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-[#4E342E] text-white text-center py-5">
        <p>&copy; {{ now()->year }} Kopi SKS. Seluruh hak cipta dilindungi.</p>
    </footer>

</body>
</html>
