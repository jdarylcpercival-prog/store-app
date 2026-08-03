<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Products | THREADLAB</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,700;0,800;1,800&family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { font-family: 'Inter', sans-serif; background: #0e0e0e; color: #fff; }
    </style>
</head>
<body class="bg-[#0e0e0e] text-white">
    @php
        $adminInitials = collect(explode(' ', $admin['full_name']))->filter()->map(fn ($part) => strtoupper(substr($part, 0, 1)))->take(2)->implode('');
    @endphp

    <header class="fixed top-0 z-50 flex h-16 w-full items-center justify-between border-b border-white/10 bg-[#0e0e0e]/80 px-6 backdrop-blur-xl">
        <div class="text-2xl font-black italic tracking-tight text-[#d5fb00]">VOLT_ADMIN</div>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-white/60 hover:text-[#d5fb00]">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-[#d5fb00]">Products</a>
            <div class="flex h-8 w-8 items-center justify-center rounded-full border border-[#d5fb00]/20 bg-[#201f1f] text-xs font-black text-[#d5fb00]">{{ $adminInitials ?: 'AD' }}</div>
        </div>
    </header>

    <main class="mx-auto max-w-[1200px] px-6 pb-20 pt-24">
        @if (session('status'))
            <div class="mb-8 border border-[#d5fb00]/30 bg-[#d5fb00]/10 px-5 py-4 text-sm font-semibold text-[#d5fb00]">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="font-['Plus_Jakarta_Sans'] text-6xl font-extrabold italic uppercase tracking-tighter">All <span class="text-[#d5fb00]">Products</span></h1>
                <p class="mt-3 max-w-2xl text-white/60">Manage the storefront catalog from one place. Add new products or update existing ones without cluttering the main dashboard.</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-[#d5fb00] px-6 py-4 text-[11px] font-black uppercase tracking-[0.2em] text-[#4e5d00] transition-transform active:scale-95">
                <span class="material-symbols-outlined">add</span>
                Add Product
            </a>
        </div>

        <div class="overflow-hidden border border-white/10 bg-[#131313]">
            <div class="grid grid-cols-[120px_1.5fr_120px_120px_160px_180px] gap-4 border-b border-white/10 px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-white/40">
                <span>Image</span>
                <span>Product</span>
                <span>Category</span>
                <span>Price</span>
                <span>Sizes</span>
                <span class="text-right">Actions</span>
            </div>

            @forelse ($products as $product)
                <div class="grid grid-cols-[120px_1.5fr_120px_120px_160px_180px] gap-4 border-b border-white/5 px-6 py-5 last:border-b-0">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="h-24 w-20 object-cover">
                    <div class="min-w-0">
                        <div class="truncate font-['Plus_Jakarta_Sans'] text-2xl font-black italic uppercase tracking-tight text-white">{{ $product['name'] }}</div>
                        <div class="mt-2 text-[10px] font-bold uppercase tracking-[0.2em] text-white/40">{{ $product['sku'] }}</div>
                        <div class="mt-3 text-sm text-white/60 line-clamp-2">{{ $product['description'] }}</div>
                    </div>
                    <div class="text-sm font-bold uppercase text-white/80">{{ $product['category'] }}</div>
                    <div class="text-sm font-black text-[#d5fb00]">&#8369;{{ number_format($product['price']) }}</div>
                    <div class="text-sm font-bold text-white/80">{{ implode(', ', $product['sizes'] ?? ['M']) }}</div>
                    <div class="flex items-start justify-end gap-2">
                        <a href="{{ route('admin.products.edit', $product['slug']) }}" class="border border-white/10 px-4 py-3 text-[10px] font-black uppercase tracking-[0.2em] text-white hover:border-[#d5fb00] hover:text-[#d5fb00]">Edit</a>
                        <form action="{{ route('admin.products.delete', $product['slug']) }}" method="POST" onsubmit="return confirm('Delete this product?');">
                            @csrf
                            <button type="submit" class="border border-red-500/20 px-4 py-3 text-[10px] font-black uppercase tracking-[0.2em] text-red-300 hover:bg-red-500/10">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="px-6 py-16 text-center text-sm font-semibold uppercase tracking-[0.2em] text-white/40">
                    No products available yet
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>
