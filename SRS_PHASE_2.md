# SOFTWARE REQUIREMENTS SPECIFICATION
## FarmLink — Phase 2: Finals Upgrade
### GDSS-PSInno AgriTech Innovation Challenge

| Attribute | Details |
| --- | --- |
| Document Version | v1.0 |
| Status | Draft — Awaiting Review |
| Date | 29 July 2026 |
| Team | Team Mythos |
| Prepared For | GDSS-PSInno AgriTech Innovation Challenge Finals |
| Phase | Phase 2 — Post-Shortlist Upgrade |
| Branch | feature/finals-upgrade |

---

## Table of Contents
1. [Introduction](#1-introduction)
2. [Project Context & Problem Statement](#2-project-context--problem-statement)
3. [Stakeholder Definitions](#3-stakeholder-definitions)
4. [Scope of This Phase](#4-scope-of-this-phase)
5. [Field Research Summary](#5-field-research-summary)
6. [Functional Requirements](#6-functional-requirements)
7. [Non-Functional Requirements](#7-non-functional-requirements)
8. [Database Schema Changes](#8-database-schema-changes)
9. [UI/UX Requirements](#9-uiux-requirements)
10. [System Constraints](#10-system-constraints)
11. [Verification & Acceptance Criteria](#11-verification--acceptance-criteria)
12. [Out of Scope](#12-out-of-scope)
13. [Phase 2 — Build Phases](#farmlink-phase-2--build-phases)

---

## 1. Introduction

### 1.1 Purpose
This document specifies the software requirements for Phase 2 of the FarmLink platform — a targeted upgrade in response to judge feedback from the GDSS-PSInno AgriTech Innovation Challenge shortlisting round. Phase 1 (the original hackathon build) established a functional farmer-to-buyer marketplace with MoMo escrow payment, driver logistics, and a rating system. Phase 2 narrows the platform's scope, grounds it in real field research, and closes the identified gaps in quality transparency, buyer definition, and transport cost accountability.

### 1.2 Intended Audience
* Team Mythos development team
* GDSS-PSInno challenge judges
* Any technical reviewer assessing the platform for the finals

### 1.3 Document Conventions
* **SHALL** — mandatory requirement
* **SHOULD** — recommended but not mandatory
* **MAY** — optional

---

## 2. Project Context & Problem Statement

### 2.1 Background
FarmLink is a web-based marketplace that connects smallholder farmers, market-trader buyers, and transport operators (aboboyaa drivers) in the Western Region of Ghana. The Phase 1 build demonstrated core marketplace functionality. The judge panel identified that the platform, while technically sound, needed to demonstrate a deeper understanding of the specific ecosystem problems it targets.

### 2.2 The Problem Being Solved
Smallholder tomato farmers in the Daboase and Beposo farming communities face a recurring post-harvest loss crisis driven by three compounding factors:

* **Factor 1 — No Pre-Committed Buyers**: Farmers harvest and transport produce to Beposo aggregation market on designated market days (Tuesdays) without any guarantee of a buyer. If produce does not sell by end of day, the farmer is forced to reduce prices drastically or discard the produce. Market women are aware of this dynamic and deliberately delay purchasing until prices fall.
* **Factor 2 — Unresolved Transport Cost**: Transport via aboboyaa (tricycle) operators is the primary mode of moving produce from farms to Beposo and from Beposo to Takoradi Market Circle. The cost of transport is borne by whoever is initiating the movement at that point in time — with no advance agreement between parties. This creates disputes, absorbs unpredictable portions of the farmer's revenue, and disincentivises transport operators from committing to jobs in advance.
* **Factor 3 — No Quality Signal for Remote Buyers**: Market women who do not physically inspect produce before purchasing have no reliable information about freshness, harvest date, or quality condition. This prevents pre-commitment purchases and forces buyers to show up in person — a friction that FarmLink is designed to eliminate.

### 2.3 The Supply Corridor
FarmLink Phase 2 is explicitly scoped to a single supply corridor:

**Daboase / Beposo Farming Area → Takoradi Market Circle**

This is a defined, realistic pilot corridor with:
* An established aggregation point (Beposo market)
* A high-volume end market (Takoradi Market Circle)
* An existing informal transport layer (aboboyaa operators)
* A defined primary crop (tomatoes)
* A defined primary buyer type (market women / traders)

### 2.4 Scope Statement
> "FarmLink helps smallholder tomato farmers in the Daboase/Beposo area move produce to market women at Takoradi Market Circle by eliminating the distress sale — giving market traders pre-committed purchases, agreed transport costs, and escrow-secured payment before harvest day ends."

---

## 3. Stakeholder Definitions

### 3.1 Farmer
A smallholder tomato producer based in the Daboase or Beposo farming communities. Harvests produce with no cold storage capability. Must sell within the same day to avoid loss. Primary concern: guaranteed sale at fair price before or on market day.

### 3.2 Buyer — Market Trader (Primary)
A market woman or trader based at Takoradi Market Circle or Beposo who purchases tomatoes in bulk (by crate or bag) for resale. Buys frequently, cares about affordability, and will prioritise early-morning purchases at agreed prices over uncertain end-of-day bargains. This is FarmLink's primary buyer persona.

### 3.3 Buyer — Restaurant / Chop Bar (Secondary)
A food business owner who buys produce in moderate quantities on a regular schedule. Cares more about quality consistency than price minimisation.

### 3.4 Buyer — Individual Consumer (Tertiary)
A household buyer purchasing small quantities. Not the primary target for Phase 2 but remains supported.

### 3.5 Transport Operator (Aboboyaa Driver)
An informal tricycle (aboboyaa) operator who already works the Daboase/Beposo → Market Circle corridor daily. Currently finds jobs by being physically present at the market or through personal networks. FarmLink provides a digital job board so operators can see confirmed, pre-paid delivery jobs before leaving home.

---

## 4. Scope of This Phase

### 4.1 What Phase 2 Adds

| Feature Area | Description |
| --- | --- |
| **Product Quality Information** | Harvest date, quality grade, unit of sale, minimum order quantity on every listing |
| **Buyer Type Definition** | Buyer role differentiated at registration into Market Trader, Restaurant, or Individual |
| **Transport Cost at Checkout** | Estimated transport cost shown to buyer at order time, included in escrow total |
| **Escrow Payout Split** | On delivery, system notifies farmer and driver of their respective payouts |
| **Freshness Signalling** | Visual freshness indicators on product listings (days since harvest, color-coded bar) |
| **Scope Narrative in UI** | Welcome page and buyer browse page communicate the specific problem, corridor, and crop focus |
| **Driver Job Visibility** | Driver dashboard shows estimated payout per job before acceptance |

### 4.2 What Phase 2 Does Not Change
* MoMo API payment flow and sandbox configuration
* Driver accept / pickup / deliver status logic
* Rating and review system
* Notification dispatch logic
* Route definitions and middleware guards
* Any existing database records or migration files

---

## 5. Field Research Summary

The following insights were gathered directly from farmers and buyers operating in the Daboase/Beposo corridor. They inform the requirements in Section 6.

| # | Insight | Requirement It Drives |
| --- | --- | --- |
| **F-01** | Tomatoes are the primary crop; highly perishable, must sell same day as harvest | Harvest date and freshness bar on listings; shelf life threshold = 4 days |
| **F-02** | Beposo is the aggregation market; market women from Market Circle travel there | Supply corridor defined as Daboase/Beposo → Market Circle in all UI |
| **F-03** | Market days are Tuesdays at Daboase, Beposo, and Market Circle | SHOULD: surface next market day in farmer dashboard (future phase) |
| **F-04** | Market women are the primary bulk buyers | Buyer type = Market Trader is the primary registration persona |
| **F-05** | Buyers prioritise affordability; early morning buyers are more quality-selective | Quality grade (A/B/C) allows farmers to price and position appropriately |
| **F-06** | Transport cost is the biggest pain point; cost is borne by whoever initiates the move | Transport cost calculated and shown at order checkout; included in escrow |
| **F-07** | Aboboyaa drivers are already operating this corridor daily | Driver registration = formalising an existing informal supply; job board model |
| **F-08** | Farmers have no cold storage; harvest and sell same day | Near-expiry warning on listings; urgency framing in UI |
| **F-09** | Transit damage: farmer bears cost if moving to buyer; once sold, buyer bears it | Driver handover record (pickup action) creates documented accountability |
| **F-10** | End-of-day price desperation is the primary loss mechanism | Pre-committed escrow purchase eliminates distress sale |

---

## 6. Functional Requirements

### 6.1 Product Listing — Quality Information
* **FR-01**: The system **SHALL** allow a farmer to specify a `harvest_date` when creating or editing a product listing.
* **FR-02**: The system **SHALL** allow a farmer to select a `quality_grade` for their listing from three options:
  * Grade A — Premium (best condition, highest price)
  * Grade B — Standard (good condition, market price)
  * Grade C — Budget (minor blemishes, priced for quick sale)
* **FR-03**: The system **SHALL** allow a farmer to specify the unit of sale per listing (Crate, Bag, or Kg).
* **FR-04**: The system **SHALL** allow a farmer to specify a `minimum_order_qty` — the minimum number of units a buyer must order. This enforces the wholesale model.
* **FR-05**: The system **SHALL** automatically calculate `days_since_harvest` from the `harvest_date` field and expose it to the buyer browse view.
* **FR-06**: The system **SHALL** display a visual freshness indicator on every listing card in the buyer browse view, using the following thresholds for tomatoes:
  * 0–2 days since harvest → Green (Fresh)
  * 3–4 days since harvest → Yellow (Use Soon)
  * 5+ days since harvest → Red (Near Expiry)
* **FR-07**: If `harvest_date` is not provided by the farmer, the system **SHALL** display "Harvest date not specified" and render a neutral grey freshness indicator.

### 6.2 Buyer Registration — Type Differentiation
* **FR-08**: During registration, when a user selects the Buyer role, the system **SHALL** prompt them to select their buyer type from:
  * Market Trader (I buy in bulk to resell)
  * Restaurant / Chop Bar (I buy for my business)
  * Individual Consumer (I buy for personal use)
* **FR-09**: If the user selects Market Trader or Restaurant / Chop Bar, the system **SHALL** display an additional field for `business_name`.
* **FR-10**: The system **SHALL** store `buyer_type` and `business_name` on the user record. Both fields are optional for all other roles and **SHALL NOT** be required for farmer or driver registration.
* **FR-11**: The system **SHALL** display the buyer's type as a badge on the Farmer Orders page so farmers can identify the nature of their buyer (e.g. "Market Trader 🏪").

### 6.3 Transport Cost at Order Checkout
* **FR-12**: When a buyer places an order, the system **SHALL** calculate an estimated transport cost at the time of order creation using the following formula:
  $$\text{Estimated Transport Cost} = ₵40.00 \text{ (base rate)} + (\text{quantity\_ordered} \times ₵2.00)$$
  This base rate represents an estimate for the Daboase/Beposo → Takoradi Market Circle corridor. It is explicitly labelled as an estimate throughout the UI.
* **FR-13**: The system **SHALL** store the estimated transport cost on the order record at creation time, in the existing `estimated_transport_cost` column.
* **FR-14**: The MoMo checkout drawer **SHALL** display a clear cost breakdown before the buyer authorises payment:
  * Line 1: Product Cost (quantity × unit price)
  * Line 2: Estimated Transport (Daboase → Market Circle)
  * Line 3: Total in Escrow (sum of above)
* **FR-15**: The MoMo payment request amount **SHALL** include both the product cost and the estimated transport cost.
* **FR-16**: The checkout drawer **SHALL** include a note explaining the escrow split:
  *"Your product payment goes to the farmer. Transport is released to the driver on confirmed delivery."*

### 6.4 Order Validation — Minimum Order Quantity
* **FR-17**: When a buyer submits an order, the system **SHALL** validate that `quantity_ordered` is greater than or equal to the product's `minimum_order_qty`. If not, the system **SHALL** return a validation error:
  *"This farmer requires a minimum order of [X] [unit]. Please increase your quantity."*

### 6.5 Delivery Payout Notifications
* **FR-18**: When a driver marks an order as delivered, the system **SHALL** send a notification to the farmer stating:
  *"Order #[ID] delivered. ₵[product_total] has been released to your account."*
* **FR-19**: When a driver marks an order as delivered, the system **SHALL** send a notification to the driver stating:
  *"Delivery complete. Your transport payout of ₵[transport_cost] has been released."*

### 6.6 Driver Job Board — Payout Visibility
* **FR-20**: Each available job card on the Driver Dashboard **SHALL** display the estimated transport payout for that job before the driver accepts it.

### 6.7 Welcome Page — Problem Narrative
* **FR-21**: The Welcome page **SHALL** contain a hero section with the platform scope statement clearly visible without scrolling.
* **FR-22**: The Welcome page **SHALL** contain a "The Problem We Solve" section referencing:
  * Post-harvest loss due to end-of-day distress sales
  * Lack of pre-committed buyers
  * Unresolved transport costs
* **FR-23**: The Welcome page **SHALL** contain a visual supply chain diagram representing:
  `Farm (Daboase/Beposo) → FarmLink Match → Aboboyaa Transit → Market Circle Trader`
* **FR-24**: The Welcome page **SHALL** contain a "How It Works" section with three steps corresponding to the core user flow.
* **FR-25**: The Welcome page **SHALL** contain a "Who It's For" section naming the three stakeholders explicitly: tomato farmers in Daboase/Beposo, market women at Takoradi Market Circle, and aboboyaa transport operators.

### 6.8 Buyer Browse Page — Context and Filtering
* **FR-26**: The buyer browse page **SHALL** display a focus corridor banner communicating:
  *"Connecting Daboase & Beposo tomato farmers to Takoradi Market Circle — fresh produce, agreed prices, secured payment."*
* **FR-27**: The buyer browse page **SHALL** support filtering by `quality_grade` (All / Grade A / Grade B / Grade C).
* **FR-28**: Each product card on the buyer browse page **SHALL** display:
  * Days since harvest
  * Quality grade badge
  * Minimum order quantity
  * Freshness bar (FR-06)

---

## 7. Non-Functional Requirements

### 7.1 Data Safety
All database changes **SHALL** use nullable columns with defaults. No existing farmer listings, user accounts, or order records **SHALL** be modified by the new migrations.

### 7.2 Design Consistency
All new UI elements **SHALL** follow the Agri-Tech Modern design system as defined in `resources/css/design-tokens.css`. No hex values **SHALL** be hardcoded in Vue components.

### 7.3 No New Dependencies
This phase **SHALL NOT** introduce new npm packages or Composer packages.

### 7.4 Mobile Responsiveness
All new UI elements **SHALL** be functional and readable on screens from 320px width and above, following the existing mobile-first pattern.

### 7.5 Backward Compatibility
All new product fields are optional. Existing listings without harvest date or quality grade **SHALL** render gracefully in the UI with "Not specified" labels rather than errors.

---

## 8. Database Schema Changes

### 8.1 New Migration — `add_quality_fields_to_products_table`
**Table**: `products`  
**Action**: ADD COLUMNS

| Column | Type | Nullable | Default |
| --- | --- | --- | --- |
| `harvest_date` | `DATE` | YES | `NULL` |
| `quality_grade` | `ENUM('A','B','C')` | YES | `NULL` |
| `unit` | `VARCHAR(50)` | YES | `'crate'` |
| `minimum_order_qty` | `INTEGER` | YES | `1` |

### 8.2 New Migration — `add_buyer_profile_to_users_table`
**Table**: `users`  
**Action**: ADD COLUMNS

| Column | Type | Nullable | Default |
| --- | --- | --- | --- |
| `buyer_type` | `VARCHAR(50)` | YES | `NULL` |
| `business_name` | `VARCHAR(255)` | YES | `NULL` |

### 8.3 No Changes to Existing Columns or Tables
The `estimated_transport_cost` column already exists on the `orders` table from Phase 1. Phase 2 populates it at order creation time rather than at transport-request time. No column definition change is required.

---

## 9. UI/UX Requirements

### 9.1 New Reusable Component — `FreshnessBar.vue`
* **Location**: `resources/js/Components/UI/FreshnessBar.vue`
* **Props**:
  * `harvestDate`: String (date), Optional — ISO date string of harvest
  * `shelfLifeDays`: Number, Optional — Default: 4 (tomatoes)
* **Behaviour**:
  * Computes days elapsed since harvest
  * Renders a horizontal progress bar
  * Colour transitions: green (0–40% elapsed) → yellow (40–75%) → red (75–100%+)
  * If `harvestDate` is null: render grey bar with "No date provided" label
* **Constraints**:
  * Pure presentation component — no emits, no API calls, no Inertia dependencies

### 9.2 `FarmerDashboard.vue` — Post Produce Modal
The existing "Post Produce" modal form **SHALL** be extended with the following new fields in order:
1. Harvest Date (date picker, max = today)
2. Quality Grade (3 selectable cards: A / B / C with descriptions)
3. Unit of Sale (select: Crate / Bag / Kg)
4. Minimum Order Quantity (number input, min = 1)

### 9.3 `BuyerBrowse.vue` — MoMo Checkout Drawer
The existing MoMo checkout drawer **SHALL** be updated to show:
1. Product line item
2. Estimated transport line item (labeled as estimate)
3. Total in escrow (bold)
4. Explanatory note on the payout split

---

## 10. System Constraints

| Constraint | Reason |
| --- | --- |
| **No real-time features** | Out of scope per original SRS |
| **No GPS or live maps** | Out of scope per original SRS |
| **Transport rate is an estimate** | Real aboboyaa rates for the corridor are not yet confirmed; must be labeled as estimate throughout |
| **No cold storage integration** | Infrastructure does not exist in the target area |
| **Single supply corridor only** | Daboase/Beposo → Market Circle; no other routes in this phase |

---

## 11. Verification & Acceptance Criteria

### 11.1 Registration
* A new buyer can register and select "Market Trader" as their buyer type
* A new buyer who selects Market Trader sees and can fill a Business Name field
* A new farmer or driver registration is not affected by the `buyer_type` field

### 11.2 Product Listing
* A farmer can create a listing with harvest date, quality grade, unit, and minimum order qty
* A farmer can create a listing without these fields (they are optional)
* Existing products are visible and functional after migration

### 11.3 Buyer Browse
* Listings with harvest dates show correct "days since harvest" count
* Freshness bar renders green/yellow/red correctly per threshold
* Listings without harvest date render gracefully (grey bar, "not specified")
* Quality grade filter works (filter by A / B / C returns correct results)
* Focus corridor banner is visible on the browse page

### 11.4 Order Placement
* Checkout drawer shows product cost, transport cost, and total separately
* Attempting to order below `minimum_order_qty` returns a validation error
* Order record stores `estimated_transport_cost` at creation time

### 11.5 Delivery & Payout
* Driver Dashboard shows estimated transport payout on each job card before acceptance
* On delivery completion, farmer receives notification with product payout amount
* On delivery completion, driver receives notification with transport payout amount

### 11.6 Welcome Page
* Scope statement visible in hero without scrolling
* Supply chain diagram rendered
* "The Problem We Solve", "How It Works", and "Who It's For" sections present

### 11.7 Regression
* `php artisan test` passes with no new failures
* Existing MoMo payment flow functions end-to-end
* Existing driver accept/pickup/deliver flow functions end-to-end

---

## 12. Out of Scope for This Phase
* Admin panel or dispute resolution mechanism
* Cold storage booking or management
* Aggregation pooling (multiple farmers sharing a single order)
* Live GPS or real-time driver tracking
* Real MTN MoMo production API (sandbox only)
* Push notifications (SMS or mobile)
* Any features not listed in Section 6

---

# FarmLink Phase 2 — Build Phases
### GDSS-PSInno AgriTech Innovation Challenge Finals Upgrade

| Attribute | Details |
| --- | --- |
| Document Version | v1.0 |
| Status | Draft — Awaiting Review |
| Date | 30 July 2026 |
| Team | Team Mythos |
| Parent SRS | FarmLink Phase 2 SRS v1.0 |
| Branch | feature/finals-upgrade |

---

## Overview
The Phase 2 upgrade is divided into 4 sequential build phases. Each phase is independently testable and builds on the previous. No phase requires work from a later phase to function.

| Phase | Name | Focus | Judge Concern Addressed |
| --- | --- | --- | --- |
| **A** | Database & Backend Foundation | Schema + logic changes | Precondition for all others |
| **B** | Quality & Freshness Layer | Product quality fields + freshness UI | "Buyers need quality/freshness info" |
| **C** | Buyer Definition & Transaction Transparency | Buyer types + transport cost at checkout | "Define your buyer" + "Transport cost problem" |
| **D** | Story & Narrative Layer | Welcome page + browse focus banner | "Narrow your scope" + "Learn from farmers" |

---

## Phase A — Database & Backend Foundation

### Objective
Lay the data and logic foundation that all frontend phases depend on. No UI changes in this phase — purely backend and database.

### Deliverables

#### A1 — Migration: Quality Fields on Products
Create and run a new migration that adds the following nullable columns to the `products` table:

| Column | Type | Default | Purpose |
| --- | --- | --- | --- |
| `harvest_date` | `DATE` | `NULL` | When the crop was picked |
| `quality_grade` | `ENUM('A','B','C')` | `NULL` | Farmer-declared quality level |
| `unit` | `VARCHAR(50)` | `'crate'` | Unit of sale |
| `minimum_order_qty` | `INTEGER` | `1` | Minimum wholesale quantity per order |

#### A2 — Migration: Buyer Profile Fields on Users
Create and run a new migration that adds the following nullable columns to the `users` table:

| Column | Type | Default | Purpose |
| --- | --- | --- | --- |
| `buyer_type` | `VARCHAR(50)` | `NULL` | market_trader / restaurant / individual |
| `business_name` | `VARCHAR(255)` | `NULL` | For market traders and restaurants |

#### A3 — ProductController Updates
Update `store()` and `update()` to:
* Accept and validate `harvest_date`, `quality_grade`, `unit`, `minimum_order_qty`
* All fields optional (nullable validation)
* Save fields to database

Update `buyerBrowse()` to:
* Compute `days_since_harvest` for each product and append to the result
* Accept and apply an optional `quality_grade` filter from query parameters
* Pass all new fields through to the Vue page as props

#### A4 — OrderController Updates
Update `store()` to:
* Calculate estimated transport cost at order creation time:  
  `estimated_transport_cost = 40.00 + (quantity_ordered * 2.00)`
* Store result in existing `estimated_transport_cost` column on the order
* Add the transport cost to the MoMo payment request amount:  
  `payment_amount = total_price + estimated_transport_cost`
* Validate that `quantity_ordered >= product.minimum_order_qty`. If not, return:  
  *"This farmer requires a minimum order of [X] [unit]. Please adjust your quantity."*

Update `completeDelivery()` to:
* Send farmer notification: *"Order #[ID] delivered. ₵[total_price] has been released to your account."*
* Send driver notification: *"Delivery complete. Your transport payout of ₵[estimated_transport_cost] has been released."*

Update `driverIndex()` to:
* Include `estimated_transport_cost` in the data passed to the Driver Dashboard view, so each job card can display the driver's payout.

#### A5 — AuthController Update
Update `register()` to:
* Accept `buyer_type` and `business_name` as optional fields
* Save to the `users` table when provided
* No validation change required — fields are optional and role-agnostic at the data layer

### Requirements Covered
FR-01, FR-02, FR-03, FR-04, FR-05, FR-08, FR-10, FR-12, FR-13, FR-15, FR-17, FR-18, FR-19, FR-20

### Dependencies
* None. This phase is the foundation.

### Acceptance Criteria
* `php artisan migrate` runs without errors on clean database
* `php artisan migrate --pretend` shows only ADD COLUMN operations — no drops or truncates
* A farmer can create a product with all new fields via Tinker or Postman
* An order created via Tinker/Postman includes `estimated_transport_cost` populated correctly
* `php artisan test` passes with no regressions

---

## Phase B — Quality & Freshness Layer

### Objective
Make quality and freshness information visible to both farmers (when listing) and buyers (when browsing). This is the most visible answer to the judge's concern about buyers having no information about crop condition.

### Deliverables

#### B1 — New Component: `FreshnessBar.vue`
* **Location**: `resources/js/Components/UI/FreshnessBar.vue`
* Pure display component. No emits. No API calls.

| Prop | Type | Required | Default |
| --- | --- | --- | --- |
| `harvestDate` | String (ISO date) | No | `null` |
| `shelfLifeDays` | Number | No | `4` |

**Rendering logic**:
* If `harvestDate` is null → grey bar + "Harvest date not specified"
* 0–2 days elapsed → Green bar ("Fresh")
* 3–4 days elapsed → Yellow bar ("Use Soon")
* 5+ days elapsed → Red bar ("Near Expiry")

#### B2 — `FarmerDashboard.vue` — Post Produce Modal
Extend the existing "Post Produce" modal with four new input fields (template only — no logic changes):
1. Harvest Date — date picker, max value = today
2. Quality Grade — three selectable cards displayed side by side:
   * A — Premium (best condition)
   * B — Standard (good condition)
   * C — Budget (quick sale)
3. Unit of Sale — dropdown: Crate / Bag / Kg
4. Minimum Order Quantity — number input, min = 1, label: "Minimum units a buyer must order"

Add to each product listing card on the dashboard:
* Quality grade badge (A=green, B=amber, C=orange pill)
* "Harvested [X] days ago" line below product name
* `FreshnessBar` component
* Near-expiry warning badge if `days_since_harvest >= 5`: "⚠️ Near Expiry"

#### B3 — `BuyerBrowse.vue` — Product Cards (Freshness Display Only)
Add to each product listing card in the browse view:
* "Harvested [X] days ago" line
* `FreshnessBar` component
* Quality grade badge
* Minimum order note: "Min. [X] crates" or equivalent unit

Add to the filter bar:
* Quality Grade filter: All / Grade A / Grade B / Grade C

### Requirements Covered
FR-01, FR-02, FR-03, FR-04, FR-05, FR-06, FR-07, FR-27, FR-28

### Dependencies
* Phase A must be complete — new product fields must exist in DB and be returned by the controller

### Acceptance Criteria
* A farmer can post a listing with harvest date, quality grade, unit, and min order qty
* The product card on `FarmerDashboard` shows quality badge + freshness bar
* The product card on `BuyerBrowse` shows harvest age + freshness bar
* A listing with harvest date = today shows green bar
* A listing with harvest date = 5+ days ago shows red bar and near-expiry badge
* A listing with no harvest date shows grey bar and "not specified"
* Quality grade filter on `BuyerBrowse` returns correct results

---

## Phase C — Buyer Definition & Transaction Transparency

### Objective
Clearly define who the buyer is and make the full cost of a transaction visible at checkout — including transport. This directly addresses the judge's concern about the platform not defining buyers and leaving transport costs unresolved.

### Deliverables

#### C1 — `Register.vue` — Buyer Type Selector
When the "Buyer" role card is selected during registration, reveal a second selection step:
*"What type of buyer are you?"*
* 🏪 Market Trader — I buy in bulk to resell
* 🍽️ Restaurant / Chop Bar — I buy for my business
* 🧍 Individual Consumer — I buy for personal use

If Market Trader or Restaurant is selected, reveal a Business Name text input.  
Bind `buyer_type` and `business_name` to the existing `useForm` object — no changes to form submission handler.

#### C2 — `BuyerBrowse.vue` — MoMo Checkout Drawer
Update the existing MoMo checkout drawer to show a cost breakdown before payment authorisation:

```
Product Cost:              ₵ [amount]
Estimated Transport:       ₵ [amount]   (Daboase → Market Circle)
─────────────────────────────────────────────────────────────
Total in Escrow:           ₵ [total]
```

Add note below the total:  
*"Your product payment goes to the farmer. Transport is released to the driver on confirmed delivery. Transport cost is an estimate for this route."*

#### C3 — `FarmerOrders.vue` — Buyer Type Badge
Add to each order card:
* Buyer type badge next to buyer name ("Market Trader 🏪", "Restaurant 🍽️", "Individual 🧍")
* Transport line: "Est. Transport: ₵[amount] — arranged by FarmLink"

This makes it immediately clear to farmers that they do not need to find a driver — the platform handles it.

#### C4 — `MyOrders.vue` — Order Detail
In each order's expanded detail view, add:
* Harvest date of the product ordered ("Harvested on [date]")
* Quality grade declared by farmer
* Payment breakdown: Product ₵[X] + Transport ₵[Y] = ₵[Total] in escrow
* Driver name once assigned

#### C5 — `DriverDashboard.vue` — Job Payout Display
On each available job card, add:
* "Your payout for this trip: ₵[estimated_transport_cost]"

This is the incentive for aboboyaa drivers to register and use the platform.

### Requirements Covered
FR-08, FR-09, FR-10, FR-11, FR-14, FR-15, FR-16, FR-19, FR-20

### Dependencies
* Phase A must be complete — buyer_type fields must exist in DB; transport cost must be in order data
* Phase B must be complete — harvest date and quality grade must exist in product data for C4

### Acceptance Criteria
* Registering as a Buyer shows the buyer type selector
* Selecting Market Trader shows the Business Name field
* Buyer type badge appears on each order in `FarmerOrders`
* MoMo checkout drawer shows the three-line cost breakdown
* Driver Dashboard job card shows the transport payout amount
* `MyOrders` shows harvest date, quality grade, and cost breakdown per order
* End-to-end flow: place order → driver sees payout → accepts → delivers → both get payout notifications

---

## Phase D — Story & Narrative Layer

### Objective
Ensure the platform communicates what it is and who it's for before a judge even logs in. This is purely a UI storytelling phase — no backend changes, no new logic, no new components.

### Deliverables

#### D1 — `Welcome.vue` — Full Rewrite
The Welcome page becomes the platform's pitch to the judges. It must communicate the problem, the solution, and the target users at a glance.

**Section 1 — Hero**
* Headline: "From Daboase Farm to Takoradi Market — Fresh. Committed. Secured."
* Sub-headline (scope statement): "FarmLink helps smallholder tomato farmers in Daboase and Beposo move produce to market women at Takoradi Market Circle — eliminating distress sales through pre-committed, escrow-secured orders."
* Two CTA buttons: Register as Farmer / Register as Buyer

**Section 2 — The Problem We Solve**  
Three problem cards:
* 🍅 "Tomatoes harvested in Daboase must sell the same day — or they're lost."
* ₵ "Without pre-committed buyers, farmers slash prices at day's end. Market women wait to exploit this."
* 🛺 "Transport costs are settled informally under time pressure — with no agreement in advance."

**Section 3 — The Supply Chain (Visual Diagram)**  
A horizontal visual:  
`🌾 Farm (Daboase/Beposo harvests crop) → 📱 FarmLink (Pre-committed order + escrow payment locked) → 🛺 Aboboyaa (Driver picks up on confirmation) → 🏪 Market Circle (Market woman receives fresh tomatoes)`

**Section 4 — How It Works (3 Steps)**
1. "Farmer lists fresh tomatoes with harvest date and quality grade"
2. "Market trader commits to a purchase — product + transport cost locked in escrow"
3. "FarmLink assigns an aboboyaa driver — farmer is paid, driver is paid, no waste"

**Section 5 — Who It's For**
* 🌾 Smallholder tomato farmers in Daboase and Beposo
* 🏪 Market women and traders at Takoradi Market Circle
* 🛺 Aboboyaa transport operators on the corridor

#### D2 — `BuyerBrowse.vue` — Focus Corridor Banner
Replace the existing generic seasonal promo banner with a focused context banner:  
*"Connecting Daboase & Beposo tomato farmers to Takoradi Market Circle — fresh produce, agreed prices, secured payment."*

Style it with the primary green color scheme, not the secondary orange.

### Requirements Covered
FR-21, FR-22, FR-23, FR-24, FR-25, FR-26

### Dependencies
* No backend dependencies
* Phases A, B, C do not need to be complete for D to be built — D is fully independent
* However, build D last so it reflects a complete, polished product

### Acceptance Criteria
* Welcome page hero is visible without scrolling on both mobile and desktop
* Scope statement is present in hero sub-headline
* Supply chain diagram is visible and legible
* Three problem cards, three how-it-works steps, and three who-it's-for entries are present
* Focus corridor banner is visible on the `BuyerBrowse` page
* All new elements follow the Agri-Tech Modern design system (CSS variables, no hardcoded hex)

---

## Build Sequence Summary

```
Phase A  ──────────────────────────────────────────────────────►  READY
         Database migrations + backend logic
         (Prerequisite for B and C)

Phase B  ──────────────────────────────────────────────────────►  READY
         FreshnessBar component + FarmerDashboard form
         + BuyerBrowse card quality display
         (Depends on A)

Phase C  ──────────────────────────────────────────────────────►  READY
         Register buyer type + Checkout cost breakdown
         + FarmerOrders badges + MyOrders detail
         + Driver payout display
         (Depends on A and B)

Phase D  ──────────────────────────────────────────────────────►  READY
         Welcome page rewrite + BuyerBrowse focus banner
         (Independent — but build last)
```

---

## Files Changed Per Phase

| Phase | Files |
| --- | --- |
| **A** | 2 new migration files, `OrderController.php`, `ProductController.php`, `AuthController.php` |
| **B** | `FreshnessBar.vue` (new), `FarmerDashboard.vue`, `BuyerBrowse.vue` (cards + filter only) |
| **C** | `Register.vue`, `BuyerBrowse.vue` (checkout drawer), `FarmerOrders.vue`, `MyOrders.vue`, `DriverDashboard.vue` |
| **D** | `Welcome.vue`, `BuyerBrowse.vue` (focus banner only) |

---
*End of Document — FarmLink Phase 2 SRS v1.0*
