<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>THREADLAB | JOIN THE COLLECTIVE</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400..800;1,400..800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "tertiary-fixed": "#fedb42",
                        "on-primary-container": "#4e5d00",
                        "on-secondary-fixed": "#002d80",
                        "on-error-container": "#ffd2c8",
                        "surface-container-highest": "#262626",
                        "secondary-fixed": "#c4d0ff",
                        "tertiary-dim": "#efcd34",
                        primary: "#f5ffc4",
                        "tertiary-fixed-dim": "#efcd34",
                        "secondary-container": "#0053db",
                        "on-secondary": "#001b55",
                        "on-tertiary": "#675600",
                        "error-dim": "#d53d18",
                        "inverse-primary": "#556600",
                        "on-primary-fixed-variant": "#576800",
                        "secondary-dim": "#316bf3",
                        outline: "#777575",
                        tertiary: "#ffeaa2",
                        "secondary-fixed-dim": "#b0c2ff",
                        "surface-bright": "#2c2c2c",
                        "surface-container-high": "#201f1f",
                        "error-container": "#b92902",
                        "outline-variant": "#484847",
                        "surface-variant": "#262626",
                        surface: "#0e0e0e",
                        background: "#0e0e0e",
                        "on-secondary-fixed-variant": "#0047bd",
                        "inverse-on-surface": "#565554",
                        "primary-fixed-dim": "#c8ec00",
                        "surface-container-lowest": "#000000",
                        "surface-container": "#1a1919",
                        secondary: "#7799ff",
                        "on-primary-fixed": "#3d4a00",
                        "on-tertiary-container": "#5d4d00",
                        "on-background": "#ffffff",
                        "on-tertiary-fixed-variant": "#685700",
                        "inverse-surface": "#fcf8f8",
                        "on-secondary-container": "#f8f7ff",
                        "on-primary": "#556600",
                        error: "#ff7351",
                        "on-surface-variant": "#adaaaa",
                        "on-surface": "#ffffff",
                        "on-tertiary-fixed": "#473b00",
                        "surface-tint": "#f5ffc4",
                        "surface-container-low": "#131313",
                        "primary-container": "#d5fb00",
                        "surface-dim": "#0e0e0e",
                        "tertiary-container": "#fedb42",
                        "primary-fixed": "#d5fb00",
                        "primary-dim": "#cbef00",
                        "on-error": "#450900"
                    },
                    borderRadius: {
                        DEFAULT: "0.125rem",
                        lg: "0.25rem",
                        xl: "0.5rem",
                        full: "0.75rem"
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans"],
                        display: ["Plus Jakarta Sans"],
                        body: ["Inter"],
                        label: ["Inter"]
                    }
                }
            }
        };
    </script>
    <style>
        .glow-input:focus {
            box-shadow: 0 0 10px rgba(119, 153, 255, 0.5);
            border-color: #7799ff;
        }
    </style>
</head>
<body class="bg-surface text-on-surface font-body min-h-screen antialiased selection:bg-primary-container selection:text-on-primary-container flex flex-col">
    <main class="flex-grow flex w-full">
        <div class="hidden lg:flex w-1/2 relative bg-surface-container-lowest overflow-hidden items-center justify-center">
            <div class="absolute inset-0 bg-cover bg-center opacity-60" style="background-image: url('https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&w=1600&q=95')"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-surface via-transparent to-transparent z-10"></div>
            <div class="absolute inset-0 bg-black/30 z-10"></div>
            <div class="relative z-20 p-16 flex flex-col justify-end h-full w-full">
                <h1 class="font-display font-black text-6xl md:text-7xl lg:text-8xl tracking-tighter text-on-surface uppercase mb-4 leading-none mix-blend-difference">
                    Join The<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-container">Collective</span>
                </h1>
                <p class="font-body text-on-surface-variant max-w-md text-lg">
                    Unlock exclusive drops, VIP archive access, and curated editorial edits. This is your access code to THREADLAB.
                </p>
            </div>
            <div class="absolute top-8 left-8 z-20">
                <a class="font-display text-2xl font-black italic tracking-tighter text-primary-container" href="{{ route('home') }}">THREADLAB</a>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-surface-container-low relative">
            <div class="absolute top-8 left-8 lg:hidden z-20">
                <a class="font-display text-2xl font-black italic tracking-tighter text-primary-container" href="{{ route('home') }}">THREADLAB</a>
            </div>

            <div class="w-full max-w-md space-y-12">
                <div class="space-y-2">
                    <h2 class="font-display text-4xl sm:text-5xl font-black tracking-tight text-on-surface uppercase">
                        Create Account
                    </h2>
                    <p class="font-body text-on-surface-variant">Initialize your profile to gain V-01 access.</p>
                </div>

                @if ($errors->any())
                    <div class="rounded border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm font-semibold text-red-300">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form class="space-y-6" action="{{ route('customer.register.submit') }}" method="POST">
                    @csrf
                    <div class="space-y-5">
                        <div class="space-y-1">
                            <label class="block font-label text-xs tracking-widest uppercase text-on-surface-variant font-medium" for="fullName">Full Name</label>
                            <input class="w-full bg-surface-container-highest border border-outline-variant rounded-DEFAULT px-4 py-3 text-on-surface font-body placeholder:text-on-surface-variant/50 focus:outline-none focus:ring-0 transition-all duration-300 glow-input" id="fullName" name="full_name" placeholder="Enter your full name" required type="text" value="{{ old('full_name') }}">
                        </div>
                        <div class="space-y-1">
                            <label class="block font-label text-xs tracking-widest uppercase text-on-surface-variant font-medium" for="email">Email Address</label>
                            <input class="w-full bg-surface-container-highest border border-outline-variant rounded-DEFAULT px-4 py-3 text-on-surface font-body placeholder:text-on-surface-variant/50 focus:outline-none focus:ring-0 transition-all duration-300 glow-input" id="email" name="email" placeholder="Enter your email" required type="email" value="{{ old('email') }}">
                        </div>
                        <div class="space-y-1">
                            <label class="block font-label text-xs tracking-widest uppercase text-on-surface-variant font-medium" for="password">Password</label>
                            <div class="relative">
                                <input class="w-full bg-surface-container-highest border border-outline-variant rounded-DEFAULT px-4 py-3 pr-12 text-on-surface font-body placeholder:text-on-surface-variant/50 focus:outline-none focus:ring-0 transition-all duration-300 glow-input" id="password" name="password" placeholder="Create a strong password" required type="password">
                                <button class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-white transition-colors" type="button" aria-label="Show password" data-password-toggle data-password-target="password">
                                    <span class="material-symbols-outlined text-xl" data-password-icon>visibility</span>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label class="block font-label text-xs tracking-widest uppercase text-on-surface-variant font-medium" for="confirmPassword">Confirm Password</label>
                            <div class="relative">
                                <input class="w-full bg-surface-container-highest border border-outline-variant rounded-DEFAULT px-4 py-3 pr-12 text-on-surface font-body placeholder:text-on-surface-variant/50 focus:outline-none focus:ring-0 transition-all duration-300 glow-input" id="confirmPassword" name="confirm_password" placeholder="Repeat your password" required type="password">
                                <button class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-white transition-colors" type="button" aria-label="Show password" data-password-toggle data-password-target="confirmPassword">
                                    <span class="material-symbols-outlined text-xl" data-password-icon>visibility</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 mt-8">
                        <div class="flex items-center h-5 mt-0.5">
                            <input class="w-4 h-4 bg-surface-container-highest border-outline-variant rounded-DEFAULT text-primary-container focus:ring-secondary focus:ring-offset-surface-container-low transition-colors cursor-pointer" id="terms" required type="checkbox">
                        </div>
                        <label class="font-body text-sm text-on-surface-variant cursor-pointer" for="terms">
                            I agree to the <a class="text-primary-container hover:underline underline-offset-4 decoration-primary-container/50" href="#">Terms of Service</a> and acknowledge the <a class="text-primary-container hover:underline underline-offset-4 decoration-primary-container/50" href="#">Privacy Policy</a>.
                        </label>
                    </div>

                    <button class="w-full bg-gradient-to-r from-primary to-primary-container text-on-primary-container font-body font-bold text-sm tracking-widest uppercase py-4 px-6 rounded-DEFAULT hover:opacity-90 transition-all duration-300 shadow-[0_0_20px_rgba(213,251,0,0.2)] hover:shadow-[0_0_30px_rgba(213,251,0,0.4)] active:scale-[0.98] mt-8" type="submit">
                        Register
                    </button>
                </form>

                <div class="pt-8 text-center border-t border-white/5">
                    <p class="font-body text-sm text-on-surface-variant">
                        Already have an account?
                        <a class="font-bold text-secondary hover:text-primary-container transition-colors uppercase tracking-wider ml-2" href="{{ route('customer.login') }}">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

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
