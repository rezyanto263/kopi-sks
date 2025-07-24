<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk Kopi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-white text-gray-800">

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row items-center justify-between mb-6 space-y-4 md:space-y-0">
        <h1 class="text-3xl font-bold text-yellow-900">Produk Kopi SKS</h1>
        
        
        <div class="flex space-x-3">
            <!-- Tombol Home -->
            <a href="/"
               class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium bg-gray-200 text-yellow-900 shadow-sm hover:bg-gray-300 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Home
            </a>

            <!-- Tombol Tambah Produk -->
            <a href="{{ route('products.create') }}"
               class="bg-yellow-900 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-yellow-800 transition">
                Tambah Produk
            </a>
        </div>
    </div>

    <!-- Tampilkan pesan sukses -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white border border-yellow-200 shadow-md rounded-xl">
        <table class="min-w-full text-left">
            <thead>
                <tr class="bg-yellow-100 text-yellow-900 text-sm uppercase tracking-wider">
                    <th class="px-5 py-3">ID</th>
                    <th class="px-5 py-3">Gambar</th>
                    <th class="px-5 py-3">Nama</th>
                    <th class="px-5 py-3">Harga</th>
                    <th class="px-5 py-3">Stok</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
                @forelse($products as $product)
                    <tr class="border-t hover:bg-yellow-50">
                        <td class="px-5 py-3">{{ $product->id }}</td>
                        <td class="px-5 py-3">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="h-16 w-16 object-cover rounded shadow">
                            @else
                                <span class="text-gray-400 text-sm italic">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-5 py-3">{{ $product->name }}</td>
                        <td class="px-5 py-3">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-5 py-3">{{ $product->stock }}</td>
                        <td class="px-5 py-3">{{ $product->status }}</td>
                        <td class="px-5 py-3">
                            <div class="flex space-x-3">
                                <!-- Tombol Edit -->
                                <a href="{{ route('products.edit', $product) }}"
                                   class="text-yellow-800 hover:text-yellow-600 transition" title="Edit">
                                    <i data-feather="edit"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('products.destroy', $product) }}"
                                      method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-400 transition" title="Hapus">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-5 py-5 text-center text-gray-500 italic">Belum ada produk kopi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    feather.replace();
</script>
</body>
</html>
