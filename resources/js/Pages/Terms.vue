<template>
  <div class="terms-page">
    <Head title="Terms & Conditions — FarmLink" />

    <!-- 1. STICKY APP HEADER -->
    <header class="app-header">
      <div class="header-inner">
        <!-- Logo -->
        <Link href="/" class="app-logo">
          <svg class="logo-icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/>
            <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>
          </svg>
          <span class="app-logo-text">FarmLink</span>
        </Link>

        <!-- Navigation Links -->
        <div class="header-nav">
          <Link href="/" class="nav-link">Home</Link>
          
          <template v-if="$page.props.auth && $page.props.auth.user">
            <Link :href="dashboardRoute" class="nav-primary-btn">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"/>
                <rect x="14" y="3" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/>
              </svg>
              <span>Back to Dashboard</span>
            </Link>
          </template>
          <template v-else>
            <Link href="/login" class="nav-login-btn">Log In</Link>
            <Link href="/register" class="nav-primary-btn">Get Started</Link>
          </template>
        </div>
      </div>
    </header>

    <!-- 2. HERO HEADER SECTION -->
    <section class="terms-hero">
      <div class="hero-inner">
        <div class="hero-badge-pill">
          <span class="badge-dot"></span>
          <span>Western Region Pilot Corridor Agreement</span>
        </div>
        <h1 class="hero-title">Terms &amp; Conditions</h1>
        <p class="hero-subtitle">
          Operational rules, escrow safeguards, and mutual commitments for farmers, buyers, and transporters across the Daboase–Beposo–Takoradi corridor.
        </p>
        
        <div class="hero-meta-bar">
          <div class="meta-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
              <line x1="16" y1="2" x2="16" y2="6"/>
              <line x1="8" y1="2" x2="8" y2="6"/>
              <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            <span><strong>Effective Date:</strong> October 2026</span>
          </div>
          <div class="meta-divider">•</div>
          <div class="meta-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
            <span><strong>Jurisdiction:</strong> Western Region, Ghana</span>
          </div>
          <div class="meta-divider">•</div>
          <div class="meta-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/>
              <polyline points="12 6 12 12 14 14"/>
            </svg>
            <span><strong>Version:</strong> 1.0 (Pilot)</span>
          </div>
        </div>
      </div>
    </section>

    <!-- 3. MAIN CONTENT BODY -->
    <main class="terms-main">
      <div class="main-container">

        <!-- Quick Jump Navigation -->
        <nav class="quick-nav-bar" aria-label="Table of Contents">
          <span class="quick-nav-label">Jump to Section:</span>
          <div class="quick-nav-pills">
            <a href="#overview" class="quick-pill">1. Overview</a>
            <a href="#roles" class="quick-pill">2. Roles &amp; Accounts</a>
            <a href="#produce" class="quick-pill">3. Produce &amp; Grading</a>
            <a href="#escrow" class="quick-pill">4. Escrow &amp; Payments</a>
            <a href="#transport" class="quick-pill">5. Transport Logistics</a>
            <a href="#inspection" class="quick-pill">6. Inspection &amp; Payout</a>
            <a href="#disputes" class="quick-pill">7. Disputes &amp; Refunds</a>
            <a href="#conduct" class="quick-pill">8. Conduct &amp; Prohibitions</a>
            <a href="#liability" class="quick-pill">9. Liability &amp; Disclaimers</a>
            <a href="#law" class="quick-pill">10. Applicable Law</a>
          </div>
        </nav>

        <!-- Terms Content Wrapper -->
        <div class="terms-content">

          <!-- Section 1 -->
          <article id="overview" class="terms-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"/>
                  <line x1="12" y1="16" x2="12" y2="12"/>
                  <line x1="12" y1="8" x2="12.01" y2="8"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 1</span>
                <h2 class="section-heading">Platform Overview &amp; Corridor Purpose</h2>
              </div>
            </div>
            
            <div class="section-body">
              <p>
                FarmLink is a digital agricultural marketplace and escrow facilitation platform engineered specifically for the <strong>Western Region of Ghana</strong>. The platform connects tomato-farming communities in <strong>Daboase and Beposo</strong> with wholesale market traders, chop bars, restaurants, and retail buyers situated around the <strong>Takoradi Market Circle</strong>.
              </p>
              <p>
                The primary purpose of FarmLink is to eliminate exploitative distress sales by empowering smallholder farmers to pre-commit harvests before produce is cut, securing buyer commitments upfront through Mobile Money escrow, and organizing reliable transport via local Aboboyaa tricycle operators.
              </p>
              <div class="callout-box info-callout">
                <div class="callout-title">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                  </svg>
                  <span>Core Principle: Escrow-First Guarantee</span>
                </div>
                <p>
                  No farmer is required to release produce, and no driver is expected to commence transit, until full buyer payment is locked inside the FarmLink Mobile Money Escrow vault.
                </p>
              </div>
            </div>
          </article>

          <!-- Section 2 -->
          <article id="roles" class="terms-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                  <circle cx="9" cy="7" r="4"/>
                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 2</span>
                <h2 class="section-heading">User Roles, Registration &amp; Account Eligibility</h2>
              </div>
            </div>

            <div class="section-body">
              <p>Every participant on FarmLink operates under a verified role. You agree to provide authentic, up-to-date credentials upon registration:</p>

              <div class="roles-grid">
                <div class="role-card">
                  <div class="role-card-header farmer-header">
                    <span class="role-tag">Role: Farmer</span>
                    <h3>Smallholder Producer</h3>
                  </div>
                  <p>
                    Agricultural producers with active cultivation in Daboase, Beposo, or neighboring Western Region farming belts. Responsible for accurate harvest dates, honest produce grading, and fair pricing.
                  </p>
                </div>

                <div class="role-card">
                  <div class="role-card-header buyer-header">
                    <span class="role-tag">Role: Buyer</span>
                    <h3>Wholesale &amp; Retail Purchaser</h3>
                  </div>
                  <p>
                    Market Circle wholesale traders, local restaurants, chop bars, or individual consumers committing funds to purchase fresh produce with designated delivery drop-offs.
                  </p>
                </div>

                <div class="role-card">
                  <div class="role-card-header driver-header">
                    <span class="role-tag">Role: Driver</span>
                    <h3>Aboboyaa Cargo Transporter</h3>
                  </div>
                  <p>
                    Registered tricycle and mini-truck operators who accept delivery jobs, inspect cargo batches at farm gates, and transport produce safely to Takoradi drop-off stations.
                  </p>
                </div>
              </div>

              <h4 class="sub-heading">Phone-Number Authentication</h4>
              <p>
                Accounts are registered and authenticated using Ghanaian mobile phone numbers (MTN, Telecel, or AT). You are solely responsible for all activity conducted under your registered phone number and PIN authentication credentials.
              </p>
            </div>
          </article>

          <!-- Section 3 -->
          <article id="produce" class="terms-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                  <line x1="3" y1="6" x2="21" y2="6"/>
                  <path d="M16 10a4 4 0 0 1-8 0"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 3</span>
                <h2 class="section-heading">Produce Listings, Quality Grades &amp; Freshness Tracking</h2>
              </div>
            </div>

            <div class="section-body">
              <p>
                To maintain transparency and eliminate quality disputes, all produce listings on FarmLink must conform to strict corridor grading benchmarks:
              </p>

              <div class="grades-spec-table">
                <div class="spec-row">
                  <div class="spec-cell grade-col"><span class="badge-grade grade-a">Grade A</span></div>
                  <div class="spec-cell desc-col">
                    <strong>Premium Wholesale:</strong> Firm, uniform shape, mature green to light breaker stage, suitable for multi-day market display and transit resilience.
                  </div>
                </div>
                <div class="spec-row">
                  <div class="spec-cell grade-col"><span class="badge-grade grade-b">Grade B</span></div>
                  <div class="spec-cell desc-col">
                    <strong>Standard Commercial:</strong> Good market condition, slight size variation or pink-ripe coloring, ideal for immediate retail or food service preparation.
                  </div>
                </div>
                <div class="spec-row">
                  <div class="spec-cell grade-col"><span class="badge-grade grade-c">Grade C</span></div>
                  <div class="spec-cell desc-col">
                    <strong>Processing / Fast Sale:</strong> Fully ripe, soft tomatoes designated for instant stew or sauce processing. Must be collected and consumed promptly.
                  </div>
                </div>
              </div>

              <h4 class="sub-heading">Freshness &amp; Harvest Date Integrity</h4>
              <p>
                Farmers must specify the true <em>Harvest Date</em> when creating listings. The platform calculates a dynamic <strong>Freshness Indicator</strong> (Green: 0–2 days; Yellow: 3–4 days; Red: 5+ days). Deliberately falsifying harvest dates to misrepresent aging stock constitutes a material breach and results in listing removal and account restriction.
              </p>

              <h4 class="sub-heading">Locked Pricing &amp; Units of Sale</h4>
              <p>
                Prices are quoted in Ghanaian Cedis (GH₵) per standard unit (Crate, Bag, or Kilogram). Once a buyer commits an order, the unit price is locked; farmers may not demand roadside price adjustments, and buyers may not retroactively request discounts upon arrival.
              </p>
            </div>
          </article>

          <!-- Section 4 -->
          <article id="escrow" class="terms-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="2" y="5" width="20" height="14" rx="2"/>
                  <line x1="2" y1="10" x2="22" y2="10"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 4</span>
                <h2 class="section-heading">Mobile Money Escrow &amp; Payment Safeguards</h2>
              </div>
            </div>

            <div class="section-body">
              <p>
                FarmLink utilizes a programmatic escrow system powered by Mobile Money networks (MTN MoMo, Telecel Cash, and AT Money) to guarantee financial safety for both trade parties.
              </p>

              <ol class="styled-steps-list">
                <li>
                  <strong>Upfront Escrow Commitment:</strong> When placing an order, the buyer authorizes full payment comprising the produce subtotal and the upfront estimated transport fee.
                </li>
                <li>
                  <strong>Escrow Locking (`escrow_held`):</strong> Funds are immediately deducted from the buyer's Mobile Money wallet and safely held in escrow. Funds are inaccessible to the seller and driver during transit.
                </li>
                <li>
                  <strong>Automatic Split Disbursement:</strong> When the driver confirms delivery and the buyer inspects the produce, escrow unlocks programmatically:
                  <ul class="sub-list">
                    <li>Produce value is credited directly to the farmer's Mobile Money account.</li>
                    <li>Transport fee is credited directly to the driver's Mobile Money account.</li>
                  </ul>
                </li>
              </ol>

              <div class="callout-box warning-callout">
                <div class="callout-title">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                  </svg>
                  <span>Strict Prohibition of Offline Cash Payments</span>
                </div>
                <p>
                  Any agreement between buyer, farmer, or driver to conduct transactions outside the FarmLink escrow system forfeits all platform dispute rights, insurance considerations, and automated payout guarantees.
                </p>
              </div>
            </div>
          </article>

          <!-- Section 5 -->
          <article id="transport" class="terms-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="1" y="3" width="15" height="13" rx="2"/>
                  <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                  <circle cx="5.5" cy="18.5" r="2.5"/>
                  <circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 5</span>
                <h2 class="section-heading">Transport Logistics, Fares &amp; Driver Responsibilities</h2>
              </div>
            </div>

            <div class="section-body">
              <p>
                Farm-to-market dispatch along the corridor is performed by verified Aboboyaa tricycle operators governed by standardized logistics terms:
              </p>

              <h4 class="sub-heading">Standardized Fare Structure</h4>
              <p>
                To avoid roadside bargaining and unpredictable charges, transport fares are computed deterministically at order checkout using the formula:
              </p>
              <div class="formula-box">
                <code>Estimated Transport Fare = GH₵ 40.00 (Corridor Base Fare) + (GH₵ 2.00 × Number of Units)</code>
              </div>

              <h4 class="sub-heading">Driver Acceptance &amp; Chain of Custody</h4>
              <ul>
                <li>Drivers may only accept jobs where payment status is confirmed as <code>escrow_held</code>.</li>
                <li>Upon arrival at the farm gate, the driver inspects crate counts and marks the job as <strong>"Picked Up"</strong> (`in_transit`).</li>
                <li>The driver assumes custodial responsibility for exercising reasonable transit precautions (e.g., tarp covering against sun exposure and heavy rain) until arrival at Takoradi.</li>
              </ul>

              <h4 class="sub-heading">Delivery Drop-Off Points</h4>
              <p>
                Unless an explicit custom delivery address is provided by the buyer during checkout, standard delivery terminates at the <strong>Takoradi Market Circle</strong> unloading bays.
              </p>
            </div>
          </article>

          <!-- Section 6 -->
          <article id="inspection" class="terms-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                  <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 6</span>
                <h2 class="section-heading">Produce Inspection &amp; Escrow Release Protocol</h2>
              </div>
            </div>

            <div class="section-body">
              <p>
                Upon arrival of the Aboboyaa at the designated destination, the delivery confirmation and payout protocol commences:
              </p>

              <div class="protocol-grid">
                <div class="protocol-card">
                  <div class="protocol-number">Step 1</div>
                  <h4>Physical Verification</h4>
                  <p>The buyer or their authorized representative conducts immediate visual inspection of crates to verify grade conformity, quantity, and packaging integrity.</p>
                </div>

                <div class="protocol-card">
                  <div class="protocol-number">Step 2</div>
                  <h4>Delivery Confirmation</h4>
                  <p>The driver marks the order as <strong>"Delivered"</strong> via the Driver Portal, triggering instant notifications to the buyer and farmer.</p>
                </div>

                <div class="protocol-card">
                  <div class="protocol-number">Step 3</div>
                  <h4>Escrow Release</h4>
                  <p>Escrow status transitions to <code>released</code>. The farmer's dashboard updates available revenue, and transport payouts are queued for processing.</p>
                </div>
              </div>

              <p class="inspection-note">
                Buyers have a standard <strong>4-hour inspection window</strong> following physical delivery to log any critical dispute regarding missing crates or substantial spoilage.
              </p>
            </div>
          </article>

          <!-- Section 7 -->
          <article id="disputes" class="terms-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"/>
                  <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                  <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 7</span>
                <h2 class="section-heading">Dispute Resolution, Cancellations &amp; Refund Terms</h2>
              </div>
            </div>

            <div class="section-body">
              <p>
                While FarmLink's pre-commitment model prevents most trade friction, genuine logistical and quality failures are adjudicated according to clear rules:
              </p>

              <h4 class="sub-heading">1. Severe Quality Mismatch</h4>
              <p>
                If produce advertised as Grade A arrives largely overripe, crushed, or decayed through farmer misrepresentation, the buyer may trigger a dispute. Following verification by the Western Region Corridor Desk, escrow may be partially or completely refunded to the buyer's wallet.
              </p>

              <h4 class="sub-heading">2. Driver Transit Damage or Breakdown</h4>
              <p>
                If an Aboboyaa breaks down mid-transit, the driver is obligated to immediately alert the Corridor Desk. The desk coordinates an emergency backup tricycle or authorizes partial fare adjustment to protect produce freshness.
              </p>

              <h4 class="sub-heading">3. Order Cancellations</h4>
              <ul>
                <li><strong>Before Escrow Commitment:</strong> Orders may be cancelled without penalty at any time prior to payment authorization.</li>
                <li><strong>While Pending Assignment:</strong> If no driver accepts the job within 24 hours of harvest, the buyer may request full escrow reversal without deductions.</li>
                <li><strong>After Driver Pickup:</strong> Once cargo is <code>in_transit</code>, orders cannot be cancelled by either party.</li>
              </ul>
            </div>
          </article>

          <!-- Section 8 -->
          <article id="conduct" class="terms-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                  <line x1="12" y1="8" x2="12" y2="12"/>
                  <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 8</span>
                <h2 class="section-heading">User Conduct &amp; Prohibited Activities</h2>
              </div>
            </div>

            <div class="section-body">
              <p>All members of the FarmLink corridor network must maintain professional commercial conduct. Prohibited acts include:</p>
              
              <ul class="prohibited-list">
                <li><strong>False Listings:</strong> Creating fictitious produce listings without intent or harvest capacity to supply.</li>
                <li><strong>Rating Manipulation:</strong> Submitting fake or coerced 1-star or 5-star ratings to artificially penalize or boost participants.</li>
                <li><strong>Identity Impersonation:</strong> Using another individual's Mobile Money account or credentials without authorization.</li>
                <li><strong>Roadside Price Extortion:</strong> Demanding supplementary payments above the locked checkout amount.</li>
                <li><strong>Route Abandonment:</strong> Transporters accepting delivery jobs and abandoning cargo without notifying corridor coordinators.</li>
              </ul>

              <p>
                Infractions lead to immediate suspension from the Western Region pilot corridor, forfeiture of platform rating standing, and report to local market authorities.
              </p>
            </div>
          </article>

          <!-- Section 9 -->
          <article id="liability" class="terms-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                  <polyline points="14 2 14 8 20 8"/>
                  <line x1="16" y1="13" x2="8" y2="13"/>
                  <line x1="16" y1="17" x2="8" y2="17"/>
                  <polyline points="10 9 9 9 8 9"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 9</span>
                <h2 class="section-heading">Limitation of Liability &amp; Disclaimers</h2>
              </div>
            </div>

            <div class="section-body">
              <p>
                FarmLink provides a digital connection and escrow facility. While rigorous standards are enforced across the corridor:
              </p>
              <ul>
                <li>
                  <strong>Perishable Goods:</strong> Agricultural commodities are inherently subject to climatic fluctuations and natural perishability. The platform does not insure against crop damage prior to harvest or post-acceptance handling.
                </li>
                <li>
                  <strong>Force Majeure:</strong> Delays caused by severe flooding, road closures along the Beposo–Takoradi route, or telecommunication network downtime are adjudicated through fair mediation rather than platform damages.
                </li>
                <li>
                  <strong>Maximum Liability:</strong> In all circumstances, FarmLink's cumulative liability to any user for any order dispute shall not exceed the total transaction amount held in escrow for that specific transaction.
                </li>
              </ul>
            </div>
          </article>

          <!-- Section 10 -->
          <article id="law" class="terms-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polygon points="12 2 2 7 12 12 22 7 12 2"/>
                  <polyline points="2 17 12 22 22 17"/>
                  <polyline points="2 12 12 17 22 12"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 10</span>
                <h2 class="section-heading">Corridor Governance, Amendments &amp; Applicable Law</h2>
              </div>
            </div>

            <div class="section-body">
              <p>
                These Terms are governed by and construed in accordance with the laws of the <strong>Republic of Ghana</strong>, including the Electronic Transactions Act (Act 772) and relevant digital financial regulations.
              </p>
              <p>
                Any dispute arising from or related to these Terms that cannot be resolved amicably through the FarmLink Corridor Support Desk shall fall under the jurisdiction of the competent courts of the Western Region in <strong>Sekondi-Takoradi</strong>.
              </p>
              <p>
                FarmLink reserves the right to update these terms as the pilot expands from tomatoes to additional crops across the Western Region. Registered users will receive notification of substantive updates via platform alerts.
              </p>
            </div>
          </article>

        </div>

        <!-- Support Callout Card -->
        <div class="support-card">
          <div class="support-card-content">
            <div class="support-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
              </svg>
            </div>
            <div>
              <h3 class="support-title">Questions about our Terms &amp; Conditions?</h3>
              <p class="support-desc">
                Contact the <strong>Western Region Corridor Desk</strong> at Takoradi Market Circle or reach out via our support dispatch.
              </p>
            </div>
          </div>
          <div class="support-actions">
            <Link href="/" class="btn-support-secondary">Back to Home</Link>
            <Link v-if="!$page.props.auth?.user" href="/register" class="btn-support-primary">Join the Corridor</Link>
          </div>
        </div>

      </div>
    </main>

    <!-- 4. APP FOOTER -->
    <footer class="app-footer">
      <div class="footer-inner">
        <div class="footer-top-row">
          <div class="footer-brand">
            <div class="footer-logo">
              <svg class="logo-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/>
                <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>
              </svg>
              <span class="footer-logo-text">FarmLink</span>
            </div>
            <p class="footer-tagline">
              Connecting Daboase &amp; Beposo tomato farmers directly with Takoradi wholesale buyers via pre-committed orders and escrow.
            </p>
          </div>

          <div class="footer-links-grid">
            <div class="footer-link-group">
              <span class="footer-group-title">Navigation</span>
              <Link href="/" class="footer-link">Home</Link>
              <Link href="/login" class="footer-link">Log In</Link>
              <Link href="/register" class="footer-link">Register Account</Link>
            </div>

            <div class="footer-link-group">
              <span class="footer-group-title">Corridor Focus</span>
              <span class="footer-info-text">Daboase (Farming Belt)</span>
              <span class="footer-info-text">Beposo (Farming Belt)</span>
              <span class="footer-info-text">Takoradi Market Circle</span>
            </div>

            <div class="footer-link-group">
              <span class="footer-group-title">Legal &amp; Policy</span>
              <Link href="/terms" class="footer-link active-link">Terms &amp; Conditions</Link>
              <span class="footer-info-text">Privacy Policy (Coming Soon)</span>
            </div>
          </div>
        </div>

        <div class="footer-bottom-row">
          <span class="footer-copy">© 2026 FarmLink • Daboase &amp; Beposo Tomato Corridor Pilot • Western Region, Ghana</span>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const page = usePage();

const dashboardRoute = computed(() => {
  const role = page.props.auth?.user?.role;
  if (role === 'farmer') return '/farmer/dashboard';
  if (role === 'buyer') return '/buyer/browse';
  if (role === 'driver') return '/driver/dashboard';
  return '/';
});
</script>

<style scoped>
@import "../../css/design-tokens.css";

/* Wrapper */
.terms-page {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  background-color: var(--color-bg-page);
  font-family: var(--font-family);
  color: var(--color-neutral-900);
  line-height: var(--line-height-base);
}

/* Header */
.app-header {
  position: sticky;
  top: 0;
  z-index: 100;
  width: 100%;
  background-color: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-bottom: 1px solid var(--color-border);
}

.header-inner {
  max-width: 1160px;
  margin: 0 auto;
  padding: 0 var(--space-6);
  height: 68px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.app-logo {
  display: flex;
  align-items: center;
  gap: 10px;
  color: var(--color-primary);
  text-decoration: none;
}

.logo-icon {
  color: var(--color-primary);
}

.app-logo-text {
  font-size: 21px;
  font-weight: 800;
  letter-spacing: -0.5px;
  color: var(--color-primary);
}

.header-nav {
  display: flex;
  align-items: center;
  gap: var(--space-4);
}

.nav-link {
  font-size: var(--font-size-base);
  color: var(--color-neutral-700);
  text-decoration: none;
  font-weight: var(--font-weight-medium);
  padding: 8px 12px;
  border-radius: var(--radius-md);
  transition: color 0.15s ease;
}

.nav-link:hover {
  color: var(--color-primary);
}

.nav-login-btn {
  font-size: var(--font-size-base);
  color: var(--color-neutral-900);
  text-decoration: none;
  font-weight: var(--font-weight-semibold);
  padding: 8px 16px;
  border-radius: var(--radius-md);
  transition: all 0.15s ease;
}

.nav-login-btn:hover {
  background-color: var(--color-neutral-100);
  color: var(--color-primary);
}

.nav-primary-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: var(--font-size-base);
  color: var(--color-white);
  text-decoration: none;
  font-weight: var(--font-weight-bold);
  background-color: var(--color-primary);
  padding: 9px 18px;
  border-radius: var(--radius-md);
  transition: all 0.15s ease;
  box-shadow: 0 2px 8px rgba(45, 106, 79, 0.25);
}

.nav-primary-btn:hover {
  background-color: var(--color-primary-hover);
  transform: translateY(-1px);
}

/* Hero Section */
.terms-hero {
  background: linear-gradient(180deg, var(--color-primary-subtle) 0%, var(--color-bg-page) 100%);
  border-bottom: 1px solid var(--color-border);
  padding: var(--space-12) var(--space-6) var(--space-10);
  text-align: center;
}

.hero-inner {
  max-width: 820px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.hero-badge-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 14px;
  background-color: var(--color-white);
  border: 1px solid var(--color-primary-lighter);
  color: var(--color-primary);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-semibold);
  border-radius: var(--radius-pill);
  margin-bottom: var(--space-4);
  box-shadow: var(--shadow-xs);
}

.badge-dot {
  width: 8px;
  height: 8px;
  border-radius: var(--radius-full);
  background-color: var(--color-primary);
}

.hero-title {
  font-size: clamp(28px, 4vw, 40px);
  font-weight: 800;
  letter-spacing: -0.75px;
  color: var(--color-neutral-900);
  margin: 0 0 var(--space-3);
  line-height: var(--line-height-tight);
}

.hero-subtitle {
  font-size: var(--font-size-lg);
  color: var(--color-neutral-700);
  margin: 0 0 var(--space-6);
  max-width: 680px;
  line-height: var(--line-height-relaxed);
}

.hero-meta-bar {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: center;
  gap: var(--space-3);
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
  background-color: var(--color-white);
  padding: 10px 20px;
  border-radius: var(--radius-pill);
  border: 1px solid var(--color-border);
  box-shadow: var(--shadow-xs);
}

.meta-item {
  display: flex;
  align-items: center;
  gap: 6px;
}

.meta-divider {
  color: var(--color-neutral-400);
}

/* Main Container */
.terms-main {
  flex: 1;
  padding: var(--space-8) var(--space-6) var(--space-16);
}

.main-container {
  max-width: 900px;
  margin: 0 auto;
}

/* Quick Jump Nav */
.quick-nav-bar {
  background-color: var(--color-bg-card);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-4) var(--space-5);
  margin-bottom: var(--space-8);
  box-shadow: var(--shadow-xs);
}

.quick-nav-label {
  display: block;
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: var(--color-neutral-500);
  margin-bottom: var(--space-3);
}

.quick-nav-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}

.quick-pill {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-medium);
  color: var(--color-neutral-700);
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-neutral-200);
  padding: 6px 12px;
  border-radius: var(--radius-pill);
  text-decoration: none;
  transition: all 0.15s ease;
}

.quick-pill:hover {
  background-color: var(--color-primary-lighter);
  color: var(--color-primary-hover);
  border-color: var(--color-primary-light);
}

/* Sections */
.terms-content {
  display: flex;
  flex-direction: column;
  gap: var(--space-6);
}

.terms-section {
  background-color: var(--color-bg-card);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-8);
  box-shadow: var(--shadow-sm);
  scroll-margin-top: 90px;
}

.section-icon-header {
  display: flex;
  align-items: flex-start;
  gap: var(--space-4);
  margin-bottom: var(--space-5);
  border-bottom: 1px solid var(--color-neutral-100);
  padding-bottom: var(--space-4);
}

.section-icon-badge {
  width: 44px;
  height: 44px;
  border-radius: var(--radius-lg);
  background-color: var(--color-primary-subtle);
  color: var(--color-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.section-number {
  display: block;
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: var(--color-primary);
  margin-bottom: 2px;
}

.section-heading {
  font-size: var(--font-size-xl);
  font-weight: 700;
  color: var(--color-neutral-900);
  margin: 0;
  line-height: var(--line-height-tight);
}

.section-body {
  font-size: var(--font-size-base);
  color: var(--color-neutral-700);
  line-height: var(--line-height-relaxed);
}

.section-body p {
  margin-top: 0;
  margin-bottom: var(--space-4);
}

.sub-heading {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin-top: var(--space-5);
  margin-bottom: var(--space-2);
}

/* Callouts */
.callout-box {
  border-radius: var(--radius-md);
  padding: var(--space-4) var(--space-5);
  margin: var(--space-5) 0;
}

.info-callout {
  background-color: var(--color-primary-subtle);
  border-left: 4px solid var(--color-primary);
}

.warning-callout {
  background-color: var(--color-warning-light);
  border-left: 4px solid var(--color-warning);
}

.callout-title {
  display: flex;
  align-items: center;
  gap: 8px;
  font-weight: var(--font-weight-bold);
  font-size: var(--font-size-base);
  color: var(--color-neutral-900);
  margin-bottom: 6px;
}

.callout-box p {
  margin: 0;
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
}

/* Roles Grid */
.roles-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
  gap: var(--space-4);
  margin: var(--space-5) 0;
}

.role-card {
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-neutral-200);
  border-radius: var(--radius-md);
  padding: var(--space-4);
}

.role-card-header {
  margin-bottom: var(--space-2);
}

.role-tag {
  display: inline-block;
  font-size: 11px;
  font-weight: var(--font-weight-bold);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  padding: 2px 8px;
  border-radius: var(--radius-pill);
  margin-bottom: 6px;
}

.farmer-header .role-tag {
  background-color: var(--color-primary-lighter);
  color: var(--color-primary-hover);
}

.buyer-header .role-tag {
  background-color: var(--color-secondary-light);
  color: var(--color-secondary-dark);
}

.driver-header .role-tag {
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary-hover);
}

.role-card h3 {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0;
}

.role-card p {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
  margin: 0;
  line-height: var(--line-height-base);
}

/* Quality Grades Table */
.grades-spec-table {
  display: flex;
  flex-direction: column;
  border: 1px solid var(--color-neutral-200);
  border-radius: var(--radius-md);
  overflow: hidden;
  margin: var(--space-4) 0 var(--space-5);
}

.spec-row {
  display: flex;
  align-items: center;
  padding: var(--space-3) var(--space-4);
  border-bottom: 1px solid var(--color-neutral-200);
  background-color: var(--color-white);
}

.spec-row:last-child {
  border-bottom: none;
}

.grade-col {
  width: 90px;
  flex-shrink: 0;
}

.badge-grade {
  display: inline-block;
  font-size: 11px;
  font-weight: var(--font-weight-bold);
  padding: 3px 10px;
  border-radius: var(--radius-pill);
}

.grade-a {
  background-color: var(--color-primary-lighter);
  color: var(--color-primary-hover);
}

.grade-b {
  background-color: var(--color-secondary-light);
  color: var(--color-secondary-dark);
}

.grade-c {
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary-hover);
}

.desc-col {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
}

/* Styled Lists */
.styled-steps-list {
  padding-left: var(--space-5);
  margin: var(--space-4) 0;
}

.styled-steps-list li {
  margin-bottom: var(--space-3);
  font-size: var(--font-size-base);
}

.sub-list {
  margin-top: 6px;
  padding-left: var(--space-4);
}

.sub-list li {
  font-size: var(--font-size-sm);
  margin-bottom: 4px;
}

.formula-box {
  background-color: var(--color-neutral-100);
  border: 1px solid var(--color-neutral-300);
  border-radius: var(--radius-md);
  padding: 12px 16px;
  font-family: monospace;
  font-size: var(--font-size-sm);
  color: var(--color-neutral-900);
  margin: var(--space-3) 0 var(--space-4);
  overflow-x: auto;
}

/* Protocol Grid */
.protocol-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: var(--space-4);
  margin: var(--space-4) 0;
}

.protocol-card {
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-neutral-200);
  border-radius: var(--radius-md);
  padding: var(--space-4);
}

.protocol-number {
  display: inline-block;
  font-size: 11px;
  font-weight: var(--font-weight-bold);
  color: var(--color-primary);
  background-color: var(--color-primary-subtle);
  padding: 2px 8px;
  border-radius: var(--radius-pill);
  margin-bottom: 6px;
}

.protocol-card h4 {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0 0 6px 0;
}

.protocol-card p {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
  margin: 0;
}

.inspection-note {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
  background-color: var(--color-neutral-50);
  padding: 10px 14px;
  border-radius: var(--radius-md);
  border: 1px solid var(--color-neutral-200);
}

.prohibited-list {
  padding-left: var(--space-5);
  margin: var(--space-3) 0 var(--space-5);
}

.prohibited-list li {
  margin-bottom: 8px;
}

/* Support Card */
.support-card {
  margin-top: var(--space-10);
  background: linear-gradient(135deg, var(--color-primary-subtle) 0%, var(--color-white) 100%);
  border: 1px solid var(--color-primary-lighter);
  border-radius: var(--radius-lg);
  padding: var(--space-6) var(--space-8);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-6);
  box-shadow: var(--shadow-sm);
}

.support-card-content {
  display: flex;
  align-items: center;
  gap: var(--space-4);
}

.support-icon {
  width: 52px;
  height: 52px;
  border-radius: var(--radius-lg);
  background-color: var(--color-primary);
  color: var(--color-white);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.support-title {
  font-size: var(--font-size-lg);
  font-weight: 700;
  color: var(--color-neutral-900);
  margin: 0 0 4px 0;
}

.support-desc {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
  margin: 0;
}

.support-actions {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  flex-shrink: 0;
}

.btn-support-secondary {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-semibold);
  color: var(--color-neutral-700);
  background-color: var(--color-white);
  border: 1px solid var(--color-neutral-300);
  padding: 10px 18px;
  border-radius: var(--radius-md);
  text-decoration: none;
  transition: all 0.15s ease;
}

.btn-support-secondary:hover {
  background-color: var(--color-neutral-100);
  color: var(--color-neutral-900);
}

.btn-support-primary {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-white);
  background-color: var(--color-primary);
  padding: 10px 20px;
  border-radius: var(--radius-md);
  text-decoration: none;
  transition: all 0.15s ease;
  box-shadow: 0 2px 8px rgba(45, 106, 79, 0.25);
}

.btn-support-primary:hover {
  background-color: var(--color-primary-hover);
}

/* Footer */
.app-footer {
  background-color: var(--color-neutral-900);
  color: var(--color-neutral-100);
  padding: var(--space-12) var(--space-6) var(--space-8);
  margin-top: auto;
}

.footer-inner {
  max-width: 1160px;
  margin: 0 auto;
}

.footer-top-row {
  display: flex;
  justify-content: space-between;
  gap: var(--space-10);
  flex-wrap: wrap;
  padding-bottom: var(--space-8);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-brand {
  max-width: 380px;
}

.footer-logo {
  display: flex;
  align-items: center;
  gap: 10px;
  color: var(--color-primary-light);
  margin-bottom: var(--space-3);
}

.footer-logo-text {
  font-size: 20px;
  font-weight: 800;
  letter-spacing: -0.5px;
  color: var(--color-white);
}

.footer-tagline {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-400);
  line-height: var(--line-height-relaxed);
  margin: 0;
}

.footer-links-grid {
  display: flex;
  gap: var(--space-12);
  flex-wrap: wrap;
}

.footer-link-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.footer-group-title {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: var(--color-primary-light);
  margin-bottom: 4px;
}

.footer-link {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-400);
  text-decoration: none;
  transition: color 0.15s ease;
}

.footer-link:hover,
.footer-link.active-link {
  color: var(--color-white);
}

.footer-link.active-link {
  font-weight: var(--font-weight-semibold);
}

.footer-info-text {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
}

.footer-bottom-row {
  padding-top: var(--space-6);
  text-align: center;
}

.footer-copy {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

/* Responsive */
@media (max-width: 768px) {
  .terms-section {
    padding: var(--space-5);
  }

  .section-icon-header {
    gap: var(--space-3);
  }

  .section-heading {
    font-size: var(--font-size-lg);
  }

  .support-card {
    flex-direction: column;
    align-items: flex-start;
    padding: var(--space-5);
  }

  .support-actions {
    width: 100%;
    flex-direction: column;
  }

  .btn-support-secondary,
  .btn-support-primary {
    width: 100%;
    text-align: center;
  }

  .footer-links-grid {
    gap: var(--space-6);
  }

  .quick-nav-pills {
    overflow-x: auto;
    flex-wrap: nowrap;
    padding-bottom: 4px;
  }

  .quick-pill {
    flex-shrink: 0;
  }
}
</style>
