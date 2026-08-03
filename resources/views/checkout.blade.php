<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout | THREADLAB</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,700;0,800;1,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#D9FF00",
                        background: "#0B0B0B",
                        surface: "#141414",
                        "surface-variant": "#1A1A1A",
                        "on-surface": "#FFFFFF",
                        "on-surface-variant": "#A1A1A1",
                        outline: "#2A2A2A",
                        error: "#FF4444"
                    },
                    borderRadius: {
                        DEFAULT: "0px",
                        lg: "2px",
                        xl: "4px",
                        full: "9999px"
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans"],
                        body: ["Plus Jakarta Sans"],
                        label: ["Plus Jakarta Sans"]
                    }
                }
            }
        };
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .neon-border {
            box-shadow: 0 0 15px rgba(217, 255, 0, 0.15);
        }

        .neon-glow {
            text-shadow: 0 0 10px rgba(217, 255, 0, 0.5);
        }

        .italic-heading {
            font-style: italic;
            font-weight: 800;
        }
    </style>
</head>
<body class="bg-background font-body text-on-surface selection:bg-primary selection:text-black">
    @include('partials.header')

    @php
        $standardShipping = $subtotal > 0 ? 100 : 0;
        $expressShipping = $subtotal > 0 ? 300 : 0;
    @endphp

    <main class="pt-32 pb-24 px-8 max-w-[1200px] mx-auto min-h-screen">
        <form id="checkout-form" action="{{ route('checkout.complete') }}" method="POST" data-checkout-form data-profile-sync-url="{{ route('checkout.profile.sync') }}">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-20">
            <div class="lg:col-span-7 space-y-20">
                <div class="relative">
                    <h1 class="text-6xl md:text-8xl italic-heading tracking-tighter uppercase mb-2">Checkout</h1>
                    <p class="text-primary font-bold tracking-[0.2em] text-xs uppercase">Secure your selection from the Digital Atelier.</p>
                    <div class="absolute -left-8 top-0 w-1 h-full bg-primary neon-border"></div>
                </div>

                <section class="space-y-10">
                    <div class="flex items-baseline justify-between border-b border-outline pb-4">
                        <h2 class="text-2xl italic-heading tracking-tight uppercase">01 / Shipping Address</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-on-surface-variant" for="first_name">First Name</label>
                            <input id="first_name" name="first_name" value="{{ old('first_name', $shippingAddress['first_name']) }}" class="w-full bg-transparent border-0 border-b-2 border-outline focus:border-primary focus:ring-0 py-4 px-0 placeholder:text-white/10 font-bold uppercase text-lg transition-all" placeholder="ALEXANDER" type="text">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-on-surface-variant" for="last_name">Last Name</label>
                            <input id="last_name" name="last_name" value="{{ old('last_name', $shippingAddress['last_name']) }}" class="w-full bg-transparent border-0 border-b-2 border-outline focus:border-primary focus:ring-0 py-4 px-0 placeholder:text-white/10 font-bold uppercase text-lg transition-all" placeholder="MCQUEEN" type="text">
                        </div>
                        <div class="md:col-span-2 space-y-3">
                            <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-on-surface-variant" for="street_address">Street Address</label>
                            <input id="street_address" name="street_address" value="{{ old('street_address', $shippingAddress['street_address']) }}" class="w-full bg-transparent border-0 border-b-2 border-outline focus:border-primary focus:ring-0 py-4 px-0 placeholder:text-white/10 font-bold uppercase text-lg transition-all" placeholder="128 STUDIO ALLEY, SUITE 4" type="text">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-on-surface-variant" for="city">City</label>
                            <input id="city" name="city" value="{{ old('city', $shippingAddress['city']) }}" class="w-full bg-transparent border-0 border-b-2 border-outline focus:border-primary focus:ring-0 py-4 px-0 placeholder:text-white/10 font-bold uppercase text-lg transition-all" placeholder="METRO MANILA" type="text">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-on-surface-variant" for="zip_code">Zip Code</label>
                            <input id="zip_code" name="zip_code" value="{{ old('zip_code', $shippingAddress['zip_code']) }}" class="w-full bg-transparent border-0 border-b-2 border-outline focus:border-primary focus:ring-0 py-4 px-0 placeholder:text-white/10 font-bold uppercase text-lg transition-all" placeholder="1200" type="text">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-on-surface-variant" for="phone">Phone Number</label>
                            <input id="phone" name="phone" value="{{ old('phone', $shippingAddress['phone']) }}" class="w-full bg-transparent border-0 border-b-2 border-outline focus:border-primary focus:ring-0 py-4 px-0 placeholder:text-white/10 font-bold uppercase text-lg transition-all" placeholder="+63 000 000 0000" type="tel">
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="border border-error/40 bg-error/10 px-4 py-4 text-sm font-semibold text-red-300">
                            {{ $errors->first() }}
                        </div>
                    @endif
                </section>

                <section class="space-y-10">
                    <h2 class="text-2xl italic-heading tracking-tight uppercase border-b border-outline pb-4">02 / Shipping Method</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <label class="group relative flex items-center justify-between p-8 bg-surface-variant cursor-pointer border border-outline hover:border-primary transition-all duration-300">
                            <input {{ old('shipping_method', $shippingMethod) === 'standard' ? 'checked' : '' }} class="hidden peer" name="shipping" type="radio" value="standard" data-shipping-option data-shipping-fee="{{ $standardShipping }}">
                            <div class="space-y-1">
                                <span class="block font-bold italic uppercase text-lg">Standard</span>
                                <span class="text-[10px] text-on-surface-variant tracking-widest uppercase">3-5 Business Days</span>
                            </div>
                            <span class="font-bold text-xl italic tracking-tighter">PHP 100</span>
                            <div class="absolute inset-0 border-2 border-primary opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none neon-border"></div>
                        </label>
                        <label class="group relative flex items-center justify-between p-8 bg-surface-variant cursor-pointer border border-outline hover:border-primary transition-all duration-300">
                            <input {{ old('shipping_method', $shippingMethod) === 'express' ? 'checked' : '' }} class="hidden peer" name="shipping" type="radio" value="express" data-shipping-option data-shipping-fee="{{ $expressShipping }}">
                            <div class="space-y-1">
                                <span class="block font-bold italic uppercase text-lg">Express</span>
                                <span class="text-[10px] text-on-surface-variant tracking-widest uppercase">Overnight Delivery</span>
                            </div>
                            <span class="font-bold text-xl italic tracking-tighter">PHP 300</span>
                            <div class="absolute inset-0 border-2 border-primary opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none neon-border"></div>
                        </label>
                    </div>
                </section>

                <section class="space-y-10">
                    <h2 class="text-2xl italic-heading tracking-tight uppercase border-b border-outline pb-4">03 / Payment Method</h2>
                    <div class="space-y-8">
                        <div class="bg-surface-variant border border-outline">
                            <label class="flex items-center gap-6 p-8 cursor-pointer group">
                                <input {{ old('payment_method', 'card') === 'card' ? 'checked' : '' }} class="w-6 h-6 border-2 border-primary bg-transparent text-primary focus:ring-0 focus:ring-offset-0" name="payment" type="radio" value="card" data-payment-option>
                                <span class="font-bold italic uppercase text-xl">Credit / Debit Card</span>
                            </label>
                            <div class="px-8 pb-10 space-y-8">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-on-surface-variant" for="card_number">Card Number</label>
                                    <input
                                        id="card_number"
                                        class="w-full bg-transparent border-0 border-b-2 border-outline focus:border-primary focus:ring-0 py-4 px-0 placeholder:text-white/10 font-bold uppercase text-lg transition-all"
                                        placeholder="0000 0000 0000 0000"
                                        type="text"
                                        inputmode="numeric"
                                        autocomplete="cc-number"
                                        maxlength="19"
                                        data-card-number
                                    >
                                </div>
                                <div class="grid grid-cols-2 gap-12">
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-on-surface-variant" for="expiry_date">Expiry Date</label>
                                        <input
                                            id="expiry_date"
                                            class="w-full bg-transparent border-0 border-b-2 border-outline focus:border-primary focus:ring-0 py-4 px-0 placeholder:text-white/10 font-bold uppercase text-lg transition-all"
                                            placeholder="MM/YY"
                                            type="text"
                                            inputmode="numeric"
                                            autocomplete="cc-exp"
                                            maxlength="5"
                                            data-expiry-date
                                        >
                                    </div>
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-bold uppercase tracking-[0.3em] text-on-surface-variant" for="cvv">CVV</label>
                                        <input
                                            id="cvv"
                                            class="w-full bg-transparent border-0 border-b-2 border-outline focus:border-primary focus:ring-0 py-4 px-0 placeholder:text-white/10 font-bold uppercase text-lg transition-all"
                                            placeholder="***"
                                            type="password"
                                            inputmode="numeric"
                                            autocomplete="cc-csc"
                                            maxlength="4"
                                            data-cvv
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="relative group">
                            <div class="absolute -inset-0.5 bg-primary opacity-20 blur group-hover:opacity-40 transition duration-500"></div>
                            <div class="relative bg-surface-variant border-2 border-primary/50 group-hover:border-primary transition-all duration-300">
                                <label class="flex items-center gap-6 p-8 cursor-pointer">
                                    <input {{ old('payment_method') === 'cod' ? 'checked' : '' }} class="w-6 h-6 border-2 border-primary bg-transparent text-primary focus:ring-0 focus:ring-offset-0" name="payment" type="radio" value="cod" data-payment-option>
                                    <div class="flex flex-col">
                                        <span class="font-bold italic uppercase text-xl text-primary neon-glow">Cash on Delivery</span>
                                        <span class="text-[10px] text-white/50 uppercase tracking-[0.2em]">Pay upon receiving your pieces - Premium Service</span>
                                    </div>
                                    <span class="ml-auto material-symbols-outlined text-primary">workspace_premium</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="lg:col-span-5">
                <div class="sticky top-32 space-y-10 bg-surface p-10 border border-outline neon-border">
                    <h2 class="text-4xl italic-heading tracking-tighter uppercase mb-10 border-b border-primary/20 pb-6">Summary</h2>

                    <div class="space-y-8 pb-10 border-b border-outline">
                        @forelse ($orderItems as $item)
                            <div class="flex gap-6">
                                <div class="w-28 h-36 bg-surface-variant flex-shrink-0 border border-outline relative overflow-hidden">
                                    <img class="w-full h-full object-cover grayscale transition-all duration-500 hover:grayscale-0 hover:scale-110" src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                                    <div class="absolute inset-0 bg-primary/5"></div>
                                </div>
                                <div class="flex-grow flex flex-col justify-between py-2">
                                    <div>
                                        <h3 class="font-bold italic uppercase tracking-tight text-lg">{{ $item['name'] }}</h3>
                                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mt-2">Size: <span class="text-on-surface font-bold">{{ $item['size'] }}</span></p>
                                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Qty: <span class="text-on-surface font-bold">{{ $item['quantity'] }}</span></p>
                                    </div>
                                    <span class="font-bold text-xl italic tracking-tighter text-primary">&#8369;{{ number_format($item['price']) }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="bg-surface-variant p-8 text-center">
                                <h3 class="font-bold italic uppercase tracking-tight text-lg">No items selected</h3>
                                <p class="mt-2 text-sm text-on-surface-variant">Add products to your cart before checkout.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="space-y-6">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-on-surface-variant uppercase tracking-[0.3em] font-bold">Subtotal</span>
                            <span class="font-bold italic tracking-tighter" data-subtotal-value="{{ $subtotal }}">&#8369;{{ number_format($subtotal) }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-on-surface-variant uppercase tracking-[0.3em] font-bold">Shipping</span>
                            <span class="font-bold italic tracking-tighter" data-shipping-summary>&#8369;{{ number_format($shipping) }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-8 border-t border-primary/20">
                            <span class="text-2xl italic-heading uppercase tracking-tighter">Total</span>
                            <span class="text-4xl font-black italic tracking-tighter text-primary neon-glow" data-total-summary>&#8369;{{ number_format($total) }}</span>
                        </div>
                    </div>

                    @if (count($orderItems) > 0)
                            <input type="hidden" name="shipping_method" value="{{ old('shipping_method', $shippingMethod) }}" data-shipping-hidden>
                            <input type="hidden" name="payment_method" value="{{ old('payment_method', 'card') }}" data-payment-hidden>
                            <button class="w-full bg-primary text-black py-8 px-12 italic-heading uppercase tracking-[0.3em] text-sm hover:bg-white transition-all duration-300 scale-100 hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-4 group" type="submit">
                                Complete Purchase
                                <span class="material-symbols-outlined font-bold group-hover:translate-x-2 transition-transform">arrow_forward</span>
                            </button>
                    @endif
                    <div class="pt-6 flex items-center justify-center gap-4 opacity-30">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        <span class="text-[9px] font-bold tracking-[0.4em] uppercase">SSL Secured Encryption</span>
                    </div>
                </div>
            </div>
            </div>
        </form>
    </main>

    <footer class="bg-surface border-t border-outline w-full py-16 px-8 mt-24">
        <div class="flex flex-col md:flex-row justify-between items-center gap-12 w-full max-w-[1200px] mx-auto">
            <div class="italic-heading tracking-tighter text-primary text-xl uppercase">
                THREADLAB ATELIER
            </div>
            <div class="flex flex-wrap justify-center gap-12">
                <a class="text-[10px] tracking-[0.4em] text-on-surface-variant uppercase hover:text-primary transition-colors" href="#">PRIVACY</a>
                <a class="text-[10px] tracking-[0.4em] text-on-surface-variant uppercase hover:text-primary transition-colors" href="#">TERMS</a>
                <a class="text-[10px] tracking-[0.4em] text-on-surface-variant uppercase hover:text-primary transition-colors" href="#">SHIPPING</a>
                <a class="text-[10px] tracking-[0.4em] text-on-surface-variant uppercase hover:text-primary transition-colors" href="#">RETURNS</a>
            </div>
            <div class="text-[9px] font-bold tracking-[0.3em] text-white/20">
                © 2024 THREADLAB DIGITAL ATELIER
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        const checkoutForm = document.querySelector('[data-checkout-form]');
        const profileSyncUrl = checkoutForm?.dataset.profileSyncUrl;
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const checkoutShippingOptions = document.querySelectorAll('[data-shipping-option]');
        const checkoutPaymentOptions = document.querySelectorAll('[data-payment-option]');
        const cardNumberInput = document.querySelector('[data-card-number]');
        const expiryDateInput = document.querySelector('[data-expiry-date]');
        const cvvInput = document.querySelector('[data-cvv]');
        const shippingSummary = document.querySelector('[data-shipping-summary]');
        const totalSummary = document.querySelector('[data-total-summary]');
        const subtotalSummary = document.querySelector('[data-subtotal-value]');
        const shippingHidden = document.querySelector('[data-shipping-hidden]');
        const paymentHidden = document.querySelector('[data-payment-hidden]');
        let syncTimeout;

        const formatPeso = (value) => `₱${Number(value).toLocaleString('en-PH')}`;

        const updateCheckoutSummary = () => {
            const selectedShipping = document.querySelector('[data-shipping-option]:checked');
            const selectedPayment = document.querySelector('[data-payment-option]:checked');
            const subtotal = Number(subtotalSummary?.dataset.subtotalValue || 0);
            const shippingFee = Number(selectedShipping?.dataset.shippingFee || 0);
            const total = subtotal + shippingFee;

            if (shippingSummary) {
                shippingSummary.textContent = formatPeso(shippingFee);
            }

            if (totalSummary) {
                totalSummary.textContent = formatPeso(total);
            }

            if (shippingHidden && selectedShipping) {
                shippingHidden.value = selectedShipping.value;
            }

            if (paymentHidden && selectedPayment) {
                paymentHidden.value = selectedPayment.value;
            }
        };

        checkoutShippingOptions.forEach((option) => {
            option.addEventListener('change', updateCheckoutSummary);
        });

        checkoutPaymentOptions.forEach((option) => {
            option.addEventListener('change', updateCheckoutSummary);
        });

        const syncCheckoutProfile = () => {
            if (!checkoutForm || !profileSyncUrl || !csrfToken) {
                return;
            }

            const payload = {
                first_name: checkoutForm.querySelector('[name="first_name"]')?.value ?? '',
                last_name: checkoutForm.querySelector('[name="last_name"]')?.value ?? '',
                street_address: checkoutForm.querySelector('[name="street_address"]')?.value ?? '',
                city: checkoutForm.querySelector('[name="city"]')?.value ?? '',
                zip_code: checkoutForm.querySelector('[name="zip_code"]')?.value ?? '',
                phone: checkoutForm.querySelector('[name="phone"]')?.value ?? '',
                shipping_method: shippingHidden?.value ?? 'standard',
            };

            window.clearTimeout(syncTimeout);
            syncTimeout = window.setTimeout(() => {
                fetch(profileSyncUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        Accept: 'application/json',
                    },
                    body: JSON.stringify(payload),
                }).catch(() => {});
            }, 350);
        };

        checkoutForm?.querySelectorAll('input[name="first_name"], input[name="last_name"], input[name="street_address"], input[name="city"], input[name="zip_code"], input[name="phone"]').forEach((input) => {
            input.addEventListener('input', syncCheckoutProfile);
            input.addEventListener('change', syncCheckoutProfile);
        });

        checkoutShippingOptions.forEach((option) => {
            option.addEventListener('change', syncCheckoutProfile);
        });

        cardNumberInput?.addEventListener('input', (event) => {
            const digitsOnly = event.target.value.replace(/\D/g, '').slice(0, 16);
            event.target.value = digitsOnly.replace(/(\d{4})(?=\d)/g, '$1-');
        });

        expiryDateInput?.addEventListener('input', (event) => {
            const digitsOnly = event.target.value.replace(/\D/g, '').slice(0, 4);

            if (digitsOnly.length === 0) {
                event.target.value = '';
                return;
            }

            let month = digitsOnly.slice(0, 2);
            const year = digitsOnly.slice(2, 4);

            if (month.length === 1 && Number(month) > 1) {
                month = `0${month}`;
            } else if (month.length === 2) {
                const numericMonth = Math.min(Math.max(Number(month), 1), 12);
                month = String(numericMonth).padStart(2, '0');
            }

            event.target.value = year ? `${month}/${year}` : month;
        });

        cvvInput?.addEventListener('input', (event) => {
            event.target.value = event.target.value.replace(/\D/g, '').slice(0, 4);
        });

        updateCheckoutSummary();
    </script>
</body>
</html>
