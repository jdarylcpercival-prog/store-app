<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>THREADLAB | YOUR CART</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,700;0,800;1,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#D9FF00",
                        "on-primary": "#000000",
                        background: "#000000",
                        surface: "#111111",
                        "surface-container": "#1A1A1A",
                        "surface-variant": "#222222",
                        "on-surface": "#FFFFFF",
                        "on-surface-variant": "#A1A1A1"
                    },
                    borderRadius: {
                        DEFAULT: "0rem",
                        lg: "0rem",
                        xl: "0rem",
                        full: "9999px"
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans", "sans-serif"],
                        body: ["Plus Jakarta Sans", "sans-serif"],
                        label: ["Plus Jakarta Sans", "sans-serif"]
                    }
                }
            }
        };
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #000000;
            color: #FFFFFF;
        }

        h1, h2, h3, h4 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
        }

        .italic-headline {
            font-style: italic;
        }

        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .animate-marquee {
            display: inline-block;
            animation: marquee 20s linear infinite;
        }
    </style>
</head>
<body class="bg-background text-on-surface antialiased">
    @include('partials.header')

    <main class="max-w-[1200px] mx-auto px-6 pt-32 pb-24 min-h-screen">
        <header class="mb-20">
            <h1 class="text-7xl md:text-9xl font-extrabold tracking-tighter italic-headline uppercase mb-4 leading-none">Your Cart</h1>
            <p class="font-body text-primary uppercase tracking-[0.2em] text-xs font-bold">Atelier Selection / Vol. 24</p>
        </header>

        @if (session('status'))
            <div class="mb-10 border border-white/10 bg-surface px-6 py-5 text-sm font-bold uppercase tracking-[0.15em] text-primary">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-16">
            <div class="flex-grow space-y-16">
                @forelse ($cartItems as $item)
                    <div class="flex flex-col md:flex-row gap-8 items-start border-b border-white/10 pb-16">
                        <a class="w-full md:w-64 aspect-[3/4] bg-surface-container overflow-hidden" href="{{ route('product.show', $item['slug']) }}">
                            <img alt="{{ $item['name'] }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" src="{{ $item['image'] }}">
                        </a>

                        <div class="flex-grow py-2 flex flex-col justify-between min-h-64 w-full">
                            <div class="flex justify-between items-start gap-6">
                                <div>
                                    <a class="inline-block" href="{{ route('product.show', $item['slug']) }}">
                                        <h3 class="text-3xl font-extrabold tracking-tighter uppercase italic-headline transition-colors hover:text-primary">{{ $item['name'] }}</h3>
                                    </a>
                                    <p class="text-zinc-500 text-sm mt-2 uppercase font-bold tracking-widest">
                                        {{ str_contains($item['slug'], 'tee') ? 'Size: ' . $item['size'] : 'Variant: ' . $item['size'] }}
                                    </p>
                                    <a class="inline-block text-zinc-700 text-xs mt-3 uppercase font-bold tracking-[0.2em] transition-colors hover:text-primary" href="{{ route('product.show', $item['slug']) }}">SKU {{ $item['sku'] }}</a>
                                </div>
                                <span class="font-extrabold text-2xl text-primary tracking-tighter italic-headline">&#8369;{{ number_format($item['price']) }}</span>
                            </div>

                            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mt-8">
                                <div class="flex items-center border border-white/20 p-1">
                                    <form action="{{ route('cart.update', $item['key']) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="decrease">
                                        <button class="w-10 h-10 flex items-center justify-center hover:bg-white/10 transition-colors" type="submit" aria-label="Decrease quantity">
                                            <span class="material-symbols-outlined text-sm">remove</span>
                                        </button>
                                    </form>
                                    <span class="px-6 font-bold text-lg">{{ $item['quantity'] }}</span>
                                    <form action="{{ route('cart.update', $item['key']) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="increase">
                                        <button class="w-10 h-10 flex items-center justify-center hover:bg-white/10 transition-colors" type="submit" aria-label="Increase quantity">
                                            <span class="material-symbols-outlined text-sm">add</span>
                                        </button>
                                    </form>
                                </div>

                                <form action="{{ route('cart.remove', $item['key']) }}" method="POST">
                                    @csrf
                                    <button class="text-xs font-bold uppercase tracking-widest text-zinc-500 hover:text-white transition-colors underline underline-offset-8 decoration-primary" type="submit">
                                        Remove Item
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="border border-white/10 bg-surface p-12 text-center">
                        <h2 class="text-4xl font-extrabold tracking-tighter uppercase italic-headline">Your cart is empty</h2>
                        <p class="mt-4 text-sm font-bold uppercase tracking-[0.18em] text-zinc-500">Build your next THREADLAB selection from the latest drop.</p>
                        <a class="mt-10 inline-flex bg-primary px-10 py-5 text-xs font-extrabold uppercase tracking-[0.2em] text-black transition-all hover:scale-[1.02]" href="{{ route('shop') }}">
                            Return to Shop
                        </a>
                    </div>
                @endforelse
            </div>

            <aside class="lg:w-96">
                <div class="sticky top-32 bg-surface p-10 border border-white/10">
                    <h2 class="text-3xl font-extrabold tracking-tighter uppercase italic-headline mb-10">Summary</h2>
                    <div class="space-y-6 font-body text-sm uppercase tracking-[0.15em]">
                        <div class="flex justify-between">
                            <span class="text-zinc-500 font-bold">Subtotal</span>
                            <span class="font-extrabold text-white">&#8369;{{ number_format($subtotal) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-zinc-500 font-bold">Shipping</span>
                            <span class="font-extrabold text-white">&#8369;{{ number_format($shipping) }}</span>
                        </div>
                        <div class="flex justify-between pt-6 border-t border-white/10">
                            <span class="font-extrabold text-lg">Total</span>
                            <span class="font-extrabold text-3xl tracking-tighter text-primary italic-headline">&#8369;{{ number_format($total) }}</span>
                        </div>
                    </div>

                    <div class="mt-12 space-y-4">
                        @if (count($cartItems) > 0)
                            <a class="block w-full bg-primary text-center text-black font-extrabold py-6 uppercase tracking-[0.2em] text-xs transition-all hover:scale-[1.02] active:scale-95 duration-300 shadow-[0_0_20px_rgba(217,255,0,0.3)]" href="{{ route('checkout') }}">
                                Proceed to Checkout
                            </a>
                        @endif
                        <p class="text-[9px] text-center text-zinc-500 uppercase font-bold tracking-[0.2em] mt-6">
                            Tax included. Shipping calculated at checkout.
                        </p>
                    </div>

                    <div class="mt-10 pt-10 border-t border-white/10 flex items-start gap-4">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">verified</span>
                        <p class="text-[10px] font-bold text-zinc-400 leading-relaxed uppercase tracking-widest">
                            Exclusive Atelier Guarantee. Limited production runs ensuring rarity.
                        </p>
                    </div>
                </div>
            </aside>
        </div>

        <div class="mt-40 overflow-hidden whitespace-nowrap bg-primary py-6 -mx-6 -rotate-1">
            <div class="inline-block animate-marquee">
                <span class="text-black text-5xl font-extrabold tracking-tighter italic uppercase mx-8">New Archive Drop 2024 - Worldwide Shipping - ThreadLab Atelier - Hand-Finished Details - Kinetic Editorial -</span>
                <span class="text-black text-5xl font-extrabold tracking-tighter italic uppercase mx-8">New Archive Drop 2024 - Worldwide Shipping - ThreadLab Atelier - Hand-Finished Details - Kinetic Editorial -</span>
            </div>
        </div>
    </main>

    <footer class="bg-black w-full py-24 px-8 border-t border-white/10">
        <div class="max-w-[1200px] mx-auto flex flex-col md:flex-row justify-between items-center gap-12">
            <div class="flex flex-col items-center md:items-start">
                <span class="text-2xl font-extrabold text-white mb-4 tracking-tighter italic-headline">THREADLAB</span>
                <p class="font-bold text-[10px] tracking-[0.3em] uppercase text-zinc-600">&copy; 2024 THREADLAB ATELIER. PRODUCED IN LIMITED QUANTITIES.</p>
            </div>
            <div class="flex flex-wrap justify-center gap-x-12 gap-y-6">
                <a class="text-[10px] tracking-[0.3em] font-bold uppercase text-zinc-500 hover:text-primary transition-all duration-300" href="#">PRIVACY</a>
                <a class="text-[10px] tracking-[0.3em] font-bold uppercase text-zinc-500 hover:text-primary transition-all duration-300" href="#">TERMS</a>
                <a class="text-[10px] tracking-[0.3em] font-bold uppercase text-zinc-500 hover:text-primary transition-all duration-300" href="#">SHIPPING</a>
                <a class="text-[10px] tracking-[0.3em] font-bold uppercase text-zinc-500 hover:text-primary transition-all duration-300" href="#">RETURNS</a>
                <a class="text-[10px] tracking-[0.3em] font-bold uppercase text-zinc-500 hover:text-primary transition-all duration-300" href="{{ route('contact') }}">CONTACT</a>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
