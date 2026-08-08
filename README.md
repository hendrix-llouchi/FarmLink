# 🌾 FarmLink

> A localized farmer-to-buyer marketplace connecting smallholder **tomato farmers in Daboase & Beposo** with **market traders at Takoradi Market Circle**, built with Laravel 10 + Inertia.js + Vue 3.
>
> **Problem solved:** Farmers are forced into distress sales at day's end because buyers appear only when prices crash. FarmLink enables pre-committed, escrow-secured orders — with transport cost agreed upfront — before harvest day ends.

---

## Overview

FarmLink connects **farmers**, **buyers**, and **drivers** in a single monolithic web application. Farmers list produce, buyers place orders, and drivers accept and complete deliveries — all tracked through a unified order lifecycle.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 10 (PHP 8.1) |
| Frontend | Vue 3 + Inertia.js |
| Bundler | Vite 4 |
| Database | MySQL |
| Auth | Laravel Session Auth (phone number identifier) |
| Icons | Lucide / Tabler outline icons (inline SVG) |
| Deployment | Render (production) + XAMPP MySQL (local) |

---

## Roles

| Role | Sub-type | Capabilities |
|---|---|---|
| **Farmer** | — | List produce with harvest date, quality grade, unit & minimum order qty; view dashboard metrics; view incoming orders; request transport |
| **Buyer** | Market Trader 🏪 | Browse marketplace, place wholesale orders, view order history with cost breakdown, rate deliveries |
| **Buyer** | Restaurant / Chop Bar 🍽️ | Same as above |
| **Buyer** | Individual Consumer 🧍 | Same as above |
| **Driver** | Aboboyaa Operator | View available delivery jobs with payout amount, accept, pick up, and complete deliveries; view earnings history & profile |

---

## Modules Implemented

### ✅ Module 1 — Authentication
- Phone-number-based registration and login (no email)
- Role selection at registration: `farmer`, `buyer`, `driver`
- Session-based authentication with role middleware guard
- Redirect-by-role on login (each role lands on their own dashboard)

### ✅ Module 2 — Marketplace Core
- Farmer dashboard: list products with name, category, price, quantity
- Buyer browse page: view all available products with stock filtering
- `ProductController` with farmer-only `store` and buyer-only `buyerBrowse`

### ✅ Module 3 — Order Flow
- Buyers place orders directly from the browse page
- Stock is decremented atomically inside a DB transaction (race-condition safe)
- `MyOrders` page shows the buyer their full order history with statuses

### ✅ Module 4 — Delivery & Feedback
- **Driver Dashboard**: shows available pending jobs + active trips
- Drivers accept a delivery job → order status changes to `processing`
- Drivers mark a job as delivered → order status changes to `delivered`
- **Buyer rating**: after delivery, buyer can submit a 1–5 star rating + comment
- Rating is saved to the `ratings` table; farmer's `average_rating` is recalculated
- Duplicate rating prevention per order

### ✅ Module 5 — Mobile Money & Escrow
- **MoMo Checkout Form**: buyers select a network (MTN / Telecel / AT), enter their MoMo number and 4-digit PIN before an order is placed
- **2-second authorization simulation**: a spinner plays to mimic real MoMo network authorization, followed by a confirmation prompt
- **Escrow hold**: on successful checkout, `payment_status` is set to `escrow_held` — funds are considered locked until delivery
- **Automatic escrow release**: when a driver marks a delivery as complete, `payment_status` transitions to `released` automatically
- **Farmer revenue card**: the Farmer Dashboard now shows a **Total Revenue** metric card displaying only earnings from `released` orders (i.e. confirmed deliveries)
- **Scroll UX fix**: background page scroll is locked while the checkout modal is open; modal content scrolls internally on large viewports

### ✅ Module 6 — Agri-Tech Modern Redesign (Phases 1–5)
- **Phase 1 (Auth)**: Redesigned Login and Register screens with responsive split-screen layouts, color-coded role cards, Forgot Password 6-digit flow, and CSS design tokens setup.
- **Phase 2 (Farmer)**: Redesigned Farmer Dashboard with sidebar navigation (desktop), collapsible tablet sidebar, bottom navigation capsule (mobile), responsive metrics cards, and listing actions.
- **Phase 3 (Buyer)**: Redesigned Buyer Browse with full-width product cards, horizontal category scrollbar filter, seasonal promo banners, slide-up Mobile Money payment drawers, and status-bordered order logs.
- **Phase 4 (Transporter)**: Redesigned Driver Dashboard featuring active trip card progress stages (Farm → Transit → Market), orange "Picked Up" & teal "Delivered" action indicators, nearby jobs list, and bottom navigation.
- **Phase 5 (Shared)**: Redesigned Settings screen (user profile update, password change, platform rating card) and Notifications feed (in-app alerts list, read/unread states, mark single/all as read).

### ✅ Module 7 — MTN MoMo API Integration & Sandbox Command
- **MTN MoMo API Service**: Implemented `MomoApiService.php` to integrate with official MTN MoMo Collection APIs. Handles token generation, number normalization (e.g. prefixing `233`), and `requesttopay` HTTP calls.
- **Sandbox Configuration CLI**: Created the `php artisan momo:setup-sandbox` console command to automate API User registration, API Key retrieval from MTN, and dynamic local `.env` writing.
- **Webhook Callback Processing**: Added `MomoWebhookController.php` to handle asynchronous callback responses securely, updating order state to `escrow_held` and notifying the farmer.
- **Interactive PIN Prompt Simulator**: Embedded a `Simulate MoMo PIN Prompt` modal dialog inside `MyOrders.vue` for demo presentations, allowing developers to simulate prompt entry and trigger webhook payments instantly.

### ✅ Module 8 — Transport Logistics & Escrow Safety Enhancements
- **Escrow-Secured Transit Gate**: Restricted the "Request Transport" capability in `OrderController.php` so that farmers can only request transport for orders whose payment status is `escrow_held`.
- **Driver Pickup Lifecycle**: Added support for active cargo transitions, allowing drivers to mark accepted orders as "Picked Up", updating status to `in_transit` and triggering notifications.
- **Transit Progress Tracker**: Embedded progress indicators (Farm → Transit → Market) in the driver dashboard for live trip feedback.

### ✅ Module 9 — Responsive Portals & Interface Polish
- **Driver Dashboard Responsiveness**: Full layout overhaul of the Driver Portal for web, tablet, and mobile views.
- **Header Action Alignment**: Cleaned up the notification bells and aligned logout and clear actions consistently.
- **Payment Method Coming Soon**: Labeled Telecel and other payment networks as "Coming Soon" in the buyer's payment modal.

### ✅ Module 10 — Phase 2A: Database & Backend Foundation (Finals Upgrade)

Grounded in real field research from Daboase/Beposo farmers, this phase extends the data layer to carry quality, freshness, buyer identity, and transport cost transparency.

- **Product Quality Schema** (`add_quality_fields_to_products_table`): Added `harvest_date`, `quality_grade` (ENUM A/B/C), `unit` (Crate/Bag/Kg), and `minimum_order_qty` as nullable columns to `products`.
- **Buyer Profile Schema** (`add_buyer_profile_to_users_table`): Added `buyer_type` (market_trader / restaurant / individual) and `business_name` as nullable columns to `users`.
- **ProductController** — `store()` and `update()` accept and validate all new quality fields; `buyerBrowse()` computes `days_since_harvest` dynamically and supports `quality_grade` filtering.
- **OrderController** — `store()` now calculates estimated transport cost at order creation time (`GHS 40 base + GHS 2 x qty`), stores it in `estimated_transport_cost`, includes it in the MoMo payment amount, and validates minimum order quantity against the product's `minimum_order_qty`; `completeDelivery()` sends separate payout notifications to the farmer (product amount) and driver (transport amount).
- **AuthController** — `register()` accepts and stores `buyer_type` and `business_name`.

### ✅ Module 11 — Phase 2B: Quality & Freshness Layer (Finals Upgrade)

Makes quality, freshness, and wholesale terms visible to both farmers and market buyers.

- **`FreshnessBar.vue`** (new shared UI component): Pure presentational component that computes days elapsed since `harvest_date` and renders a color-coded progress bar — **Green** (0–2 days, Fresh Harvest), **Yellow** (3–4 days, Good Condition), **Red** (5+ days, Fast Sale), **Grey** (no date provided).
- **FarmerDashboard** — Post Produce modal extended with four new fields: Harvest Date picker (capped at today), Quality Grade selector (three clickable A/B/C cards), Unit of Sale dropdown, and Minimum Order Quantity input. Product listing cards now display quality grade badge, freshness bar, and a warning Near Expiry indicator when applicable.
- **BuyerBrowse** — Product cards now show quality grade badge, freshness bar, and minimum order note. A Quality Grade filter pill bar (All / Grade A / Grade B / Grade C) is added above the listing results. The `quality_grade` filter is wired into `applyFilters()` and sent as a query parameter to the backend.

### ✅ Module 12 — Driver Portal Redesign & Real Data

A full overhaul of the Driver experience, now driven entirely by real database records.

- **4-Tab Portal UI**: Driver Dashboard redesigned into four tabbed screens — **Jobs** (available deliveries), **My Trips** (active & completed), **Earnings** (payout history), and **Profile** (driver details & vehicle info).
- **Real Earnings Data**: Removed all static dummy data; driver earnings and recent payout history are computed directly from completed `orders` records.
- **Editable Profile & Vehicle**: Drivers can update their name, phone number, and Aboboyaa vehicle details via an inline edit modal.
- **Escrow-Only Job Filtering**: Available jobs list in the driver portal is restricted to orders with `payment_status = escrow_held`, so drivers are never dispatched on unpaid orders. Backend guard added to `acceptDelivery` to enforce this server-side.
- **Stat Card Layout Fix**: Resolved text overflow and overlap in the driver stats cards for all screen sizes.

### ✅ Module 13 — Phase C: Transaction Transparency & Contact Layer

Brings clarity and trust to every transaction by surfacing farmer contact info, buyer identity, and custom delivery logistics.

- **Farmer Contact Display**: Farmer phone numbers are now displayed on product cards and order screens so buyers and drivers can call directly. A tap-to-call action is available on mobile.
- **Buyer Phone & Identity**: Buyer phone numbers and buyer type (market trader / restaurant / individual) are surfaced on farmer order views and driver job cards for verification.
- **Custom Delivery Location**: Buyers can now specify a custom delivery address when placing an order, overriding the default Takoradi Market Circle location. The custom location is stored on the order and shown to the driver.
- **Transaction Transparency**: Full buyer definition (name, phone, type, business name) and complete cost breakdown (product subtotal + transport cost) surfaced across all 5 Vue screens — FarmerOrders, FarmerDashboard, BuyerBrowse, MyOrders, DriverDashboard.

### ✅ Module 14 — Live Background Polling

Keeps all portals up-to-date without requiring a page reload.

- **5-Second Auto-Polling**: A `setInterval` polling loop (5,000 ms) is active across the Farmer Dashboard, Farmer Orders, Buyer Browse, My Orders, and Driver Dashboard pages.
- **Legacy Transport Button Removed**: The manual "Request Transport" button on the Farmer Orders screen was replaced by automatic background auto-assignment via the polling cycle, reducing farmer friction.
- **Optimistic UI**: Status badges and order counts update in-place as poll responses return, without full page flashes.

### ✅ Module 15 — Tomato-Only Marketplace & Local Image Library

Focuses the marketplace on the Western Region's primary crop with rich, authentic imagery.

- **Tomato-Only Listings**: The marketplace is scoped exclusively to tomatoes — the principal cash crop of the Daboase/Beposo corridor — for the live demo and production launch.
- **20 Local Product Images**: A curated library of 20 high-quality tomato product images sourced and stored under `public/images/products/` is used across all product cards in Buyer Browse and Farmer Dashboard.
- **Lazy Loading & Error Fallbacks**: All product `<img>` tags across BuyerBrowse, FarmerDashboard, FarmerOrders, and MyOrders now use `loading="lazy"` and `@error` handlers that swap to a branded placeholder on broken image URLs.

### ✅ Module 16 — Welcome / Landing Page Redesign

A polished, narrative-driven public landing page that communicates FarmLink's mission before a user logs in.

- **Sticky Mobile Header**: Frosted-glass navbar with FarmLink logo, Log In, and Register CTA. Collapses to a hamburger dropdown menu on mobile with smooth slide-in animation.
- **Hero Section**: Full-bleed background image overlay of Western Region farmland, with headline "Sell Your Tomatoes Before Harvest.", supporting tagline, and dual CTA buttons (Get Started / Log In).
- **Section 2 — The Problem We Solve**: Dark green cards with circular light icon badges and impact statistics highlighting the distress-sale problem for Daboase & Beposo farmers.
- **Section 3 — How Produce Moves**: Step-by-step flow (Farmer lists → Buyer pre-orders → Driver delivers) rendered on a dark green background with branded step cards.
- **Section 4 — Focus Corridor Banner**: A full-width callout card naming the Daboase–Beposo–Takoradi corridor as FarmLink's initial operational zone.
- **Section 5 — Who Uses FarmLink**: Three role cards (Farmer, Market Trader, Aboboyaa Driver) with a single-sentence value proposition and CTA per role.
- **Footer**: Minimal footer with project name, tagline, and quick navigation links.
- **Responsive Design**: All sections are fully responsive across mobile, tablet, and desktop breakpoints.

---

## Database Schema (Key Tables)

```
users       — id, name, phone_number, password, role, location, average_rating,
              buyer_type, business_name, reset_token, reset_token_expires_at

products    — id, user_id (farmer), name, category, price, quantity,
              harvest_date, quality_grade, unit, minimum_order_qty

orders      — id, buyer_id, product_id, driver_id, quantity_ordered, total_price,
              estimated_transport_cost, status, payment_status, delivery_location

ratings     — id, order_id, rater_id, ratee_id, score, comment

notifications — id, user_id, type, title, message, is_read, data, created_at, updated_at
```

**Order status lifecycle:**
```
pending → processing → in_transit → delivered
```

**Payment status lifecycle:**
```
unpaid → escrow_held → released
```

---

## Local Setup

### Prerequisites
- PHP 8.1+, Composer
- Node.js 18+, npm
- MySQL (via XAMPP — start manually from XAMPP Control Panel before running)

### Install

```bash
git clone https://github.com/hendrix-llouchi/FarmLink.git
cd FarmLink

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Configure your `.env` database credentials, then:

```bash
php artisan migrate --seed
```

### Run

```bash
# Terminal 1 — Laravel backend
php artisan serve

# Terminal 2 — Vite frontend
npm run dev
```

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Seeded Test Accounts

| Role | Name | Phone | Password |
|---|---|---|---|
| Farmer | Kojo Mensah | `0244111222` | `password123` |
| Farmer | Kwesi Appiah | `0244222333` | `password123` |
| Buyer | Yaw Boateng | `0244333444` | `password123` |
| Driver | Emmanuel Mensah | `0244555666` | `password123` |
| Driver | Kofi Ansah | `0244666777` | `password123` |

---

## Route Map

| Method | URI | Role | Action |
|---|---|---|---|
| GET | `/` | any | Role-based redirect (or Welcome page for guests) |
| GET/POST | `/login` | guest | Login |
| GET/POST | `/register` | guest | Register |
| GET/POST | `/forgot-password` | guest | Password reset request (6-digit code) |
| GET/POST | `/reset-password` | guest | Password reset confirmation |
| GET | `/settings` | auth | View profile & settings page |
| POST | `/settings/profile` | auth | Update profile information |
| POST | `/settings/password` | auth | Update account password |
| GET | `/notifications` | auth | View notifications feed |
| POST | `/notifications/{id}/read` | auth | Mark notification as read |
| POST | `/notifications/read-all` | auth | Mark all notifications as read |
| GET | `/farmer/dashboard` | farmer | View own products & metrics |
| POST | `/farmer/products` | farmer | List a new product |
| POST | `/farmer/products/{id}/update` | farmer | Update existing product details |
| DELETE | `/farmer/products/{id}` | farmer | Delete product listing |
| GET | `/farmer/orders` | farmer | View incoming buyer orders & escrow status |
| POST | `/farmer/orders/{id}/request-transport` | farmer | Request transporter for escrow-held order |
| GET | `/buyer/browse` | buyer | Browse marketplace |
| POST | `/buyer/orders` | buyer | Place an order (with optional custom delivery location) |
| GET | `/buyer/orders` | buyer | View order history |
| POST | `/buyer/orders/{id}/rate` | buyer | Submit rating |
| GET | `/driver/dashboard` | driver | View available jobs + active trips |
| POST | `/driver/orders/{id}/accept` | driver | Accept a delivery (escrow-held orders only) |
| POST | `/driver/orders/{id}/pickup` | driver | Mark cargo as picked up (`in_transit`) |
| POST | `/driver/orders/{id}/complete` | driver | Mark as delivered (triggers escrow release) |
| POST | `/momo/webhook` | system | Receive MTN MoMo payment callback |

---

## Design System (Agri-Tech Modern)

Defined as CSS Custom Properties in `resources/css/design-tokens.css`:

### Colors

| Variable | Hex Value | Purpose |
|---|---|---|
| `--color-primary` | `#2D6A4F` | Primary green accents, active buttons |
| `--color-primary-hover` | `#1B4332` | Darker green for hover states |
| `--color-primary-light` | `#52B788` | Light green for borders & icon backdrops |
| `--color-primary-lighter` | `#B7E4C7` | Tag/chip backgrounds, subtle tints |
| `--color-secondary` | `#F4A261` | Warm orange accent for buyer/pricing |
| `--color-secondary-dark` | `#8B4513` | Text on light secondary backgrounds |
| `--color-tertiary` | `#2A9D8F` | Teal transporter/delivery details |
| `--color-tertiary-light` | `#76C9C0` | Tertiary backgrounds |
| `--color-neutral-50` | `#F8F9FA` | Main page background |
| `--color-neutral-100` | `#E9ECEF` | Card borders, dividers |
| `--color-neutral-300` | `#CED4DA` | Input borders |
| `--color-neutral-500` | `#6C757D` | Placeholder, subtext |
| `--color-neutral-700` | `#495057` | Secondary body text |
| `--color-neutral-900` | `#212529` | Headings & dark typography |
| `--color-danger` | `#DC3545` | Delete, reject & error actions |
| `--color-white` | `#FFFFFF` | Card & form content surfaces |

### Typography & Spacing
- **Font Family**: Inter (imported from Google Fonts)
- **Typography Weights**: 400 (Body), 500 (Labels), 600 (Subtitle), 700 (Headings)
- **Border Radius**: Cards (`12px`), Buttons/Inputs (`8px`), Pills (`999px`), FABs (`50%`)
- **Card Shadow**: Subtle depth (`0 2px 12px rgba(0,0,0,0.08)`)
- **Input Height**: `44px`
- **Sidebar Width (desktop)**: `220px` | **Collapsed**: `64px`

### Responsive Navigation

| Breakpoint | Pattern |
|---|---|
| Mobile `< 768px` | Bottom navigation bar (4–5 icon tabs) |
| Tablet `768px – 1024px` | Collapsible icon-only sidebar |
| Desktop `> 1024px` | Full left sidebar (icons + labels) |

---

## Key Shared Components

All reusable presentation components live in `resources/js/Components/UI/`:

| Component | Purpose |
|---|---|
| `AppButton.vue` | All button variants (Primary, Secondary, Danger, Outlined) |
| `AppInput.vue` | Styled text / select / textarea inputs |
| `AppCard.vue` | Standard card wrapper with shadow |
| `AppBadge.vue` | Status chips and role tags |
| `FreshnessBar.vue` | Color-coded produce freshness bar (Fresh / Good / Fast Sale) |

---

## Deployment

- **Production**: Live on [Render](https://render.com)
- **Local DB**: MySQL via XAMPP (start manually before running migrations)
- **Docker Entrypoint**: `php artisan migrate --force` runs automatically on Render container start via `docker-entrypoint.sh`
- **Image Delivery**: Product images are delivered with Cloudinary optimizations (format, quality, and responsive size accessors) in production

> **NEVER** run `migrate:fresh`, `db:wipe`, or `truncate` against the production Render database. All schema changes must use additive, nullable migrations only.

---

## License

Private project — Western Region of Ghana localized marketplace.
