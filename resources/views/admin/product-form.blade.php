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
            
            <!-- Tampilkan gambar yang sudah ada (untuk edit) -->
            @if(isset($product) && $product->image)
                <div class="mb-3">
                    <p class="text-sm text-yellow-700 mb-2">Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="h-32 w-32 object-cover rounded-xl shadow-md border border-yellow-200">
                </div>
            @endif
            
            <input type="file" name="image" id="image" accept="image/*"
                   class="block w-full text-sm text-yellow-900 border border-yellow-300 rounded-xl px-3 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100 @error('image') border-red-500 @enderror">
            <p class="text-xs text-yellow-600 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB</p>
            
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            
            <!-- Preview gambar baru -->
            <div id="image-preview" class="mt-3 hidden">
                <p class="text-sm text-yellow-700 mb-2">Preview gambar baru:</p>
                <img id="preview-img" class="h-32 w-32 object-cover rounded-xl shadow-md border border-yellow-200">
            </div>
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

<!-- JavaScript untuk preview gambar -->
<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
    }
});
</script>
</body>
</html>