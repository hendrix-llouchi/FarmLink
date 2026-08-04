# Beposo & Daboase — Delivery Logistics Research
> Researched: 2026-08-04 | Relevant to: FarmLink Western Region Delivery Pricing

---

## 1. Location Context

| Town | District | Position |
|---|---|---|
| **Beposo** | Shama District | Sits directly on the N1 Accra–Takoradi coastal highway |
| **Daboase** | Wassa East District | ~11.5 km inland (north) off the N1 highway |

- Coming from Accra, you meet **Beposo first**, then Daboase Junction further west.
- Daboase is the **capital of Wassa East District**, near the Pra River.
- Distance between the two towns: **~11.5 km** (~25 min drive).

---

## 2. Distance to Market Circle, Takoradi

| Route | Distance | Est. Travel Time |
|---|---|---|
| Beposo → Market Circle | **31 km** | ~35–45 mins |
| Daboase → Market Circle | **41 km** | ~50–60 mins |

**Why is Daboase further despite being closer to Takoradi on the map?**
Daboase is 11.5 km inland. Drivers must go south to Daboase Junction first, then west along the N1. Beposo is already on the N1 — no detour needed.

---

## 3. Aboboya Delivery Cost Estimates

### Cost Parameters Used
| Parameter | Value |
|---|---|
| Petrol price | GH₵ 15.50 / litre |
| Aboboya fuel economy (loaded) | ~25 km / litre |
| Average speed | ~35 km/h |
| Operator labor rate | GH₵ 25.00 / hour |
| Maintenance & wear | GH₵ 0.50 / km |

### Cost Breakdown

| Cost Component | Beposo (31 km) | Daboase (41 km) |
|---|---|---|
| Fuel | GH₵ 19.22 | GH₵ 25.42 |
| Labor | GH₵ 22.14 | GH₵ 29.29 |
| Maintenance | GH₵ 15.50 | GH₵ 20.50 |
| **Base Operating Cost** | **GH₵ 56.86** | **GH₵ 75.21** |
| **App Price (35% margin)** | **GH₵ 76.76** | **GH₵ 101.53** |

---

## 4. Will Buyers Pay This?

**Not for small/retail orders.** A GH₵ 77–102 delivery fee is unacceptable for a single item.

**Yes, for bulk/wholesale orders** — under 3 conditions:

### Condition 1 — Wholesale Bulk Buying
- Farm-gate prices in Beposo/Daboase are significantly cheaper than Market Circle middlemen.
- Savings of GH₵ 300–500 on a full Aboboya load easily justifies GH₵ 77–102 delivery.

### Condition 2 — Market Days (Price Drops)
| Town | Active Market Days |
|---|---|
| Beposo | **Tuesdays & Fridays** |
| Daboase | **Mondays & Thursdays** |

On these days, farm produce prices drop sharply. Delivery cost is easily absorbed.

### Condition 3 — Group / Pooled Orders
- 4 households splitting a GH₵ 102 Daboase delivery = **GH₵ 25.50 per household** — very acceptable.

---

## 5. App Design Recommendations (from research)

| Feature | Rationale |
|---|---|
| **Minimum order threshold** | Enforce bulk-only ordering for long-distance routes (no single-item retail for 31+ km) |
| **Savings counter UI** | Show "You save ~GH₵ 150 vs. Market Circle prices" to justify delivery fee |
| **Route consolidation / pooling** | Group multiple Takoradi buyers ordering from same town on same day — lower per-buyer cost, higher rider payout |
| **Dynamic pricing on market days** | Reduce delivery fee slightly on Tue/Fri (Beposo) and Mon/Thu (Daboase) to drive volume |
| **Empty return multiplier** | If rider returns empty, apply ~1.6x base rate or implement return-load matching |
| **Weight-based surcharge** | Loads >500 kg drop fuel economy from 25 km/L to ~15 km/L — price accordingly |

---

## 6. Key Insight for FarmLink

> FarmLink is not a last-mile food delivery app. It is a **farm-to-bulk-buyer logistics platform**.
> The unit economics only work when orders are **wholesale-sized**, buyers understand they are cutting out the middleman, and the app clearly communicates the **savings vs. Market Circle prices**.
> The Aboboya driver is the backbone of the last-mile rural corridor — not a courier, but a **cargo hauler**.
