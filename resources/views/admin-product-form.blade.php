<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $mode === 'edit' ? 'Edit Product' : 'Add Product' }} | THREADLAB</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,700;0,800;1,800&family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { font-family: 'Inter', sans-serif; background: #0e0e0e; color: #fff; }
    </style>
</head>
<body class="bg-[#0e0e0e] text-white">
    <header class="fixed top-0 z-50 flex h-16 w-full items-center justify-between border-b border-white/10 bg-[#0e0e0e]/80 px-6 backdrop-blur-xl">
        <div class="text-2xl font-black italic tracking-tight text-[#d5fb00]">VOLT_ADMIN</div>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-white/60 hover:text-[#d5fb00]">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-[#d5fb00]">Products</a>
        </div>
    </header>

    @php
        $formAction = $mode === 'edit' ? route('admin.products.update', $slug) : route('admin.products.store');
        $selectedSizes = collect(old('sizes', $product['sizes'] ?? ['M']));
        $galleryItems = collect($product['gallery'] ?? [])->values();
    @endphp

    <main class="mx-auto max-w-[1200px] px-6 pb-20 pt-24">
        <div class="mb-10">
            <h1 class="font-['Plus_Jakarta_Sans'] text-6xl font-extrabold italic uppercase tracking-tighter">{{ $mode === 'edit' ? 'Edit' : 'Add' }} <span class="text-[#d5fb00]">Product</span></h1>
            <p class="mt-3 max-w-2xl text-white/60">Use this product workspace to {{ $mode === 'edit' ? 'update storefront content, pricing, images, and sizes' : 'publish a new storefront product with images, category, price, and available sizes' }}.</p>
        </div>

        @if ($errors->any())
            <div class="mb-8 border border-red-500/30 bg-red-500/10 px-5 py-4 text-sm font-semibold text-red-300">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-8 lg:grid-cols-12">
            @csrf
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Title</label>
                    <input type="text" name="title" value="{{ old('title', $product['name'] ?? '') }}" class="w-full border border-white/10 bg-[#1a1919] px-4 py-4 text-sm font-semibold text-white focus:border-[#d5fb00] focus:ring-0">
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Price</label>
                        <input type="number" min="1" step="1" name="price" value="{{ old('price', $product['price'] ?? '') }}" class="w-full border border-white/10 bg-[#1a1919] px-4 py-4 text-sm font-semibold text-white focus:border-[#d5fb00] focus:ring-0">
                    </div>
                    <div>
                        <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Category</label>
                        <select name="category" class="w-full border border-white/10 bg-[#1a1919] px-4 py-4 text-sm font-semibold uppercase text-white focus:border-[#d5fb00] focus:ring-0">
                            @foreach (['basic' => 'Basic', 'oversized' => 'Oversized', 'minimal' => 'Minimal'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('category', $product['category'] ?? 'basic') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Description</label>
                    <textarea name="description" rows="6" class="w-full border border-white/10 bg-[#1a1919] px-4 py-4 text-sm font-semibold text-white focus:border-[#d5fb00] focus:ring-0">{{ old('description', $product['description'] ?? '') }}</textarea>
                </div>

                <div>
                    <label class="mb-3 block text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Sizes</label>
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                        @foreach (['S', 'M', 'L', 'XL'] as $size)
                            <label class="flex items-center gap-3 border border-white/10 bg-[#1a1919] px-4 py-3 text-sm font-bold text-white">
                                <input type="checkbox" name="sizes[]" value="{{ $size }}" class="border-white/20 bg-transparent text-[#d5fb00] focus:ring-[#d5fb00]" @checked($selectedSizes->contains($size))>
                                <span>{{ $size }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-6">
                @if ($mode === 'edit' && !empty($product['image']))
                    <div>
                        <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Current Featured Image</label>
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="h-64 w-full object-cover">
                    </div>
                @endif

                <div>
                    <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Featured Image</label>
                    <input type="file" name="featured_image" accept="image/*" class="block w-full border border-white/10 bg-[#1a1919] px-4 py-3 text-sm font-semibold text-white file:mr-4 file:border-0 file:bg-[#d5fb00] file:px-3 file:py-2 file:text-[10px] file:font-black file:uppercase file:tracking-[0.2em] file:text-[#4e5d00]">
                </div>

                <div>
                    <label class="mb-2 block text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Gallery Images (up to 4)</label>
                    <input type="file" name="gallery_images[]" accept="image/*" multiple class="block w-full border border-white/10 bg-[#1a1919] px-4 py-3 text-sm font-semibold text-white file:mr-4 file:border-0 file:bg-[#7799ff] file:px-3 file:py-2 file:text-[10px] file:font-black file:uppercase file:tracking-[0.2em] file:text-white">
                </div>

                @if ($mode === 'edit' && $galleryItems->isNotEmpty())
                    <div>
                        <label class="mb-3 block text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Current Gallery</label>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach ($galleryItems as $imageIndex => $image)
                                @php
                                    $galleryKey = $imageIndex;
                                @endphp
                                <div class="group relative overflow-hidden border border-white/10 bg-[#1a1919] transition-all duration-200" data-gallery-card>
                                    <input type="checkbox" name="remove_gallery[]" value="{{ $galleryKey }}" id="remove-gallery-{{ $galleryKey }}" class="peer sr-only">
                                    <img src="{{ $image }}" alt="Gallery image" class="h-32 w-full object-cover transition duration-200 peer-checked:opacity-30">
                                    <button type="button" class="absolute right-2 top-2 flex h-8 w-8 items-center justify-center rounded-full border border-white/10 bg-black/70 text-white transition hover:border-red-400 hover:text-red-300" data-gallery-remove-trigger data-gallery-target="remove-gallery-{{ $galleryKey }}" aria-label="Remove gallery image">
                                        <span class="material-symbols-outlined text-base">close</span>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <p class="mt-3 text-[10px] font-bold uppercase tracking-[0.2em] text-white/40">Click the X icon on any gallery image you want to remove, then save changes.</p>
                    </div>
                @endif

                <div class="flex gap-3 pt-4">
                    <a href="{{ route('admin.products.index') }}" class="flex-1 border border-white/10 px-6 py-4 text-center text-[11px] font-black uppercase tracking-[0.2em] text-white hover:border-[#d5fb00] hover:text-[#d5fb00]">Back</a>
                    <button type="submit" class="flex-1 bg-[#d5fb00] px-6 py-4 text-[11px] font-black uppercase tracking-[0.2em] text-[#4e5d00] transition-transform active:scale-95">
                        {{ $mode === 'edit' ? 'Save Changes' : 'Upload Product' }}
                    </button>
                </div>
            </div>
        </form>
    </main>

    <script>
        (() => {
            document.querySelectorAll('[data-gallery-remove-trigger]').forEach((button) => {
                button.addEventListener('click', () => {
                    const checkboxId = button.dataset.galleryTarget;
                    const checkbox = checkboxId ? document.getElementById(checkboxId) : null;
                    const card = button.closest('[data-gallery-card]');

                    if (checkbox) {
                        checkbox.checked = true;
                    }

                    if (card) {
                        card.classList.add('scale-95', 'opacity-0');
                        window.setTimeout(() => {
                            card.classList.add('hidden');
                        }, 180);
                    }
                });
            });
        })();
    </script>
</body>
</html>
