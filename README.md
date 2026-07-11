# 🌾 FarmLink

> A localized farmer-to-buyer marketplace for the Western Region of Ghana (Takoradi / Tarkwa area), built with Laravel 10 + Inertia.js + Vue 3.

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

---

## Roles

| Role | Capabilities |
|---|---|
| **Farmer** | List produce, view dashboard with own products |
| **Buyer** | Browse marketplace, place orders, view order history, rate delivered orders |
| **Driver** | View pending delivery jobs, accept jobs, mark deliveries as completed |

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

### ✅ Module 6 — Agri-Tech Modern Redesign (Phases 1–4)
- **Phase 1 (Auth)**: Redesigned Login and Register screens with responsive split-screen layouts, color-coded role cards, Forgot Password 6-digit flow, and CSS design tokens setup.
- **Phase 2 (Farmer)**: Redesigned Farmer Dashboard with sidebar navigation (desktop), collapsible tablet sidebar, bottom navigation capsule (mobile), responsive metrics cards, and listing actions.
- **Phase 3 (Buyer)**: Redesigned Buyer Browse with full-width product cards, horizontal category scrollbar filter, seasonal promo banners, slide-up Mobile Money payment drawers, and status-bordered order logs.
- **Phase 4 (Transporter)**: Redesigned Driver Dashboard featuring active trip card progress stages (Farm → Transit → Market), orange "Picked Up" & teal "Delivered" action indicators, nearby jobs list, and bottom navigation.

### ✅ Module 7 — MTN MoMo API Integration & Sandbox Command
- **MTN MoMo API Service**: Implemented [MomoApiService.php](file:///C:/Users/HP%20Laptop/Downloads/FarmLink/app/Services/MomoApiService.php) to integrate with official MTN MoMo Collection APIs. Handles token generation, number normalization (e.g. prefixing `233`), and `requesttopay` HTTP calls.
- **Sandbox Configuration CLI**: Created the `php artisan momo:setup-sandbox` console command to automate API User registration, API Key retrieval from MTN, and dynamic local `.env` writing.
- **Webhook Callback Processing**: Added [MomoWebhookController.php](file:///C:/Users/HP%20Laptop/Downloads/FarmLink/app/Http/Controllers/MomoWebhookController.php) to handle asynchronous callback responses securely, updating order state to `escrow_held` and notifying the farmer.
- **Interactive PIN Prompt Simulator**: Embedded a `Simulate MoMo PIN Prompt` modal dialog inside [MyOrders.vue](file:///C:/Users/HP%20Laptop/Downloads/FarmLink/resources/js/Pages/MyOrders.vue) for demo presentations, allowing developers to simulate prompt entry and trigger webhook payments instantly.

### ✅ Module 8 — Transport Logistics & Escrow Safety Enhancements
- **Escrow-Secured Transit Gate**: Restricted the "Request Transport" capability in [OrderController.php](file:///C:/Users/HP%20Laptop/Downloads/FarmLink/app/Http/Controllers/OrderController.php) so that farmers can only request transport for orders whose payment status is `escrow_held`.
- **Driver Pickup Lifecycle**: Added support for active cargo transitions, allowing drivers to mark accepted orders as "Picked Up", updating status to `in_transit` and triggering notifications.
- **Transit Progress Tracker**: Embedded progress indicators (Farm → Transit → Market) in the driver dashboard for live trip feedback.

### ✅ Module 9 — Responsive Portals & Interface Polish
- **Driver Dashboard Responsiveness**: Full layout overhaul of the Driver Portal for web, tablet, and mobile views.
- **Header Action Alignment**: Cleaned up the notification bells and aligned logout and clear actions consistently.
- **Payment Method Coming Soon**: Labeled Telecel and other payment networks as "Coming Soon" in the buyer's payment modal.

---

## Database Schema (Key Tables)

```
users           — id, name, phone_number, password, role, location, average_rating
products        — id, user_id (farmer), name, category, price, quantity, unit
orders          — id, buyer_id, product_id, driver_id, quantity_ordered, total_price, status, payment_status
ratings         — id, order_id, rater_id, ratee_id, score, comment
```

**Order status lifecycle:**
```
pending → processing → delivered
```

**Payment status lifecycle (Module 5):**
```
unpaid → escrow_held → released
```

---

## Local Setup

### Prerequisites
- PHP 8.1+, Composer
- Node.js 18+, npm
- MySQL

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
| GET | `/` | any | Role-based redirect |
| GET/POST | `/login` | guest | Login |
| GET/POST | `/register` | guest | Register |
| GET | `/farmer/dashboard` | farmer | View own products |
| POST | `/farmer/products` | farmer | List a product |
| GET | `/buyer/browse` | buyer | Browse marketplace |
| POST | `/buyer/orders` | buyer | Place an order |
| GET | `/buyer/orders` | buyer | View order history |
| POST | `/buyer/orders/{id}/rate` | buyer | Submit rating |
| GET | `/driver/dashboard` | driver | View available jobs + active trips |
| POST | `/driver/orders/{id}/accept` | driver | Accept a delivery |
| POST | `/driver/orders/{id}/complete` | driver | Mark as delivered (triggers escrow release) |

---

## Design System (Agri-Tech Modern)

Defined as CSS Custom Properties in `resources/css/design-tokens.css`:

### Colors

| Variable | Hex Value | Purpose |
|---|---|---|
| `--color-primary` | `#2D6A4F` | Primary green accents, active buttons |
| `--color-primary-hover` | `#1B4332` | Darker green for hover states |
| `--color-primary-light` | `#52B788` | Light green for borders & icon backdrops |
| `--color-secondary` | `#F4A261` | Warm orange accent for buyer/pricing |
| `--color-tertiary` | `#2A9D8F` | Teal transporter/delivery details |
| `--color-neutral-50` | `#F8F9FA` | Main page background |
| `--color-neutral-900` | `#212529` | Headings & dark typography |
| `--color-danger` | `#DC3545` | Delete, reject & error actions |
| `--color-white` | `#FFFFFF` | Card & form content surfaces |

### Typography & Spacing
- **Font Family**: Inter (imported from Google Fonts)
- **Typography Weights**: 400 (Body), 500 (Labels), 600 (Subtitle), 700 (Headings)
- **Border Radius**: Cards (`12px`), Buttons/Inputs (`8px`), Pills (`999px`)
- **Card Shadow**: Subtle depth (`0 2px 12px rgba(0,0,0,0.08)`)

---

## License

Private project — Western Region of Ghana localized marketplace.

