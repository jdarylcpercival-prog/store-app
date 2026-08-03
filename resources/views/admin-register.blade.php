<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>THREADLAB Admin Register</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-bright": "#2c2c2c",
                        "on-primary-fixed-variant": "#576800",
                        "on-secondary-container": "#f8f7ff",
                        "on-secondary": "#001b55",
                        surface: "#0e0e0e",
                        "error-container": "#b92902",
                        "on-tertiary-fixed-variant": "#685700",
                        "primary-fixed-dim": "#c8ec00",
                        "surface-variant": "#262626",
                        "surface-container-highest": "#262626",
                        "on-background": "#ffffff",
                        "surface-container-high": "#201f1f",
                        "primary-fixed": "#d5fb00",
                        "surface-container-low": "#131313",
                        "surface-container": "#1a1919",
                        "on-tertiary-container": "#5d4d00",
                        secondary: "#7799ff",
                        error: "#ff7351",
                        "primary-dim": "#cbef00",
                        "on-tertiary-fixed": "#473b00",
                        tertiary: "#ffeaa2",
                        "tertiary-dim": "#efcd34",
                        "outline-variant": "#484847",
                        background: "#0e0e0e",
                        "inverse-on-surface": "#565554",
                        "secondary-dim": "#316bf3",
                        outline: "#777575",
                        "on-primary": "#556600",
                        "surface-tint": "#f5ffc4",
                        "on-surface": "#ffffff",
                        "surface-container-lowest": "#000000",
                        "secondary-fixed": "#c4d0ff",
                        "inverse-surface": "#fcf8f8",
                        "error-dim": "#d53d18",
                        "on-error": "#450900",
                        "primary-container": "#d5fb00",
                        "on-tertiary": "#675600",
                        "tertiary-container": "#fedb42",
                        "on-surface-variant": "#adaaaa",
                        "on-secondary-fixed": "#002d80",
                        "secondary-fixed-dim": "#b0c2ff",
                        "inverse-primary": "#556600",
                        "on-primary-container": "#4e5d00",
                        "tertiary-fixed-dim": "#efcd34",
                        "on-primary-fixed": "#3d4a00",
                        "on-error-container": "#ffd2c8",
                        "on-secondary-fixed-variant": "#0047bd",
                        primary: "#f5ffc4",
                        "surface-dim": "#0e0e0e",
                        "tertiary-fixed": "#fedb42",
                        "secondary-container": "#0053db"
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

        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(213, 251, 0, 0.4);
        }
    </style>
</head>
<body class="bg-background text-on-background font-body min-h-screen selection:bg-primary-container selection:text-on-primary-container">
    <main class="min-h-screen flex flex-col md:flex-row">
        <section class="relative w-full md:w-1/2 lg:w-3/5 overflow-hidden flex items-end p-8 md:p-16 lg:p-24 bg-surface-container-lowest">
            <div class="absolute inset-0 z-0">
                <img alt="Editorial streetwear fashion" class="w-full h-full object-cover opacity-40 grayscale contrast-125" src="https://images.unsplash.com/photo-1551028719-00167b16eac5?auto=format&fit=crop&w=1600&q=95">
                <div class="absolute inset-0 bg-gradient-to-t from-background via-transparent to-transparent opacity-90"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-background via-transparent to-transparent opacity-40"></div>
            </div>

            <div class="relative z-10 max-w-2xl">
                <div class="mb-12">
                    <span class="text-primary-container font-headline font-black italic tracking-tighter text-3xl">THREADLAB</span>
                    <span class="text-white/40 block text-xs tracking-[0.3em] uppercase mt-2">Kinetic Editorial Systems</span>
                </div>
                <h1 class="font-headline font-extrabold text-5xl md:text-7xl lg:text-8xl leading-[0.9] tracking-tighter mb-8">
                    Manage Your <span class="text-primary-container italic">Store</span> with <br>Confidence
                </h1>
                <p class="font-body text-lg md:text-xl text-white/60 max-w-md leading-relaxed border-l-2 border-primary-container pl-6">
                    Track orders, manage products, and monitor performance in one place. The digital flagship for your kinetic brand evolution.
                </p>
                <div class="mt-16 flex gap-12 items-center text-white/20">
                    <div class="flex flex-col">
                        <span class="font-headline font-bold text-3xl text-white">99.9%</span>
                        <span class="text-[10px] uppercase tracking-widest">Uptime Performance</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-headline font-bold text-3xl text-white">0.02s</span>
                        <span class="text-[10px] uppercase tracking-widest">Global Latency</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="w-full md:w-1/2 lg:w-2/5 flex flex-col justify-center items-center p-6 md:p-12 lg:p-20 relative bg-surface">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-container/5 blur-[120px] rounded-full -mr-32 -mt-32"></div>
            <div class="w-full max-w-md">
                <div class="mb-10 text-left">
                    <h2 class="font-headline font-bold text-3xl md:text-4xl tracking-tight mb-2">Create Admin Account</h2>
                    <p class="text-white/50 text-sm md:text-base">Set up your THREADLAB admin access</p>
                </div>

                @if (session('status'))
                    <div class="mb-6 rounded-xl border border-primary-container/30 bg-primary-container/10 px-4 py-3 text-sm font-semibold text-primary-container">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm font-semibold text-red-300">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form class="space-y-6" action="{{ route('admin.register.submit') }}" method="POST">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="text-[10px] uppercase tracking-widest font-semibold text-white/40 ml-1" for="full_name">Full Name</label>
                        <input class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 text-on-surface focus:ring-2 focus:ring-secondary transition-all outline-none placeholder:text-white/20" id="full_name" name="full_name" placeholder="Alexander McQueen" required type="text" value="{{ old('full_name') }}">
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[10px] uppercase tracking-widest font-semibold text-white/40 ml-1" for="email">Email Address</label>
                        <input class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 text-on-surface focus:ring-2 focus:ring-secondary transition-all outline-none placeholder:text-white/20" id="email" name="email" placeholder="admin@threadlab.com" required type="email" value="{{ old('email') }}">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-[10px] uppercase tracking-widest font-semibold text-white/40 ml-1" for="password">Password</label>
                            <div class="relative">
                                <input class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 pr-12 text-on-surface focus:ring-2 focus:ring-secondary transition-all outline-none placeholder:text-white/20" id="password" name="password" placeholder="••••••••" required type="password">
                                <button class="absolute right-4 top-1/2 -translate-y-1/2 text-white/40 hover:text-white transition-colors" type="button" aria-label="Show password" data-password-toggle data-password-target="password">
                                    <span class="material-symbols-outlined text-xl" data-password-icon>visibility</span>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] uppercase tracking-widest font-semibold text-white/40 ml-1" for="confirm_password">Confirm Password</label>
                            <div class="relative">
                                <input class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 pr-12 text-on-surface focus:ring-2 focus:ring-secondary transition-all outline-none placeholder:text-white/20" id="confirm_password" name="confirm_password" placeholder="••••••••" required type="password">
                                <button class="absolute right-4 top-1/2 -translate-y-1/2 text-white/40 hover:text-white transition-colors" type="button" aria-label="Show password" data-password-toggle data-password-target="confirm_password">
                                    <span class="material-symbols-outlined text-xl" data-password-icon>visibility</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 pt-2">
                        <input class="w-5 h-5 rounded bg-surface-container-highest border-none text-primary-container focus:ring-offset-background focus:ring-primary-container" id="terms" required type="checkbox">
                        <label class="text-xs text-white/40 leading-snug" for="terms">
                            I agree to the <span class="text-white hover:text-primary-container cursor-pointer transition-colors underline underline-offset-4">Terms of Service</span> and <span class="text-white hover:text-primary-container cursor-pointer transition-colors underline underline-offset-4">Privacy Policy</span>.
                        </label>
                    </div>
                    <button class="w-full bg-primary-container text-on-primary-container font-headline font-black py-5 rounded-xl uppercase tracking-widest text-sm btn-glow transition-all active:scale-[0.98] mt-4" type="submit">
                        Register
                    </button>
                </form>

                <div class="mt-12 text-center border-t border-outline-variant/10 pt-8">
                    <p class="text-white/40 text-sm">
                        Already have an account?
                        <a class="text-secondary font-bold ml-1 hover:text-primary-container transition-colors" href="{{ route('admin.login') }}">Login</a>
                    </p>
                </div>
            </div>

            <footer class="absolute bottom-8 w-full px-8 flex justify-between items-center opacity-40 hover:opacity-100 transition-opacity">
                <span class="text-[9px] uppercase tracking-[0.3em] font-headline font-bold">© 2024 THREADLAB KINETIC EDITORIAL</span>
                <div class="flex gap-6">
                    <a class="text-[9px] uppercase tracking-widest hover:text-primary-container transition-colors" href="#">Support</a>
                    <a class="text-[9px] uppercase tracking-widest hover:text-primary-container transition-colors" href="#">System Status</a>
                </div>
            </footer>
        </section>
    </main>

    <div class="fixed top-1/4 -left-32 w-64 h-64 bg-primary-container/10 blur-[150px] pointer-events-none rounded-full"></div>
    <div class="fixed bottom-0 right-0 w-96 h-96 bg-secondary/5 blur-[180px] pointer-events-none rounded-full"></div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.querySelectorAll('[data-password-toggle]').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.passwordTarget);
                const icon = button.querySelector('[data-password-icon]');

                if (!input) {
                    return;
                }

                const showing = input.type === 'text';
                input.type = showing ? 'password' : 'text';
                button.setAttribute('aria-label', showing ? 'Show password' : 'Hide password');

                if (icon) {
                    icon.textContent = showing ? 'visibility' : 'visibility_off';
                }
            });
        });
    </script>
</body>
</html>
