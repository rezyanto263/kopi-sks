@extends('layouts.app')

@section('title', 'Landing Page Produk')

@section('content')
{{-- Background Dekorasi --}}
<div class="absolute -top-20 -left-20 w-96 h-96 bg-yellow-200 rounded-full blur-3xl opacity-30 z-0"></div>
<div class="absolute bottom-0 right-0 w-80 h-80 bg-amber-100 rounded-full blur-2xl opacity-20 z-0"></div>

{{-- Hero Section --}}
<section id="hero-section" class="relative z-10 bg-gradient-to-br from-[#963C00] via-[#7d3200] to-[#5e2400] text-white py-24 opacity-0 translate-y-10 transition-all duration-1000 rounded-b-[3rem] shadow-xl">
    <div class="container mx-auto px-6 max-w-4xl text-center">
        <h1 class="text-5xl font-extrabold mb-4 drop-shadow-lg">Tugas Numpuk? Kopiin aja Dulu!</h1>
        <p class="text-xl mb-8">Istirahatkan pikiranmu dengan ngopi SKS berkualitas.</p>
        <a href="#products"
           id="scroll-to-products"
           class="inline-block bg-yellow-400 text-[#5e2400] font-semibold px-8 py-3 rounded-full shadow-lg 
                  hover:shadow-2xl hover:bg-yellow-500 transition duration-300">
            Lihat Produk
        </a>
    </div>
</section>

{{-- Produk Section --}}
<section id="products"
         class="relative z-10 py-24 bg-white text-[#963C00] opacity-0 translate-y-10 transition-all duration-1000 delay-300"
         data-scroll-section>
    <div class="container mx-auto px-6 max-w-7xl">
        <h2 class="text-4xl font-bold text-center mb-14 drop-shadow-sm text-yellow-500">Kopi Kami</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
            @foreach($products as $product)
                <div class="bg-gradient-to-b from-amber-50 to-white rounded-2xl shadow-lg hover:shadow-2xl 
                            hover:ring-2 hover:ring-yellow-300/50 transition-all duration-300 ease-in-out 
                            transform hover:scale-105 flex flex-col overflow-hidden text-[#963C00]">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                         class="w-full h-48 object-cover rounded-t-2xl" />
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-xl font-semibold mb-4">{{ $product['name'] }}</h3>
                        <a href="{{ url('/product/' . $product['id']) }}"
                           class="mt-auto bg-[#963C00] text-white py-2 rounded-full hover:bg-[#7d3200] 
                                  hover:shadow-md hover:ring-2 hover:ring-yellow-400 
                                  transition-all duration-300 text-center font-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Fade-in Hero
        const hero = document.getElementById('hero-section');
        setTimeout(() => {
            hero.classList.remove('opacity-0', 'translate-y-10');
            hero.classList.add('opacity-100', 'translate-y-0');
        }, 100);

        // Scroll-triggered fade-in Produk
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove("opacity-0", "translate-y-10");
                    entry.target.classList.add("opacity-100", "translate-y-0");
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        document.querySelectorAll('[data-scroll-section]').forEach(el => observer.observe(el));

        // Smooth Scroll on Button Click
        const scrollBtn = document.getElementById('scroll-to-products');
        const productsSection = document.getElementById('products');
        scrollBtn.addEventListener('click', function (e) {
            e.preventDefault();
            productsSection.scrollIntoView({ behavior: 'smooth' });
        });
    });
</script>
@endsection