<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorefrontState
{
    public function rememberCookieName(): string
    {
        return 'threadlab_remember';
    }

    public function customerAccounts(): array
    {
        if (! Storage::disk('local')->exists('customer_accounts.json')) {
            return [];
        }

        $accounts = json_decode(Storage::disk('local')->get('customer_accounts.json'), true);

        return is_array($accounts) ? $accounts : [];
    }

    public function customerSessionPayload(array $account): array
    {
        return [
            'full_name' => $account['full_name'] ?? '',
            'email' => $account['email'] ?? '',
            'member_since' => $account['member_since'] ?? '',
        ];
    }

    public function syncSessionCustomer(Request $request, array $account): array
    {
        $sessionCustomer = $this->customerSessionPayload($account);
        $request->session()->put('customer', $sessionCustomer);

        return $sessionCustomer;
    }

    public function currentCustomer(Request $request): ?array
    {
        $sessionCustomer = $request->session()->get('customer');
        $accounts = $this->customerAccounts();

        if ($sessionCustomer) {
            $emailKey = strtolower((string) ($sessionCustomer['email'] ?? ''));

            if ($emailKey !== '' && isset($accounts[$emailKey])) {
                return $this->syncSessionCustomer($request, $accounts[$emailKey]);
            }
        }

        $rememberValue = $request->cookie($this->rememberCookieName());

        if (is_string($rememberValue) && str_contains($rememberValue, '|')) {
            [$emailKey, $token] = explode('|', $rememberValue, 2);
            $emailKey = strtolower($emailKey);
            $account = $accounts[$emailKey] ?? null;

            if ($account && ! empty($account['remember_token']) && hash_equals($account['remember_token'], $token)) {
                return $this->syncSessionCustomer($request, $account);
            }
        }

        return null;
    }

    public function currentCustomerKey(Request $request): ?string
    {
        $customer = $this->currentCustomer($request);

        return $customer ? strtolower((string) $customer['email']) : null;
    }

    public function rawCart(Request $request): array
    {
        $customerKey = $this->currentCustomerKey($request);

        if (! $customerKey) {
            return $request->session()->get('guest_cart', []);
        }

        $accounts = $this->customerAccounts();

        return $accounts[$customerKey]['cart'] ?? [];
    }

    public function cartItems(Request $request): array
    {
        return array_values($this->rawCart($request));
    }

    public function cartSubtotal(array $cartItems): int
    {
        return collect($cartItems)->sum(function (array $item) {
            return ((int) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 0));
        });
    }
}
