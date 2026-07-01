# SOFTWARE REQUIREMENTS SPECIFICATION
## Farmer-to-Buyer Digital Marketplace Platform
### GDSS-PSInno AgriTech Innovation Challenge — Hackathon Build Blueprint

| Attribute | Details |
| --- | --- |
| **Target region** | Western Region, Ghana (Takoradi / Tarkwa) |
| **Application type** | Responsive web application, monolithic repo |
| **Stack** | Laravel + Inertia + Vue.js + MySQL (XAMPP) |
| **Challenge window** | 29 June 2026 – 10 July 2026 |
| **Document status** | v2 — revised after SRS review |

---

## 1. Project Overview & Scope

### 1.1 System Name
Farmer-to-Buyer Digital Marketplace Platform

### 1.2 One-Sentence Description
A digital web platform that connects smallholder vegetable farmers directly to buyers, while enabling simple coordination of local transport providers.

### 1.3 Target Supply Region
Western Region, Ghana — focused on localized markets such as Takoradi and Tarkwa. Narrowing the region keeps produce matching simple and avoids the need for real GPS infrastructure, in line with the challenge brief's guidance to focus on a specific supply region rather than the whole country.

### 1.4 Application Type
Responsive web application, built as a single unified monorepo (frontend + backend together).

### 1.5 Deliberately Out of Scope
* **Live interactive map interfaces or real-time GPS tracking**
* **Real, production mobile money payment gateways** requiring live verification
* **Real-time WebSocket infrastructure or open in-app chat windows**
* **Logistics or shipping capabilities** scaling outside the defined localized region

These cuts target features marked optional/bonus in the challenge brief, freeing up build time for the mandatory core workflow within the hackathon window.

---

## 2. System Architecture & Tech Stack

### 2.1 Architectural Style
Monolith — frontend and backend housed in a single repository to maximize development velocity and keep AI-assisted coding context simple.

### 2.2 Backend
Laravel, using Eloquent ORM, built-in routing, and default session-cookie authentication.

### 2.3 Frontend
Vue.js integrated via Laravel Inertia, enabling direct server-to-frontend prop injection with no separate API boilerplate.

### 2.4 Database
MySQL via a local XAMPP environment.

### 2.5 File Storage
Produce images stored on local disk via Laravel's public storage disk (`storage/app/public`, symlinked to `public/storage`). No cloud storage integration needed for the hackathon build.

---

## 3. User Roles & Permissions

| Role | Key System Permissions |
| --- | --- |
| **Farmer** | Register/log in, create/update/delete produce listings, upload produce images, view active orders, rate buyers and transport providers, request transport |
| **Buyer** | Register/log in, browse/search/filter produce listings, place direct orders, track order status, rate farmers and transport providers |
| **Transport Provider** | Register/log in, view available delivery requests, accept delivery jobs, update fulfillment status, rate farmers and buyers |

---

## 4. Functional Requirements & User Stories

### 4.1 Farmer Stories
* As a Farmer, I want to register and create a profile so that buyers and drivers can view my local marketplace presence.
* As a Farmer, I want to list my perishable vegetables with a photo, price, and quantity so that buyers can purchase them directly.
* As a Farmer, I want to update or remove a listing so that buyers only see accurate stock.
* As a Farmer, I want to request transport for an order so that my vegetables do not spoil while waiting for pickup.
* As a Farmer, I want to rate the buyer and transport provider after a completed order so that trust builds across the marketplace.

### 4.2 Buyer Stories
* As a Buyer, I want to search and filter produce by location, category, or price so that I can source nearby vegetable supplies.
* As a Buyer, I want to place a direct order so that I can secure a batch of produce.
* As a Buyer, I want to track my order status so that I can prepare for arrival and avoid delivery delays.
* As a Buyer, I want to see a farmer's average rating before ordering so that I can buy from trusted sellers.

### 4.3 Transport Provider Stories
* As a Transport Provider, I want to view available delivery requests so that I can find local delivery jobs.
* As a Transport Provider, I want to see an estimated payout for a job before accepting it so that I can decide if it's worth the trip.
* As a Transport Provider, I want to accept a delivery job and update its status so that the farmer and buyer can track progress.

### 4.4 Cross-Cutting Stories
* As any user, I want to receive an in-app notification when my order or listing status changes so that I don't have to keep refreshing to check.
* As any user, I want to see a simple dashboard of my recent activity (listings, orders, deliveries) so that I understand what needs my attention.

---

## 5. End-to-End Core Workflow Mapping

1. **Onboarding**: a user creates an account via phone number and password, and assigns themselves a role (farmer, buyer, or driver) along with their primary market location string.
2. **Listing**: the Farmer uploads a product (e.g. tomatoes, peppers) with a photo, type, quantity, and unit price.
3. **Discovery & Order**: the Buyer filters listings by location string and category, then places an order. A backend record is written with a pending status and product stock is decremented.
4. **Logistics Match (bonus system)**: the Farmer clicks “Request Transport” on their dashboard. The system estimates a transport cost from a location-tier lookup, scans the users table for a driver matching the same location string, and links them to the order.
5. **Fulfillment**: the assigned Transport Provider updates the order status to `in_transit` on pickup and `delivered` on drop-off; both events push an in-app notification to the farmer and buyer.
6. **Feedback**: once an order is marked delivered, the farmer, buyer, and transport provider can each leave a 1–5 star rating and optional comment about the other parties involved.

---

## 6. Live Demo Script

This walkthrough is written directly against the challenge's required demo flow so the presentation maps 1:1 to what judges will be scoring.

| Step | Required Flow (per challenge brief) | What We Show |
| --- | --- | --- |
| 1 | Farmer registration and produce upload | Register as a farmer, add a produce listing with photo, price, quantity |
| 2 | Buyer product search and interaction | Register as a buyer, filter by location/category, view farmer rating, place an order |
| 3 | End-to-end marketplace operations workflow | Order appears on farmer dashboard as pending; stock decrements automatically |
| 4 | Additional innovative features | In-app notifications, activity dashboard, and post-delivery rating system |
| 5 | Transport request and logistics coordination (bonus) | Farmer requests transport; nearby driver is matched with an estimated cost; driver updates status to `in_transit` then `delivered` |

---

## 7. Database Schema Design

### 7.1 users
* `id` (BigInt, Primary Key)
* `name` (String)
* `phone_number` (String, Unique)
* `password` (String, hashed via bcrypt)
* `role` (Enum: 'farmer', 'buyer', 'driver')
* `location` (String, e.g. 'Takoradi Market Circle')
* `average_rating` (Decimal, 3,2 — denormalized cache, recalculated on new rating)
* `timestamps`

### 7.2 products
* `id` (BigInt, Primary Key)
* `user_id` (Foreign Key → users.id, Cascade on Delete)
* `name` (String, e.g. 'Tomatoes', 'Peppers')
* `category` (String, e.g. 'Vegetable', 'Leafy Green')
* `quantity` (Integer)
* `price` (Decimal, 10, 2)
* `image_path` (String, Nullable)
* `timestamps`

### 7.3 orders
* `id` (BigInt, Primary Key)
* `buyer_id` (Foreign Key → users.id)
* `product_id` (Foreign Key → products.id)
* `driver_id` (Foreign Key → users.id, Nullable)
* `quantity_ordered` (Integer)
* `total_price` (Decimal, 10, 2)
* `status` (Enum: 'pending', 'processing', 'in_transit', 'delivered')
* `transport_requested` (Boolean, Default: false)
* `estimated_transport_cost` (Decimal, 10, 2, Nullable)
* `timestamps`

### 7.4 notifications (new)
* `id` (BigInt, Primary Key)
* `user_id` (Foreign Key → users.id, Cascade on Delete)
* `message` (String)
* `type` (Enum: 'order_update', 'transport_update', 'new_listing')
* `read_at` (Timestamp, Nullable)
* `timestamps`

### 7.5 ratings (new)
* `id` (BigInt, Primary Key)
* `order_id` (Foreign Key → orders.id, Cascade on Delete)
* `rater_id` (Foreign Key → users.id — who is leaving the rating)
* `ratee_id` (Foreign Key → users.id — who is being rated)
* `score` (Integer, 1–5)
* `comment` (String, Nullable)
* `timestamps`

---

## 8. Backend API Routing Endpoint Design

### 8.1 Authentication API
* `POST /api/register` — accepts profile parameters and saves a new user
* `POST /api/login` — authenticates matching credentials via phone number

### 8.2 Farmer Controller API
* `POST /api/products` — validates, stores a new vegetable inventory item, and handles image upload
* `PATCH /api/products/{id}` — updates an existing listing
* `DELETE /api/products/{id}` — removes a listing
* `GET /api/farmer/orders` — returns active incoming consumer orders placed against the farmer's inventory
* `PATCH /api/orders/{id}/request-transport` — toggles transport flag, calculates an estimated cost, and runs the localized driver-matching logic

### 8.3 Buyer Controller API
* `GET /api/products` — returns available products, filtered by location, category, and price
* `POST /api/orders` — builds an order object and decrements the corresponding product stock
* `GET /api/buyer/orders` — fetches order statuses for the active buyer account

### 8.4 Logistics Controller API
* `GET /api/driver/trips` — queries pending transport requests matching the authenticated driver's location
* `PATCH /api/orders/{id}/status` — updates the order status field (`in_transit` or `delivered`)

### 8.5 Notifications API
* `GET /api/notifications` — returns the authenticated user's recent notifications
* `PATCH /api/notifications/{id}/read` — marks a notification as read

### 8.6 Ratings API
* `POST /api/orders/{id}/ratings` — submits a rating from one party to another on a completed order
* `GET /api/users/{id}/ratings` — returns a user's average rating and recent reviews

### 8.7 Dashboard API
* `GET /api/dashboard` — returns role-appropriate summary counts (active listings, pending orders, completed deliveries, average rating)

---

## 9. Non-Functional Requirements

### 9.1 Security
* Passwords hashed with bcrypt; never stored or logged in plaintext
* Role-based route middleware so a buyer cannot hit farmer/driver-only endpoints
* Server-side validation on all form submissions (Laravel Form Requests)

### 9.2 Usability & Accessibility
* Mobile-first responsive layout, since most users will access via phone browsers
* Plain-language labels and large tap targets suited to varying digital literacy levels

### 9.3 Performance & Low-Bandwidth Considerations
* Compress and resize uploaded produce images server-side before storage
* Paginate product and order listings rather than loading full tables at once

### 9.4 Scalability Notes
* Location is stored as a plain string for the hackathon build; this can be swapped for a proper geocoded field later without changing the rest of the schema
* Notification and rating tables are decoupled from core order logic, so either can be extended (e.g. push notifications, weighted ratings) post-hackathon without a schema rewrite

---

## 10. Feature Traceability to Challenge Brief

| Brief Feature | Status | Where |
| --- | --- | --- |
| Produce listing with images | Covered | §4.1, §7.2, §8.2 |
| Search/filter by category, price, location | Covered | §4.2, §8.3 |
| Transport matching & scheduling | Covered (simplified) | §5, §8.2, §8.4 |
| Estimated transport cost | Covered | §7.3, §8.2 |
| Notifications (listings/orders/deliveries) | Covered (non-realtime) | §7.4, §8.5 |
| Rating & review system | Covered | §7.5, §8.6 |
| Dashboard for activity monitoring | Covered | §8.7 |
| Live GPS / mapping | Out of scope | §1.5 |
| Real mobile money integration | Out of scope | §1.5 |
| Real-time chat | Out of scope | §1.5 |
