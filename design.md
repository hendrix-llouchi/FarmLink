# Design Brief — FarmLink Agri-Tech Modern

> **Status:** Active Redesign — Updated 2026-07-06
> **Source:** Stitch "Agri-Tech Modern" palette
> **Supersedes:** All previous design notes in this file

---

## 1. Visual Identity

### Color Palette
All values are defined as CSS variables in `resources/css/design-tokens.css`. **Never hardcode hex values in Vue components.**

| Role | Variable | Value |
|---|---|---|
| Primary | `--color-primary` | `#2D6A4F` |
| Primary Hover | `--color-primary-hover` | `#1B4332` |
| Primary Light | `--color-primary-light` | `#52B788` |
| Primary Lighter | `--color-primary-lighter` | `#B7E4C7` |
| Secondary | `--color-secondary` | `#F4A261` |
| Secondary Dark | `--color-secondary-dark` | `#8B4513` |
| Tertiary | `--color-tertiary` | `#2A9D8F` |
| Tertiary Light | `--color-tertiary-light` | `#76C9C0` |
| Page Background | `--color-bg-page` | `#F8F9FA` |
| Card Surface | `--color-bg-card` | `#FFFFFF` |
| Border | `--color-border` | `#E9ECEF` |
| Input Border | `--color-border-input` | `#CED4DA` |
| Body Text | `--color-neutral-900` | `#212529` |
| Subtext | `--color-neutral-500` | `#6C757D` |
| Danger | `--color-danger` | `#DC3545` |

### Typography
- **Font Family:** Inter (Google Fonts) — weights 400, 500, 600, 700
- **Headline:** Inter 700, 24–32px
- **Body:** Inter 400, 14–16px
- **Label:** Inter 500, 12–13px
- **Caption:** Inter 400, 11–12px
- Import: `@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap')`

### Corners & Shadows
- Cards: `border-radius: 12px`, shadow: `0 2px 12px rgba(0,0,0,0.08)`
- Buttons & Inputs: `border-radius: 8px`
- Pills / Chips: `border-radius: 999px`
- FABs / Icon buttons: `border-radius: 50%`

### Gradients
Gradients **are** used — specifically:
- Auth hero panel overlay: `linear-gradient(160deg, rgba(27,67,50,0.82), rgba(45,106,79,0.70), rgba(42,157,143,0.45))`
- Glassmorphism elements: `backdrop-filter: blur(12px)` with semi-transparent borders

### Icon Library
- **Lucide Vue** outline icons only
- Do not mix icon libraries
- Icon stroke-width: `1.8–2`

---

## 2. Layout & Navigation

### Breakpoints
| Breakpoint | Navigation Pattern |
|---|---|
| Mobile `< 768px` | Bottom navigation bar (4–5 icon tabs, 64px tall) |
| Tablet `768px – 1024px` | Collapsible icon-only sidebar (64px wide) |
| Desktop `> 1024px` | Full left sidebar (icons + labels, 220px wide) |

### Layout Principles
- **Mobile-first:** Build for `< 768px` first, then scale up
- **No stretching:** Use `max-width` containers on all panels
- **44px tap targets:** Minimum height for all interactive elements
- Auth screens: Centered card on mobile, split-screen (hero + form) on desktop
- Dashboard screens: Sidebar + main content area on desktop, full-width on mobile

### Auth Layout (Desktop)
- Left panel: Full-height hero image with gradient overlay + glassmorphism stat bar
- Right panel: Scrollable form area, max-width `420–520px`

---

## 3. Component Standards

### Buttons
| Variant | Background | Text | Border |
|---|---|---|---|
| Primary | `var(--color-primary)` | White | None |
| Secondary | Transparent | `var(--color-primary)` | `1.5px solid var(--color-primary)` |
| Inverted | White | Dark | None |
| Outlined | Transparent | Neutral | `1.5px solid var(--color-border-input)` |
| Danger | `var(--color-danger)` | White | None |

All buttons: `border-radius: 8px`, `height: 44px`, `font-weight: 600`
Hover: subtle `translateY(-1px)` + shadow lift

### Inputs
- Height: `44px`
- Border: `1.5px solid var(--color-border-input)`
- Focus ring: `box-shadow: 0 0 0 3px var(--color-primary-subtle)`
- Background: `var(--color-neutral-50)` default, `white` on focus
- Icon inset left: standard pattern for all key fields

### Cards
- Background: `var(--color-white)`
- Border: `1px solid var(--color-border)` or shadow only
- Radius: `12px`
- Shadow: `0 2px 12px rgba(0,0,0,0.08)`

### Status Badges / Chips
- Pill shape (`border-radius: 999px`)
- Pending: secondary color
- Active / Delivered: primary color
- In Transit: tertiary color
- Cancelled / Rejected: danger color

---

## 4. Screen-by-Screen Notes

### Auth Screens (Phase 1 — current branch: `redesign/phase-1-auth`)
- **Login:** Split-screen. Left = hero farmland image with overlay + stats. Right = form with phone + password.
- **Register (Basic Info):** Same split-screen. Left = community tagline. Right = name/phone/email/password form.
- **Role Selection:** Full-screen. Three large tappable role cards (Farmer 🌾 / Buyer 🛒 / Transporter 🚚). Orange highlight on selected.
- **Location Setup:** Region + district dropdowns + "Find my location" button. Map-style visual.

### Farmer Dashboard (Phase 2 — `redesign/phase-2-farmer`)
- Sidebar navigation (desktop), bottom nav (mobile)
- Metric cards row: Revenue, Active Listings, Orders, Rating
- Produce grid with photo thumbnails, price, stock
- Floating "Post Produce" primary action button

### Buyer Marketplace (Phase 3 — `redesign/phase-3-buyer`)
- Category filter bar pinned near top
- Product grid: 2 cols mobile → 3–4 cols desktop
- Cards: photo, name, price, farmer name, location tag, "Buy Now" button
- Order detail view with horizontal progress stepper

### Transporter Portal (Phase 4 — `redesign/phase-4-transporter`)
- Available delivery jobs as cards
- Active trip info with map placeholder
- Status update control (transporter-only)

### Shared Screens (Phase 5 — `redesign/phase-5-shared`)
- Settings / Profile
- Notifications
- Admin panel (if applicable)

---

## 5. What to Avoid
- ❌ Hardcoded hex color values in Vue components — use CSS variables only
- ❌ Mixing icon libraries — Lucide only
- ❌ Touching JavaScript logic during redesign — template and CSS only
- ❌ Merging any redesign branch into `main` without explicit user approval
- ❌ Installing new npm/composer packages during redesign phase
- ❌ Desktop-first layout — always mobile-first then scale up

---

## 6. System Instruction (One-liner)

> "Build all FarmLink UI using the Agri-Tech Modern design system: Inter font, `#2D6A4F` primary green, `#F4A261` secondary orange, `#2A9D8F` tertiary teal, `8–12px` rounded corners, subtle card shadows, Lucide outline icons, and a bottom-nav-on-mobile / sidebar-on-desktop navigation pattern. All CSS values must reference CSS custom properties from `resources/css/design-tokens.css`."
