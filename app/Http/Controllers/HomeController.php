<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    private function allowedOrderStatuses(): array
    {
        return ['processing', 'in_transit', 'shipped', 'delivered'];
    }

    private function normalizeOrderStatus(?string $status): string
    {
        $normalized = strtolower((string) $status);

        return in_array($normalized, $this->allowedOrderStatuses(), true) ? $normalized : 'processing';
    }

    private function orderStatusLabel(?string $status): string
    {
        return match ($this->normalizeOrderStatus($status)) {
            'in_transit' => 'In Transit',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
            default => 'Processing',
        };
    }

    private function orderStatusClasses(?string $status): string
    {
        return match ($this->normalizeOrderStatus($status)) {
            'delivered' => 'bg-white/10 text-white border-white/20',
            'shipped' => 'bg-secondary/10 text-secondary border-secondary/20',
            'in_transit' => 'bg-tertiary-container/10 text-tertiary-container border-tertiary-container/20',
            default => 'bg-primary-container/10 text-primary-container border-primary-container/20',
        };
    }

    private function baseProducts(): array
    {
        return [
            'essential-black-tee' => [
                'name' => 'Essential Black Tee',
                'sku' => 'TL-001-B',
                'price' => 799,
                'compare_price' => 1200,
                'tag' => 'Core Drop',
                'category' => 'basic',
                'sort_order' => 1,
                'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=1600&q=95',
                'description' => 'A heavyweight black cotton tee with a structured drape, clean collar, and minimal THREADLAB finish.',
                'eyebrow' => 'Kinetic Basics',
                'access_badge' => 'V-01 Access',
                'materials' => '240GSM combed cotton with reinforced seams and a pre-shrunk finish.',
                'fit_notes' => 'Relaxed silhouette with dropped shoulders for a clean editorial drape.',
                'gallery' => [
                    'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=1600&q=95',
                    'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=1000&q=95',
                    'https://images.unsplash.com/photo-1503342394128-c104d54dba01?auto=format&fit=crop&w=1000&q=95',
                ],
                'highlights' => [
                    'Double-needle stitched neck and hems',
                    'Pre-shrunk for consistent fit',
                ],
            ],
            'classic-white-tee' => [
                'name' => 'Classic White Tee',
                'sku' => 'TL-002-W',
                'price' => 849,
                'compare_price' => 1290,
                'tag' => 'Core Drop',
                'category' => 'basic',
                'sort_order' => 2,
                'image' => 'https://images.unsplash.com/photo-1581655353564-df123a1eb820?auto=format&fit=crop&w=1600&q=95',
                'description' => 'A crisp white everyday tee cut from premium cotton for a sharp, versatile silhouette.',
                'eyebrow' => 'Kinetic Basics',
                'access_badge' => 'Studio Issue',
                'materials' => 'Soft premium cotton jersey with clean finishing for everyday structure.',
                'fit_notes' => 'Tailored straight fit that layers cleanly under outerwear.',
                'gallery' => [
                    'https://images.unsplash.com/photo-1581655353564-df123a1eb820?auto=format&fit=crop&w=1600&q=95',
                    'https://images.unsplash.com/photo-1527719327859-c6ce80353573?auto=format&fit=crop&w=1000&q=95',
                    'https://images.unsplash.com/photo-1576566588028-4147f3842f27?auto=format&fit=crop&w=1000&q=95',
                ],
                'highlights' => [
                    'Crisp collar retention',
                    'Minimal seam profile for polished daily wear',
                ],
            ],
            'earth-tone-tee' => [
                'name' => 'Earth Tone Tee',
                'sku' => 'TL-003-E',
                'price' => 899,
                'compare_price' => 1350,
                'tag' => 'Minimal',
                'category' => 'minimal',
                'sort_order' => 3,
                'image' => 'https://images.unsplash.com/photo-1622445275463-afa2ab738c34?auto=format&fit=crop&w=1600&q=95',
                'description' => 'A warm neutral tee built for pared-back styling, soft layering, and daily rotation.',
                'eyebrow' => 'Neutral System',
                'access_badge' => 'Archive Tone',
                'materials' => 'Midweight cotton knit with a soft handfeel and matte neutral finish.',
                'fit_notes' => 'Easy relaxed fit with a slightly boxier body for layering.',
                'gallery' => [
                    'https://images.unsplash.com/photo-1622445275463-afa2ab738c34?auto=format&fit=crop&w=1600&q=95',
                    'https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?auto=format&fit=crop&w=1000&q=95',
                    'https://images.unsplash.com/photo-1523398002811-999ca8dec234?auto=format&fit=crop&w=1000&q=95',
                ],
                'highlights' => [
                    'Soft washed neutral finish',
                    'Balanced weight for warm-weather layering',
                ],
            ],
            'oversized-street-tee' => [
                'name' => 'Oversized Street Tee',
                'sku' => 'TL-004-OS',
                'price' => 1099,
                'compare_price' => 1590,
                'tag' => 'Limited Drop',
                'category' => 'oversized',
                'sort_order' => 4,
                'image' => 'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&w=1600&q=95',
                'description' => 'An oversized streetwear tee with dropped shoulders and a relaxed editorial shape.',
                'eyebrow' => 'Oversized Code',
                'access_badge' => 'Limited Drop',
                'materials' => 'Heavy cotton jersey with a structured hand and oversized panel cut.',
                'fit_notes' => 'Intentionally oversized through the chest, sleeve, and body.',
                'gallery' => [
                    'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&w=1600&q=95',
                    'https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=1000&q=95',
                    'https://images.unsplash.com/photo-1495385794356-15371f348c31?auto=format&fit=crop&w=1000&q=95',
                ],
                'highlights' => [
                    'Dropped shoulder construction',
                    'Boxy proportions tuned for statement layering',
                ],
            ],
            'minimal-logo-tee' => [
                'name' => 'Minimal Logo Tee',
                'sku' => 'TL-005-ML',
                'price' => 949,
                'compare_price' => 1450,
                'tag' => 'Signature',
                'category' => 'minimal',
                'sort_order' => 5,
                'image' => 'https://images.unsplash.com/photo-1562157873-818bc0726f68?auto=format&fit=crop&w=1600&q=95',
                'description' => 'Subtle branding, maximum impact. Crafted from 240GSM premium cotton with a refined finish.',
                'eyebrow' => 'Signature System',
                'access_badge' => 'Registry Mark',
                'materials' => 'Premium 240GSM cotton with subtle logo detailing and refined finishing.',
                'fit_notes' => 'Clean modern fit built for understated everyday wear.',
                'gallery' => [
                    'https://images.unsplash.com/photo-1562157873-818bc0726f68?auto=format&fit=crop&w=1600&q=95',
                    'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1000&q=95',
                    'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1000&q=95',
                ],
                'highlights' => [
                    'Subtle front mark with clean finish',
                    'Premium weight for all-day structure',
                ],
            ],
        ];
    }

    private function customProducts(): array
    {
        if (! Storage::disk('local')->exists('products.json')) {
            return [];
        }

        $products = json_decode(Storage::disk('local')->get('products.json'), true);

        return is_array($products) ? $products : [];
    }

    private function storeCustomProducts(array $products): void
    {
        Storage::disk('local')->put('products.json', json_encode($products, JSON_PRETTY_PRINT));
    }

    private function deletedProducts(): array
    {
        if (! Storage::disk('local')->exists('deleted_products.json')) {
            return [];
        }

        $products = json_decode(Storage::disk('local')->get('deleted_products.json'), true);

        return is_array($products) ? array_values($products) : [];
    }

    private function storeDeletedProducts(array $slugs): void
    {
        Storage::disk('local')->put('deleted_products.json', json_encode(array_values(array_unique($slugs)), JSON_PRETTY_PRINT));
    }

    private function products(): array
    {
        $products = array_replace($this->baseProducts(), $this->customProducts());

        foreach ($this->deletedProducts() as $deletedSlug) {
            unset($products[$deletedSlug]);
        }

        return $products;
    }

    private function categoryPresentation(string $category): array
    {
        return match ($category) {
            'oversized' => ['tag' => 'Limited Drop', 'eyebrow' => 'Oversized Code', 'access_badge' => 'Limited Drop'],
            'minimal' => ['tag' => 'Minimal', 'eyebrow' => 'Minimal System', 'access_badge' => 'Archive Tone'],
            default => ['tag' => 'Core Drop', 'eyebrow' => 'Kinetic Basics', 'access_badge' => 'Studio Issue'],
        };
    }

    private function storeUploadedProductImage($file, string $slug, string $prefix): string
    {
        $directory = public_path('uploads/products/' . $slug);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = $prefix . '-' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return asset('uploads/products/' . $slug . '/' . $filename);
    }

    private function adminSnapshot(Request $request): array
    {
        $customerAccounts = $this->customerAccounts($request);
        $customProducts = $this->customProducts();
        $allProducts = $this->products();
        $adminAccounts = $this->adminAccounts();

        $transactions = collect($customerAccounts)
            ->flatMap(function (array $account) {
                $customerName = $account['full_name'] ?? 'Unknown Customer';
                $initials = collect(preg_split('/\s+/', trim($customerName)))
                    ->filter()
                    ->map(fn ($part) => strtoupper(Str::substr($part, 0, 1)))
                    ->take(2)
                    ->implode('');

                return collect($account['orders'] ?? [])->map(function (array $order, int $index) use ($customerName, $initials, $account) {
                    $value = $order['total_value'] ?? (int) preg_replace('/[^\d]/', '', (string) ($order['total'] ?? '0'));
                    $status = $this->normalizeOrderStatus($order['status'] ?? 'processing');

                    return [
                        'id' => $order['reference'] ?? ('#' . str_pad((string) ($index + 1), 4, '0', STR_PAD_LEFT)),
                        'reference' => $order['reference'] ?? ('#' . str_pad((string) ($index + 1), 4, '0', STR_PAD_LEFT)),
                        'customer_key' => strtolower($account['email'] ?? ''),
                        'customer_email' => strtolower($account['email'] ?? ''),
                        'customer' => $customerName,
                        'initials' => $initials !== '' ? $initials : 'NA',
                        'value_raw' => $value,
                        'value' => 'PHP ' . number_format($value, 2),
                        'status' => $status,
                        'status_label' => $this->orderStatusLabel($status),
                        'status_classes' => $this->orderStatusClasses($status),
                        'created_at_iso' => $order['created_at_iso'] ?? null,
                        'created_at' => $order['created_at'] ?? 'Recent',
                        'items_count' => count($order['items'] ?? []),
                        'item_names' => collect($order['items'] ?? [])->pluck('name')->filter()->values()->all(),
                    ];
                });
            })
            ->sortByDesc(fn (array $transaction) => $transaction['created_at_iso'] ?? '')
            ->values();

        $totalOrders = $transactions->count();
        $totalRevenue = $transactions->sum('value_raw');
        $pendingOrders = $transactions->whereIn('status', ['processing', 'in_transit', 'shipped'])->count();
        $completedOrders = $transactions->where('status', 'delivered')->count();
        $customerCount = count($customerAccounts);
        $newestCustomer = collect($customerAccounts)->sortByDesc('member_since')->first();
        $liveNode = strtoupper(str_replace(['.', '-', ':'], '_', parse_url(config('app.url'), PHP_URL_HOST) ?: 'localhost'));
        $completionRate = $totalOrders > 0 ? (int) round(($completedOrders / $totalOrders) * 100) : 0;
        $averageOrderValue = $totalOrders > 0 ? (int) round($totalRevenue / $totalOrders) : 0;
        $uploadedProducts = collect($customProducts)
            ->map(fn (array $product, string $slug) => array_merge($product, ['slug' => $slug]))
            ->sortByDesc('sort_order')
            ->values();

        $categoryCounts = collect($allProducts)
            ->groupBy(fn (array $product) => $product['category'] ?? 'uncategorized')
            ->map(fn ($products, $category) => [
                'category' => strtoupper((string) $category),
                'count' => $products->count(),
                'share' => count($allProducts) > 0 ? (int) round(($products->count() / count($allProducts)) * 100) : 0,
            ])
            ->values();

        $statusBreakdown = collect($this->allowedOrderStatuses())
            ->map(function (string $status) use ($transactions, $totalOrders) {
                $count = $transactions->where('status', $status)->count();

                return [
                    'status' => $status,
                    'label' => strtoupper($this->orderStatusLabel($status)),
                    'count' => $count,
                    'share' => $totalOrders > 0 ? (int) round(($count / $totalOrders) * 100) : 0,
                    'classes' => $this->orderStatusClasses($status),
                ];
            })
            ->values();

        $topCustomers = collect($customerAccounts)
            ->map(function (array $account) {
                $orders = collect($account['orders'] ?? []);
                $totalSpent = $orders->sum(fn (array $order) => $order['total_value'] ?? (int) preg_replace('/[^\d]/', '', (string) ($order['total'] ?? '0')));

                return [
                    'full_name' => $account['full_name'] ?? 'Unknown Customer',
                    'email' => strtolower($account['email'] ?? ''),
                    'orders_count' => $orders->count(),
                    'total_spent' => $totalSpent,
                    'member_since' => $account['member_since'] ?? now()->toIso8601String(),
                ];
            })
            ->sortByDesc('total_spent')
            ->take(5)
            ->values();

        $sourceData = [
            ['ORDERS_PENDING', $totalOrders > 0 ? round(($pendingOrders / max($totalOrders, 1)) * 100) . '%' : '0%', 'bg-primary-container', 'text-white'],
            ['ORDERS_COMPLETE', $totalOrders > 0 ? round(($completedOrders / max($totalOrders, 1)) * 100) . '%' : '0%', 'bg-secondary', 'text-secondary'],
            ['CUSTOMER_BASE', $customerCount > 0 ? '100%' : '0%', 'bg-on-surface-variant', 'text-on-surface-variant'],
        ];

        $recentLogs = collect()
            ->merge(collect($adminAccounts)->map(function (array $account) {
                return [
                    'type' => 'ADMIN_REGISTERED',
                    'title' => strtoupper($account['full_name'] ?? 'Admin account created'),
                    'meta' => strtolower($account['email'] ?? ''),
                    'timestamp' => $account['created_at'] ?? null,
                    'accent' => 'text-secondary',
                ];
            }))
            ->merge(collect($customerAccounts)->map(function (array $account) {
                return [
                    'type' => 'CUSTOMER_REGISTERED',
                    'title' => strtoupper($account['full_name'] ?? 'Customer account created'),
                    'meta' => strtolower($account['email'] ?? ''),
                    'timestamp' => $account['member_since'] ?? null,
                    'accent' => 'text-primary-container',
                ];
            }))
            ->merge(collect($customProducts)->flatMap(function (array $product, string $slug) {
                $logs = [];

                if (! empty($product['uploaded_at'])) {
                    $logs[] = [
                        'type' => 'PRODUCT_PUBLISHED',
                        'title' => strtoupper($product['name'] ?? $slug),
                        'meta' => strtoupper($product['category'] ?? 'PRODUCT'),
                        'timestamp' => $product['uploaded_at'],
                        'accent' => 'text-tertiary-container',
                    ];
                }

                if (! empty($product['updated_at'])) {
                    $logs[] = [
                        'type' => 'PRODUCT_UPDATED',
                        'title' => strtoupper($product['name'] ?? $slug),
                        'meta' => strtoupper($product['category'] ?? 'PRODUCT'),
                        'timestamp' => $product['updated_at'],
                        'accent' => 'text-secondary',
                    ];
                }

                return $logs;
            }))
            ->merge($transactions->map(function (array $transaction) {
                return [
                    'type' => 'ORDER_CREATED',
                    'title' => strtoupper($transaction['reference']),
                    'meta' => strtoupper($transaction['customer']) . ' / ' . $transaction['value'],
                    'timestamp' => $transaction['created_at_iso'],
                    'accent' => 'text-primary-container',
                ];
            }))
            ->filter(fn (array $log) => ! empty($log['timestamp']))
            ->sortByDesc('timestamp')
            ->take(20)
            ->values()
            ->map(function (array $log) {
                $log['display_time'] = ! empty($log['timestamp'])
                    ? \Carbon\Carbon::parse($log['timestamp'])->timezone(config('app.timezone'))->format('M d, Y h:i A')
                    : 'RECENT';

                return $log;
            });

        return compact(
            'transactions',
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'completedOrders',
            'customerCount',
            'newestCustomer',
            'liveNode',
            'completionRate',
            'averageOrderValue',
            'uploadedProducts',
            'categoryCounts',
            'statusBreakdown',
            'topCustomers',
            'sourceData',
            'recentLogs',
            'allProducts',
            'customProducts',
            'customerAccounts',
            'adminAccounts',
        );
    }

    private function rememberCookieName(): string
    {
        return 'threadlab_remember';
    }

    private function defaultShippingAddress(): array
    {
        return [
            'first_name' => '',
            'last_name' => '',
            'street_address' => '',
            'city' => '',
            'zip_code' => '',
            'phone' => '',
            'shipping_method' => 'standard',
        ];
    }

    private function customerSessionPayload(array $account): array
    {
        return [
            'full_name' => $account['full_name'],
            'email' => $account['email'],
            'member_since' => $account['member_since'],
        ];
    }

    private function syncSessionCustomer(Request $request, array $account): array
    {
        $sessionCustomer = $this->customerSessionPayload($account);
        $request->session()->put('customer', $sessionCustomer);

        return $sessionCustomer;
    }

    private function queueRememberCookie(string $email, array &$accounts): void
    {
        $emailKey = strtolower($email);

        if (! isset($accounts[$emailKey])) {
            return;
        }

        $token = Str::random(60);
        $accounts[$emailKey]['remember_token'] = $token;
        Cookie::queue(cookie($this->rememberCookieName(), $emailKey . '|' . $token, 60 * 24 * 30));
    }

    private function forgetRememberCookie(string $email, array &$accounts): void
    {
        $emailKey = strtolower($email);

        if (isset($accounts[$emailKey])) {
            $accounts[$emailKey]['remember_token'] = null;
        }

        Cookie::queue(Cookie::forget($this->rememberCookieName()));
    }

    private function currentCustomer(Request $request): ?array
    {
        $sessionCustomer = $request->session()->get('customer');
        $accounts = $this->customerAccounts($request);

        if ($sessionCustomer) {
            $emailKey = strtolower($sessionCustomer['email']);

            if (isset($accounts[$emailKey])) {
                return $this->syncSessionCustomer($request, $accounts[$emailKey]);
            }
        }

        $rememberValue = $request->cookie($this->rememberCookieName());

        if ($rememberValue && str_contains($rememberValue, '|')) {
            [$emailKey, $token] = explode('|', $rememberValue, 2);
            $account = $accounts[$emailKey] ?? null;

            if ($account && ! empty($account['remember_token']) && hash_equals($account['remember_token'], $token)) {
                return $this->syncSessionCustomer($request, $account);
            }
        }

        return null;
    }

    private function currentCustomerKey(Request $request): ?string
    {
        $customer = $this->currentCustomer($request);

        return $customer ? strtolower($customer['email']) : null;
    }

    private function customerAccounts(Request $request): array
    {
        if (! Storage::disk('local')->exists('customer_accounts.json')) {
            return [];
        }

        $accounts = json_decode(Storage::disk('local')->get('customer_accounts.json'), true);

        return is_array($accounts) ? $accounts : [];
    }

    private function storeCustomerAccounts(Request $request, array $accounts): void
    {
        Storage::disk('local')->put('customer_accounts.json', json_encode($accounts, JSON_PRETTY_PRINT));
    }

    private function adminAccounts(): array
    {
        if (! Storage::disk('local')->exists('admin_accounts.json')) {
            return [];
        }

        $accounts = json_decode(Storage::disk('local')->get('admin_accounts.json'), true);

        return is_array($accounts) ? $accounts : [];
    }

    private function storeAdminAccounts(array $accounts): void
    {
        Storage::disk('local')->put('admin_accounts.json', json_encode($accounts, JSON_PRETTY_PRINT));
    }

    private function currentAdmin(Request $request): ?array
    {
        $admin = $request->session()->get('admin');

        if (! $admin) {
            return null;
        }

        $accounts = $this->adminAccounts();
        $adminKey = strtolower($admin['email'] ?? '');

        if ($adminKey === '' || ! isset($accounts[$adminKey])) {
            $request->session()->forget('admin');

            return null;
        }

        return $accounts[$adminKey];
    }

    private function rawCart(Request $request): array
    {
        $customerKey = $this->currentCustomerKey($request);

        if (! $customerKey) {
            return $request->session()->get('guest_cart', []);
        }

        $accounts = $this->customerAccounts($request);

        return $accounts[$customerKey]['cart'] ?? [];
    }

    private function cartItems(Request $request): array
    {
        return array_values($this->rawCart($request));
    }

    private function storeCart(Request $request, array $cart): void
    {
        $customerKey = $this->currentCustomerKey($request);

        if (! $customerKey) {
            $request->session()->put('guest_cart', $cart);
            return;
        }

        $accounts = $this->customerAccounts($request);

        if (! isset($accounts[$customerKey])) {
            return;
        }

        $accounts[$customerKey]['cart'] = $cart;
        $this->storeCustomerAccounts($request, $accounts);
    }

    private function customerOrders(Request $request): array
    {
        $customerKey = $this->currentCustomerKey($request);

        if (! $customerKey) {
            return [];
        }

        $accounts = $this->customerAccounts($request);

        return $accounts[$customerKey]['orders'] ?? [];
    }

    private function storeCustomerOrders(Request $request, array $orders): void
    {
        $customerKey = $this->currentCustomerKey($request);

        if (! $customerKey) {
            return;
        }

        $accounts = $this->customerAccounts($request);

        if (! isset($accounts[$customerKey])) {
            return;
        }

        $accounts[$customerKey]['orders'] = $orders;
        $this->storeCustomerAccounts($request, $accounts);
    }

    private function cartSubtotal(array $cartItems): int
    {
        return collect($cartItems)->sum(fn ($item) => $item['price'] * $item['quantity']);
    }

    private function shippingFee(string $shippingMethod, int $subtotal): int
    {
        if ($subtotal <= 0) {
            return 0;
        }

        return $shippingMethod === 'express' ? 300 : 100;
    }

    public function index()
    {
        $featuredProducts = collect($this->products())
            ->map(fn ($product, $slug) => array_merge($product, ['slug' => $slug]))
            ->sortBy('sort_order')
            ->take(5)
            ->values();

        return view('home', compact('featuredProducts'));
    }

    public function contact()
    {
        $faqs = [
            [
                'question' => 'Shipping Times',
                'answer' => 'Domestic orders ship within 48 hours via Kinetic Priority. International delivery ranges from 5-9 business days depending on customs processing in your region. All orders include encrypted tracking.',
            ],
            [
                'question' => 'Drop Notifications',
                'answer' => 'Join our Discord Registry or follow our X feed for millisecond-accurate drop timing. Email subscribers receive access codes 10 minutes prior to public release.',
            ],
            [
                'question' => 'Return Policy',
                'answer' => 'Returns are accepted within 7 days of delivery for store credit only. Garments must be in original condition with all technical tags and holographic authenticity stickers intact.',
            ],
        ];

        return view('contact', compact('faqs'));
    }

    public function shop(Request $request)
    {
        $selectedCategory = $request->query('category', 'all');
        $selectedSort = $request->query('sort', 'newest');
        $allowedCategories = ['all', 'basic', 'oversized', 'minimal'];
        $allowedSorts = ['newest', 'price-low', 'price-high'];

        if (! in_array($selectedCategory, $allowedCategories, true)) {
            $selectedCategory = 'all';
        }

        if (! in_array($selectedSort, $allowedSorts, true)) {
            $selectedSort = 'newest';
        }

        $products = collect($this->products())
            ->map(fn ($product, $slug) => array_merge($product, ['slug' => $slug]));

        if ($selectedCategory !== 'all') {
            $products = $products->where('category', $selectedCategory);
        }

        $products = (match ($selectedSort) {
            'price-low' => $products->sortBy('price'),
            'price-high' => $products->sortByDesc('price'),
            default => $products->sortBy('sort_order'),
        })->values();

        return view('shop', compact('products', 'selectedCategory', 'selectedSort'));
    }

    public function product(string $slug)
    {
        $products = $this->products();

        abort_unless(isset($products[$slug]), 404);

        $relatedProducts = collect($products)
            ->map(fn ($product, $relatedSlug) => array_merge($product, ['slug' => $relatedSlug]))
            ->reject(fn ($product) => $product['slug'] === $slug)
            ->sortBy('sort_order')
            ->take(3)
            ->values();

        return view('product', [
            'product' => $products[$slug],
            'slug' => $slug,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function addToCart(Request $request, string $slug)
    {
        $products = $this->products();

        abort_unless(isset($products[$slug]), 404);

        $validated = $request->validate([
            'size' => ['required', 'in:S,M,L,XL'],
            'quantity' => ['required', 'integer', 'min:1', 'max:10'],
            'redirect_to' => ['nullable', 'in:cart,checkout'],
        ]);

        $product = $products[$slug];
        $key = $slug . ':' . $validated['size'];
        $cart = $this->rawCart($request);

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $validated['quantity'];
        } else {
            $cart[$key] = [
                'key' => $key,
                'slug' => $slug,
                'name' => $product['name'],
                'sku' => $product['sku'],
                'size' => $validated['size'],
                'quantity' => $validated['quantity'],
                'price' => $product['price'],
                'image' => $product['image'],
            ];
        }

        $this->storeCart($request, $cart);

        $redirectRoute = $validated['redirect_to'] ?? 'cart';

        return redirect()->route($redirectRoute)->with('status', $product['name'] . ' added to your cart.');
    }

    public function removeFromCart(Request $request, string $key)
    {
        $cart = $this->rawCart($request);
        unset($cart[$key]);
        $this->storeCart($request, $cart);

        return redirect()->route('cart')->with('status', 'Item removed from your cart.');
    }

    public function updateCartQuantity(Request $request, string $key)
    {
        $validated = $request->validate([
            'action' => ['required', 'in:increase,decrease'],
        ]);

        $cart = $this->rawCart($request);

        if (! isset($cart[$key])) {
            return redirect()->route('cart')->with('status', 'Cart item not found.');
        }

        $currentQuantity = $cart[$key]['quantity'];
        $nextQuantity = $validated['action'] === 'increase'
            ? min($currentQuantity + 1, 10)
            : max($currentQuantity - 1, 0);

        if ($nextQuantity === 0) {
            unset($cart[$key]);
            $this->storeCart($request, $cart);

            return redirect()->route('cart')->with('status', 'Item removed from your cart.');
        }

        $cart[$key]['quantity'] = $nextQuantity;
        $this->storeCart($request, $cart);

        return redirect()->route('cart');
    }

    public function cart(Request $request)
    {
        $cartItems = $this->cartItems($request);
        $subtotal = $this->cartSubtotal($cartItems);
        $shipping = $subtotal > 0 ? 100 : 0;
        $total = $subtotal + $shipping;

        return view('cart', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    public function checkout(Request $request)
    {
        $customer = $this->currentCustomer($request);
        $orderItems = $this->cartItems($request);
        $subtotal = $this->cartSubtotal($orderItems);
        $shippingAddress = $customer ? ($this->customerAccounts($request)[strtolower($customer['email'])]['shipping_address'] ?? $this->defaultShippingAddress()) : $this->defaultShippingAddress();
        $fullNameParts = preg_split('/\s+/', trim($customer['full_name'] ?? ''), 2);
        $shippingAddress['first_name'] = $shippingAddress['first_name'] !== '' ? $shippingAddress['first_name'] : ($fullNameParts[0] ?? '');
        $shippingAddress['last_name'] = $shippingAddress['last_name'] !== '' ? $shippingAddress['last_name'] : ($fullNameParts[1] ?? '');
        $shippingMethod = $shippingAddress['shipping_method'] ?? 'standard';
        $shipping = $this->shippingFee($shippingMethod, $subtotal);
        $total = $subtotal + $shipping;

        return view('checkout', compact('orderItems', 'subtotal', 'shipping', 'total', 'shippingMethod', 'shippingAddress', 'customer'));
    }

    public function completeCheckout(Request $request)
    {
        $customer = $this->currentCustomer($request);

        if (! $customer) {
            return redirect()->route('customer.login')->with('status', 'Please log in before completing checkout.');
        }

        $orderItems = $this->cartItems($request);

        if ($orderItems === []) {
            return redirect()->route('cart')->with('status', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'shipping_method' => ['required', 'in:standard,express'],
            'payment_method' => ['nullable', 'in:card,cod'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'street_address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:30'],
        ]);

        $subtotal = $this->cartSubtotal($orderItems);
        $shipping = $this->shippingFee($validated['shipping_method'], $subtotal);
        $total = $subtotal + $shipping;

        $order = [
            'reference' => 'TL-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 8)),
            'total' => 'PHP ' . number_format($total),
            'total_value' => $total,
            'paymentMethod' => ($validated['payment_method'] ?? 'card') === 'cod' ? 'Cash on Delivery' : 'Credit / Debit Card',
            'shippingMethod' => $validated['shipping_method'] === 'express' ? 'Express' : 'Standard',
            'status' => 'processing',
            'items' => $orderItems,
            'created_at' => now()->format('M Y'),
            'created_at_iso' => now()->toIso8601String(),
        ];

        $orders = $this->customerOrders($request);
        array_unshift($orders, $order);

        $accounts = $this->customerAccounts($request);
        $customerKey = strtolower($customer['email']);
        $accounts[$customerKey]['shipping_address'] = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'street_address' => $validated['street_address'],
            'city' => $validated['city'],
            'zip_code' => $validated['zip_code'],
            'phone' => $validated['phone'],
            'shipping_method' => $validated['shipping_method'],
        ];
        $this->storeCustomerAccounts($request, $accounts);

        $this->storeCustomerOrders($request, $orders);
        $this->storeCart($request, []);
        $request->session()->flash('latest_order', $order);

        return redirect()->route('order.success');
    }

    public function dashboard(Request $request)
    {
        $customer = $this->currentCustomer($request);

        if (! $customer) {
            return redirect()->route('customer.login')->with('status', 'Log in or create an account to access your dashboard.');
        }

        $products = $this->products();
        $accounts = $this->customerAccounts($request);
        $account = $accounts[strtolower($customer['email'])];
        $orders = $this->customerOrders($request);
        $rewardBalance = collect($orders)->sum(function ($order) {
            return collect($order['items'])->sum(fn ($item) => $item['price'] * $item['quantity']);
        });
        $orderCount = count($orders);
        $totalItemsPurchased = collect($orders)->sum(function ($order) {
            return collect($order['items'])->sum('quantity');
        });
        $xp = min($rewardBalance, 5000);
        $xpPercent = (int) round(($xp / 5000) * 100);
        $memberSince = $customer['member_since'];
        $latestOrder = $orders[0] ?? null;
        $orderedSlugs = collect($orders)
            ->flatMap(fn ($order) => collect($order['items'])->pluck('slug'))
            ->unique()
            ->values();
        $recommendedSlug = collect(array_keys($products))->first(fn ($slug) => ! $orderedSlugs->contains($slug)) ?? array_key_first($products);
        $recommendedProduct = $products[$recommendedSlug];
        $shippingAddress = $account['shipping_address'] ?? $this->defaultShippingAddress();

        return view('dashboard', compact(
            'customer',
            'orders',
            'rewardBalance',
            'xp',
            'xpPercent',
            'memberSince',
            'orderCount',
            'totalItemsPurchased',
            'latestOrder',
            'recommendedProduct',
            'recommendedSlug',
            'shippingAddress',
        ));
    }

    public function orderSuccess(Request $request)
    {
        $order = $request->session()->get('latest_order', [
            'reference' => 'TL-T0QY7QW8',
            'total' => 'PHP 1,698',
            'paymentMethod' => 'Cash on Delivery',
        ]);

        return view('order-success', [
            'reference' => $order['reference'],
            'total' => $order['total'],
            'paymentMethod' => $order['paymentMethod'],
        ]);
    }

    public function customerLogin(Request $request)
    {
        if ($this->currentCustomer($request)) {
            return redirect()->route('dashboard');
        }

        return view('customer-login');
    }

    public function customerLoginSubmit(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $accounts = $this->customerAccounts($request);
        $account = $accounts[strtolower($validated['email'])] ?? null;

        if (! $account || ! password_verify($validated['password'], $account['password_hash'])) {
            return back()->withInput(['email' => $validated['email']])->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        $this->syncSessionCustomer($request, $account);

        if ($request->boolean('remember-me')) {
            $this->queueRememberCookie($account['email'], $accounts);
            $this->storeCustomerAccounts($request, $accounts);
        }

        return redirect()->route('dashboard');
    }

    public function customerRegister(Request $request)
    {
        if ($this->currentCustomer($request)) {
            return redirect()->route('dashboard');
        }

        return view('customer-register');
    }

    public function customerRegisterSubmit(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'same:confirm_password'],
            'confirm_password' => ['required', 'string'],
        ]);

        $accounts = $this->customerAccounts($request);
        $emailKey = strtolower($validated['email']);

        if (isset($accounts[$emailKey])) {
            return back()->withInput(['full_name' => $validated['full_name'], 'email' => $validated['email']])->withErrors([
                'email' => 'An account with this email already exists.',
            ]);
        }

        $account = [
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'password_hash' => password_hash($validated['password'], PASSWORD_DEFAULT),
            'member_since' => now()->format('M Y'),
            'cart' => [],
            'orders' => [],
            'shipping_address' => $this->defaultShippingAddress(),
            'remember_token' => null,
        ];

        $accounts[$emailKey] = $account;
        $this->storeCustomerAccounts($request, $accounts);
        $this->syncSessionCustomer($request, $account);

        return redirect()->route('dashboard');
    }

    public function updateAccount(Request $request)
    {
        $customer = $this->currentCustomer($request);

        if (! $customer) {
            return redirect()->route('customer.login')->with('status', 'Please log in to update your account.');
        }

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'street_address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'zip_code' => ['nullable', 'string', 'max:20'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $accounts = $this->customerAccounts($request);
        $customerKey = strtolower($customer['email']);

        if (! isset($accounts[$customerKey])) {
            return redirect()->route('dashboard')->with('status', 'Account not found.');
        }

        $existingAddress = $accounts[$customerKey]['shipping_address'] ?? $this->defaultShippingAddress();
        $fullNameParts = preg_split('/\s+/', trim($validated['full_name']), 2);

        $accounts[$customerKey]['full_name'] = $validated['full_name'];
        $accounts[$customerKey]['shipping_address'] = [
            'first_name' => $fullNameParts[0] ?? '',
            'last_name' => $fullNameParts[1] ?? '',
            'street_address' => $validated['street_address'] ?? '',
            'city' => $validated['city'] ?? '',
            'zip_code' => $validated['zip_code'] ?? '',
            'phone' => $validated['phone'] ?? '',
            'shipping_method' => $existingAddress['shipping_method'] ?? 'standard',
        ];

        $this->storeCustomerAccounts($request, $accounts);
        $this->syncSessionCustomer($request, $accounts[$customerKey]);

        return redirect()->route('dashboard')->with('status', 'Your account details have been updated.');
    }

    public function autosaveCheckoutProfile(Request $request)
    {
        $customer = $this->currentCustomer($request);

        if (! $customer) {
            return response()->json(['saved' => false, 'message' => 'Authentication required.'], 401);
        }

        $validated = $request->validate([
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'street_address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'zip_code' => ['nullable', 'string', 'max:20'],
            'phone' => ['nullable', 'string', 'max:30'],
            'shipping_method' => ['nullable', 'in:standard,express'],
        ]);

        $accounts = $this->customerAccounts($request);
        $customerKey = strtolower($customer['email']);

        if (! isset($accounts[$customerKey])) {
            return response()->json(['saved' => false, 'message' => 'Account not found.'], 404);
        }

        $existingAddress = $accounts[$customerKey]['shipping_address'] ?? $this->defaultShippingAddress();
        $firstName = trim((string) ($validated['first_name'] ?? $existingAddress['first_name'] ?? ''));
        $lastName = trim((string) ($validated['last_name'] ?? $existingAddress['last_name'] ?? ''));
        $fullName = trim($firstName . ' ' . $lastName);

        $accounts[$customerKey]['shipping_address'] = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'street_address' => trim((string) ($validated['street_address'] ?? $existingAddress['street_address'] ?? '')),
            'city' => trim((string) ($validated['city'] ?? $existingAddress['city'] ?? '')),
            'zip_code' => trim((string) ($validated['zip_code'] ?? $existingAddress['zip_code'] ?? '')),
            'phone' => trim((string) ($validated['phone'] ?? $existingAddress['phone'] ?? '')),
            'shipping_method' => $validated['shipping_method'] ?? ($existingAddress['shipping_method'] ?? 'standard'),
        ];

        if ($fullName !== '') {
            $accounts[$customerKey]['full_name'] = $fullName;
        }

        $this->storeCustomerAccounts($request, $accounts);
        $this->syncSessionCustomer($request, $accounts[$customerKey]);

        return response()->json([
            'saved' => true,
            'full_name' => $accounts[$customerKey]['full_name'],
            'shipping_address' => $accounts[$customerKey]['shipping_address'],
        ]);
    }

    public function customerLogout(Request $request)
    {
        $customer = $this->currentCustomer($request);
        $accounts = $this->customerAccounts($request);

        if ($customer) {
            $this->forgetRememberCookie($customer['email'], $accounts);
            $this->storeCustomerAccounts($request, $accounts);
        }

        $request->session()->forget('customer');

        return redirect()->route('customer.login')->with('status', 'You have been logged out.');
    }

    public function adminLogin(Request $request)
    {
        if ($this->currentAdmin($request)) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin-login');
    }

    public function adminLoginSubmit(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $accounts = $this->adminAccounts();
        $account = $accounts[strtolower($validated['email'])] ?? null;

        if (! $account || ! password_verify($validated['password'], $account['password_hash'])) {
            return back()->withInput(['email' => $validated['email']])->withErrors([
                'email' => 'The provided admin credentials do not match our records.',
            ]);
        }

        $request->session()->put('admin', [
            'full_name' => $account['full_name'],
            'email' => $account['email'],
            'created_at' => $account['created_at'],
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function adminRegister(Request $request)
    {
        if ($this->currentAdmin($request)) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin-register');
    }

    public function adminRegisterSubmit(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'same:confirm_password'],
            'confirm_password' => ['required', 'string'],
        ]);

        $accounts = $this->adminAccounts();
        $adminKey = strtolower($validated['email']);

        if (isset($accounts[$adminKey])) {
            return back()->withInput(['full_name' => $validated['full_name'], 'email' => $validated['email']])->withErrors([
                'email' => 'An admin account with this email already exists.',
            ]);
        }

        $account = [
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'password_hash' => password_hash($validated['password'], PASSWORD_DEFAULT),
            'created_at' => now()->toIso8601String(),
        ];

        $accounts[$adminKey] = $account;
        $this->storeAdminAccounts($accounts);

        $request->session()->put('admin', [
            'full_name' => $account['full_name'],
            'email' => $account['email'],
            'created_at' => $account['created_at'],
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function adminDashboard(Request $request)
    {
        $admin = $this->currentAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.login')->with('status', 'Please log in to access the admin dashboard.');
        }

        return view('admin-dashboard', array_merge(
            ['admin' => $admin],
            $this->adminSnapshot($request),
        ));
    }

    public function adminAnalytics(Request $request)
    {
        $admin = $this->currentAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.login')->with('status', 'Please log in to access analytics.');
        }

        return view('admin-analytics', array_merge(
            ['admin' => $admin],
            $this->adminSnapshot($request),
        ));
    }

    public function adminProducts(Request $request)
    {
        $admin = $this->currentAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.login')->with('status', 'Please log in to manage products.');
        }

        $products = collect($this->products())
            ->map(function (array $product, string $slug) {
                return array_merge($product, [
                    'slug' => $slug,
                    'is_custom' => array_key_exists($slug, $this->customProducts()),
                ]);
            })
            ->sortBy('sort_order')
            ->values();

        return view('admin-products-index', compact('admin', 'products'));
    }

    public function adminTransactions(Request $request)
    {
        $admin = $this->currentAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.login')->with('status', 'Please log in to view transactions.');
        }

        return view('admin-transactions', array_merge(
            ['admin' => $admin],
            $this->adminSnapshot($request),
        ));
    }

    public function adminSystemLogs(Request $request)
    {
        $admin = $this->currentAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.login')->with('status', 'Please log in to view system logs.');
        }

        return view('admin-system-logs', array_merge(
            ['admin' => $admin],
            $this->adminSnapshot($request),
        ));
    }

    public function adminCreateProduct(Request $request)
    {
        $admin = $this->currentAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.login')->with('status', 'Please log in to add products.');
        }

        return view('admin-product-form', [
            'admin' => $admin,
            'mode' => 'create',
            'product' => null,
            'slug' => null,
        ]);
    }

    public function adminStoreProduct(Request $request)
    {
        $admin = $this->currentAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.login')->with('status', 'Please log in to upload products.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:1'],
            'category' => ['required', 'in:basic,oversized,minimal'],
            'description' => ['required', 'string', 'max:1500'],
            'sizes' => ['required', 'array', 'min:1'],
            'sizes.*' => ['in:S,M,L,XL'],
            'featured_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'gallery_images' => ['nullable', 'array', 'max:4'],
            'gallery_images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $slug = Str::slug($validated['title']);
        $existingProducts = $this->products();

        if ($slug === '' || isset($existingProducts[$slug])) {
            $slug = Str::slug($validated['title']) . '-' . strtolower(Str::random(4));
        }

        $presentation = $this->categoryPresentation($validated['category']);
        $featuredImage = $this->storeUploadedProductImage($request->file('featured_image'), $slug, 'featured');
        $gallery = [];

        foreach ($request->file('gallery_images', []) as $index => $image) {
            $gallery[] = $this->storeUploadedProductImage($image, $slug, 'gallery-' . ($index + 1));
        }

        $customProducts = $this->customProducts();
        $sortOrder = collect($this->products())->max('sort_order') + 1;
        $baseSkuNumber = str_pad((string) (count($this->products()) + 1), 3, '0', STR_PAD_LEFT);
        $skuSuffix = strtoupper(Str::substr($validated['category'], 0, 1));

        $customProducts[$slug] = [
            'name' => $validated['title'],
            'sku' => 'TL-' . $baseSkuNumber . '-' . $skuSuffix,
            'price' => (int) round($validated['price']),
            'compare_price' => (int) round($validated['price'] * 1.25),
            'tag' => $presentation['tag'],
            'category' => $validated['category'],
            'sort_order' => $sortOrder,
            'image' => $featuredImage,
            'description' => $validated['description'],
            'eyebrow' => $presentation['eyebrow'],
            'access_badge' => $presentation['access_badge'],
            'materials' => 'Premium cotton studio fabrication selected for everyday wear and clean structure.',
            'fit_notes' => 'Sized for a balanced editorial silhouette with a comfortable everyday drape.',
            'sizes' => array_values(array_unique($validated['sizes'])),
            'gallery' => array_slice($gallery, 0, 4),
            'highlights' => [
                'Uploaded and managed directly from the admin catalog',
                'Prepared for storefront display with multiple gallery views',
            ],
            'uploaded_at' => now()->toIso8601String(),
        ];

        $this->storeCustomProducts($customProducts);

        return redirect()->route('admin.products.index')->with('status', 'Product uploaded successfully.');
    }

    public function adminEditProduct(Request $request, string $slug)
    {
        $admin = $this->currentAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.login')->with('status', 'Please log in to edit products.');
        }

        $products = $this->products();
        abort_unless(isset($products[$slug]), 404);

        return view('admin-product-form', [
            'admin' => $admin,
            'mode' => 'edit',
            'product' => $products[$slug],
            'slug' => $slug,
        ]);
    }

    public function adminUpdateProduct(Request $request, string $slug)
    {
        $admin = $this->currentAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.login')->with('status', 'Please log in to update products.');
        }

        $existingProducts = $this->products();
        abort_unless(isset($existingProducts[$slug]), 404);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:1'],
            'category' => ['required', 'in:basic,oversized,minimal'],
            'description' => ['required', 'string', 'max:1500'],
            'sizes' => ['required', 'array', 'min:1'],
            'sizes.*' => ['in:S,M,L,XL'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'gallery_images' => ['nullable', 'array', 'max:4'],
            'gallery_images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_gallery' => ['nullable', 'array'],
            'remove_gallery.*' => ['integer', 'min:0'],
        ]);

        $currentProduct = $existingProducts[$slug];
        $presentation = $this->categoryPresentation($validated['category']);
        $customProducts = $this->customProducts();

        $featuredImage = $currentProduct['image'];
        if ($request->hasFile('featured_image')) {
            $featuredImage = $this->storeUploadedProductImage($request->file('featured_image'), $slug, 'featured');
        }

        $gallery = array_values($currentProduct['gallery'] ?? []);

        $removeGalleryIndexes = collect($validated['remove_gallery'] ?? [])
            ->map(fn ($index) => (int) $index)
            ->filter(fn ($index) => $index >= 0)
            ->unique()
            ->sortDesc()
            ->values();

        foreach ($removeGalleryIndexes as $index) {
            unset($gallery[$index]);
        }

        $gallery = array_values($gallery);
        foreach ($request->file('gallery_images', []) as $index => $image) {
            $gallery[] = $this->storeUploadedProductImage($image, $slug, 'gallery-' . ($index + 1));
        }

        $customProducts[$slug] = [
            'name' => $validated['title'],
            'sku' => $currentProduct['sku'] ?? ('TL-' . strtoupper(Str::random(3))),
            'price' => (int) round($validated['price']),
            'compare_price' => (int) round(max($validated['price'] * 1.25, $validated['price'])),
            'tag' => $presentation['tag'],
            'category' => $validated['category'],
            'sort_order' => $currentProduct['sort_order'] ?? (collect($this->products())->max('sort_order') + 1),
            'image' => $featuredImage,
            'description' => $validated['description'],
            'eyebrow' => $presentation['eyebrow'],
            'access_badge' => $presentation['access_badge'],
            'materials' => $currentProduct['materials'] ?? 'Premium cotton studio fabrication selected for everyday wear and clean structure.',
            'fit_notes' => $currentProduct['fit_notes'] ?? 'Sized for a balanced editorial silhouette with a comfortable everyday drape.',
            'sizes' => array_values(array_unique($validated['sizes'])),
            'gallery' => array_slice($gallery, 0, 4),
            'highlights' => $currentProduct['highlights'] ?? [
                'Managed directly from the admin catalog',
                'Prepared for storefront display with multiple gallery views',
            ],
            'uploaded_at' => $currentProduct['uploaded_at'] ?? now()->toIso8601String(),
            'updated_at' => now()->toIso8601String(),
        ];

        $deletedProducts = array_values(array_diff($this->deletedProducts(), [$slug]));
        $this->storeDeletedProducts($deletedProducts);
        $this->storeCustomProducts($customProducts);

        return redirect()->route('admin.products.index')->with('status', 'Product updated successfully.');
    }

    public function adminDeleteProduct(Request $request, string $slug)
    {
        $admin = $this->currentAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.login')->with('status', 'Please log in to delete products.');
        }

        $products = $this->products();
        abort_unless(isset($products[$slug]), 404);

        $customProducts = $this->customProducts();
        unset($customProducts[$slug]);
        $this->storeCustomProducts($customProducts);

        $baseProducts = $this->baseProducts();
        $deletedProducts = $this->deletedProducts();

        if (isset($baseProducts[$slug])) {
            $deletedProducts[] = $slug;
            $this->storeDeletedProducts($deletedProducts);
        } else {
            $this->storeDeletedProducts(array_values(array_diff($deletedProducts, [$slug])));
        }

        return redirect()->route('admin.products.index')->with('status', 'Product deleted successfully.');
    }

    public function updateAdminOrderStatus(Request $request, string $reference)
    {
        $admin = $this->currentAdmin($request);

        if (! $admin) {
            return redirect()->route('admin.login')->with('status', 'Please log in to manage order statuses.');
        }

        $validated = $request->validate([
            'customer_key' => ['required', 'string'],
            'status' => ['required', 'in:' . implode(',', $this->allowedOrderStatuses())],
        ]);

        $accounts = $this->customerAccounts($request);
        $customerKey = strtolower($validated['customer_key']);

        if (! isset($accounts[$customerKey])) {
            return back()->with('status', 'Customer record not found.');
        }

        $updated = false;
        $accounts[$customerKey]['orders'] = collect($accounts[$customerKey]['orders'] ?? [])
            ->map(function (array $order) use ($reference, $validated, &$updated) {
                if (($order['reference'] ?? null) === $reference) {
                    $order['status'] = $this->normalizeOrderStatus($validated['status']);
                    $updated = true;
                }

                return $order;
            })
            ->all();

        if (! $updated) {
            return back()->with('status', 'Order reference not found.');
        }

        $this->storeCustomerAccounts($request, $accounts);

        return back()->with('status', 'Order status updated successfully.');
    }

    public function adminLogout(Request $request)
    {
        $request->session()->forget('admin');

        return redirect()->route('admin.login')->with('status', 'You have been logged out of the admin dashboard.');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'business_type' => ['required', 'string', 'max:255'],
        ]);

        return 'Generated successfully';
    }
}
