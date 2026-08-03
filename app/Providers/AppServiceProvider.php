<?php

namespace App\Providers;

use App\Support\StorefrontState;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.header', function ($view) {
            $storefrontState = app(StorefrontState::class);
            $request = request();
            $cartItems = $storefrontState->cartItems($request);
            $cartCount = collect($cartItems)->sum(fn (array $item) => (int) ($item['quantity'] ?? 0));
            $currentCustomer = $storefrontState->currentCustomer($request);

            $view->with([
                'headerCurrentCustomer' => $currentCustomer,
                'headerCartItems' => $cartItems,
                'headerCartCount' => $cartCount,
                'headerCartSubtotal' => $storefrontState->cartSubtotal($cartItems),
                'headerAccountRoute' => $currentCustomer ? route('dashboard') : route('customer.login'),
            ]);
        });
    }
}
