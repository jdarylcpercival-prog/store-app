<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product['name'] }} | THREADLAB</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,700;0,800;1,800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        surface: "#0e0e0e",
                        "error-container": "#b92902",
                        "surface-dim": "#0e0e0e",
                        "surface-variant": "#262626",
                        "surface-container-high": "#201f1f",
                        tertiary: "#ffeaa2",
                        "inverse-on-surface": "#565554",
                        "surface-tint": "#f5ffc4",
                        "on-surface": "#ffffff",
                        "on-secondary-container": "#f8f7ff",
                        "on-tertiary-container": "#5d4d00",
                        primary: "#f5ffc4",
                        "on-primary-fixed": "#3d4a00",
                        "on-secondary-fixed": "#002d80",
                        "on-primary-container": "#4e5d00",
                        "surface-container": "#1a1919",
                        "tertiary-fixed": "#fedb42",
                        "on-surface-variant": "#adaaaa",
                        "on-secondary": "#001b55",
                        "surface-bright": "#2c2c2c",
                        outline: "#777575",
                        "tertiary-fixed-dim": "#efcd34",
                        "primary-fixed-dim": "#c8ec00",
                        background: "#0e0e0e",
                        "inverse-primary": "#556600",
                        "on-secondary-fixed-variant": "#0047bd",
                        "tertiary-dim": "#efcd34",
                        "secondary-fixed-dim": "#b0c2ff",
                        "primary-fixed": "#d5fb00",
                        "on-primary-fixed-variant": "#576800",
                        "tertiary-container": "#fedb42",
                        "on-error": "#450900",
                        "primary-dim": "#cbef00",
                        "surface-container-lowest": "#000000",
                        "on-background": "#ffffff",
                        "secondary-fixed": "#c4d0ff",
                        "on-tertiary-fixed": "#473b00",
                        "on-primary": "#556600",
                        "primary-container": "#d5fb00",
                        "surface-container-highest": "#262626",
                        "on-tertiary": "#675600",
                        "on-error-container": "#ffd2c8",
                        error: "#ff7351",
                        "surface-container-low": "#131313",
                        "outline-variant": "#484847",
                        secondary: "#7799ff",
                        "inverse-surface": "#fcf8f8",
                        "secondary-dim": "#316bf3",
                        "secondary-container": "#0053db",
                        "error-dim": "#d53d18",
                        "on-tertiary-fixed-variant": "#685700"
                    },
                    borderRadius: {
                        DEFAULT: "0.125rem",
                        lg: "0.25rem",
                        xl: "0.5rem",
                        full: "0.75rem"
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans"],
                        body: ["Inter"],
                        label: ["Inter"]
                    }
                }
            }
        };
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .kinetic-gradient {
            background: linear-gradient(135deg, #f5ffc4 0%, #d5fb00 100%);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body selection:bg-primary-container selection:text-on-primary-container">
    @include('partials.header')

    @php
        $availableSizes = $product['sizes'] ?? ['S', 'M', 'L', 'XL'];
        $defaultSize = in_array('M', $availableSizes, true) ? 'M' : ($availableSizes[0] ?? 'M');
        $galleryImages = collect($product['gallery'] ?? [])
            ->filter(fn ($image) => filled($image) && $image !== ($product['image'] ?? null))
            ->values();
    @endphp

    <main class="pt-24 pb-20 px-6 lg:px-12 max-w-[1200px] mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20">
            <div class="lg:col-span-7 space-y-6">
                <div class="aspect-[4/5] bg-surface-container-low overflow-hidden rounded-xl group relative transition-all duration-500 ease-out" data-product-main-stage>
                    <img alt="{{ $product['name'] }}" class="w-full h-full object-cover transition-all duration-500 ease-out group-hover:scale-105" src="{{ $product['image'] }}" data-product-main-image>
                    <div class="absolute top-6 left-6">
                        <span class="bg-secondary px-4 py-1 rounded-full text-surface text-[10px] font-bold tracking-[0.2em] uppercase">{{ $product['access_badge'] }}</span>
                    </div>
                </div>

                @if ($galleryImages->isNotEmpty())
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                        @foreach ($galleryImages as $galleryImage)
                            <button
                                class="aspect-square bg-surface-container rounded-lg overflow-hidden transition-all duration-300 cursor-pointer opacity-60 hover:opacity-100"
                                type="button"
                                data-gallery-trigger
                                data-gallery-image="{{ $galleryImage }}"
                                aria-label="View {{ $product['name'] }} image {{ $loop->iteration }}"
                            >
                                <img alt="{{ $product['name'] }} view {{ $loop->iteration }}" class="w-full h-full object-cover" src="{{ $galleryImage }}">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="lg:col-span-5 flex flex-col justify-center">
                <header class="mb-8">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="text-primary-container text-[11px] font-bold tracking-[0.3em] font-label uppercase">{{ $product['eyebrow'] }}</span>
                        <div class="h-px flex-1 bg-outline-variant/20"></div>
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-black font-headline tracking-tighter leading-none mb-4 italic uppercase">{{ $product['name'] }}</h1>
                    <div class="flex items-baseline gap-4">
                        <p class="text-3xl font-headline font-bold text-on-surface italic">&#8369;{{ number_format($product['price']) }}</p>
                        <span class="text-on-surface-variant text-sm line-through">&#8369;{{ number_format($product['compare_price']) }}</span>
                    </div>
                </header>

                <div class="mb-10 max-w-md">
                    <p class="text-on-surface-variant text-lg leading-relaxed font-body">
                        {{ $product['description'] }}
                    </p>
                </div>

                <form action="{{ route('cart.add', $slug) }}" method="POST" data-product-form>
                    @csrf

                    <div class="mb-10">
                        <div class="flex justify-between items-center mb-4">
                            <label class="text-[10px] font-black tracking-widest text-on-surface uppercase font-label">Select Size</label>
                            <button class="text-[10px] text-secondary font-bold tracking-widest uppercase hover:underline" type="button" data-open-size-guide>Size Guide</button>
                        </div>
                        <div class="grid gap-3" style="grid-template-columns: repeat({{ max(count($availableSizes), 1) }}, minmax(0, 1fr));">
                            @foreach ($availableSizes as $size)
                                <label>
                                    <input class="peer sr-only" name="size" type="radio" value="{{ $size }}" {{ $size === $defaultSize ? 'checked' : '' }} data-size-input>
                                    <span class="flex items-center justify-center py-4 border text-sm font-bold transition-all {{ $size === $defaultSize ? 'border-2 border-primary-container text-primary-container bg-primary-container/5' : 'border-outline-variant/30 hover:border-primary-container hover:text-primary-container' }}" data-size-option>{{ $size }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p class="mt-3 text-[11px] font-bold uppercase tracking-[0.2em] text-on-surface-variant">
                            Selected size:
                            <span class="text-primary-container" data-selected-size>{{ $defaultSize }}</span>
                        </p>
                    </div>

                    <div class="mb-10">
                        <label class="text-[10px] font-black tracking-widest text-on-surface uppercase font-label block mb-4">Quantity</label>
                        <div class="w-32 border border-outline-variant/30 px-4 py-4 flex items-center justify-between">
                            <button class="material-symbols-outlined text-on-surface-variant transition-colors hover:text-primary-container disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:text-on-surface-variant" type="button" data-quantity-decrease aria-label="Decrease quantity">remove</button>
                            <input class="w-10 border-0 bg-transparent p-0 text-center font-black text-white focus:ring-0" name="quantity" type="number" value="1" min="1" max="10" aria-label="Quantity" data-quantity-input>
                            <button class="material-symbols-outlined text-on-surface-variant transition-colors hover:text-primary-container disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:text-on-surface-variant" type="button" data-quantity-increase aria-label="Increase quantity">add</button>
                        </div>
                        <p class="mt-3 text-[11px] font-bold uppercase tracking-[0.2em] text-on-surface-variant">
                            Up to 10 pieces per add to cart.
                        </p>
                    </div>

                    <div class="space-y-4 mb-12">
                        <button class="w-full kinetic-gradient py-5 text-on-primary-container font-black tracking-widest uppercase font-label transition-transform active:scale-[0.98]" type="submit" name="redirect_to" value="cart">
                            Add to Cart
                        </button>
                        <button class="w-full border-2 border-on-surface py-5 text-on-surface font-black tracking-widest uppercase font-label hover:bg-on-surface hover:text-surface transition-all active:scale-[0.98]" type="submit" name="redirect_to" value="checkout">
                            Buy Now
                        </button>
                    </div>
                </form>

                <div class="border-t border-outline-variant/10 pt-8" data-product-tabs>
                    <div class="flex gap-8 mb-6 border-b border-outline-variant/10 pb-4 overflow-x-auto no-scrollbar">
                        <button class="text-primary-container text-[11px] font-bold tracking-widest uppercase whitespace-nowrap transition-colors" type="button" data-tab-trigger="description">Description</button>
                        <button class="text-on-surface-variant text-[11px] font-bold tracking-widest uppercase whitespace-nowrap hover:text-on-surface transition-colors" type="button" data-tab-trigger="materials">Materials</button>
                        <button class="text-on-surface-variant text-[11px] font-bold tracking-widest uppercase whitespace-nowrap hover:text-on-surface transition-colors" type="button" data-tab-trigger="sizing">Sizing Guide</button>
                    </div>

                    <div class="text-on-surface-variant text-sm space-y-4 font-body leading-relaxed" data-tab-panel="description">
                        <p>{{ $product['description'] }}</p>
                        <p>{{ $product['fit_notes'] }}</p>
                        <ul class="list-none space-y-2">
                            @foreach ($product['highlights'] as $highlight)
                                <li class="flex items-center gap-3">
                                    <span class="w-1 h-1 bg-primary-container rounded-full"></span>
                                    <span>{{ $highlight }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="hidden text-on-surface-variant text-sm space-y-4 font-body leading-relaxed" data-tab-panel="materials">
                        <p>{{ $product['materials'] }}</p>
                        <ul class="list-none space-y-2">
                            <li class="flex items-center gap-3">
                                <span class="w-1 h-1 bg-primary-container rounded-full"></span>
                                <span>Premium fabrication selected for structure, comfort, and repeat wear.</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-1 h-1 bg-primary-container rounded-full"></span>
                                <span>Finished for a clean silhouette with durable seam construction.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="hidden text-on-surface-variant text-sm space-y-6 font-body leading-relaxed" data-tab-panel="sizing" id="product-sizing-guide">
                        <p>Choose your regular fit for a clean silhouette, or size up for a more relaxed editorial drape.</p>

                        <div class="overflow-hidden rounded-lg border border-outline-variant/10 bg-surface-container-low">
                            <div class="grid grid-cols-[80px_1fr] border-b border-outline-variant/10 px-5 py-3 text-[10px] font-bold uppercase tracking-[0.25em] text-on-surface-variant">
                                <span>Size</span>
                                <span>Measurements</span>
                            </div>
                            <div class="space-y-0">
                                <div class="grid grid-cols-[80px_1fr] px-5 py-3 text-sm border-b border-outline-variant/10">
                                    <span class="font-black uppercase text-primary-container">S</span>
                                    <span>Chest 20" / Length 27" / Shoulder 18"</span>
                                </div>
                                <div class="grid grid-cols-[80px_1fr] px-5 py-3 text-sm border-b border-outline-variant/10">
                                    <span class="font-black uppercase text-primary-container">M</span>
                                    <span>Chest 21" / Length 28" / Shoulder 19"</span>
                                </div>
                                <div class="grid grid-cols-[80px_1fr] px-5 py-3 text-sm border-b border-outline-variant/10">
                                    <span class="font-black uppercase text-primary-container">L</span>
                                    <span>Chest 22" / Length 29" / Shoulder 20"</span>
                                </div>
                                <div class="grid grid-cols-[80px_1fr] px-5 py-3 text-sm">
                                    <span class="font-black uppercase text-primary-container">XL</span>
                                    <span>Chest 23" / Length 30" / Shoulder 21"</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="mt-32">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div>
                    <h2 class="text-4xl font-headline font-black italic tracking-tighter uppercase mb-2">Complement the Look</h2>
                    <p class="text-on-surface-variant font-body">Curated pieces to complete your digital uniform.</p>
                </div>
                <div class="h-[2px] hidden md:block flex-1 mx-12 bg-outline-variant/10"></div>
                <a class="text-primary-container font-black tracking-widest text-xs uppercase flex items-center gap-2 group" href="{{ route('shop') }}">
                    View Full Collection
                    <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="group">
                        <a class="block aspect-[3/4] bg-surface-container-low mb-6 overflow-hidden relative rounded-lg" href="{{ route('product.show', $relatedProduct['slug']) }}">
                            <img alt="{{ $relatedProduct['name'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="{{ $relatedProduct['image'] }}">
                            <div class="absolute bottom-4 right-4 translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all">
                                <button
                                    class="bg-primary-container text-on-primary-container p-3 rounded-full inline-flex transition-transform active:scale-95"
                                    type="button"
                                    data-quick-add-trigger
                                    data-product-slug="{{ $relatedProduct['slug'] }}"
                                    data-product-name="{{ $relatedProduct['name'] }}"
                                    data-product-price="{{ number_format($relatedProduct['price']) }}"
                                    data-product-image="{{ $relatedProduct['image'] }}"
                                    aria-label="Quick add {{ $relatedProduct['name'] }}"
                                >
                                    <span class="material-symbols-outlined">add</span>
                                </button>
                            </div>
                        </a>
                        <div class="space-y-1">
                            <a class="inline-block text-lg font-headline font-bold uppercase italic tracking-tight transition-colors hover:text-primary-container" href="{{ route('product.show', $relatedProduct['slug']) }}">{{ $relatedProduct['name'] }}</a>
                            <a class="block text-on-surface-variant text-sm font-label uppercase tracking-widest transition-colors hover:text-primary-container" href="{{ route('product.show', $relatedProduct['slug']) }}">&#8369;{{ number_format($relatedProduct['price']) }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <div class="pointer-events-none fixed inset-0 z-[90] opacity-0 transition-all duration-200" data-quick-add-modal>
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" data-quick-add-close></div>
        <div class="absolute inset-x-4 top-1/2 mx-auto w-full max-w-md -translate-y-1/2 border border-outline-variant/30 bg-surface-container-low p-6 shadow-[0_30px_80px_rgba(0,0,0,0.6)] transition-all duration-200 md:p-8">
            <div class="mb-6 flex items-start justify-between gap-4">
                <div>
                    <div class="text-[10px] font-black uppercase tracking-[0.25em] text-primary-container">Quick Add</div>
                    <h3 class="mt-2 font-headline text-2xl font-black uppercase italic tracking-tight text-white" data-quick-add-name>Product</h3>
                    <p class="mt-1 text-sm font-bold text-on-surface-variant" data-quick-add-price>₱0</p>
                </div>
                <button class="text-on-surface-variant transition-colors hover:text-white" type="button" aria-label="Close quick add" data-quick-add-close>
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="mb-6 flex items-center gap-4">
                <img class="h-24 w-24 rounded-lg object-cover" src="" alt="" data-quick-add-image>
                <p class="text-sm leading-relaxed text-on-surface-variant">
                    Choose a variation and quantity, then add this piece straight to your cart without leaving the page.
                </p>
            </div>

            <form method="POST" data-quick-add-form>
                @csrf
                <div class="mb-6">
                    <label class="mb-3 block text-[10px] font-black uppercase tracking-[0.25em] text-on-surface-variant">Select Size</label>
                    <div class="grid grid-cols-4 gap-3">
                        @foreach (['S', 'M', 'L', 'XL'] as $size)
                            <label>
                                <input class="peer sr-only" type="radio" name="size" value="{{ $size }}" {{ $size === 'M' ? 'checked' : '' }} data-quick-add-size>
                                <span class="flex items-center justify-center border border-outline-variant/30 py-3 text-sm font-bold transition-all peer-checked:border-2 peer-checked:border-primary-container peer-checked:bg-primary-container/5 peer-checked:text-primary-container hover:border-primary-container hover:text-primary-container">{{ $size }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-8">
                    <label class="mb-3 block text-[10px] font-black uppercase tracking-[0.25em] text-on-surface-variant">Quantity</label>
                    <div class="flex w-36 items-center justify-between border border-outline-variant/30 px-4 py-3">
                        <button class="material-symbols-outlined text-on-surface-variant transition-colors hover:text-primary-container disabled:cursor-not-allowed disabled:opacity-30" type="button" data-quick-add-decrease>remove</button>
                        <input class="w-10 border-0 bg-transparent p-0 text-center font-black text-white focus:ring-0" type="number" name="quantity" value="1" min="1" max="10" data-quick-add-quantity>
                        <button class="material-symbols-outlined text-on-surface-variant transition-colors hover:text-primary-container disabled:cursor-not-allowed disabled:opacity-30" type="button" data-quick-add-increase>add</button>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <button class="border border-outline-variant/30 px-4 py-4 text-[11px] font-black uppercase tracking-[0.2em] text-white transition-colors hover:border-primary-container hover:text-primary-container" type="button" data-quick-add-close>
                        Cancel
                    </button>
                    <button class="kinetic-gradient px-4 py-4 text-[11px] font-black uppercase tracking-[0.2em] text-on-primary-container transition-transform active:scale-95" type="submit">
                        Add to Cart
                    </button>
                </div>
            </form>
        </div>
    </div>

    <footer class="bg-black w-full border-t border-white/5">
        <div class="flex flex-col md:flex-row justify-between items-center px-10 py-12 gap-8 max-w-[1200px] mx-auto">
            <div class="flex flex-col items-center md:items-start gap-4">
                <div class="text-[#D9FF00] font-black text-xl italic tracking-tighter font-headline">THREADLAB</div>
                <p class="text-white/30 font-['Inter'] text-[10px] tracking-widest uppercase">&copy;2024 THREADLAB KINETIC EDITORIAL. ALL RIGHTS RESERVED.</p>
            </div>
            <div class="flex gap-8">
                <a class="text-white/30 font-['Inter'] text-[10px] tracking-widest uppercase hover:text-[#D9FF00] transition-colors" href="#">PRIVACY</a>
                <a class="text-white/30 font-['Inter'] text-[10px] tracking-widest uppercase hover:text-[#D9FF00] transition-colors" href="#">TERMS</a>
                <a class="text-white/30 font-['Inter'] text-[10px] tracking-widest uppercase hover:text-[#D9FF00] transition-colors" href="#">SHIPPING</a>
                <a class="text-white/30 font-['Inter'] text-[10px] tracking-widest uppercase hover:text-[#D9FF00] transition-colors" href="#">RETURNS</a>
            </div>
            <div class="flex gap-4">
                <div class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center hover:border-[#D9FF00] group transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-white/30 group-hover:text-[#D9FF00] text-sm">share</span>
                </div>
                <div class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center hover:border-[#D9FF00] group transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-white/30 group-hover:text-[#D9FF00] text-sm">language</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (() => {
            const productForm = document.querySelector('[data-product-form]');
            const quantityInput = document.querySelector('[data-quantity-input]');
            const decreaseButton = document.querySelector('[data-quantity-decrease]');
            const increaseButton = document.querySelector('[data-quantity-increase]');
            const sizeInputs = document.querySelectorAll('[data-size-input]');
            const sizeOptions = document.querySelectorAll('[data-size-option]');
            const selectedSizeLabel = document.querySelector('[data-selected-size]');
            const sizeGuideButton = document.querySelector('[data-open-size-guide]');
            const galleryTriggers = document.querySelectorAll('[data-gallery-trigger]');
            const mainImage = document.querySelector('[data-product-main-image]');
            const mainStage = document.querySelector('[data-product-main-stage]');
            const quickAddModal = document.querySelector('[data-quick-add-modal]');
            const quickAddTriggers = document.querySelectorAll('[data-quick-add-trigger]');
            const quickAddCloseButtons = document.querySelectorAll('[data-quick-add-close]');
            const quickAddForm = document.querySelector('[data-quick-add-form]');
            const quickAddName = document.querySelector('[data-quick-add-name]');
            const quickAddPrice = document.querySelector('[data-quick-add-price]');
            const quickAddImage = document.querySelector('[data-quick-add-image]');
            const quickAddQuantity = document.querySelector('[data-quick-add-quantity]');
            const quickAddDecrease = document.querySelector('[data-quick-add-decrease]');
            const quickAddIncrease = document.querySelector('[data-quick-add-increase]');

            if (quantityInput && decreaseButton && increaseButton) {
                const normalizeQuantity = (value) => {
                    const min = Number(quantityInput.min || 1);
                    const max = Number(quantityInput.max || 10);
                    const parsed = Number(value);

                    if (Number.isNaN(parsed)) {
                        return min;
                    }

                    return Math.min(max, Math.max(min, parsed));
                };

                const updateQuantityButtons = () => {
                    const min = Number(quantityInput.min || 1);
                    const max = Number(quantityInput.max || 10);
                    const current = normalizeQuantity(quantityInput.value);

                    decreaseButton.disabled = current <= min;
                    increaseButton.disabled = current >= max;
                };

                decreaseButton.addEventListener('click', () => {
                    quantityInput.value = normalizeQuantity(Number(quantityInput.value || 1) - 1);
                    updateQuantityButtons();
                });

                increaseButton.addEventListener('click', () => {
                    quantityInput.value = normalizeQuantity(Number(quantityInput.value || 1) + 1);
                    updateQuantityButtons();
                });

                quantityInput.addEventListener('input', () => {
                    quantityInput.value = quantityInput.value.replace(/[^0-9]/g, '');
                });

                quantityInput.addEventListener('change', () => {
                    quantityInput.value = normalizeQuantity(quantityInput.value);
                    updateQuantityButtons();
                });

                quantityInput.value = normalizeQuantity(quantityInput.value);
                updateQuantityButtons();
            }

            if (sizeInputs.length > 0) {
                const updateSelectedSize = () => {
                    const selectedInput = [...sizeInputs].find((input) => input.checked) || sizeInputs[0];
                    const selectedValue = selectedInput?.value ?? 'M';

                    if (selectedSizeLabel) {
                        selectedSizeLabel.textContent = selectedValue;
                    }

                    sizeOptions.forEach((option, index) => {
                        const isActive = sizeInputs[index]?.checked;
                        option.classList.toggle('border-2', Boolean(isActive));
                        option.classList.toggle('border-primary-container', Boolean(isActive));
                        option.classList.toggle('text-primary-container', Boolean(isActive));
                        option.classList.toggle('bg-primary-container/5', Boolean(isActive));
                        option.classList.toggle('border-outline-variant/30', !isActive);
                    });
                };

                sizeInputs.forEach((input) => {
                    input.addEventListener('change', updateSelectedSize);
                });

                updateSelectedSize();
            }

            if (mainImage && galleryTriggers.length > 0) {
                const setActiveGalleryImage = (trigger) => {
                    const nextImage = trigger.dataset.galleryImage;
                    const thumbnailImage = trigger.querySelector('img');

                    if (!nextImage || mainImage.src === nextImage) {
                        return;
                    }

                    mainImage.classList.add('opacity-0');
                    mainStage?.classList.add('translate-y-2', 'scale-[0.99]');

                    window.setTimeout(() => {
                        mainImage.src = nextImage;
                        mainImage.alt = thumbnailImage?.alt || mainImage.alt;
                        mainImage.classList.remove('opacity-0');
                        mainStage?.classList.remove('translate-y-2', 'scale-[0.99]');
                        mainStage?.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }, 180);

                    galleryTriggers.forEach((item) => {
                        const isActive = item === trigger;
                        item.classList.toggle('ring-2', isActive);
                        item.classList.toggle('ring-primary-container', isActive);
                        item.classList.toggle('opacity-100', isActive);
                        item.classList.toggle('opacity-60', !isActive);
                    });
                };

                galleryTriggers.forEach((trigger) => {
                    trigger.addEventListener('click', () => setActiveGalleryImage(trigger));
                });
            }

            productForm?.addEventListener('submit', () => {
                if (quantityInput) {
                    const min = Number(quantityInput.min || 1);
                    const max = Number(quantityInput.max || 10);
                    const quantity = Number(quantityInput.value || min);
                    quantityInput.value = Math.min(max, Math.max(min, quantity));
                }
            });

            sizeGuideButton?.addEventListener('click', () => {
                const sizingTab = document.querySelector('[data-tab-trigger="sizing"]');
                const sizingPanel = document.getElementById('product-sizing-guide');

                sizingTab?.click();
                sizingPanel?.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            });

            if (quickAddModal && quickAddForm && quickAddQuantity && quickAddDecrease && quickAddIncrease) {
                const normalizeQuickAddQuantity = (value) => {
                    const min = Number(quickAddQuantity.min || 1);
                    const max = Number(quickAddQuantity.max || 10);
                    const parsed = Number(value);

                    if (Number.isNaN(parsed)) {
                        return min;
                    }

                    return Math.min(max, Math.max(min, parsed));
                };

                const updateQuickAddButtons = () => {
                    const min = Number(quickAddQuantity.min || 1);
                    const max = Number(quickAddQuantity.max || 10);
                    const current = normalizeQuickAddQuantity(quickAddQuantity.value);

                    quickAddDecrease.disabled = current <= min;
                    quickAddIncrease.disabled = current >= max;
                };

                const openQuickAdd = (trigger) => {
                    const slug = trigger.dataset.productSlug;
                    const name = trigger.dataset.productName;
                    const price = trigger.dataset.productPrice;
                    const image = trigger.dataset.productImage;

                    quickAddForm.action = `/cart/add/${slug}`;
                    quickAddName.textContent = name;
                    quickAddPrice.textContent = `₱${price}`;
                    quickAddImage.src = image;
                    quickAddImage.alt = name;
                    quickAddQuantity.value = 1;
                    quickAddForm.querySelectorAll('[data-quick-add-size]').forEach((input) => {
                        input.checked = input.value === 'M';
                    });
                    updateQuickAddButtons();

                    quickAddModal.classList.remove('pointer-events-none', 'opacity-0');
                    quickAddModal.classList.add('opacity-100');
                    document.body.classList.add('overflow-hidden');
                };

                const closeQuickAdd = () => {
                    quickAddModal.classList.add('pointer-events-none', 'opacity-0');
                    quickAddModal.classList.remove('opacity-100');
                    document.body.classList.remove('overflow-hidden');
                };

                quickAddTriggers.forEach((trigger) => {
                    trigger.addEventListener('click', (event) => {
                        event.preventDefault();
                        event.stopPropagation();
                        openQuickAdd(trigger);
                    });
                });

                quickAddCloseButtons.forEach((button) => {
                    button.addEventListener('click', closeQuickAdd);
                });

                quickAddDecrease.addEventListener('click', () => {
                    quickAddQuantity.value = normalizeQuickAddQuantity(Number(quickAddQuantity.value || 1) - 1);
                    updateQuickAddButtons();
                });

                quickAddIncrease.addEventListener('click', () => {
                    quickAddQuantity.value = normalizeQuickAddQuantity(Number(quickAddQuantity.value || 1) + 1);
                    updateQuickAddButtons();
                });

                quickAddQuantity.addEventListener('input', () => {
                    quickAddQuantity.value = quickAddQuantity.value.replace(/[^0-9]/g, '');
                });

                quickAddQuantity.addEventListener('change', () => {
                    quickAddQuantity.value = normalizeQuickAddQuantity(quickAddQuantity.value);
                    updateQuickAddButtons();
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape' && !quickAddModal.classList.contains('pointer-events-none')) {
                        closeQuickAdd();
                    }
                });

                updateQuickAddButtons();
            }
        })();

        document.querySelectorAll('[data-product-tabs]').forEach((tabsRoot) => {
            const triggers = tabsRoot.querySelectorAll('[data-tab-trigger]');
            const panels = tabsRoot.querySelectorAll('[data-tab-panel]');

            const setActiveTab = (target) => {
                triggers.forEach((trigger) => {
                    const isActive = trigger.dataset.tabTrigger === target;
                    trigger.classList.toggle('text-primary-container', isActive);
                    trigger.classList.toggle('text-on-surface-variant', !isActive);
                    trigger.setAttribute('aria-pressed', isActive ? 'true' : 'false');
                });

                panels.forEach((panel) => {
                    panel.classList.toggle('hidden', panel.dataset.tabPanel !== target);
                });
            };

            triggers.forEach((trigger) => {
                trigger.addEventListener('click', () => setActiveTab(trigger.dataset.tabTrigger));
            });

            setActiveTab('description');
        });
    </script>
</body>
</html>
