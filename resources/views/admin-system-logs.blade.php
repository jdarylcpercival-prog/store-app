<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin System Logs | THREADLAB</title>
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
            <a href="{{ route('admin.system-logs') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-[#d5fb00]">System Logs</a>
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
            <a href="{{ route('admin.transactions') }}" class="block px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-white/40 transition-all hover:bg-[#201f1f] hover:text-white"><span class="flex items-center gap-4"><span class="material-symbols-outlined">payments</span>Transactions</span></a>
            <a href="{{ route('admin.system-logs') }}" class="block border-l-4 border-[#d5fb00] bg-[#201f1f] px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-[#d5fb00]"><span class="flex items-center gap-4"><span class="material-symbols-outlined">terminal</span>System Logs</span></a>
        </nav>
    </aside>
    <main class="px-6 pb-24 pt-24 lg:ml-64">
        <div class="mx-auto max-w-[1200px]">
            <div class="mb-10">
                <h1 class="font-['Plus_Jakarta_Sans'] text-6xl font-extrabold italic uppercase tracking-tighter md:text-8xl">System <span class="text-[#d5fb00]">Logs</span></h1>
                <p class="mt-4 max-w-2xl text-lg text-white/60">A chronological feed built from real admin registrations, customer signups, product uploads, edits, and placed orders.</p>
            </div>
            <div class="overflow-hidden bg-[#131313]">
                <div class="grid grid-cols-[180px_180px_1fr_220px] gap-4 border-b border-white/10 px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-white/40">
                    <span>Event</span>
                    <span>Time</span>
                    <span>Details</span>
                    <span>Meta</span>
                </div>
                @forelse ($recentLogs as $log)
                    <div class="grid grid-cols-[180px_180px_1fr_220px] gap-4 border-b border-white/5 px-6 py-5 last:border-b-0">
                        <div class="text-sm font-black uppercase {{ $log['accent'] }}">{{ str_replace('_', ' ', $log['type']) }}</div>
                        <div class="text-sm font-bold text-white/70">{{ $log['display_time'] }}</div>
                        <div class="text-sm font-bold uppercase text-white">{{ $log['title'] }}</div>
                        <div class="text-xs font-bold uppercase tracking-[0.2em] text-white/40">{{ $log['meta'] }}</div>
                    </div>
                @empty
                    <div class="px-6 py-16 text-center text-sm font-semibold uppercase tracking-[0.2em] text-white/40">No system logs recorded yet</div>
                @endforelse
            </div>
        </div>
    </main>
</body>
</html>
