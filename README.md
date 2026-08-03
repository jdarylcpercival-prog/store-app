# THREADLAB Store App

THREADLAB Store App is a Laravel-powered fashion ecommerce prototype with a storefront, cart and checkout flow, customer dashboard, and admin catalog/order management.

The project currently includes:

- editorial-style homepage
- shop and single product pages
- cart and checkout flow
- customer login, registration, and dashboard
- admin login, dashboard, analytics, product create/edit/delete, and order status updates
- local JSON-backed storage for accounts, products, and order activity

## Stack

- Laravel 12
- PHP
- Blade templates
- Tailwind via CDN in the view layer
- local file and JSON persistence for app-managed content

## Project Structure

- `app/Http/Controllers/HomeController.php` - main storefront, account, checkout, and admin logic
- `resources/views/` - all storefront and admin Blade templates
- `routes/web.php` - application routes
- `public/uploads/products/` - uploaded product images used by the storefront
- `storage/app/` - local runtime JSON data for products, accounts, and other app state

## Local Setup

1. Clone the repository.
2. Install PHP dependencies:

```bash
composer install
```

3. Copy the environment file:

```bash
cp .env.example .env
```

On Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

4. Generate the Laravel app key:

```bash
php artisan key:generate
```

5. Update your `.env` values as needed.

At minimum, review:

- `APP_NAME`
- `APP_URL`
- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

6. Start the local server:

```bash
php artisan serve
```

Default local URL:

```text
http://127.0.0.1:8000
```

## Running Tests

```bash
php artisan test
```

## App Routes

### Storefront

- `/` - homepage
- `/shop` - product listing
- `/product/{slug}` - single product page
- `/cart` - cart
- `/checkout` - checkout
- `/order-success` - order confirmation
- `/contact` - contact page

### Customer

- `/login`
- `/register`
- `/dashboard`

### Admin

- `/admin/login`
- `/admin/register`
- `/admin/dashboard`
- `/admin/analytics`
- `/admin/products`
- `/admin/transactions`
- `/admin/system-logs`

## Runtime Data Notes

This project stores some app data in local JSON files under `storage/app/`, including:

- `customer_accounts.json`
- `admin_accounts.json`
- `products.json`
- `deleted_products.json`

These are runtime files, not source-of-truth application code. They should stay out of normal Git commits unless you intentionally want to version seeded app data.

## Deployment Prep

Before deploying, make sure to:

1. set a production `APP_URL`
2. configure production database credentials if you move away from local JSON-only flows
3. review writable folders:
   - `storage/`
   - `bootstrap/cache/`
4. confirm uploaded product images exist on the target server
5. decide whether runtime JSON data should remain file-based or move into database tables

## Recommended Git Workflow

For ongoing work:

1. create a branch for each feature or fix
2. commit small, focused changes
3. push branches to GitHub
4. open pull requests for larger updates

Example:

```bash
git checkout -b codex/contact-page
git add .
git commit -m "Add contact page"
git push -u origin codex/contact-page
```

## Repository

GitHub remote:

[https://github.com/jdarylcpercival-prog/store-app](https://github.com/jdarylcpercival-prog/store-app)
