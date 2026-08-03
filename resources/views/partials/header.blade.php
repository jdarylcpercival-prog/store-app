@php
    $isHome = request()->routeIs('home');
    $isShop = request()->routeIs('shop') || request()->routeIs('product.show');
    $currentCustomer = $headerCurrentCustomer ?? null;
    $cartItems = $headerCartItems ?? [];
    $cartCount = $headerCartCount ?? 0;
    $cartSubtotal = $headerCartSubtotal ?? 0;
    $accountRoute = $headerAccountRoute ?? route('customer.login');
@endphp

<nav class="fixed top-0 w-full z-50 bg-[#0e0e0e]/80 backdrop-blur-xl border-b border-[#484847]/20">
    <div class="mx-auto flex w-full max-w-[1200px] justify-between items-center px-8 py-6">
        <a href="{{ route('home') }}" class="text-3xl font-black italic tracking-tighter text-[#d5fb00] font-headline">THREADLAB</a>
        <div class="hidden md:flex gap-8 items-center">
            <a class="font-headline uppercase tracking-tighter font-black text-sm {{ $isHome ? 'text-[#d5fb00] border-b-2 border-[#d5fb00] pb-1' : 'text-white hover:text-[#d5fb00]' }} transition-colors duration-300" href="{{ route('home') }}">EDITORIAL</a>
            <a class="font-headline uppercase tracking-tighter font-black text-sm {{ $isShop ? 'text-[#d5fb00] border-b-2 border-[#d5fb00] pb-1' : 'text-white hover:text-[#d5fb00]' }} transition-colors duration-300" href="{{ route('shop') }}">SHOP</a>
            <a class="font-headline uppercase tracking-tighter font-black text-sm text-white hover:text-[#d5fb00] transition-colors duration-300" href="#">COLLECTIONS</a>
            <a class="font-headline uppercase tracking-tighter font-black text-sm text-white hover:text-[#d5fb00] transition-colors duration-300" href="{{ route('contact') }}">CONTACT</a>
        </div>
        <div class="flex items-center gap-6">
            <button class="scale-95 active:scale-90 transition-transform text-white hover:text-[#d5fb00]" type="button" aria-label="Search">
                <span class="material-symbols-outlined">search</span>
            </button>
            <div class="group relative">
                <a class="relative block scale-95 active:scale-90 transition-transform text-white hover:text-[#d5fb00]" href="{{ route('cart') }}" aria-label="Shopping bag">
                    <span class="material-symbols-outlined">shopping_bag</span>
                    @if ($cartCount > 0)
                        <span class="absolute -right-2 -top-2 flex h-4 min-w-4 items-center justify-center rounded-full bg-[#d5fb00] px-1 text-[9px] font-black leading-none text-[#4e5d00]">{{ $cartCount }}</span>
                    @endif
                </a>

                <div class="invisible absolute right-0 top-full z-[80] w-80 translate-y-4 opacity-0 transition-all duration-200 group-hover:visible group-hover:translate-y-3 group-hover:opacity-100">
                    <div class="border border-[#484847]/40 bg-[#131313]/95 p-4 shadow-[0_24px_60px_rgba(0,0,0,0.55)] backdrop-blur-xl">
                        <div class="mb-4 flex items-center justify-between border-b border-white/10 pb-3">
                            <span class="font-headline text-xs font-black uppercase tracking-widest text-[#d5fb00]">Cart Preview</span>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-white/40">{{ $cartCount }} {{ $cartCount === 1 ? 'Item' : 'Items' }}</span>
                        </div>

                        @if ($cartCount > 0)
                            <div class="max-h-72 space-y-3 overflow-y-auto">
                                @foreach ($cartItems as $item)
                                    <a class="grid grid-cols-[64px_1fr] gap-3 rounded bg-[#201f1f] p-2 transition-colors hover:bg-[#262626]" href="{{ route('product.show', $item['slug']) }}">
                                        <img class="h-16 w-16 object-cover grayscale" src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                                        <div class="min-w-0">
                                            <div class="truncate font-headline text-sm font-black uppercase tracking-tighter text-white">{{ $item['name'] }}</div>
                                            <div class="mt-1 text-[10px] font-bold uppercase tracking-widest text-white/40">Size {{ $item['size'] }} / Qty {{ $item['quantity'] }}</div>
                                            <div class="mt-2 text-sm font-black text-[#d5fb00]">&#8369;{{ number_format($item['price']) }}</div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            <div class="mt-4 flex items-center justify-between border-t border-white/10 pt-4">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-white/40">Subtotal</span>
                                <span class="font-headline text-xl font-black text-white">&#8369;{{ number_format($cartSubtotal) }}</span>
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-2">
                                <a class="bg-[#262626] px-4 py-3 text-center text-[10px] font-black uppercase tracking-widest text-white transition-colors hover:text-[#d5fb00]" href="{{ route('cart') }}">View Cart</a>
                                <a class="bg-[#d5fb00] px-4 py-3 text-center text-[10px] font-black uppercase tracking-widest text-[#4e5d00] transition-transform active:scale-95" href="{{ route('checkout') }}">Checkout</a>
                            </div>
                        @else
                            <div class="py-6 text-center">
                                <p class="font-headline text-lg font-black uppercase tracking-tighter text-white">Your cart is empty</p>
                                <p class="mt-2 text-xs text-white/40">Add a product to see it here.</p>
                                <a class="mt-5 inline-flex bg-[#d5fb00] px-5 py-3 text-[10px] font-black uppercase tracking-widest text-[#4e5d00]" href="{{ route('shop') }}">Shop Drops</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <a class="scale-95 active:scale-90 transition-transform text-white hover:text-[#d5fb00]" href="{{ $accountRoute }}" aria-label="Account">
                <span class="material-symbols-outlined">person</span>
            </a>
        </div>
    </div>
</nav>
