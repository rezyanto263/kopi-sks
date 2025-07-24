<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ isset($product) ? 'Edit' : 'Tambah' }} Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-800">

<div class="w-full max-w-lg mx-auto py-10">
    <h1 class="text-2xl font-bold text-yellow-900 mb-6 text-center">
        {{ isset($product) ? 'Edit Produk' : 'Tambah Produk' }}
    </h1>

    <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}"
          method="POST" enctype="multipart/form-data"
          class="bg-white shadow-md rounded-2xl p-8 border border-yellow-100">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        <!-- Nama Produk -->
        <div class="mb-4">
            <label class="block text-yellow-900 font-semibold mb-1">Nama Produk</label>
            <input type="text" name="name"
                   value="{{ old('name', $product->name ?? '') }}"
                   class="w-full border border-yellow-300 rounded-xl px-4 py-2 text-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-700"
                   required>
        </div>

        <!-- Harga -->
        <div class="mb-4">
            <label class="block text-yellow-900 font-semibold mb-1">Harga</label>
            <input type="number" name="price"
                   value="{{ old('price', $product->price ?? '') }}"
                   class="w-full border border-yellow-300 rounded-xl px-4 py-2 text-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-700"
                   required>
        </div>

        <!-- Stok -->
        <div class="mb-4">
            <label class="block text-yellow-900 font-semibold mb-1">Stok</label>
            <input type="number" name="stock"
                   value="{{ old('stock', $product->stock ?? '') }}"
                   class="w-full border border-yellow-300 rounded-xl px-4 py-2 text-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-700"
                   required>
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label class="block text-yellow-900 font-semibold mb-1">Status</label>
            <select name="status"
                    class="w-full text-yellow-900 bg-white border border-yellow-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-700 appearance-none">
                <option value="tersedia" {{ old('status', $product->status ?? '') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="habis" {{ old('status', $product->status ?? '') == 'habis' ? 'selected' : '' }}>Habis</option>
            </select>
        </div>

        <!-- Upload Gambar -->
        <div class="mb-6">
            <label class="block text-yellow-900 font-semibold mb-1">Gambar Produk</label>
            <input type="file" name="image" accept="image/*"
                   class="block w-full text-sm text-yellow-900 border border-yellow-300 rounded-xl px-3 py-2">

            @if(isset($product) && $product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Preview Gambar" class="mt-3 h-32 rounded shadow">
            @endif
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center justify-between">
            <button type="submit"
                    class="bg-yellow-800 hover:bg-yellow-700 text-white font-semibold py-2 px-6 rounded-xl transition">
                {{ isset($product) ? 'Perbarui' : 'Simpan' }}
            </button>
            <a href="{{ route('products.index') }}"
               class="text-yellow-800 hover:underline font-semibold">
                Kembali
            </a>
        </div>
    </form>
</div>

</body>
</html>
