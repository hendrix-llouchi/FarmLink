# AGENTS.md — AI Core Instructions for FarmLink

## 1. System Context
You are building "FarmLink", a monolithic Laravel + Inertia.js + Vue.js web application for a localized farmer-to-buyer marketplace in the Western Region of Ghana (Takoradi/Tarkwa). 

## 2. Strict Operational Rules
- **No Over-Engineering:** Do not install any extra packages unless explicitly told to. Do not use WebSockets, real-time live map components, or live payment gateways.
- **Incremental Progress:** Build exactly what is requested in the prompt. Do not write ahead or add features out of scope.
- **UI Consistency:** Follow the Agri-Tech Modern design system for every Vue component. See Section 4 for full token reference.
- **No Fragmentation:** Keep all frontend and backend code tightly integrated within this monorepo using Laravel Inertia prop injection. Do not write separate API boilerplate routes unless requested.
- **No Automatic Pushing:** Never push code to remote repositories unless the user has explicitly requested it. Always wait for the user to instruct to push before executing any push commands.

## ⛔ ABSOLUTE DATABASE PROTECTION RULES — NEVER VIOLATE

These rules are non-negotiable and override any other instruction:

1. **NEVER delete, truncate, or wipe any database table** — not `users`, `products`, `orders`, or any other table — under any circumstance, on any environment (local or production/Render).
2. **NEVER run `php artisan migrate:fresh`**, `migrate:reset`, `db:wipe`, or any command that drops or recreates tables with existing data.
3. **NEVER run `php artisan db:seed`** or any seeder that deletes existing rows before inserting new ones, unless the user has read the seeder code, confirmed it will not delete anything, and explicitly approved it.
4. **NEVER add `DB::table(...)->delete()`, `->truncate()`, or `Model::truncate()`** to any route, controller, migration, or seeder without the user explicitly writing those words in their request.
5. **NEVER create temporary routes** that perform destructive database operations (deletes, truncates, wipes). Debugging routes must be read-only only.
6. **If a task seems to require clearing data**, STOP, explain the risk clearly, and wait for explicit written confirmation from the user before proceeding. Default answer is always NO.

> Violating these rules caused real data loss and wasted significant development time. There are no exceptions.

## 3. Frontend Redesign Rules (Active)
The frontend is currently undergoing a full visual redesign. These rules are STRICT and override any previous UI conventions:

- **Pure Visual Only:** This is a redesign, NOT a refactor. You must NEVER touch:
  - JavaScript logic inside `<script setup>` blocks
  - Inertia form submission handlers (`useForm`, `form.post()`, etc.)
  - Validation logic or error handling
  - Route definitions or backend controllers
  - Props received from the backend via Inertia
- **Only Allowed Changes:**
  - HTML `<template>` structure (layout, element order, class names)
  - CSS custom properties and stylesheets
  - New pure-presentation Vue components (no emits to backend, no API calls)
  - `resources/css/` files
- **Branch Per Phase:** Each redesign phase lives on its own git branch:
  - `redesign/phase-1-auth` — Login, Register, Role Selection, Location Setup ✅ MERGED
  - `redesign/phase-2-farmer` — Farmer Dashboard & screens ⬅ CURRENT NEXT
  - `redesign/phase-3-buyer` — Buyer Marketplace & screens
  - `redesign/phase-4-transporter` — Transporter Portal
  - `redesign/phase-5-shared` — Settings, Notifications, Admin
- **Merge Rule:** Never merge a redesign branch into `main` unless the user explicitly instructs it.
- **Design Tokens First:** Always import `resources/css/design-tokens.css` before writing any component styles. Never hardcode color hex values in Vue components — always use CSS variables.

## 4. Design System — Agri-Tech Modern

### Colors (CSS Variables defined in `resources/css/design-tokens.css`)
| Variable | Value | Usage |
|---|---|---|
| `--color-primary` | `#2D6A4F` | Primary buttons, active nav, key accents |
| `--color-primary-hover` | `#1B4332` | Hover on primary elements |
| `--color-primary-light` | `#52B788` | Hover states, icon backgrounds |
| `--color-primary-lighter` | `#B7E4C7` | Tag/chip backgrounds, subtle tints |
| `--color-secondary` | `#F4A261` | Secondary actions, buyer accents, warnings |
| `--color-secondary-dark` | `#8B4513` | Text on light secondary bg |
| `--color-tertiary` | `#2A9D8F` | In-transit status, transporter accents |
| `--color-tertiary-light` | `#76C9C0` | Tertiary backgrounds |
| `--color-neutral-50` | `#F8F9FA` | Page backgrounds |
| `--color-neutral-100` | `#E9ECEF` | Card borders, dividers |
| `--color-neutral-300` | `#CED4DA` | Input borders |
| `--color-neutral-500` | `#6C757D` | Placeholder, subtext |
| `--color-neutral-700` | `#495057` | Secondary body text |
| `--color-neutral-900` | `#212529` | Headings, primary text |
| `--color-danger` | `#DC3545` | Delete, error, rejected |
| `--color-white` | `#FFFFFF` | Card surfaces, modal backgrounds |

### Typography
- **Font Family:** Inter (Google Fonts) — weights 400, 500, 600, 700
- **Headline:** Inter 700, 24–32px
- **Body:** Inter 400, 14–16px
- **Label:** Inter 500, 12–13px
- **Caption:** Inter 400, 11–12px

### Spacing & Shape
- **Border radius cards:** `12px`
- **Border radius buttons/inputs:** `8px`
- **Border radius pills/chips:** `999px`
- **Border radius FABs:** `50%`
- **Card shadow:** `0 2px 12px rgba(0,0,0,0.08)`
- **Input height:** `44px`
- **Sidebar width (desktop):** `220px`
- **Sidebar width (collapsed):** `64px`

### Navigation Layout
| Breakpoint | Pattern |
|---|---|
| Mobile `< 768px` | Bottom navigation bar (4–5 icon tabs) |
| Tablet `768px – 1024px` | Collapsible icon-only sidebar |
| Desktop `> 1024px` | Full left sidebar (icons + labels) |

### Button Variants
| Variant | Style |
|---|---|
| Primary | `bg: var(--color-primary)`, white text, `border-radius: 8px` |
| Secondary | Transparent bg, `border: 1.5px solid var(--color-primary)`, primary text |
| Inverted | White bg, dark text |
| Outlined | Neutral border, neutral text |
| Danger | `bg: var(--color-danger)`, white text |

### Icon Library
Use **Lucide Vue** outline icons only. Do not mix icon libraries.

## 5. Shared UI Components
All reusable presentation components live in `resources/js/Components/UI/`:
- `AppButton.vue` — All button variants
- `AppInput.vue` — Styled text/select/textarea inputs
- `AppCard.vue` — Standard card wrapper
- `AppBadge.vue` — Status chips

These components must be used across all screens — do not re-implement button or input styles inline.

## 6. Redesign Progress Tracker

### ✅ Phase 1 — Auth (MERGED into main, PR #21)
**Branch:** `redesign/phase-1-auth`
| File | Status |
|---|---|
| `resources/js/Pages/Auth/Login.vue` | ✅ Redesigned — split-screen hero + form |
| `resources/js/Pages/Auth/Register.vue` | ✅ Redesigned — split-screen, 3-section form, color-coded role cards |
| `resources/js/Pages/Auth/ForgotPassword.vue` | ✅ New — centered card, blob bg, 6-digit code flow |
| `resources/js/Pages/Auth/ResetPassword.vue` | ✅ New — phone + token + new password |
| `resources/css/design-tokens.css` | ✅ Created — full CSS variable system |
| `resources/css/app.css` | ✅ Updated — Inter font, base resets |
| `resources/views/app.blade.php` | ✅ Updated — CSS via Vite, Inter font |
| `app/Http/Controllers/AuthController.php` | ✅ Updated — forgot/reset password methods added |
| `database/migrations/2026_07_06_000000_add_reset_token_to_users_table.php` | ✅ Migrated |
| `routes/web.php` | ✅ Updated — forgot/reset routes added |

### ✅ Phase 2 — Farmer Dashboard (MERGED into main, PR #22)
**Branch:** `redesign/phase-2-farmer`
| File | Status | Notes |
|---|---|---|
| `resources/js/Pages/FarmerDashboard.vue` | ✅ Redesigned | Sidebar nav, collapsible tablet sidebar, bottom nav capsule, metrics cards, product listings |

### ✅ Phase 3 — Buyer Marketplace (MERGED into main, PR #23)
**Branch:** `redesign/phase-3-buyer`
| File | Status | Notes |
|---|---|---|
| `resources/js/Pages/BuyerBrowse.vue` | ✅ Redesigned | Full-width product cards, categories, seasonal promo banner, drawer MoMo checkout |
| `resources/js/Pages/MyOrders.vue` | ✅ Redesigned | Status-bordered tracking timeline/logs |

### ✅ Phase 4 — Transporter Portal (MERGED into main, PR #24)
**Branch:** `redesign/phase-4-transporter`
| File | Status | Notes |
|---|---|---|
| `resources/js/Pages/DriverDashboard.vue` | ✅ Redesigned | Active trip card stages, pickup/delivered action buttons, bottom nav |

### ✅ Phase 5 — Shared Screens (MERGED into main, PR #28)
**Branch:** `redesign/phase-5-shared`
| File | Status | Notes |
|---|---|---|
| `resources/js/Pages/Settings.vue` | ✅ Redesigned | User Profile, password reset forms, and average platform rating card |
| `resources/js/Pages/Notifications.vue` | ✅ Redesigned | In-app alerts feed, read states, category icons, and clear-all actions |

## 7. Running the Project Locally
```bash
# Terminal 1 — Frontend (Vite)
npm run dev

# Terminal 2 — Backend (Laravel)
php artisan serve

# Database — Start MySQL via XAMPP Control Panel manually
# Then visit: http://127.0.0.1:8000
```
