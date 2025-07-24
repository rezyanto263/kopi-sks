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

        <!-- Tombol Tambah Produk dan Logout -->
        <div class="flex space-x-4">
            <!-- Tombol Tambah Produk -->
            <a href="{{ route('products.create') }}"
               class="bg-yellow-900 text-white font-semibold px-5 py-2 rounded-xl shadow hover:bg-yellow-800 transition">
                Tambah Produk
            </a>

            <!-- Tombol Logout -->
            <form action="{{ route('logout') }}" method="POST" class="inline-block">
                @csrf
                <button type="submit"
                        class="bg-red-600 text-white font-semibold px-5 py-2 rounded-xl shadow hover:bg-red-700 transition">
                    Logout
                </button>
            </form>
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
