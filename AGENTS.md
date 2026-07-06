# AGENTS.md — AI Core Instructions for FarmLink

## 1. System Context
You are building "FarmLink", a monolithic Laravel + Inertia.js + Vue.js web application for a localized farmer-to-buyer marketplace in the Western Region of Ghana (Takoradi/Tarkwa). 

## 2. Strict Operational Rules
- **No Over-Engineering:** Do not install any extra packages unless explicitly told to. Do not use WebSockets, real-time live map components, or live payment gateways.
- **Incremental Progress:** Build exactly what is requested in the prompt. Do not write ahead or add features out of scope.
- **UI Consistency:** Follow the Agri-Tech Modern design system for every Vue component. See Section 4 for full token reference.
- **No Fragmentation:** Keep all frontend and backend code tightly integrated within this monorepo using Laravel Inertia prop injection. Do not write separate API boilerplate routes unless requested.
- **No Automatic Pushing:** Never push code to remote repositories unless the user has explicitly requested it. Always wait for the user to instruct to push before executing any push commands.

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
  - `redesign/phase-1-auth` — Login, Register, Role Selection, Location Setup
  - `redesign/phase-2-farmer` — Farmer Dashboard & screens
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
