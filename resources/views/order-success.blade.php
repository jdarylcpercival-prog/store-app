<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Order Successful | THREADLAB</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "error-container": "#b92902",
                        "surface-container-lowest": "#000000",
                        "secondary-dim": "#316bf3",
                        "on-secondary": "#001b55",
                        "surface-container-low": "#131313",
                        "outline-variant": "#484847",
                        "surface-variant": "#262626",
                        "on-surface": "#ffffff",
                        "primary-container": "#d5fb00",
                        primary: "#f5ffc4",
                        "tertiary-container": "#fedb42",
                        "surface-container-high": "#201f1f",
                        outline: "#777575",
                        "tertiary-dim": "#efcd34",
                        "on-tertiary-fixed": "#473b00",
                        background: "#0e0e0e",
                        "on-primary": "#556600",
                        "primary-fixed": "#d5fb00",
                        "on-secondary-fixed": "#002d80",
                        tertiary: "#ffeaa2",
                        "primary-dim": "#cbef00",
                        "on-tertiary-fixed-variant": "#685700",
                        "surface-container": "#1a1919",
                        surface: "#0e0e0e",
                        secondary: "#7799ff",
                        "surface-container-highest": "#262626",
                        "tertiary-fixed-dim": "#efcd34",
                        "secondary-fixed": "#c4d0ff",
                        "on-secondary-container": "#f8f7ff",
                        "inverse-primary": "#556600",
                        "on-primary-container": "#4e5d00",
                        "surface-bright": "#2c2c2c",
                        "inverse-on-surface": "#565554",
                        "surface-dim": "#0e0e0e",
                        "on-background": "#ffffff",
                        "on-error": "#450900",
                        "tertiary-fixed": "#fedb42",
                        "on-primary-fixed": "#3d4a00",
                        "secondary-fixed-dim": "#b0c2ff",
                        "secondary-container": "#0053db",
                        "on-primary-fixed-variant": "#576800",
                        "error-dim": "#d53d18",
                        "on-error-container": "#ffd2c8",
                        "on-tertiary-container": "#5d4d00",
                        "on-secondary-fixed-variant": "#0047bd",
                        "on-surface-variant": "#adaaaa",
                        "on-tertiary": "#675600",
                        "inverse-surface": "#fcf8f8",
                        error: "#ff7351",
                        "surface-tint": "#f5ffc4",
                        "primary-fixed-dim": "#c8ec00"
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

        .kinetic-grid {
            background-image: linear-gradient(to right, #484847 1px, transparent 1px), linear-gradient(to bottom, #484847 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.05;
        }

        .blur-glow {
            filter: blur(80px);
            opacity: 0.15;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body selection:bg-primary-container selection:text-on-primary-container">
    <main class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden px-6 py-20">
        <div class="absolute inset-0 kinetic-grid pointer-events-none"></div>
        <div class="absolute -top-20 -left-20 w-96 h-96 bg-primary-container rounded-full blur-glow pointer-events-none"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-secondary rounded-full blur-glow pointer-events-none"></div>

        <div class="relative w-full max-w-2xl z-10">
            <div class="flex justify-center mb-12">
                <div class="relative">
                    <div class="absolute inset-0 bg-primary-container blur-2xl opacity-40"></div>
                    <div class="relative w-24 h-24 bg-primary-container flex items-center justify-center transform rotate-12">
                        <span class="material-symbols-outlined text-on-primary-container !text-5xl -rotate-12" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    </div>
                </div>
            </div>

            <div class="text-center mb-16 space-y-4">
                <h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tighter leading-none italic uppercase">
                    Your order has been placed <span class="text-primary-container">successfully</span>
                </h1>
                <p class="font-label text-on-surface-variant tracking-[0.2em] uppercase text-sm">Confirmation Stage Complete</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-1 mb-16">
                <div class="bg-surface-container-low p-8 flex flex-col justify-between border-l-4 border-primary-container">
                    <span class="font-label text-xs text-on-surface-variant uppercase tracking-widest mb-4">Reference</span>
                    <span class="font-headline text-xl font-bold text-white tracking-tight">{{ $reference }}</span>
                </div>
                <div class="bg-surface-container p-8 flex flex-col justify-between">
                    <span class="font-label text-xs text-on-surface-variant uppercase tracking-widest mb-4">Total Amount</span>
                    <span class="font-headline text-xl font-bold text-primary-container tracking-tight">{{ $total }}</span>
                </div>
                <div class="bg-surface-container-high p-8 flex flex-col justify-between border-r-4 border-secondary">
                    <span class="font-label text-xs text-on-surface-variant uppercase tracking-widest mb-4">Method</span>
                    <span class="font-headline text-xl font-bold text-white tracking-tight">{{ $paymentMethod }}</span>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-6 items-center justify-center">
                <a class="group relative w-full md:w-auto px-12 py-5 bg-gradient-to-r from-primary to-primary-container text-on-primary-container font-headline font-extrabold italic tracking-tighter uppercase transition-all hover:scale-105 active:scale-95 overflow-hidden text-center" href="{{ route('dashboard') }}">
                    <span class="relative z-10">Dashboard</span>
                    <div class="absolute inset-0 bg-white/20 translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                </a>
                <a class="w-full md:w-auto px-12 py-5 bg-transparent border-2 border-outline-variant text-white font-headline font-bold italic tracking-tighter uppercase transition-all hover:border-secondary hover:text-secondary active:scale-95 text-center" href="{{ route('cart') }}">
                    Back To Cart
                </a>
            </div>

            <div class="mt-24 flex items-center justify-center gap-4 opacity-30">
                <div class="h-[1px] w-12 bg-outline-variant"></div>
                <span class="font-label text-[10px] tracking-[0.5em] uppercase text-on-surface-variant">KINETIC EDITORIAL SYST v2.0</span>
                <div class="h-[1px] w-12 bg-outline-variant"></div>
            </div>
        </div>

        <div class="hidden lg:block absolute -right-20 top-1/2 -translate-y-1/2 opacity-20 pointer-events-none">
            <p class="font-headline text-[20rem] font-black italic tracking-tighter text-outline-variant leading-none select-none">THREAD</p>
        </div>
        <div class="hidden lg:block absolute -left-20 top-1/2 -translate-y-1/2 opacity-20 pointer-events-none">
            <p class="font-headline text-[20rem] font-black italic tracking-tighter text-outline-variant leading-none select-none rotate-180">LAB</p>
        </div>
    </main>

    <footer class="bg-[#131313] w-full py-12 px-6 mt-auto border-t border-[#484847]/20 flex flex-col md:flex-row justify-between items-center gap-8">
        <div class="text-lg font-bold text-white">THREADLAB</div>
        <div class="flex flex-wrap justify-center gap-6">
            <a class="text-white/40 font-label text-xs tracking-widest hover:text-secondary transition-colors uppercase" href="#">TERMS</a>
            <a class="text-white/40 font-label text-xs tracking-widest hover:text-secondary transition-colors uppercase" href="#">PRIVACY</a>
            <a class="text-white/40 font-label text-xs tracking-widest hover:text-secondary transition-colors uppercase" href="#">SHIPPING</a>
            <a class="text-white/40 font-label text-xs tracking-widest hover:text-secondary transition-colors uppercase" href="#">RETURNS</a>
            <a class="text-white/40 font-label text-xs tracking-widest hover:text-secondary transition-colors uppercase" href="{{ route('contact') }}">CONTACT</a>
        </div>
        <div class="text-white/40 font-label text-[10px] tracking-wider uppercase">
            ©2024 THREADLAB KINETIC EDITORIAL
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
