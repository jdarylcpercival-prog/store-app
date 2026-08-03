<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin Transactions | THREADLAB</title>
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
            <a href="{{ route('admin.transactions') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-[#d5fb00]">Transactions</a>
            <div class="flex h-8 w-8 items-center justify-center rounded-full border border-[#d5fb00]/20 bg-[#201f1f] text-xs font-black text-[#d5fb00]">{{ $adminInitials ?: 'AD' }}</div>
        </div>
    </header>
    <aside class="fixed left-0 top-0 hidden h-full w-64 flex-col bg-[#131313] pb-8 pt-20 shadow-[0px_24px_48px_rgba(0,0,0,0.4)] lg:flex">
        <div class="px-6 mb-10">
            <div class="flex items-center gap-3"><div class="h-8 w-2 bg-[#d5fb00]"></div><div><div class="text-[12px] font-black uppercase tracking-widest text-[#d5fb00]">KINETIC_CORE</div><div class="text-[10px] font-bold text-white/30">{{ now()->format('Y.m.d') }} LIVE</div></div></div>
        </div>
        <nav class="flex-1 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="block px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-white/40 transition-all hover:bg-[#201f1f] hover:text-white"><span class="flex items-center gap-4"><span class="material-symbols-outlined">dashboard</span>Dashboard</span></a>
            <a href="{{ route('admin.analytics') }}" class="block px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-white/40 transition-all hover:bg-[#201f1f] hover:text-white"><span class="flex items-center gap-4"><span class="material-symbols-outlined">monitoring</span>Analytics</span></a>
            <a href="{{ route('admin.products.index') }}" class="block px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-white/40 transition-all hover:bg-[#201f1f] hover:text-white"><span class="flex items-center gap-4"><span class="material-symbols-outlined">inventory_2</span>Inventory</span></a>
            <a href="{{ route('admin.transactions') }}" class="block border-l-4 border-[#d5fb00] bg-[#201f1f] px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-[#d5fb00]"><span class="flex items-center gap-4"><span class="material-symbols-outlined">payments</span>Transactions</span></a>
            <a href="{{ route('admin.system-logs') }}" class="block px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-white/40 transition-all hover:bg-[#201f1f] hover:text-white"><span class="flex items-center gap-4"><span class="material-symbols-outlined">terminal</span>System Logs</span></a>
        </nav>
    </aside>
    <main class="px-6 pb-24 pt-24 lg:ml-64">
        <div class="mx-auto max-w-[1200px]">
            @if (session('status'))
                <div class="mb-8 border border-[#d5fb00]/30 bg-[#d5fb00]/10 px-5 py-4 text-sm font-semibold text-[#d5fb00]">{{ session('status') }}</div>
            @endif
            <div class="mb-10">
                <h1 class="font-['Plus_Jakarta_Sans'] text-6xl font-extrabold italic uppercase tracking-tighter md:text-8xl">Order <span class="text-[#d5fb00]">Transactions</span></h1>
                <p class="mt-4 max-w-2xl text-lg text-white/60">Review every real checkout and update each order status from one dedicated admin surface.</p>
            </div>
            <div class="overflow-hidden bg-[#131313] p-8">
                <div class="mb-8 grid gap-4 md:grid-cols-4">
                    <div class="border border-white/5 bg-[#1a1919] p-5"><div class="text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Total Orders</div><div class="mt-3 text-3xl font-black italic">{{ number_format($totalOrders) }}</div></div>
                    <div class="border border-white/5 bg-[#1a1919] p-5"><div class="text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Pending</div><div class="mt-3 text-3xl font-black italic text-[#d5fb00]">{{ number_format($pendingOrders) }}</div></div>
                    <div class="border border-white/5 bg-[#1a1919] p-5"><div class="text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Delivered</div><div class="mt-3 text-3xl font-black italic">{{ number_format($completedOrders) }}</div></div>
                    <div class="border border-white/5 bg-[#1a1919] p-5"><div class="text-[10px] font-black uppercase tracking-[0.2em] text-white/40">Revenue</div><div class="mt-3 text-3xl font-black italic">&#8369;{{ number_format($totalRevenue) }}</div></div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="border-b border-white/10">
                            <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-white/40">
                                <th class="pb-4">Reference</th>
                                <th class="pb-4">Customer</th>
                                <th class="pb-4">Items</th>
                                <th class="pb-4">Value</th>
                                <th class="pb-4">Status</th>
                                <th class="pb-4 text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td class="py-5 text-sm font-black text-secondary">{{ $transaction['reference'] }}</td>
                                    <td class="py-5">
                                        <div class="font-bold uppercase">{{ $transaction['customer'] }}</div>
                                        <div class="mt-1 text-[10px] font-bold uppercase tracking-[0.2em] text-white/40">{{ $transaction['customer_email'] }}</div>
                                    </td>
                                    <td class="py-5 text-sm text-white/70">{{ $transaction['items_count'] }} item{{ $transaction['items_count'] === 1 ? '' : 's' }}</td>
                                    <td class="py-5 text-sm font-bold">{{ $transaction['value'] }}</td>
                                    <td class="py-5">
                                        <form action="{{ route('admin.orders.status', $transaction['reference']) }}" method="POST" class="flex flex-wrap items-center gap-2">
                                            @csrf
                                            <input type="hidden" name="customer_key" value="{{ $transaction['customer_key'] }}">
                                            <span class="{{ $transaction['status_classes'] }} border px-3 py-1 text-[10px] font-black uppercase tracking-widest">{{ $transaction['status_label'] }}</span>
                                            <select name="status" class="min-w-[140px] border border-white/10 bg-[#262626] px-3 py-2 text-[10px] font-black uppercase tracking-[0.2em] text-white focus:border-[#d5fb00] focus:ring-0">
                                                @foreach (['processing' => 'Processing', 'in_transit' => 'In Transit', 'shipped' => 'Shipped', 'delivered' => 'Delivered'] as $value => $label)
                                                    <option value="{{ $value }}" @selected($transaction['status'] === $value)>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="bg-[#d5fb00] px-4 py-2 text-[10px] font-black uppercase tracking-[0.2em] text-[#4e5d00]">Update</button>
                                        </form>
                                    </td>
                                    <td class="py-5 text-right text-xs font-bold uppercase tracking-widest text-white/40">{{ strtoupper($transaction['created_at']) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="py-12 text-center text-sm font-semibold uppercase tracking-[0.2em] text-white/40">No transactions yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
