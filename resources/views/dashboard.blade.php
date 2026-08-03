<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KINETIC // CUSTOMER DASHBOARD</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,700;0,800;1,800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-surface": "#ffffff",
                        "surface-container-lowest": "#000000",
                        outline: "#777575",
                        "on-primary": "#556600",
                        "surface-tint": "#f5ffc4",
                        "on-error": "#450900",
                        "primary-container": "#d5fb00",
                        "on-tertiary": "#675600",
                        "tertiary-container": "#fedb42",
                        "on-surface-variant": "#adaaaa",
                        "inverse-surface": "#fcf8f8",
                        "secondary-fixed": "#c4d0ff",
                        "error-dim": "#d53d18",
                        "tertiary-fixed-dim": "#efcd34",
                        "on-error-container": "#ffd2c8",
                        "on-primary-fixed": "#3d4a00",
                        "on-secondary-fixed": "#002d80",
                        "secondary-fixed-dim": "#b0c2ff",
                        "inverse-primary": "#556600",
                        "on-primary-container": "#4e5d00",
                        primary: "#f5ffc4",
                        "surface-dim": "#0e0e0e",
                        "tertiary-fixed": "#fedb42",
                        "secondary-container": "#0053db",
                        "on-secondary-fixed-variant": "#0047bd",
                        surface: "#0e0e0e",
                        "error-container": "#b92902",
                        "on-primary-fixed-variant": "#576800",
                        "surface-bright": "#2c2c2c",
                        "on-secondary-container": "#f8f7ff",
                        "on-secondary": "#001b55",
                        "surface-container-highest": "#262626",
                        "on-background": "#ffffff",
                        "on-tertiary-fixed-variant": "#685700",
                        "primary-fixed-dim": "#c8ec00",
                        "surface-variant": "#262626",
                        "surface-container-low": "#131313",
                        "surface-container": "#1a1919",
                        "on-tertiary-container": "#5d4d00",
                        "primary-fixed": "#d5fb00",
                        "primary-dim": "#cbef00",
                        "on-tertiary-fixed": "#473b00",
                        secondary: "#7799ff",
                        error: "#ff7351",
                        "tertiary-dim": "#efcd34",
                        tertiary: "#ffeaa2",
                        "surface-container-high": "#201f1f",
                        background: "#0e0e0e",
                        "inverse-on-surface": "#565554",
                        "secondary-dim": "#316bf3",
                        "outline-variant": "#484847"
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

        .glass-panel {
            background: rgba(32, 31, 31, 0.6);
            backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body selection:bg-primary-container selection:text-on-primary-container">
    @include('partials.header')

    <div class="flex min-h-screen pt-24">
        <aside class="fixed left-0 top-24 hidden h-[calc(100vh-6rem)] w-64 z-40 bg-[#131313] shadow-[24px_0_48px_rgba(0,0,0,0.4)] flex-col pb-8 lg:flex">
            <div class="px-6 mb-10 pt-8">
                <div class="font-body font-bold tracking-widest text-[10px] uppercase text-[#d5fb00] mb-1">VIP STATUS</div>
                <div class="text-white font-headline font-extrabold italic text-lg leading-tight uppercase">
                    {{ count($orders) > 0 ? 'Collective Member' : 'New Registry Member' }}
                </div>
            </div>
            <nav class="flex-1 space-y-1">
                <a class="flex items-center gap-4 text-[#d5fb00] bg-[#201f1f] border-l-4 border-[#d5fb00] px-6 py-4 font-body font-bold tracking-widest text-xs uppercase transition-all duration-300 translate-x-1" href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined">grid_view</span>
                    <span>Dashboard</span>
                </a>
                <a class="flex items-center gap-4 text-white/40 hover:text-white px-6 py-4 font-body font-bold tracking-widest text-xs uppercase hover:bg-[#201f1f] transition-all" href="#">
                    <span class="material-symbols-outlined">package_2</span>
                    <span>Order History</span>
                </a>
                <a class="flex items-center gap-4 text-white/40 hover:text-white px-6 py-4 font-body font-bold tracking-widest text-xs uppercase hover:bg-[#201f1f] transition-all" href="#account-section">
                    <span class="material-symbols-outlined">person</span>
                    <span>Account</span>
                </a>
            </nav>
            <div class="mt-auto px-6 mb-8">
                <button class="w-full kinetic-gradient text-on-primary-container font-bold py-3 text-[10px] tracking-[0.2em] uppercase hover:opacity-90 transition-opacity" type="button">
                    Upgrade Status
                </button>
            </div>
            <div class="border-t border-white/5 pt-4 px-6 space-y-3">
                <a class="flex items-center gap-4 text-white/40 hover:text-white py-3 font-body font-bold tracking-widest text-xs uppercase transition-all" href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <span>Settings</span>
                </a>
                <form action="{{ route('customer.logout') }}" method="POST">
                    @csrf
                    <button class="flex w-full items-center gap-4 text-white/40 hover:text-error py-3 font-body font-bold tracking-widest text-xs uppercase transition-all" type="submit">
                        <span class="material-symbols-outlined">logout</span>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 bg-background p-6 pb-28 lg:ml-64 lg:p-10">
            <div class="mx-auto w-full max-w-[1200px]">
                @if (session('status'))
                    <div class="mb-8 border border-primary-container/30 bg-primary-container/10 px-5 py-4 text-sm font-semibold text-primary-container">
                        {{ session('status') }}
                    </div>
                @endif

                <header class="mb-12 flex flex-col gap-6 lg:flex-row lg:justify-between lg:items-end">
                    <div>
                        <h1 class="font-headline font-extrabold italic text-5xl lg:text-6xl text-white uppercase tracking-tighter mb-2">
                            Welcome Back, <span class="text-primary-container">{{ strtoupper(strtok($customer['full_name'], ' ')) }}</span>
                        </h1>
                        <p class="text-on-surface-variant font-body text-lg max-w-lg">
                            {{ $customer['email'] }} is signed in. Your rewards, order activity, and registry profile are synced to this session.
                        </p>
                    </div>
                    <div class="text-left lg:text-right">
                        <div class="text-on-surface-variant text-[10px] font-bold tracking-widest uppercase">Member Since</div>
                        <div class="text-white font-headline font-bold text-xl">{{ strtoupper($memberSince) }}</div>
                    </div>
                </header>

                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12">
                        <h2 class="font-headline font-extrabold italic text-3xl text-white uppercase tracking-tight">Recent Acquisitions</h2>
                    </div>

                    @forelse ($orders as $order)
                        @php
                            $firstItem = $order['items'][0];
                            $statusValue = strtolower($order['status'] ?? 'processing');
                            $statusLabel = match ($statusValue) {
                                'in_transit' => 'In Transit',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                default => 'Processing',
                            };
                            $statusClasses = match ($statusValue) {
                                'delivered' => 'text-white bg-white/10',
                                'shipped' => 'text-secondary bg-secondary/10',
                                'in_transit' => 'text-tertiary-container bg-tertiary-container/10',
                                default => 'text-primary-container bg-primary-container/10',
                            };
                        @endphp
                        <article class="col-span-12 md:col-span-6 bg-surface-container-low hover:bg-surface-container-high transition-colors p-6 flex gap-6 items-center">
                            <div class="w-32 h-32 flex-shrink-0 overflow-hidden bg-surface-container-highest">
                                <img alt="{{ $firstItem['name'] }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500" src="{{ $firstItem['image'] }}">
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start gap-4 mb-2">
                                    <h4 class="font-headline font-bold italic text-xl text-white uppercase">{{ $firstItem['name'] }}</h4>
                                    <span class="text-[10px] font-bold tracking-widest uppercase px-2 py-1 {{ $statusClasses }}">{{ $statusLabel }}</span>
                                </div>
                                <p class="text-on-surface-variant text-xs font-label mb-4">ORDER {{ $order['reference'] }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-white font-bold">{{ $order['total'] }}</span>
                                    <span class="text-white hover:text-primary-container font-label font-bold tracking-widest text-[10px] uppercase transition-colors">{{ strtoupper($order['created_at']) }}</span>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-12 rounded-lg bg-surface-container-low p-10 text-center">
                            <h3 class="font-headline text-3xl font-black uppercase tracking-tighter text-white">No orders yet</h3>
                            <p class="mt-3 text-on-surface-variant">Your dashboard will fill in with purchases, rewards, and order history after your first checkout.</p>
                            <a class="mt-8 inline-flex bg-primary-container px-8 py-4 font-black uppercase tracking-tighter text-on-primary-container" href="{{ route('shop') }}">Start Shopping</a>
                        </div>
                    @endforelse

                    <section class="col-span-12 mt-12 bg-surface-container-low overflow-hidden flex flex-col md:flex-row">
                        <div class="md:w-1/2 p-12 flex flex-col justify-center order-2 md:order-1">
                            <span class="text-secondary font-headline font-bold tracking-[0.3em] text-xs uppercase mb-4">Recommended Next Piece</span>
                            <h2 class="font-headline font-extrabold italic text-5xl text-white uppercase mb-6 leading-[0.9]">
                                {{ strtoupper($recommendedProduct['name']) }}
                            </h2>
                            <p class="text-on-surface-variant text-lg mb-8 max-w-md">
                                {{ $recommendedProduct['description'] }}
                            </p>
                            <div>
                                <a class="kinetic-gradient inline-flex text-on-primary-container font-extrabold px-10 py-5 text-sm tracking-[0.2em] uppercase transition-transform active:scale-95" href="{{ route('product.show', $recommendedSlug) }}">
                                    View Product
                                </a>
                            </div>
                        </div>
                        <div class="md:w-1/2 min-h-[400px] order-1 md:order-2">
                            <img alt="{{ $recommendedProduct['name'] }}" class="w-full h-full object-cover" src="{{ $recommendedProduct['image'] }}">
                        </div>
                    </section>

                    <section id="account-section" class="col-span-12 mt-12 bg-surface-container-low p-8 lg:p-10">
                        <div class="mb-10 flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
                            <div>
                                <h2 class="font-headline font-extrabold italic text-3xl text-white uppercase tracking-tight">Account Settings</h2>
                                <p class="mt-2 max-w-2xl text-on-surface-variant">
                                    Your checkout details sync here automatically. You can also update your registry name and default shipping address anytime.
                                </p>
                            </div>
                            <div class="text-left lg:text-right">
                                <div class="text-on-surface-variant text-[10px] font-bold tracking-widest uppercase">Default Shipping</div>
                                <div class="text-white font-headline font-bold text-lg">{{ strtoupper($shippingAddress['shipping_method'] ?? 'standard') }}</div>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="mb-8 border border-red-500/30 bg-red-500/10 px-5 py-4 text-sm font-semibold text-red-300">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form action="{{ route('dashboard.account.update') }}" method="POST" class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                            @csrf
                            <div class="space-y-3">
                                <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-on-surface-variant" for="full_name">Full Name</label>
                                <input id="full_name" name="full_name" type="text" value="{{ old('full_name', $customer['full_name']) }}" class="w-full bg-transparent border-0 border-b-2 border-outline-variant focus:border-primary-container focus:ring-0 px-0 py-4 text-lg font-bold uppercase text-white">
                            </div>
                            <div class="space-y-3">
                                <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-on-surface-variant" for="phone_dashboard">Phone Number</label>
                                <input id="phone_dashboard" name="phone" type="text" value="{{ old('phone', $shippingAddress['phone']) }}" class="w-full bg-transparent border-0 border-b-2 border-outline-variant focus:border-primary-container focus:ring-0 px-0 py-4 text-lg font-bold uppercase text-white">
                            </div>
                            <div class="space-y-3 lg:col-span-2">
                                <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-on-surface-variant" for="street_address_dashboard">Street Address</label>
                                <input id="street_address_dashboard" name="street_address" type="text" value="{{ old('street_address', $shippingAddress['street_address']) }}" class="w-full bg-transparent border-0 border-b-2 border-outline-variant focus:border-primary-container focus:ring-0 px-0 py-4 text-lg font-bold uppercase text-white">
                            </div>
                            <div class="space-y-3">
                                <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-on-surface-variant" for="city_dashboard">City</label>
                                <input id="city_dashboard" name="city" type="text" value="{{ old('city', $shippingAddress['city']) }}" class="w-full bg-transparent border-0 border-b-2 border-outline-variant focus:border-primary-container focus:ring-0 px-0 py-4 text-lg font-bold uppercase text-white">
                            </div>
                            <div class="space-y-3">
                                <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-on-surface-variant" for="zip_code_dashboard">Zip Code</label>
                                <input id="zip_code_dashboard" name="zip_code" type="text" value="{{ old('zip_code', $shippingAddress['zip_code']) }}" class="w-full bg-transparent border-0 border-b-2 border-outline-variant focus:border-primary-container focus:ring-0 px-0 py-4 text-lg font-bold uppercase text-white">
                            </div>
                            <div class="lg:col-span-2 flex flex-col gap-4 border-t border-white/5 pt-6 sm:flex-row sm:items-center sm:justify-between">
                                <p class="text-sm text-on-surface-variant">
                                    {{ $customer['email'] }}
                                </p>
                                <button type="submit" class="inline-flex justify-center kinetic-gradient px-8 py-4 text-[11px] font-black uppercase tracking-[0.2em] text-on-primary-container transition-transform active:scale-95">
                                    Save Account Details
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <nav class="lg:hidden fixed bottom-0 w-full z-50 bg-[#0e0e0e]/95 backdrop-blur-xl flex justify-around items-center h-20 px-4">
        <a class="flex flex-col items-center gap-1 text-[#d5fb00]" href="{{ route('dashboard') }}">
            <span class="material-symbols-outlined">grid_view</span>
            <span class="text-[8px] font-bold uppercase tracking-widest">Dashboard</span>
        </a>
        <a class="flex flex-col items-center gap-1 text-white/40" href="#">
            <span class="material-symbols-outlined">military_tech</span>
            <span class="text-[8px] font-bold uppercase tracking-widest">Tier</span>
        </a>
        <a class="flex flex-col items-center gap-1 text-white/40" href="#">
            <span class="material-symbols-outlined">hotel_class</span>
            <span class="text-[8px] font-bold uppercase tracking-widest">Rewards</span>
        </a>
        <a class="flex flex-col items-center gap-1 text-white/40" href="#">
            <span class="material-symbols-outlined">package_2</span>
            <span class="text-[8px] font-bold uppercase tracking-widest">Orders</span>
        </a>
        <form action="{{ route('customer.logout') }}" method="POST" class="flex flex-col items-center gap-1 text-white/40">
            @csrf
            <button type="submit" class="flex flex-col items-center gap-1">
                <span class="material-symbols-outlined">logout</span>
                <span class="text-[8px] font-bold uppercase tracking-widest">Logout</span>
            </button>
        </form>
    </nav>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
