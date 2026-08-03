<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>THREADLAB | Access the Registry</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
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
                        headline: ["Plus Jakarta Sans", "sans-serif"],
                        display: ["Plus Jakarta Sans", "sans-serif"],
                        body: ["Inter", "sans-serif"],
                        label: ["Inter", "sans-serif"]
                    }
                }
            }
        };
    </script>
    <style>
        body {
            background-color: #0e0e0e;
            color: #ffffff;
            overflow-x: hidden;
        }

        .kinetic-gradient-text {
            background: linear-gradient(to right, #f5ffc4, #d5fb00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .kinetic-gradient-bg {
            background: linear-gradient(135deg, #f5ffc4 0%, #d5fb00 100%);
        }

        .floating-label-input:focus ~ label,
        .floating-label-input:not(:placeholder-shown) ~ label {
            transform: translateY(-1.25rem) scale(0.85);
            color: #7799ff;
        }
    </style>
</head>
<body class="antialiased min-h-screen flex selection:bg-primary-container selection:text-on-primary-container">
    <div class="flex w-full min-h-screen relative">
        <div class="hidden lg:flex w-1/2 relative bg-surface-container-lowest overflow-hidden items-end p-12">
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-cover bg-center opacity-80 mix-blend-luminosity hover:mix-blend-normal transition-all duration-1000" style="background-image: url('https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=1600&q=95')"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-background via-background/40 to-transparent"></div>
            </div>

            <div class="relative z-10 w-full">
                <div class="absolute top-0 left-0 -mt-[40vh]">
                    <span class="text-3xl font-black italic tracking-tighter text-primary-container font-headline">THREADLAB</span>
                    <span class="text-xs font-label text-white/50 block mt-1 tracking-[0.3em]">V-01 KINETIC</span>
                </div>
                <h1 class="md:text-[5rem] leading-[0.85] font-display font-black uppercase tracking-tighter text-white mix-blend-difference break-words w-full">
                    Access <br>
                    <span class="kinetic-gradient-text">The Registry</span>
                </h1>
                <p class="font-body text-white/50 mt-6 max-w-sm text-sm uppercase tracking-widest">
                    Enter the digital flagship. High-velocity drops and kinetic archives await authenticated users.
                </p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 md:p-24 bg-surface relative z-10">
            <div class="absolute top-8 left-8 lg:hidden">
                <span class="text-2xl font-black italic tracking-tighter text-primary-container font-headline">THREADLAB</span>
            </div>

            <div class="w-full max-w-md space-y-12">
                <div class="space-y-2">
                    <h2 class="text-4xl sm:text-5xl font-display font-extrabold tracking-tight text-white uppercase">
                        Welcome Back
                    </h2>
                    <p class="text-on-surface-variant font-body text-sm">
                        Authenticate your session to proceed.
                    </p>
                </div>

                @if (session('status'))
                    <div class="rounded border border-primary-container/30 bg-primary-container/10 px-4 py-3 text-sm font-semibold text-primary-container">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="rounded border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm font-semibold text-red-300">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('customer.login.submit') }}" class="space-y-8" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div class="relative group">
                            <input class="floating-label-input block w-full px-4 py-4 bg-surface-container-highest border-none rounded-DEFAULT text-white font-body focus:ring-0 focus:outline-none transition-all duration-300 peer" id="email" name="email" placeholder=" " required type="email" value="{{ old('email') }}">
                            <div class="absolute inset-0 rounded-DEFAULT border border-outline-variant peer-focus:border-secondary shadow-[0_0_0_0_rgba(119,153,255,0)] peer-focus:shadow-[0_0_15px_rgba(119,153,255,0.2)] pointer-events-none transition-all duration-300"></div>
                            <label class="absolute left-4 top-4 text-on-surface-variant font-label text-sm transition-all duration-300 pointer-events-none uppercase tracking-wider" for="email">
                                Email Address
                            </label>
                            <div class="absolute right-4 top-4 text-outline-variant peer-focus:text-secondary transition-colors duration-300">
                                <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 0;">mail</span>
                            </div>
                        </div>

                        <div class="relative group">
                            <input class="floating-label-input block w-full px-4 py-4 bg-surface-container-highest border-none rounded-DEFAULT text-white font-body focus:ring-0 focus:outline-none transition-all duration-300 peer" id="password" name="password" placeholder=" " required type="password">
                            <div class="absolute inset-0 rounded-DEFAULT border border-outline-variant peer-focus:border-secondary shadow-[0_0_0_0_rgba(119,153,255,0)] peer-focus:shadow-[0_0_15px_rgba(119,153,255,0.2)] pointer-events-none transition-all duration-300"></div>
                            <label class="absolute left-4 top-4 text-on-surface-variant font-label text-sm transition-all duration-300 pointer-events-none uppercase tracking-wider" for="password">
                                Password
                            </label>
                            <button class="absolute right-4 top-4 text-outline-variant hover:text-white peer-focus:text-secondary transition-colors duration-300 focus:outline-none" type="button" aria-label="Show password" data-password-toggle data-password-target="password">
                                <span class="material-symbols-outlined text-xl" data-password-icon style="font-variation-settings: 'FILL' 0;">visibility</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <div class="flex items-center">
                            <input class="h-4 w-4 rounded-DEFAULT border-outline-variant bg-surface-container-lowest text-secondary focus:ring-secondary focus:ring-offset-surface" id="remember-me" name="remember-me" type="checkbox">
                            <label class="ml-3 block text-xs font-label text-on-surface-variant uppercase tracking-wider" for="remember-me">
                                Remember Device
                            </label>
                        </div>
                        <div class="text-xs font-label uppercase tracking-wider">
                            <a class="text-white hover:text-primary-container relative inline-block group" href="#">
                                Forgot Password?
                                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary-container transition-all group-hover:w-full"></span>
                            </a>
                        </div>
                    </div>

                    <button class="w-full flex justify-center py-5 px-4 rounded-DEFAULT kinetic-gradient-bg text-on-primary-container font-headline font-bold text-lg uppercase tracking-widest hover:brightness-110 hover:shadow-[0_0_30px_rgba(213,251,0,0.3)] active:scale-[0.98] transition-all duration-200" type="submit">
                        Login to Session
                    </button>
                </form>

                <div class="pt-8 border-t border-outline-variant/20 text-center">
                    <p class="text-sm font-label text-on-surface-variant uppercase tracking-wider">
                        Don't have an account?
                        <a class="font-bold text-white hover:text-secondary ml-2 transition-colors inline-block relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-[1px] after:bg-secondary after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:origin-left" href="{{ route('customer.register') }}">
                            Register Now
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

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
