# AGENTS.md — AI Core Instructions for FarmLink

## 1. System Context
You are building "FarmLink", a monolithic Laravel + Inertia.js + Vue.js web application for a localized farmer-to-buyer marketplace in the Western Region of Ghana (Takoradi/Tarkwa). 

## 2. Strict Operational Rules
- **No Over-Engineering:** Do not install any extra packages unless explicitly told to. Do not use WebSockets, real-time live map components, or live payment gateways.
- **Incremental Progress:** Build exactly what is requested in the prompt. Do not write ahead or add features out of scope.
- **UI Consistency:** Follow the Agri-Tech Modern design system for every Vue component. See Section 4 for full token reference.
- **No Fragmentation:** Keep all frontend and backend code tightly integrated within this monorepo using Laravel Inertia prop injection. Do not write separate API boilerplate routes unless requested.
- **No Automatic Pushing — ABSOLUTE RULE:** NEVER run `git push` to any remote (origin, GitHub, Render, or any other) under any circumstance unless the user has typed an explicit instruction in the current message such as "push", "push to GitHub", or "push to main". Even if a task is complete, even if the branch is ready — DO NOT PUSH. Commit locally only, then STOP and wait.

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

---

## 8. Deployment Environment

- **Production URL:** FarmLink is live on **Render** (https://render.com).
- **Local DB:** MySQL via XAMPP (start manually from XAMPP Control Panel before running migrations).
- **CRITICAL:** Never run destructive commands (`migrate:fresh`, `db:wipe`, `truncate`) against the production Render database. All schema changes must use additive, nullable migrations only.
- **Environment files:** `.env` is local only. Render has its own environment variables configured in the Render dashboard. Never commit `.env` to git.

---

## 9. Git & Pull Request Workflow — MANDATORY

This is the required workflow every time code changes are made on a branch. These rules are NON-NEGOTIABLE.

### ⛔ ABSOLUTE GUARDRAIL — NO DIRECT PUSH OR MERGE TO MAIN
1. **NEVER run `git merge` into `main`** under any circumstance.
2. **NEVER run `git push origin main`** or push directly to `main` under any circumstance.
3. **ALWAYS push ONLY to feature branches** (`git push origin <branch-name>`).
4. **STOP at providing the pre-filled GitHub PR link** for the user to review and merge manually. The agent's job ends when the PR link is provided.
5. Even if the user says "push to main" or "push it", push ONLY the feature branch (`git push origin <branch-name>`) and output the GitHub PR comparison link.

### ⛔ Rule 1 — Never Push Without Explicit Permission
- **NEVER run `git push`** to any remote (origin, GitHub, Render deploy hooks, or any other destination) unless the user has written an explicit instruction in the current message.
- Acceptable trigger phrases: "push", "push it", "push to GitHub", "push to main", "push the branch", "go ahead and push".
- If the user says "commit" — commit only, do NOT push.
- If the user says "save" or "done" — commit only, do NOT push.
- **Default behavior after completing code work: commit locally, then STOP. Report what was done. Wait.**

### ✅ Rule 2 — Branch-to-PR Workflow (After Code is Complete)
When all code for a feature or phase is committed on a branch, the agent MUST follow this sequence:

**Step 1 — Commit** all changes with a clear, descriptive commit message.

**Step 2 — Report** a summary of what was built. Include:
- Files changed and what changed in each
- Acceptance criteria met
- Any pending manual steps (e.g., run migrations, start XAMPP)

**Step 3 — Wait for push permission.** Do not push until the user says so.

**Step 4 — When the user says to push**, push the branch to origin:
```bash
git push origin <branch-name>
```

**Step 5 — Provide a clickable PR creation link** in this exact format so the user can click it and open a pre-filled GitHub PR:

```
https://github.com/hendrix-llouchi/FarmLink/compare/main...<branch-name>?quick_pull=1&title=<PR+Title>&body=<PR+body+URL+encoded>
```

Always output the link as a clickable markdown link, for example:

> 🔗 **[Click here to open the Pull Request on GitHub](https://github.com/hendrix-llouchi/FarmLink/compare/main...feature/finals-upgrade?quick_pull=1&title=feat%3A+Phase+A+%E2%80%94+Database+%26+Backend+Foundation&body=...)**

### ✅ Rule 3 — PR Description Requirements
Every PR link the agent provides MUST include a pre-filled body containing:
- **What this PR does** — one sentence summary
- **Files changed** — bullet list
- **How to test** — step-by-step manual verification
- **Phase / Feature** — which SRS phase or feature this belongs to
- **Acceptance criteria met** — checkboxes matching the SRS

### ✅ Rule 4 — Never Merge
- **NEVER merge any branch into `main`** unless the user explicitly says "merge" or "merge into main".
- The agent's job ends at providing the PR link. The user reviews and merges.

---

## 10. Future Roadmap / Do Later Backlog

The following features are explicitly put on hold by the user to be implemented in a future phase:

- **Offline Driver SMS / Push Notification Alert Service (Item 2)**:
  - *Context*: Alerting Aboboyaa drivers via SMS/Push when a new paid delivery order is listed in their area.
  - *Status*: **ON HOLD / DO LATER**.
  - *Planned Approach*: Simulated SMS dispatch logging in dev (`SmsService`) + HTTP API call to Ghana SMS providers (e.g. Arkesel/Hubtel) in production + database alert records.

