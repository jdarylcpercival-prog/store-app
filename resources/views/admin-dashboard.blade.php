<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>VOLT_ADMIN | KINETIC_CORE</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,700;0,800;1,800&family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-container-lowest": "#000000",
                        "on-surface-variant": "#adaaaa",
                        "on-primary-fixed-variant": "#576800",
                        "tertiary-fixed": "#fedb42",
                        "on-secondary-container": "#f8f7ff",
                        "surface-bright": "#2c2c2c",
                        "secondary-container": "#0053db",
                        "on-secondary-fixed-variant": "#0047bd",
                        "primary-fixed-dim": "#c8ec00",
                        "on-tertiary-fixed": "#473b00",
                        "on-tertiary-fixed-variant": "#685700",
                        "on-secondary": "#001b55",
                        "on-primary": "#556600",
                        "surface-variant": "#262626",
                        "tertiary-fixed-dim": "#efcd34",
                        "surface-container-high": "#201f1f",
                        "error-container": "#b92902",
                        "primary-dim": "#cbef00",
                        "secondary-fixed-dim": "#b0c2ff",
                        "surface-container-highest": "#262626",
                        background: "#0e0e0e",
                        "error-dim": "#d53d18",
                        secondary: "#7799ff",
                        "surface-container": "#1a1919",
                        "secondary-fixed": "#c4d0ff",
                        "on-surface": "#ffffff",
                        error: "#ff7351",
                        "primary-fixed": "#d5fb00",
                        "surface-dim": "#0e0e0e",
                        surface: "#0e0e0e",
                        "on-primary-container": "#4e5d00",
                        "surface-container-low": "#131313",
                        "surface-tint": "#f5ffc4",
                        "on-tertiary": "#675600",
                        "inverse-primary": "#556600",
                        "outline-variant": "#484847",
                        "on-error": "#450900",
                        "on-primary-fixed": "#3d4a00",
                        "on-background": "#ffffff",
                        "inverse-surface": "#fcf8f8",
                        "on-secondary-fixed": "#002d80",
                        "tertiary-container": "#fedb42",
                        "primary-container": "#d5fb00",
                        tertiary: "#ffeaa2",
                        "on-tertiary-container": "#5d4d00",
                        primary: "#f5ffc4",
                        outline: "#777575",
                        "tertiary-dim": "#efcd34",
                        "secondary-dim": "#316bf3",
                        "on-error-container": "#ffd2c8"
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

        body {
            font-family: 'Inter', sans-serif;
        }

        .editorial-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1.5rem;
        }

        .bento-card {
            background: #131313;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .bento-card:hover {
            background: #201f1f;
        }
    </style>
</head>
<body class="bg-background text-on-background selection:bg-primary-container selection:text-on-primary-container">
    @php
        $adminInitials = collect(explode(' ', $admin['full_name']))
            ->filter()
            ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
            ->take(2)
            ->implode('');

        $sourceData = [
            ['ORDERS_PENDING', $totalOrders > 0 ? round(($pendingOrders / max($totalOrders, 1)) * 100) . '%' : '0%', 'bg-primary-container', 'text-white'],
            ['ORDERS_COMPLETE', $totalOrders > 0 ? round(($completedOrders / max($totalOrders, 1)) * 100) . '%' : '0%', 'bg-secondary', 'text-secondary'],
            ['CUSTOMER_BASE', $customerCount > 0 ? '100%' : '0%', 'bg-on-surface-variant', 'text-on-surface-variant'],
        ];
    @endphp

    <header class="fixed top-0 w-full z-50 bg-[#0e0e0e]/80 backdrop-blur-xl border-b border-[#484847]/20 flex justify-between items-center h-16 px-6 font-headline tracking-tight">
        <div class="text-2xl font-black italic text-[#d5fb00] uppercase">VOLT_ADMIN</div>
        <div class="flex items-center gap-6">
            <div class="hidden md:flex gap-8">
                <span class="text-[#d5fb00] font-bold cursor-pointer active:scale-95 transition-transform">SYSTEM_STATUS</span>
                <span class="text-white/70 hover:text-[#d5fb00] transition-colors duration-300 cursor-pointer active:scale-95">LOGS</span>
                <span class="text-white/70 hover:text-[#d5fb00] transition-colors duration-300 cursor-pointer active:scale-95">REPORTS</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-white/70 hover:text-[#d5fb00] cursor-pointer">notifications</span>
                <span class="material-symbols-outlined text-white/70 hover:text-[#d5fb00] cursor-pointer">settings</span>
                <div class="flex h-8 w-8 items-center justify-center rounded-full border border-primary-container/20 bg-surface-container-high text-xs font-black uppercase text-primary-container">
                    {{ $adminInitials !== '' ? $adminInitials : 'AD' }}
                </div>
            </div>
        </div>
    </header>

    <aside class="fixed left-0 top-0 h-full w-64 z-[60] bg-[#131313] shadow-[0px_24px_48px_rgba(0,0,0,0.4)] flex-col pt-20 pb-8 hidden lg:flex">
        <div class="px-6 mb-10">
            <div class="flex items-center gap-3">
                <div class="w-2 h-8 bg-primary-container"></div>
                <div>
                    <div class="text-[#d5fb00] font-black uppercase tracking-widest text-[12px]">KINETIC_CORE</div>
                    <div class="text-white/30 text-[10px] font-bold">{{ now()->format('Y.m.d') }} LIVE</div>
                </div>
            </div>
        </div>
        <nav class="flex-1 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="block text-[#d5fb00] border-l-4 border-[#d5fb00] bg-[#201f1f] py-4 px-6 mb-2 uppercase tracking-widest text-[10px] font-bold">
                <span class="flex items-center gap-4">
                    <span class="material-symbols-outlined">dashboard</span>
                    Dashboard
                </span>
            </a>
            <a href="{{ route('admin.analytics') }}" class="block text-white/40 py-4 px-6 mb-2 hover:bg-[#201f1f] hover:text-white transition-all uppercase tracking-widest text-[10px] font-bold">
                <span class="flex items-center gap-4">
                    <span class="material-symbols-outlined">monitoring</span>
                    Analytics
                </span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="block text-white/40 py-4 px-6 mb-2 hover:bg-[#201f1f] hover:text-white transition-all uppercase tracking-widest text-[10px] font-bold">
                <span class="flex items-center gap-4">
                    <span class="material-symbols-outlined">inventory_2</span>
                    Inventory
                </span>
            </a>
            <a href="{{ route('admin.transactions') }}" class="block text-white/40 py-4 px-6 mb-2 hover:bg-[#201f1f] hover:text-white transition-all uppercase tracking-widest text-[10px] font-bold">
                <span class="flex items-center gap-4">
                    <span class="material-symbols-outlined">payments</span>
                    Transactions
                </span>
            </a>
            <a href="{{ route('admin.system-logs') }}" class="block text-white/40 py-4 px-6 mb-2 hover:bg-[#201f1f] hover:text-white transition-all uppercase tracking-widest text-[10px] font-bold">
                <span class="flex items-center gap-4">
                    <span class="material-symbols-outlined">terminal</span>
                    System Logs
                </span>
            </a>
        </nav>
        <div class="px-6 mb-8">
            <button class="w-full py-3 bg-primary-container text-on-primary-container font-black text-[10px] tracking-tighter uppercase active:scale-95 transition-transform" type="button">
                Deploy Update
            </button>
        </div>
        <div class="px-6 space-y-4">
            <div class="flex items-center gap-4 text-white/40 text-[10px] font-bold tracking-widest uppercase hover:text-white cursor-pointer">
                <span class="material-symbols-outlined">help</span>
                Support
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button class="flex items-center gap-4 text-white/40 text-[10px] font-bold tracking-widest uppercase hover:text-error cursor-pointer" type="submit">
                    <span class="material-symbols-outlined">logout</span>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="lg:ml-64 pt-24 px-6 pb-24">
        <div class="mx-auto w-full max-w-[1200px]">
            @if (session('status'))
                <div class="mb-8 border border-primary-container/30 bg-primary-container/10 px-5 py-4 text-sm font-semibold text-primary-container">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-8 border border-red-500/30 bg-red-500/10 px-5 py-4 text-sm font-semibold text-red-300">
                    {{ $errors->first() }}
                </div>
            @endif

            <section class="mb-12 editorial-grid">
                <div class="col-span-12 lg:col-span-8">
                    <h1 class="font-headline font-extrabold text-7xl md:text-8xl tracking-tighter leading-none mb-4 italic uppercase">
                        SYSTEM <span class="text-primary-container">OVERVIEW</span>
                    </h1>
                    <p class="font-body text-on-surface-variant max-w-xl text-lg">
                        Real-time transaction matrix and operational velocity across <span class="text-primary-container">{{ $customerCount }}</span> customer {{ \Illuminate\Support\Str::plural('account', $customerCount) }}. Completion rate currently sits at <span class="text-primary-container">{{ $completionRate }}%</span>.
                    </p>
                </div>
                <div class="col-span-12 lg:col-span-4 flex items-end justify-end">
                    <div class="bg-surface-container-high p-6 rounded-xl border-l-2 border-primary-container">
                        <div class="text-on-surface-variant font-bold tracking-widest mb-1 uppercase text-xs">Live Node</div>
                        <div class="text-2xl font-headline font-bold">{{ $liveNode }}</div>
                    </div>
                </div>
            </section>

            <section class="editorial-grid mb-12">
                <div class="col-span-12 md:col-span-6 lg:col-span-3 bento-card p-8 group overflow-hidden relative">
                    <div class="relative z-10">
                        <div class="text-primary-container font-black mb-2 text-xs tracking-[0.2em] uppercase">Total Orders</div>
                        <div class="font-headline font-black italic text-4xl">{{ number_format($totalOrders) }}</div>
                        <div class="mt-4 flex items-center gap-2 text-primary/60 text-xs font-bold">
                            <span class="material-symbols-outlined text-sm">trending_up</span>
                            {{ $customerCount }} ACTIVE CUSTOMERS
                        </div>
                    </div>
                    <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity">
                        <span class="material-symbols-outlined text-[120px]">shopping_cart</span>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3 bento-card p-8 group relative overflow-hidden bg-gradient-to-br from-surface-container-low to-surface-container-high border-t-4 border-secondary">
                    <div class="relative z-10">
                        <div class="text-secondary font-black mb-2 text-xs tracking-[0.2em] uppercase">Total Revenue</div>
                        <div class="font-headline font-black italic text-on-surface text-4xl">&#8369;{{ number_format($totalRevenue) }}</div>
                        <div class="mt-4 flex items-center gap-2 text-secondary/60 text-xs font-bold">
                            <span class="material-symbols-outlined text-sm">payments</span>
                            AOV &#8369;{{ number_format($averageOrderValue) }}
                        </div>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3 bento-card p-8 group overflow-hidden relative">
                    <div class="relative z-10">
                        <div class="text-primary-container font-black mb-2 text-xs tracking-[0.2em] uppercase">Pending Orders</div>
                        <div class="font-headline font-black italic text-4xl">{{ number_format($pendingOrders) }}</div>
                        <div class="mt-4 flex items-center gap-2">
                            <span class="inline-block w-2 h-2 rounded-full bg-primary-container animate-pulse"></span>
                            <span class="text-on-surface-variant text-xs font-bold uppercase tracking-widest">Awaiting Dispatch</span>
                        </div>
                    </div>
                    <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-10 transition-opacity">
                        <span class="material-symbols-outlined text-[120px]">pending_actions</span>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3 bento-card p-8 group overflow-hidden relative bg-surface-container-highest">
                    <div class="relative z-10">
                        <div class="text-white/40 font-black mb-2 text-xs tracking-[0.2em] uppercase">Completed Orders</div>
                        <div class="font-headline font-black italic text-4xl">{{ number_format($completedOrders) }}</div>
                        <div class="mt-4 flex items-center gap-2 text-on-surface-variant text-xs font-bold uppercase tracking-widest">
                            <span class="material-symbols-outlined text-sm text-primary-container">verified</span>
                            {{ $completionRate }}% FULFILLMENT RATE
                        </div>
                    </div>
                </div>
            </section>

            <section class="editorial-grid">
                <div class="col-span-12 bg-surface-container-low p-8 rounded-lg">
                    <div class="flex flex-col gap-6 md:flex-row md:justify-between md:items-end mb-8">
                        <div>
                            <h2 class="text-4xl font-headline font-black italic uppercase tracking-tighter">Recent <span class="text-secondary">Orders</span></h2>
                            <p class="text-on-surface-variant tracking-[0.1em] uppercase mt-2 text-xs">
                                {{ $newestCustomer ? 'Latest customer: ' . strtoupper($newestCustomer['full_name']) : 'No customer records yet' }}
                            </p>
                        </div>
                        <div class="flex gap-4">
                            <button class="bg-surface-container-highest px-6 py-2 text-[10px] font-black tracking-widest uppercase hover:bg-secondary hover:text-on-secondary transition-all" type="button">Export_CSV</button>
                            <button class="bg-primary-container px-6 py-2 text-[10px] font-black tracking-widest uppercase text-on-primary-container active:scale-95 transition-transform" type="button">Filter_Matrix</button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="border-b border-outline-variant/20">
                                <tr class="text-[10px] font-black text-on-surface-variant uppercase tracking-[0.2em]">
                                    <th class="pb-4 font-bold">Transaction ID</th>
                                    <th class="pb-4 font-bold">Customer Name</th>
                                    <th class="pb-4 font-bold">Value</th>
                                    <th class="pb-4 font-bold">Status</th>
                                    <th class="pb-4 text-right font-bold">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/10">
                                @forelse ($transactions as $transaction)
                                    <tr class="group hover:bg-surface-container-high/50 transition-colors">
                                        <td class="py-6 text-sm font-black text-secondary">{{ $transaction['id'] }}</td>
                                        <td class="py-6">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center text-[10px] font-bold">{{ $transaction['initials'] }}</div>
                                                <span class="text-sm font-bold uppercase">{{ $transaction['customer'] }}</span>
                                            </div>
                                        </td>
                                        <td class="py-6 text-sm font-bold">{{ $transaction['value'] }}</td>
                                        <td class="py-6">
                                            <form action="{{ route('admin.orders.status', $transaction['reference']) }}" method="POST" class="flex flex-col items-start gap-3 lg:flex-row lg:items-center">
                                                @csrf
                                                <input type="hidden" name="customer_key" value="{{ $transaction['customer_key'] }}">
                                                <span class="{{ $transaction['status_classes'] }} px-3 py-1 text-[10px] font-black uppercase tracking-widest border">{{ $transaction['status_label'] }}</span>
                                                <div class="flex items-center gap-2">
                                                    <select name="status" class="min-w-[140px] border border-outline-variant/20 bg-surface-container-highest px-3 py-2 text-[10px] font-black uppercase tracking-[0.2em] text-white focus:border-primary-container focus:ring-0">
                                                        @foreach (['processing' => 'Processing', 'in_transit' => 'In Transit', 'shipped' => 'Shipped', 'delivered' => 'Delivered'] as $value => $label)
                                                            <option value="{{ $value }}" @selected($transaction['status'] === $value)>{{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="bg-primary-container px-3 py-2 text-[10px] font-black uppercase tracking-[0.2em] text-on-primary-container transition-transform active:scale-95">
                                                        Update
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="py-6 text-right align-top">
                                            <div class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ strtoupper($transaction['created_at']) }}</div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-10 text-center text-sm font-semibold uppercase tracking-[0.2em] text-on-surface-variant">
                                            No real order data yet
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <section class="editorial-grid mt-12">
                <div class="col-span-12 lg:col-span-4 bg-surface-container-high p-8 flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-headline font-black uppercase italic mb-4">Traffic_Source</h3>
                        <div class="space-y-6 mt-8">
                            @foreach ($sourceData as [$label, $value, $bar, $text])
                                <div>
                                    <div class="flex justify-between text-[10px] font-bold mb-2 tracking-widest {{ $text }}">
                                        <span>{{ $label }}</span>
                                        <span>{{ $value }}</span>
                                    </div>
                                    <div class="h-1 bg-surface-container-highest w-full">
                                        <div class="h-full {{ $bar }}" style="width: {{ $value }}"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-12 text-[10px] font-bold text-on-surface-variant/40 tracking-[0.3em] uppercase">Matrix_Ref_v48</div>
                </div>
                <div class="col-span-12 lg:col-span-8 relative overflow-hidden min-h-[300px]">
                    <img alt="Performance Analytics" class="w-full h-full object-cover grayscale brightness-50 contrast-125" src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1400&q=95">
                    <div class="absolute inset-0 bg-gradient-to-t from-background to-transparent"></div>
                    <div class="absolute bottom-8 left-8">
                        <div class="font-headline font-black italic text-4xl mb-2">STORE_SNAPSHOT</div>
                        <div class="text-primary-container font-black text-xl">{{ number_format($totalOrders) }} ORDERS / &#8369;{{ number_format($totalRevenue) }} GMV</div>
                    </div>
                </div>
            </section>

        </div>
    </main>

    <nav class="fixed bottom-0 w-full bg-[#0e0e0e]/95 backdrop-blur-xl border-t border-[#484847]/20 flex justify-around items-center h-16 md:hidden z-50">
        @foreach ([['dashboard', 'Dash', 'text-[#d5fb00]'], ['monitoring', 'Analytics', 'text-white/50'], ['inventory_2', 'Stock', 'text-white/50'], ['payments', 'Sales', 'text-white/50']] as [$icon, $label, $color])
            <div class="flex flex-col items-center {{ $color }}">
                <span class="material-symbols-outlined">{{ $icon }}</span>
                <span class="text-[8px] font-bold uppercase tracking-widest mt-1">{{ $label }}</span>
            </div>
        @endforeach
    </nav>

    <a class="fixed bottom-24 right-6 md:bottom-8 md:right-8 w-14 h-14 bg-primary-container text-on-primary-container rounded-full shadow-[0px_24px_48px_rgba(213,251,0,0.3)] flex items-center justify-center z-[70] active:scale-90 transition-transform" href="{{ route('admin.products.create') }}" aria-label="Add product">
        <span class="material-symbols-outlined font-black">add</span>
    </a>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
