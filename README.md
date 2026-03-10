# MEEM Gold — Laravel Application

A production-ready Laravel 10.x application converted from a legacy PHP proxy API. Provides an admin dashboard, database-driven content, and API endpoints that preserve the original behavior.

## Requirements

- PHP 8.1+
- Composer 2.x
- Node.js 18+ (for asset building)
- SQLite (default) or MySQL/PostgreSQL

## Setup

> **Quick setup (runs all steps automatically):**
> ```bash
> composer setup
> ```

### 1. Install dependencies

```bash
composer install
npm install
```

### 2. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set:

```env
APP_URL=https://your-domain.com

# Database (SQLite by default)
DB_CONNECTION=sqlite

# Upstream API
MEEM_API_BASE_URL=https://meem.com.my/api/v1

# Gemini AI (for event explanations)
GEMINI_API_KEY=your_gemini_api_key_here
# GEMINI_API_URL=https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent
```

### 3. Create SQLite database (if using SQLite)

```bash
touch database/database.sqlite
```

### 4. Run migrations and seed

```bash
php artisan migrate --seed
```

This creates:
- All tables (users, services, pages, page_sections, branches, endpoint_configs, endpoint_json_overrides, app_settings, event_caches)
- Admin user: `admin@meem.com.my` / `12345678`
- Default services, pages, branches, and endpoint configs

### 5. Build assets

```bash
npm run build
```

### 6. Create storage symlink

```bash
php artisan storage:link
```

### 7. Start development server

```bash
php artisan serve
```

Visit `http://localhost:8000` — you will be redirected to `/login`.

## Admin Credentials

| Field    | Value              |
|----------|--------------------|
| Email    | admin@meem.com.my  |
| Password | 12345678           |

## Routes

### Auth
| Method | URL       | Description          |
|--------|-----------|----------------------|
| GET    | /login    | Login page           |
| POST   | /login    | Authenticate         |
| POST   | /logout   | Logout               |
| GET    | /dashboard| Redirects to admin   |

### Profile (authenticated)
| Method | URL       | Description          |
|--------|-----------|----------------------|
| GET    | /profile  | Edit profile         |
| PATCH  | /profile  | Update profile       |
| DELETE | /profile  | Delete account       |

### Admin (authenticated)
| URL                              | Description               |
|----------------------------------|---------------------------|
| /admin/dashboard                 | Dashboard                 |
| /admin/services                  | Services CRUD             |
| /admin/pages                     | Pages CRUD                |
| /admin/branches                  | Branches CRUD             |
| /admin/endpoint-configs          | Endpoint config viewer    |
| /admin/endpoint-overrides        | JSON override editor      |
| /admin/app-settings              | App settings              |
| /admin/event-caches              | Event cache viewer        |

### API (public)
| Method     | URL                        | Description                      |
|------------|----------------------------|----------------------------------|
| GET\|POST  | /api/customer-profile      | Customer profile proxy           |
| GET        | /api/gss-price-history     | Gold price history               |
| GET        | /api/gss-price-table       | Gold price table (OHLC + events) |
| GET        | /api/widget-more-services  | App services list                |

Query params for `/api/gss-price-table`:
- `filter=1day` — last 24 hours
- `filter=7day` — last 7 days (default)
- `filter=30day` — last 30 days (downsampled)

### WebView (public, mobile-friendly)
| URL                          | Description       |
|------------------------------|-------------------|
| /webview/about-us            | About Us page     |
| /webview/contact-us          | Contact Us + map  |
| /webview/account-closure     | Closure info      |
| /webview/coming-soon         | Coming soon       |
| /webview/shariah-advisor     | Shariah advisory  |

## Dynamic JSON Override System

Admins can override any API endpoint's response without code changes:

1. Go to **Admin → JSON Overrides**
2. Select an endpoint key (e.g., `widget-more-services`)
3. Choose merge strategy:
   - **merge** — override fields are merged into the response
   - **replace** — override completely replaces the response
4. Enter the override JSON
5. Use **Preview Result** to validate before activating
6. Toggle **Enable this override** to activate
7. Use **Reset to Default** to clear the override

## Testing

```bash
php artisan test
# or
composer test
```

## Project Structure

```
api/                 — Legacy PHP proxy files (reference only)
app/
  Http/
    Controllers/
      Admin/       — Admin CRUD controllers
      Api/         — API proxy controllers
      Webview/     — Mobile webview controllers
    Requests/Admin/ — Form validation
  Models/          — Eloquent models (User, Service, Page, PageSection,
                     Branch, EndpointConfig, EndpointJsonOverride,
                     AppSetting, EventCache)
  Services/        — Business logic (CustomerProfile, GssPriceHistory,
                     GssPriceTable, JsonOverride)
config/
  meem.php         — Upstream API config
  services.php     — Gemini AI config
database/
  migrations/      — All table migrations
  seeders/         — Admin user + baseline data
resources/views/
  admin/           — Admin Blade views
  webview/         — Mobile webview Blade pages
  layouts/         — Shared layouts
routes/
  web.php          — Web routes (admin + webview + profile)
  api.php          — API routes
  auth.php         — Breeze authentication routes
public/
  icons/           — Service icons
  webview-assets/  — WebView images
  js/flutter.js    — Flutter WebView bridge
```
