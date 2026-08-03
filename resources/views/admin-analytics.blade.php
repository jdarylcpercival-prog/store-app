<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin Analytics | THREADLAB</title>
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
            <a href="{{ route('admin.analytics') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-[#d5fb00]">Analytics</a>
            <div class="flex h-8 w-8 items-center justify-center rounded-full border border-[#d5fb00]/20 bg-[#201f1f] text-xs font-black text-[#d5fb00]">{{ $adminInitials ?: 'AD' }}</div>
        </div>
    </header>

    <aside class="fixed left-0 top-0 hidden h-full w-64 flex-col bg-[#131313] pb-8 pt-20 shadow-[0px_24px_48px_rgba(0,0,0,0.4)] lg:flex">
        <div class="px-6 mb-10">
            <div class="flex items-center gap-3">
                <div class="h-8 w-2 bg-[#d5fb00]"></div>
                <div>
                    <div class="text-[12px] font-black uppercase tracking-widest text-[#d5fb00]">KINETIC_CORE</div>
                    <div class="text-[10px] font-bold text-white/30">{{ now()->format('Y.m.d') }} LIVE</div>
                </div>
            </div>
        </div>
        <nav class="flex-1 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="block px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-white/40 transition-all hover:bg-[#201f1f] hover:text-white"><span class="flex items-center gap-4"><span class="material-symbols-outlined">dashboard</span>Dashboard</span></a>
            <a href="{{ route('admin.analytics') }}" class="block border-l-4 border-[#d5fb00] bg-[#201f1f] px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-[#d5fb00]"><span class="flex items-center gap-4"><span class="material-symbols-outlined">monitoring</span>Analytics</span></a>
            <a href="{{ route('admin.products.index') }}" class="block px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-white/40 transition-all hover:bg-[#201f1f] hover:text-white"><span class="flex items-center gap-4"><span class="material-symbols-outlined">inventory_2</span>Inventory</span></a>
            <a href="{{ route('admin.transactions') }}" class="block px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-white/40 transition-all hover:bg-[#201f1f] hover:text-white"><span class="flex items-center gap-4"><span class="material-symbols-outlined">payments</span>Transactions</span></a>
            <a href="{{ route('admin.system-logs') }}" class="block px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-white/40 transition-all hover:bg-[#201f1f] hover:text-white"><span class="flex items-center gap-4"><span class="material-symbols-outlined">terminal</span>System Logs</span></a>
        </nav>
    </aside>

    <main class="px-6 pb-24 pt-24 lg:ml-64">
        <div class="mx-auto max-w-[1200px]">
            <div class="mb-12 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <h1 class="font-['Plus_Jakarta_Sans'] text-6xl font-extrabold italic uppercase tracking-tighter md:text-8xl">Store <span class="text-[#d5fb00]">Analytics</span></h1>
                    <p class="mt-4 max-w-2xl text-lg text-white/60">A live breakdown of your actual customer orders, catalog mix, and fulfillment progress.</p>
                </div>
                <div class="border-l-2 border-[#d5fb00] bg-[#201f1f] px-6 py-5">
                    <div class="text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Live Node</div>
                    <div class="mt-2 text-3xl font-black uppercase">{{ $liveNode }}</div>
                </div>
            </div>

            <div class="mb-10 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                <div class="bg-[#131313] p-8"><div class="text-[10px] font-black uppercase tracking-[0.2em] text-[#d5fb00]">Total Orders</div><div class="mt-3 text-5xl font-black italic">{{ number_format($totalOrders) }}</div><div class="mt-3 text-xs font-bold uppercase tracking-widest text-white/50">{{ $customerCount }} Customer Accounts</div></div>
                <div class="bg-[#131313] p-8 border-t-2 border-secondary"><div class="text-[10px] font-black uppercase tracking-[0.2em] text-secondary">Revenue</div><div class="mt-3 text-5xl font-black italic">&#8369;{{ number_format($totalRevenue) }}</div><div class="mt-3 text-xs font-bold uppercase tracking-widest text-white/50">AOV &#8369;{{ number_format($averageOrderValue) }}</div></div>
                <div class="bg-[#131313] p-8"><div class="text-[10px] font-black uppercase tracking-[0.2em] text-[#d5fb00]">Pending Flow</div><div class="mt-3 text-5xl font-black italic">{{ number_format($pendingOrders) }}</div><div class="mt-3 text-xs font-bold uppercase tracking-widest text-white/50">Awaiting fulfillment</div></div>
                <div class="bg-[#131313] p-8"><div class="text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Completion Rate</div><div class="mt-3 text-5xl font-black italic">{{ $completionRate }}%</div><div class="mt-3 text-xs font-bold uppercase tracking-widest text-white/50">{{ number_format($completedOrders) }} delivered orders</div></div>
            </div>

            <div class="grid gap-6 lg:grid-cols-[1.3fr_0.7fr]">
                <section class="bg-[#131313] p-8">
                    <div class="mb-8 flex items-end justify-between">
                        <div>
                            <h2 class="font-['Plus_Jakarta_Sans'] text-4xl font-black italic uppercase tracking-tighter">Order <span class="text-secondary">Pipeline</span></h2>
                            <p class="mt-2 text-xs uppercase tracking-[0.2em] text-white/40">Status distribution from real customer checkouts</p>
                        </div>
                    </div>
                    <div class="space-y-6">
                        @foreach ($statusBreakdown as $row)
                            <div>
                                <div class="mb-2 flex items-center justify-between text-[11px] font-black uppercase tracking-[0.2em]">
                                    <span>{{ $row['label'] }}</span>
                                    <span>{{ $row['count'] }} / {{ $row['share'] }}%</span>
                                </div>
                                <div class="h-2 bg-white/5">
                                    <div class="h-full bg-[#d5fb00]" style="width: {{ $row['share'] }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="bg-[#131313] p-8">
                    <h2 class="font-['Plus_Jakarta_Sans'] text-4xl font-black italic uppercase tracking-tighter">Catalog <span class="text-[#d5fb00]">Mix</span></h2>
                    <div class="mt-8 space-y-5">
                        @forelse ($categoryCounts as $row)
                            <div>
                                <div class="mb-2 flex items-center justify-between text-[11px] font-black uppercase tracking-[0.2em]">
                                    <span>{{ $row['category'] }}</span>
                                    <span>{{ $row['count'] }} Products</span>
                                </div>
                                <div class="h-2 bg-white/5">
                                    <div class="h-full bg-secondary" style="width: {{ $row['share'] }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-sm font-semibold uppercase tracking-[0.2em] text-white/40">No product data yet</div>
                        @endforelse
                    </div>
                </section>
            </div>

            <div class="mt-10 grid gap-6 lg:grid-cols-[0.9fr_1.1fr]">
                <section class="bg-[#131313] p-8">
                    <h2 class="font-['Plus_Jakarta_Sans'] text-4xl font-black italic uppercase tracking-tighter">Top <span class="text-secondary">Customers</span></h2>
                    <div class="mt-8 space-y-4">
                        @forelse ($topCustomers as $customer)
                            <div class="flex items-center justify-between border-b border-white/5 pb-4">
                                <div>
                                    <div class="text-sm font-black uppercase">{{ $customer['full_name'] }}</div>
                                    <div class="mt-1 text-[10px] font-bold uppercase tracking-[0.2em] text-white/40">{{ $customer['orders_count'] }} orders</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-black text-[#d5fb00]">&#8369;{{ number_format($customer['total_spent']) }}</div>
                                    <div class="mt-1 text-[10px] font-bold uppercase tracking-[0.2em] text-white/40">{{ strtoupper(\Carbon\Carbon::parse($customer['member_since'])->format('M Y')) }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="text-sm font-semibold uppercase tracking-[0.2em] text-white/40">No customer spending data yet</div>
                        @endforelse
                    </div>
                </section>

                <section class="bg-[#131313] p-8">
                    <h2 class="font-['Plus_Jakarta_Sans'] text-4xl font-black italic uppercase tracking-tighter">Store <span class="text-[#d5fb00]">Signals</span></h2>
                    <div class="mt-8 space-y-6">
                        @foreach ($sourceData as [$label, $value, $bar, $text])
                            <div>
                                <div class="mb-2 flex justify-between text-[11px] font-black uppercase tracking-[0.2em] {{ $text }}">
                                    <span>{{ $label }}</span>
                                    <span>{{ $value }}</span>
                                </div>
                                <div class="h-2 bg-white/5">
                                    <div class="h-full {{ $bar }}" style="width: {{ $value }}"></div>
                                </div>
                            </div>
                        @endforeach
                        <div class="border-t border-white/10 pt-6 text-sm text-white/60">
                            Latest customer:
                            <span class="font-black uppercase text-white">{{ $newestCustomer['full_name'] ?? 'No customer yet' }}</span>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
</body>
</html>
