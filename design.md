# Design Brief — Farmer-to-Buyer Marketplace

## 1. Visual identity

- **Palette**: earth/agriculture green as primary, not generic SaaS blue.
- Primary: `#2E7D32` (green 700) — buttons, active states, links
- Primary dark: `#1B5E20` — headers, emphasis text
- Background: `#F7F8F5` (warm off-white, not stark white)
- Card surface: `#FFFFFF`
- Border: `#E0E0DA`
- Text primary: `#1A1A1A`
- Text secondary: `#6B6B63`
- Status colors: success `#2E7D32`, warning `#B8860B` (amber, for pending), danger `#C62828` (for cancelled/failed)
- **Typography**: one sans-serif family throughout (system font stack is fine — Inter or similar if available). No serif, no decorative fonts.
- Headings: 500 weight only
- Body: 400 weight only
- Never use more than two font weights on a screen
- **Corners**: `8px` radius on buttons and inputs, `12px` on cards
- **Shadows**: none, or a single flat `0 1px 2px rgba(0,0,0,0.06)` on cards only — no glow, no gradients
- **Icons**: one consistent icon set (Tabler or Lucide, outline style only) — do not mix icon sets

## 2. Layout principles

- **Mobile-first, always.** Design and build the phone-width layout first, then expand to tablet/desktop. Most real users (farmers, small buyers) will use this on a phone browser.
- **Bottom nav on mobile** for the 3–4 main sections per role (e.g. Buyer: Browse, Orders, Notifications, Profile)
- **Generous tap targets** — minimum 44px height on buttons and list rows
- **Plain language labels** — no jargon, no icons-only navigation without text labels underneath
- Reference pattern: structure product grids and filters the way Jumia or Tonaton do — familiar layout reduces cognitive load for judges and real users alike. Do not copy their visual style, just the structural pattern (grid of cards, filter bar above, sort dropdown).

## 3. Screen-by-screen notes

### Auth (register/login)
- Single column, centered card on mobile, max-width 400px
- Role selector (Farmer / Buyer / Driver) as three large tappable cards, not a dropdown — makes the role choice visible and intentional
- Phone number as the primary login field (not email)

### Farmer dashboard
- Top: 3–4 metric cards in a row (active listings, pending orders, completed deliveries, average rating)
- Below: list of own produce listings, each with photo thumbnail, name, price, quantity remaining
- Prominent "+ Add listing" button, always reachable

### Produce listing form
- Photo upload first (drag/tap to upload), since it's the highest-impact field for buyer trust
- Then name, category (dropdown), quantity, price — in that order
- Live preview of the card as it will appear to buyers, if time allows

### Buyer browse/search
- Filter bar pinned near top: category, location, price range
- Grid of product cards (2 columns mobile, 3–4 desktop): photo, name, price, farmer name + star rating, distance/location tag
- Tapping a card opens a detail view with "Place order" as the one clear primary action

### Order tracking
- Simple horizontal status stepper: Pending → Processing → In transit → Delivered
- Use the status colors defined above, not five different colors per stage
- Notification bell icon in header, badge count for unread

### Transport/driver view
- List of available delivery requests as cards: pickup location, drop-off location, estimated cost, distance
- Single "Accept" button per card
- Once accepted, same status stepper as buyer sees, with an update-status control for the driver only

### Ratings
- Simple 1–5 star input, optional short text field, shown only after an order reaches "Delivered"
- Display average rating as a rounded number + star icon everywhere a user's name appears (farmer card, driver card)

## 4. What to avoid

- No gradients, no neon accents, no dark hero sections — keep it plain and legible
- No more than one accent color used for calls-to-action per screen
- No carousels or hidden tabs for content that should just be visible (judges have limited time to click around)
- Don't design desktop-first and shrink down — build mobile layouts natively

## 5. One-line summary to paste as a system instruction

> "Build all UI mobile-first using a green (#2E7D32) and warm off-white (#F7F8F5) palette, 8–12px rounded corners, no gradients or shadows beyond a subtle card border, one sans-serif font at weights 400/500 only, and Tabler or Lucide outline icons throughout. Reference Jumia/Tonaton's card-grid-plus-filter-bar structure for marketplace screens."
