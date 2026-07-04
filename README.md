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

---

## Database Schema (Key Tables)

```
users           — id, name, phone_number, password, role, location, average_rating
products        — id, user_id (farmer), name, category, price, quantity, unit
orders          — id, buyer_id, product_id, driver_id, quantity_ordered, total_price, status
ratings         — id, order_id, rater_id, ratee_id, score, comment
```

**Order status lifecycle:**
```
pending → processing → delivered
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
| Farmer | Kojo Mensah | `0244111222` | `password` |
| Farmer | Abena Asante | `0244333444` | `password` |
| Buyer | Yaw Boateng | `0201234567` | `password` |
| Buyer | Efua Darko | `0209876543` | `password` |
| Driver | Emmanuel Mensah | `0244555666` | `password` |

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
| POST | `/driver/orders/{id}/complete` | driver | Mark as delivered |

---

## Design System

- **Primary accent:** `#2E7D32` (green)
- **Background:** `#F7F8F5` (warm off-white)
- **Typography:** System font stack (`-apple-system`, `Segoe UI`, `Roboto`)
- **Layout:** Mobile-first, max-width containers (`max-w-6xl`) to prevent desktop stretching
- **Icons:** Tabler / Lucide outline SVG (no icon font dependencies)

---

## License

Private project — Western Region of Ghana localized marketplace.
