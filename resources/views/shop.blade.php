<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>THREADLAB | SHOP COLLECTION</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "secondary-fixed": "#c4d0ff",
                        "outline-variant": "#484847",
                        "on-secondary-container": "#f8f7ff",
                        "on-primary-container": "#4e5d00",
                        "on-primary": "#556600",
                        "secondary-fixed-dim": "#b0c2ff",
                        "surface-dim": "#0e0e0e",
                        "tertiary-container": "#fedb42",
                        "on-surface": "#ffffff",
                        "error-dim": "#d53d18",
                        "surface-container-high": "#201f1f",
                        "tertiary": "#ffeaa2",
                        "on-background": "#ffffff",
                        "primary-container": "#d5fb00",
                        "on-error-container": "#ffd2c8",
                        "surface-bright": "#2c2c2c",
                        "surface": "#0e0e0e",
                        "on-secondary-fixed-variant": "#0047bd",
                        "primary-fixed-dim": "#c8ec00",
                        "surface-container-low": "#131313",
                        "surface-container": "#1a1919",
                        "on-tertiary-fixed": "#473b00",
                        "background": "#0e0e0e",
                        "primary": "#f5ffc4",
                        "tertiary-dim": "#efcd34",
                        "inverse-on-surface": "#565554",
                        "surface-container-lowest": "#000000",
                        "primary-dim": "#cbef00",
                        "surface-variant": "#262626",
                        "on-secondary-fixed": "#002d80",
                        "surface-tint": "#f5ffc4",
                        "surface-container-highest": "#262626",
                        "tertiary-fixed": "#fedb42",
                        "on-secondary": "#001b55",
                        "inverse-surface": "#fcf8f8",
                        "error": "#ff7351",
                        "on-primary-fixed-variant": "#576800",
                        "on-primary-fixed": "#3d4a00",
                        "error-container": "#b92902",
                        "on-error": "#450900",
                        "on-tertiary-fixed-variant": "#685700",
                        "inverse-primary": "#556600",
                        "tertiary-fixed-dim": "#efcd34",
                        "primary-fixed": "#d5fb00",
                        "secondary-dim": "#316bf3",
                        "on-tertiary-container": "#5d4d00",
                        "secondary": "#7799ff",
                        "on-surface-variant": "#adaaaa",
                        "secondary-container": "#0053db",
                        "outline": "#777575",
                        "on-tertiary": "#675600"
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

        .glass-gradient {
            background: linear-gradient(135deg, #f5ffc4 0%, #d5fb00 100%);
        }

        body {
            background-color: #0e0e0e;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
        }

        .shop-transition-target {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 220ms ease, transform 220ms ease;
        }

        .shop-transition-target.is-transitioning {
            opacity: 0;
            transform: translateY(10px);
        }
    </style>
</head>
<body class="bg-background text-on-background">
    @php
        $sortOptions = [
            'newest' => 'Newest First',
            'price-low' => 'Price: Low to High',
            'price-high' => 'Price: High to Low',
        ];

        $categoryOptions = [
            'all' => 'All',
            'basic' => 'Basic',
            'oversized' => 'Oversized',
            'minimal' => 'Minimal',
        ];
    @endphp

    @include('partials.header')

    <main class="pt-24 pb-12">
        <header class="px-6 py-16 md:py-24 max-w-[1200px] mx-auto">
            <div class="relative inline-block mb-4">
                <h1 class="text-6xl md:text-8xl font-black font-headline uppercase tracking-tighter leading-none">
                    Shop <span class="text-primary-container italic">Collection</span>
                </h1>
                <div class="absolute -right-8 -top-4 bg-secondary px-3 py-1 rounded-full text-black text-[10px] font-bold tracking-widest uppercase">KINETIC EDITORIAL</div>
            </div>
            <p class="text-on-surface-variant text-lg md:text-xl font-body max-w-2xl mt-6">
                Explore our curated line of premium t-shirts. Engineered for the high-velocity urban lifestyle.
            </p>
        </header>

        <section class="sticky top-16 z-40 bg-surface/90 backdrop-blur-md px-6 py-6 border-y border-outline-variant/10">
            <div class="max-w-[1200px] mx-auto flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="flex flex-wrap gap-3">
                    @foreach ($categoryOptions as $categoryValue => $categoryLabel)
                        <a
                            class="px-6 py-2 rounded-full font-bold text-xs uppercase tracking-widest transition-all duration-200 {{ $selectedCategory === $categoryValue ? 'bg-primary-container text-on-primary-container' : 'bg-surface-container-high text-white hover:text-primary-container hover:-translate-y-0.5' }}"
                            href="{{ route('shop', ['category' => $categoryValue, 'sort' => $selectedSort]) }}"
                            data-shop-filter-link
                        >
                            {{ $categoryLabel }}
                        </a>
                    @endforeach
                </div>

                <form action="{{ route('shop') }}" method="GET" class="flex items-center gap-4 bg-surface-container-low px-4 py-2 rounded-lg" data-shop-sort-form>
                    <input type="hidden" name="category" value="{{ $selectedCategory }}">
                    <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">Sort By:</span>
                    <select
                        name="sort"
                        onchange="this.form.submit()"
                        class="bg-surface-container-low border-none text-xs font-bold uppercase tracking-widest text-white focus:ring-0 cursor-pointer"
                    >
                        @foreach ($sortOptions as $sortValue => $sortLabel)
                            <option class="bg-surface-container-low text-white" value="{{ $sortValue }}" @selected($selectedSort === $sortValue)>{{ $sortLabel }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </section>

        <section class="px-6 py-16 max-w-[1200px] mx-auto">
            <div class="mb-8 flex items-center justify-between gap-4">
                <p class="text-sm uppercase tracking-[0.25em] text-on-surface-variant font-bold">
                    {{ $products->count() }} {{ $products->count() === 1 ? 'Product' : 'Products' }}
                </p>
                <p class="text-sm uppercase tracking-[0.25em] text-on-surface-variant font-bold text-right">
                    {{ $sortOptions[$selectedSort] }}
                </p>
            </div>

            <div class="shop-transition-target" data-shop-transition-target>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-16">
                @forelse ($products as $index => $product)
                    @if ($product['slug'] === 'minimal-logo-tee')
                        <article class="group relative bg-surface-container-low rounded-xl overflow-hidden lg:col-span-2">
                            <div class="aspect-[16/9] lg:aspect-auto lg:h-full w-full overflow-hidden flex flex-col md:flex-row">
                                <a class="block w-full md:w-1/2 overflow-hidden h-64 md:h-full" href="{{ route('product.show', $product['slug']) }}">
                                    <img class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700" alt="{{ $product['name'] }}" src="{{ $product['image'] }}">
                                </a>
                                <div class="w-full md:w-1/2 p-8 flex flex-col justify-center bg-surface-container-high relative">
                                    <div class="mb-8">
                                        <h3 class="font-headline font-black text-4xl uppercase tracking-tighter mb-4">{{ $product['name'] }}</h3>
                                        <p class="text-on-surface-variant font-body mb-6">{{ $product['description'] }}</p>
                                        <span class="text-2xl font-bold text-primary-container">&#8369;{{ number_format($product['price']) }}</span>
                                    </div>
                                    <a class="w-full py-4 bg-primary-container text-center text-on-primary-container font-black uppercase tracking-tighter hover:scale-95 transition-transform" href="{{ route('product.show', $product['slug']) }}">View Product</a>
                                </div>
                            </div>
                        </article>
                    @else
                        <article class="group relative bg-surface-container-low rounded-xl overflow-hidden {{ $product['slug'] === 'oversized-street-tee' ? 'md:col-span-2 lg:col-span-1' : '' }}">
                            <a class="block aspect-[3/4] w-full overflow-hidden" href="{{ route('product.show', $product['slug']) }}">
                                <img class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700" alt="{{ $product['name'] }}" src="{{ $product['image'] }}">
                                @if ($product['tag'] === 'Limited Drop')
                                    <div class="absolute top-4 left-4 bg-primary-container px-3 py-1 text-on-primary-container text-[10px] font-black uppercase tracking-widest">{{ strtoupper($product['tag']) }}</div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
                                    <span class="w-full glass-gradient py-4 rounded-xl text-center text-on-primary-container font-black uppercase tracking-tighter transform translate-y-4 group-hover:translate-y-0 transition-transform">View Product</span>
                                </div>
                            </a>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2 gap-4">
                                    <h3 class="font-headline font-bold text-xl uppercase tracking-tighter">{{ $product['name'] }}</h3>
                                    <span class="font-body font-bold text-primary-container">&#8369;{{ number_format($product['price']) }}</span>
                                </div>
                                <span class="text-[10px] text-on-surface-variant font-bold tracking-widest uppercase">SKU: {{ $product['sku'] }}</span>
                            </div>
                        </article>
                    @endif
                @empty
                    <div class="col-span-full rounded-xl bg-surface-container-low p-10 text-center">
                        <h2 class="font-headline text-3xl font-black uppercase tracking-tighter text-white">No products found</h2>
                        <p class="mt-3 text-on-surface-variant">Try a different category or sort setting.</p>
                        <a class="mt-8 inline-flex rounded-lg bg-primary-container px-8 py-4 font-black uppercase tracking-tighter text-on-primary-container" href="{{ route('shop') }}">Reset Shop View</a>
                    </div>
                @endforelse
                </div>
            </div>
        </section>

        <section class="mt-12 py-12 bg-surface-container-low border-y border-outline-variant/10">
            <div class="max-w-[1200px] mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="flex items-center gap-6 group">
                    <div class="w-12 h-12 flex items-center justify-center bg-surface-container-high rounded-lg text-primary-container group-hover:bg-primary-container group-hover:text-black transition-colors">
                        <span class="material-symbols-outlined">local_shipping</span>
                    </div>
                    <div>
                        <h4 class="font-headline font-bold uppercase tracking-widest text-sm">Free Shipping</h4>
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mt-1">Nationwide Delivery</p>
                    </div>
                </div>
                <div class="flex items-center gap-6 group">
                    <div class="w-12 h-12 flex items-center justify-center bg-surface-container-high rounded-lg text-primary-container group-hover:bg-primary-container group-hover:text-black transition-colors">
                        <span class="material-symbols-outlined">verified</span>
                    </div>
                    <div>
                        <h4 class="font-headline font-bold uppercase tracking-widest text-sm">Premium Quality</h4>
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mt-1">Ethically Sourced Fabric</p>
                    </div>
                </div>
                <div class="flex items-center gap-6 group">
                    <div class="w-12 h-12 flex items-center justify-center bg-surface-container-high rounded-lg text-primary-container group-hover:bg-primary-container group-hover:text-black transition-colors">
                        <span class="material-symbols-outlined">undo</span>
                    </div>
                    <div>
                        <h4 class="font-headline font-bold uppercase tracking-widest text-sm">Easy Returns</h4>
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mt-1">30-Day Policy</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="px-6 py-24 max-w-4xl mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-black font-headline uppercase tracking-tighter mb-4">Stay Updated with <span class="text-primary-container">THREADLAB</span></h2>
            <p class="text-on-surface-variant font-body text-lg mb-12">Get exclusive drops and offers straight to your inbox.</p>
            <form class="flex flex-col md:flex-row gap-4 max-w-xl mx-auto">
                <input class="flex-grow bg-surface-container-highest border-none py-4 px-6 text-xs font-bold tracking-widest uppercase focus:ring-2 focus:ring-secondary text-white rounded-lg" placeholder="ENTER YOUR EMAIL" type="email">
                <button class="glass-gradient px-12 py-4 text-on-primary-container font-black uppercase tracking-tighter rounded-lg hover:scale-95 transition-transform" type="submit">Subscribe</button>
            </form>
        </section>
    </main>

    <footer class="w-full border-t border-[#484847]/20 bg-[#0e0e0e]">
        <div class="mx-auto flex w-full max-w-[1200px] flex-col md:flex-row justify-between items-center px-6 py-12 gap-8">
            <div class="flex flex-col items-center md:items-start gap-4">
                <span class="text-lg font-bold text-white uppercase font-headline">THREADLAB</span>
                <p class="text-white/40 font-['Inter'] text-[10px] tracking-widest uppercase">&copy;2024 THREADLAB KINETIC EDITORIAL. ALL RIGHTS RESERVED.</p>
            </div>
            <div class="flex flex-wrap justify-center gap-8">
                <a class="text-white/40 hover:text-[#7799ff] transition-all duration-200 font-['Inter'] text-[10px] tracking-widest uppercase" href="#">PRIVACY</a>
                <a class="text-white/40 hover:text-[#7799ff] transition-all duration-200 font-['Inter'] text-[10px] tracking-widest uppercase" href="#">TERMS</a>
                <a class="text-white/40 hover:text-[#7799ff] transition-all duration-200 font-['Inter'] text-[10px] tracking-widest uppercase" href="#">SHIPPING</a>
                <a class="text-white/40 hover:text-[#7799ff] transition-all duration-200 font-['Inter'] text-[10px] tracking-widest uppercase" href="{{ route('contact') }}">CONTACT</a>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (() => {
            const transitionTarget = document.querySelector('[data-shop-transition-target]');
            const filterLinks = document.querySelectorAll('[data-shop-filter-link]');
            const sortForm = document.querySelector('[data-shop-sort-form]');

            if (!transitionTarget) {
                return;
            }

            const beginTransition = (callback) => {
                transitionTarget.classList.add('is-transitioning');
                window.setTimeout(callback, 180);
            };

            filterLinks.forEach((link) => {
                link.addEventListener('click', (event) => {
                    if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                        return;
                    }

                    event.preventDefault();
                    const href = link.getAttribute('href');
                    beginTransition(() => {
                        window.location.href = href;
                    });
                });
            });

            if (sortForm) {
                sortForm.addEventListener('submit', (event) => {
                    event.preventDefault();
                    beginTransition(() => {
                        sortForm.submit();
                    });
                });
            }
        })();
    </script>
</body>
</html>
