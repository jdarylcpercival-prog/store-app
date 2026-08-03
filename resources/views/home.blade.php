<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>THREADLAB | KINETIC EDITORIAL</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary-fixed-dim": "#c8ec00",
                        "surface-container-low": "#131313",
                        "outline-variant": "#484847",
                        "on-error": "#450900",
                        "on-secondary": "#001b55",
                        "surface-variant": "#262626",
                        "on-primary-fixed": "#3d4a00",
                        "on-surface-variant": "#adaaaa",
                        "on-primary-fixed-variant": "#576800",
                        "on-tertiary-fixed": "#473b00",
                        "error-container": "#b92902",
                        "on-background": "#ffffff",
                        "primary-dim": "#cbef00",
                        "primary": "#f5ffc4",
                        "on-primary": "#556600",
                        "primary-container": "#d5fb00",
                        "tertiary-container": "#fedb42",
                        "background": "#0e0e0e",
                        "inverse-on-surface": "#565554",
                        "on-tertiary-fixed-variant": "#685700",
                        "surface-bright": "#2c2c2c",
                        "surface": "#0e0e0e",
                        "inverse-primary": "#556600",
                        "tertiary-fixed": "#fedb42",
                        "on-error-container": "#ffd2c8",
                        "surface-container-high": "#201f1f",
                        "surface-container": "#1a1919",
                        "surface-dim": "#0e0e0e",
                        "inverse-surface": "#fcf8f8",
                        "primary-fixed": "#d5fb00",
                        "surface-tint": "#f5ffc4",
                        "on-tertiary-container": "#5d4d00",
                        "on-secondary-fixed-variant": "#0047bd",
                        "secondary-container": "#0053db",
                        "surface-container-lowest": "#000000",
                        "secondary-dim": "#316bf3",
                        "secondary": "#7799ff",
                        "error-dim": "#d53d18",
                        "error": "#ff7351",
                        "surface-container-highest": "#262626",
                        "tertiary-fixed-dim": "#efcd34",
                        "on-surface": "#ffffff",
                        "on-secondary-container": "#f8f7ff",
                        "secondary-fixed": "#c4d0ff",
                        "on-secondary-fixed": "#002d80",
                        "tertiary-dim": "#efcd34",
                        "tertiary": "#ffeaa2",
                        "on-tertiary": "#675600",
                        "secondary-fixed-dim": "#b0c2ff",
                        "on-primary-container": "#4e5d00",
                        "outline": "#777575"
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
                },
            },
        };
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            background-color: #0e0e0e;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
        }

        .kinetic-gradient {
            background: linear-gradient(to right, #f5ffc4, #d5fb00);
        }
    </style>
</head>
<body class="bg-background text-on-background selection:bg-primary-container selection:text-on-primary-container">
    @include('partials.header')

    <main class="pt-24">
        <section class="relative min-h-[921px] flex items-center px-8 overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img
                    alt="High-fashion streetwear editorial"
                    class="w-full h-full object-cover opacity-60 mix-blend-luminosity"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBLqTSHsVVKhi9uAVjUuU4lOnRqZv2ECJH7KpDkyROBFC2hIgwrfAmkbyju_tBNWsjR9hUf82rsH-QU7P1cwJ4BARAT2VckhHDk1qbQEL0zQJTwIwdqykxjv4jsm3ZeEm8S4FPxJ7FLjecqfbfmrMV5lYaas-v0BTY3yPwjQvFva44z7-bFc6uUAA9ZyJn0LK0519Bce9hbmMUu0JpAq1U5aXXYlA4_sEeMb3z0J_N_j3WX5cSvqaD3LeJL2wIDPzGnqahTFwflMHNmfg"
                    loading="eager"
                    decoding="async"
                    fetchpriority="high"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-background via-transparent to-transparent"></div>
            </div>
            <div class="relative z-10 max-w-5xl">
                <div class="inline-block px-3 py-1 bg-primary-container text-on-primary-container font-headline font-black text-xs tracking-widest mb-6">
                    KINETIC SERIES 01
                </div>
                <h1 class="font-headline text-[12vw] md:text-[8rem] leading-[0.85] font-black italic tracking-tighter mb-8 text-white uppercase">
                    Minimal.<br>Bold.<br><span class="text-primary-container">Timeless.</span>
                </h1>
                <div class="flex gap-4">
                    <a href="{{ route('shop') }}" class="kinetic-gradient text-on-primary-container px-10 py-5 font-headline font-black uppercase text-sm tracking-widest scale-95 active:scale-90 transition-transform flex items-center gap-2">
                        Shop Collection
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                    <a href="#registry" class="bg-surface-container-highest text-secondary px-10 py-5 font-headline font-black uppercase text-sm tracking-widest scale-95 active:scale-90 transition-transform">
                        Lookbook
                    </a>
                </div>
            </div>
        </section>

        <section id="registry" class="px-8 py-32 bg-surface">
            <div class="mx-auto w-full max-w-[1200px]">
                <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                    <div>
                        <h2 class="font-headline text-5xl md:text-7xl font-black italic tracking-tighter uppercase leading-none">The<br>Registry.</h2>
                    </div>
                    <p class="font-body text-on-surface-variant max-w-sm text-right">Selected high-performance prototypes and new laboratory editions. Engineered for the high-velocity urban mobility environment.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-2 auto-rows-[300px]">
                    <div class="md:col-span-2 lg:col-span-3 lg:row-span-2 bg-surface-container-low group overflow-hidden relative">
                        <img alt="Premium Outerwear" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBKxKMBfbmKxDJdbrCK7aFhjQKVy9f2LipUx-Rb_a33F6PklQv0weHyRE-su6IbJf-CE9E7SIZlb3QNrd-trAxlr9cAd1f3TnaqvVYYiewWXPaHt6Ec4d1aNp2hEk72WUZ1VAsOeXih8_O9vSYnIR9Q1LPRX5G7BfyiEVQlzJSmx0wy1SHl3-ywRwdAAwO6D0zRC-IDevPlSp3DuL4V4KjPlKL9ZCrkK2TAQDyxUSb3BQBxSdlYV8k_55ZHkiNqp4YBvOz0Fg7vGABaXQ">
                        <div class="absolute bottom-6 left-6 right-6">
                            <div class="flex justify-between items-end">
                                <div>
                                    <span class="bg-secondary text-on-secondary px-2 py-0.5 text-[10px] font-black uppercase mb-2 inline-block">LIMITED EDITION</span>
                                    <h3 class="font-headline text-3xl font-black italic tracking-tighter uppercase text-white">VOLT SERIES 01</h3>
                                </div>
                                <div class="bg-primary-container text-on-primary-container font-headline font-black px-4 py-2 italic text-lg">$128,500</div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2 lg:col-span-3 bg-surface-container-low group overflow-hidden relative">
                        <img alt="Kinetic Footwear" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAiRE5lVS_XiflUlz1Nsje0P_u93ruVgnAdv0ZtrL360rs7ADRIQldDnA61fu-iZDQGewZCBue7y28iyRe9U6GGpha693VdJV0HFXPQnQMM8x48bes1AXeA0GyQMBv-JfOOq78vIK1BwtPEmgNjb2OZXQaZitEXQe5eC1KdEEBMqKlBDCQbfUAKVK50zM4g3nZy1c_E95LBu9NrlGCKY_jnfaCDxDbtTGLVBiZ1b5xonmxn8qw7UpjuBBd190WBm85f1yPTotYHSEVAcg">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center">
                            <h3 class="font-headline text-xl font-black italic tracking-tighter uppercase text-white">LAB SEDAN</h3>
                            <div class="text-primary-container font-headline font-black">$72,500</div>
                        </div>
                    </div>

                    <div class="md:col-span-2 lg:col-span-2 bg-surface-container-low group overflow-hidden relative">
                        <img alt="Oversized Essential" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB0axV64fP6hSa7oOgdNGRnzs2uWm36D5QAr_xd4moFM_J5q_0FkCnP_5ZtoTKV2tEXCdkuVdMio0qqcC3nSDNp-sgvMg82mE6RNUG3BwOV27M3a5_BSPMba4e1O9A3SWq_vULwIu5SaoGiObbCKtwpS_tNMLy-WEpOxujzmRuiQT93BhxjYyLBlmQhXNRpwCofeaF9VaHvL6YrUgnCJhyuYVSaNTj7O9VASPx_fIIUVxof9lOQSWjg73YvDzCabsbLnYEM28oSmSFtTA">
                        <div class="absolute bottom-4 left-4">
                            <h3 class="font-headline text-xl font-black italic tracking-tighter uppercase text-white">LAB SEDAN</h3>
                            <div class="text-primary-container font-headline font-black">$72,500</div>
                        </div>
                    </div>

                    <div class="md:col-span-2 lg:col-span-2 bg-surface-container-low group overflow-hidden relative">
                        <img alt="Technical Pants" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCn0HO_ADU1roRsOBgF89a7iR7BGlMnW5YjuqQ-0b4HMSJDrr_DqIprmaJvYgp_OuFLgxkSNMUyU92t3DtB27Vi1UTYjlW7_cjPVBuDOfdu8PxXMk7Zp7w5Hve5zLZJBfw6B4RcEzUeIjd-uYLwL-kMezduTVcx0fczZb9sytS5tNHn05kd9J6goIK6IUl9wgMawNo6fWHOBd4EaFBZhy-KjYeZg2BT2n_Zkczez9wszdJACSzX_xhywfnOQizvHUAt5yNvBfLCCzhTAw">
                        <div class="absolute bottom-4 left-4">
                            <h3 class="font-headline text-xl font-black italic tracking-tighter uppercase text-white">CYBER COUPE</h3>
                            <div class="text-primary-container font-headline font-black">$110,000</div>
                        </div>
                    </div>

                    <div class="md:col-span-2 lg:col-span-2 bg-surface-container-low group overflow-hidden relative">
                        <img alt="Knitwear Accessory" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB83QYVN846z8pA_0HHRCgLC0q2DtilJ1u6geZrSmxXChRejdDWPoABtfAvS_AP9PBWfVx-8xHB-hDR3XveLXxGfQsrnb2uDuJngu7DEfLWkRcXz019q6XQ5ydY4KlpT4uaFPWKrXLu_CLZlBNlu3u-3Lj6VVMH14Rt5gfj3X4Na2vqsFwh8tIV0N4d13iBr4UuNjPwuc5-OHIBub_jzNwsn8JEHzzPBsaJMCwWrDk6Tu-Zu1puTQOi33j-1pMJ_MQFr0Jr-x2ScjJG7A">
                        <div class="absolute bottom-4 left-4">
                            <h3 class="font-headline text-xl font-black italic tracking-tighter uppercase text-white">NOMAD SUV</h3>
                            <div class="text-primary-container font-headline font-black">$95,000</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-40 bg-surface-container-low relative overflow-hidden">
            <div class="absolute -top-20 -left-20 text-[20rem] font-black italic text-white/[0.02] select-none leading-none tracking-tighter">
                KINETIC
            </div>
            <div class="max-w-6xl mx-auto px-8 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
                    <div>
                        <h2 class="font-headline text-6xl md:text-8xl font-black italic tracking-tighter uppercase leading-[0.9] mb-10">
                            The New<br><span class="text-primary-container">Uniform.</span>
                        </h2>
                        <div class="flex flex-col gap-4">
                            <p class="font-body text-xl text-white/80 leading-relaxed">
                                THREADLAB exists at the intersection of technical performance and high-fashion editorial. We don't follow seasons; we follow the pulse.
                            </p>
                            <p class="font-body text-on-surface-variant">
                                Every piece is validated through our global registry for authenticity and material excellence. Designed in the laboratory, proven on the street.
                            </p>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="aspect-[4/5] bg-surface-container-highest overflow-hidden">
                            <img alt="Editorial Motion" class="w-full h-full object-cover mix-blend-lighten" src="https://lh3.googleusercontent.com/aida-public/AB6AXuACQCmM9Hb1yQp_IzBoTOq0vdxNotV5AN-0nDohSepQhraaYQp4AXFIxQP7vE7JrEM9cltryu3z1amoRS6FhnM_Wyuw3S_mz9LfVlpWpg2RzD8iYuSj2tkxGTG9zj24qkjLNtJQcAQ5mosuSdXj4TV5aqqjUqGfxCfd6A4jtbQXe96ljoi0x00S4GHrewTjktUZTAbIpFVw-8VuBF243Pp1BCcwaBIEzjLDt-ODSw9zmyokyniU7srbt7TsA_nvoTf9y7qIIbsaiko">
                        </div>
                        <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-primary-container flex items-center justify-center p-8 text-on-primary-container font-headline font-black italic text-center text-xl leading-tight uppercase transform rotate-12">
                            Validated Archive 2024
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-32 bg-surface overflow-hidden">
            <div class="max-w-6xl mx-auto px-8">
                <h2 class="font-headline text-4xl md:text-6xl font-black italic tracking-tighter uppercase mb-16 text-[#d5fb00]">
                    COMMUNITY_VOICE
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white/5 backdrop-blur-md border border-white/10 p-10 rounded-xl relative group hover:border-[#d5fb00]/30 transition-all duration-500">
                        <div class="absolute top-0 right-0 p-4 text-[#d5fb00]/20 group-hover:text-[#d5fb00]/40 transition-colors">
                            <span class="material-symbols-outlined text-4xl">format_quote</span>
                        </div>
                        <p class="font-body text-xl md:text-2xl text-white italic leading-relaxed mb-8">
                            "This is the most comfortable shirt I’ve ever owned."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-0.5 bg-[#d5fb00]"></div>
                            <span class="font-headline font-black text-xs tracking-widest uppercase text-on-surface-variant">Verified Lab Participant</span>
                        </div>
                    </div>

                    <div class="bg-white/5 backdrop-blur-md border border-white/10 p-10 rounded-xl relative group hover:border-[#d5fb00]/30 transition-all duration-500">
                        <div class="absolute top-0 right-0 p-4 text-[#d5fb00]/20 group-hover:text-[#d5fb00]/40 transition-colors">
                            <span class="material-symbols-outlined text-4xl">format_quote</span>
                        </div>
                        <p class="font-body text-xl md:text-2xl text-white italic leading-relaxed mb-8">
                            "Simple but premium — exactly what I was looking for."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-0.5 bg-[#d5fb00]"></div>
                            <span class="font-headline font-black text-xs tracking-widest uppercase text-on-surface-variant">Archival Member</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="w-full py-20 px-8 bg-[#0e0e0e] border-t border-[#484847]/20">
        <div class="flex flex-col md:flex-row justify-between items-end gap-12">
            <div class="flex flex-col gap-8 w-full md:w-auto">
                <div class="text-white font-black tracking-tighter text-5xl italic font-headline">THREADLAB</div>
                <div class="flex flex-wrap gap-8">
                    <a class="font-['Inter'] text-[10px] tracking-widest font-medium uppercase text-[#484847] hover:text-white transition-colors opacity-80 hover:opacity-100" href="#">PRIVACY</a>
                    <a class="font-['Inter'] text-[10px] tracking-widest font-medium uppercase text-[#484847] hover:text-white transition-colors opacity-80 hover:opacity-100" href="#">TERMS</a>
                    <a class="font-['Inter'] text-[10px] tracking-widest font-medium uppercase text-[#484847] hover:text-white transition-colors opacity-80 hover:opacity-100" href="#">SHIPPING</a>
                    <a class="font-['Inter'] text-[10px] tracking-widest font-medium uppercase text-[#484847] hover:text-white transition-colors opacity-80 hover:opacity-100" href="{{ route('contact') }}">CONTACT</a>
                </div>
            </div>
            <div class="flex flex-col items-end gap-4">
                <div class="flex gap-4">
                    <span class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center hover:bg-primary-container hover:text-black transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-sm">language</span>
                    </span>
                    <span class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center hover:bg-primary-container hover:text-black transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-sm">share</span>
                    </span>
                </div>
                <p class="font-['Inter'] text-[10px] tracking-widest font-medium uppercase text-[#484847]">©2024 THREADLAB GLOBAL REGISTRY. ALL RIGHTS RESERVED.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
