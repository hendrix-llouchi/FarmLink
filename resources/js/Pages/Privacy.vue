<template>
  <div class="privacy-page">
    <Head title="Privacy Policy — FarmLink" />

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
          <Link href="/terms" class="nav-link">Terms</Link>
          
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
    <section class="privacy-hero">
      <div class="hero-inner">
        <div class="hero-badge-pill">
          <span class="badge-dot"></span>
          <span>Ghana Data Protection Act (Act 843) Compliant</span>
        </div>
        <h1 class="hero-title">Privacy Policy</h1>
        <p class="hero-subtitle">
          How FarmLink safeguards personal credentials, Mobile Money transaction data, and produce logistics records across the Western Region corridor.
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
    <main class="privacy-main">
      <div class="main-container">

        <!-- Quick Jump Navigation -->
        <nav class="quick-nav-bar" aria-label="Table of Contents">
          <span class="quick-nav-label">Jump to Section:</span>
          <div class="quick-nav-pills">
            <a href="#overview" class="quick-pill">1. Overview &amp; Scope</a>
            <a href="#collection" class="quick-pill">2. Data We Collect</a>
            <a href="#usage" class="quick-pill">3. How We Use Data</a>
            <a href="#momo" class="quick-pill">4. Mobile Money Security</a>
            <a href="#sharing" class="quick-pill">5. Information Sharing</a>
            <a href="#security" class="quick-pill">6. Security Architecture</a>
            <a href="#retention" class="quick-pill">7. Retention &amp; Storage</a>
            <a href="#rights" class="quick-pill">8. Your Rights (Act 843)</a>
            <a href="#cookies" class="quick-pill">9. Cookies &amp; Sessions</a>
            <a href="#contact" class="quick-pill">10. Contact Desk</a>
          </div>
        </nav>

        <!-- Privacy Content Wrapper -->
        <div class="privacy-content">

          <!-- Section 1 -->
          <article id="overview" class="privacy-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 1</span>
                <h2 class="section-heading">Overview, Scope &amp; Legal Framework</h2>
              </div>
            </div>
            
            <div class="section-body">
              <p>
                FarmLink ("we", "our", or "the Platform") is a localized agricultural marketplace and escrow facilitation system designed to connect smallholder tomato farmers in <strong>Daboase and Beposo</strong> with wholesale market traders, chop bars, and retail buyers in the <strong>Takoradi Market Circle</strong> corridor.
              </p>
              <p>
                We are committed to processing and protecting your personal data in full compliance with the <strong>Data Protection Act, 2012 (Act 843)</strong> of the Republic of Ghana, the <strong>Electronic Transactions Act, 2008 (Act 772)</strong>, and applicable Bank of Ghana directives governing digital payment platforms.
              </p>
              <p>
                Our privacy ethos is straightforward: <em>we collect only the minimal data necessary to authenticate your account, secure your produce transactions, coordinate Aboboyaa delivery logistics, and disburse Mobile Money escrow payouts</em>.
              </p>

              <div class="callout-box info-callout">
                <div class="callout-title">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="16" x2="12" y2="12"/>
                    <line x1="12" y1="8" x2="12.01" y2="8"/>
                  </svg>
                  <span>Our Data Protection Principles</span>
                </div>
                <p>
                  We process data lawfully, transparently, and fairly; restrict collection strictly to agricultural trade fulfillment; keep records accurate and updated; and never sell or monetize user information to external marketing brokers.
                </p>
              </div>
            </div>
          </article>

          <!-- Section 2 -->
          <article id="collection" class="privacy-section">
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
                <span class="section-number">Section 2</span>
                <h2 class="section-heading">Information We Collect</h2>
              </div>
            </div>

            <div class="section-body">
              <p>Depending on your role and participation on FarmLink, we collect the following categories of information:</p>

              <div class="data-cards-grid">
                <div class="data-card">
                  <div class="data-card-header">
                    <span class="data-tag account-tag">Account &amp; Identity</span>
                    <h3>Profile Information</h3>
                  </div>
                  <ul>
                    <li><strong>Full Name:</strong> To identify trade participants on invoices and dispatch notes.</li>
                    <li><strong>Phone Number:</strong> Your primary account identifier (no email required) used for authentication, password recovery, and order SMS alerts.</li>
                    <li><strong>Role:</strong> Selected platform capacity (<code>farmer</code>, <code>buyer</code>, or <code>driver</code>).</li>
                    <li><strong>Corridor Location:</strong> Farming community (Daboase, Beposo) or delivery drop-off zone (Takoradi).</li>
                    <li><strong>Business Profile:</strong> Business name and buyer category (Market Trader, Restaurant/Chop Bar, Individual).</li>
                  </ul>
                </div>

                <div class="data-card">
                  <div class="data-card-header">
                    <span class="data-tag produce-tag">Produce &amp; Inventory</span>
                    <h3>Marketplace Listings</h3>
                  </div>
                  <ul>
                    <li><strong>Crop Specifications:</strong> Crop name (tomatoes), unit of sale (Crates, Bags, Kg), and quantity in stock.</li>
                    <li><strong>Quality Grading:</strong> Assigned Grade (Grade A, B, or C) and Minimum Order Quantity.</li>
                    <li><strong>Harvest Date:</strong> True harvest schedule used to compute dynamic freshness bars.</li>
                    <li><strong>Pricing:</strong> Unit price in Ghanaian Cedis (GH₵) locked at order placement.</li>
                  </ul>
                </div>

                <div class="data-card">
                  <div class="data-card-header">
                    <span class="data-tag logistics-tag">Orders &amp; Logistics</span>
                    <h3>Escrow &amp; Dispatch Records</h3>
                  </div>
                  <ul>
                    <li><strong>Order Records:</strong> Quantities ordered, product subtotal, and estimated transport cost.</li>
                    <li><strong>Delivery Address:</strong> Takoradi Market Circle or buyer-specified custom delivery drop-off location.</li>
                    <li><strong>Transit Stages:</strong> Pickup confirmations (<code>in_transit</code>) and final delivery timestamps (<code>delivered</code>).</li>
                    <li><strong>Transporter Profile:</strong> Aboboyaa tricycle registration details, driver phone, and verified payout records.</li>
                  </ul>
                </div>

                <div class="data-card">
                  <div class="data-card-header">
                    <span class="data-tag rating-tag">Reputation &amp; Security</span>
                    <h3>Quality &amp; Technical Signals</h3>
                  </div>
                  <ul>
                    <li><strong>Ratings &amp; Feedback:</strong> 1–5 star ratings and comments submitted upon delivery to establish mutual corridor trust.</li>
                    <li><strong>Security Telemetry:</strong> Encrypted password hashes (bcrypt), session tokens, IP address, and rate-limiting counters.</li>
                  </ul>
                </div>
              </div>
            </div>
          </article>

          <!-- Section 3 -->
          <article id="usage" class="privacy-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 3</span>
                <h2 class="section-heading">How We Use Your Information</h2>
              </div>
            </div>

            <div class="section-body">
              <p>Your data is processed strictly for the execution and enhancement of corridor trade:</p>

              <ol class="styled-steps-list">
                <li>
                  <strong>Pre-Committed Order Fulfillment:</strong> Connecting tomato buyers with smallholder farmers prior to harvest, establishing transparent prices, and generating digital waybills.
                </li>
                <li>
                  <strong>Escrow Management &amp; Payout Release:</strong> Locking buyer funds in escrow upon checkout and automatically calculating the split disbursement (produce payout to farmer, transport fare to driver) upon delivery confirmation.
                </li>
                <li>
                  <strong>Logistics Coordination:</strong> Enabling Aboboyaa drivers to locate farm gates in Daboase/Beposo and complete drop-offs at Takoradi Market Circle or verified custom addresses.
                </li>
                <li>
                  <strong>Direct Trade Communication:</strong> Surfacing verified phone numbers on active orders so farmers, buyers, and drivers can coordinate cargo loading, arrival timing, and crate handoffs.
                </li>
                <li>
                  <strong>Platform Hardening &amp; Fraud Prevention:</strong> Implementing rate-limiting to prevent automated brute-force attacks, enforcing resource ownership guards to block unauthorized data access, and preventing duplicate ratings.
                </li>
              </ol>
            </div>
          </article>

          <!-- Section 4 -->
          <article id="momo" class="privacy-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="2" y="5" width="20" height="14" rx="2"/>
                  <line x1="2" y1="10" x2="22" y2="10"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 4</span>
                <h2 class="section-heading">Mobile Money &amp; Financial Data Safeguards</h2>
              </div>
            </div>

            <div class="section-body">
              <p>
                FarmLink connects directly with Ghana's Mobile Money telecommunication networks (MTN MoMo, Telecel Cash, and AT Money) to execute automated escrow holds and payouts.
              </p>

              <div class="callout-box warning-callout">
                <div class="callout-title">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                  </svg>
                  <span>We NEVER Store or Request Your Mobile Money PIN</span>
                </div>
                <p>
                  FarmLink will <strong>never</strong> ask for, intercept, log, or store your 4-digit Mobile Money PIN. All payment authorization occurs strictly on your telecommunication network's secure USSD prompt or official payment interface. Never disclose your PIN to any driver, farmer, or platform coordinator.
                </p>
              </div>

              <h4 class="sub-heading">What We Process for Mobile Money</h4>
              <ul>
                <li><strong>Normalized Phone Number (MSISDN):</strong> E.g., `233244XXXXXX`, transmitted securely to the telecom API gateway to initiate payment prompts.</li>
                <li><strong>Transaction Reference &amp; UUID:</strong> Unique payment identifiers used to verify callback webhooks and correlate escrow holds with specific orders.</li>
                <li><strong>Payment Status Tokens:</strong> State flags (`unpaid`, `escrow_held`, `released`) reflecting transaction progress in our database.</li>
              </ul>
            </div>
          </article>

          <!-- Section 5 -->
          <article id="sharing" class="privacy-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/>
                  <polyline points="16 6 12 2 8 6"/>
                  <line x1="12" y1="2" x2="12" y2="15"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 5</span>
                <h2 class="section-heading">Information Sharing &amp; Third-Party Disclosures</h2>
              </div>
            </div>

            <div class="section-body">
              <p>
                We do not sell, rent, license, or trade your personal information. Information is shared strictly under the following controlled operational parameters:
              </p>

              <h4 class="sub-heading">1. Transaction-Specific Sharing Between Trade Parties</h4>
              <p>
                When an order is created and locked in escrow:
              </p>
              <ul>
                <li>The <strong>Farmer</strong> sees the buyer's name, buyer category, and contact phone number to confirm harvest readiness.</li>
                <li>The <strong>Buyer</strong> sees the farmer's name, farm location, and phone number to verify produce origin and harvest dates.</li>
                <li>The <strong>Driver</strong> who accepts the delivery job receives the farmer's location for pickup, the buyer's delivery destination, and direct contact numbers for both parties to coordinate loading and offloading.</li>
              </ul>

              <h4 class="sub-heading">2. Essential Technology Service Providers</h4>
              <ul>
                <li><strong>Mobile Money Gateways (MTN, Telecel, AT):</strong> For processing payment collection requests and webhook confirmations.</li>
                <li><strong>Cloud Storage &amp; Image Delivery:</strong> Cloudinary delivers optimized, responsive product photos without capturing user identity data.</li>
                <li><strong>Hosting Infrastructure:</strong> Production instances operate on Render with encrypted database connections and isolated container environments.</li>
              </ul>

              <h4 class="sub-heading">3. Legal Compliance</h4>
              <p>
                We may disclose personal data if compelled by court order, law enforcement inquiry, or statutory authority under the laws of the Republic of Ghana.
              </p>
            </div>
          </article>

          <!-- Section 6 -->
          <article id="security" class="privacy-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                  <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 6</span>
                <h2 class="section-heading">Security Architecture &amp; Data Safeguards</h2>
              </div>
            </div>

            <div class="section-body">
              <p>FarmLink incorporates multi-tiered defenses to protect user data from unauthorized access, breach, or disclosure:</p>

              <div class="security-grid">
                <div class="security-item">
                  <div class="security-item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                      <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                  </div>
                  <div>
                    <h4>Bcrypt Password Hashing</h4>
                    <p>All passwords are irreversibly salted and hashed. Plaintext passwords are never recorded in database tables or server logs.</p>
                  </div>
                </div>

                <div class="security-item">
                  <div class="security-item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                    </svg>
                  </div>
                  <div>
                    <h4>Rate-Limiting Guards</h4>
                    <p>Authentication, password reset, and checkout endpoints are protected by automated rate limiters to deflect brute-force credential stuffing.</p>
                  </div>
                </div>

                <div class="security-item">
                  <div class="security-item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                  </div>
                  <div>
                    <h4>IDOR &amp; Ownership Verification</h4>
                    <p>Backend middleware (<code>owns.resource</code>) verifies that users can only view, edit, or dispute records belonging to their own account.</p>
                  </div>
                </div>

                <div class="security-item">
                  <div class="security-item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="12" cy="12" r="10"/>
                      <line x1="2" y1="12" x2="22" y2="12"/>
                    </svg>
                  </div>
                  <div>
                    <h4>HTTPS &amp; Secure Session Cookies</h4>
                    <p>All web traffic is encrypted in transit via SSL/TLS. Session cookies are HTTP-only and protected against cross-site scripting (XSS).</p>
                  </div>
                </div>
              </div>
            </div>
          </article>

          <!-- Section 7 -->
          <article id="retention" class="privacy-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <ellipse cx="12" cy="5" rx="9" ry="3"/>
                  <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                  <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 7</span>
                <h2 class="section-heading">Data Retention &amp; Storage Integrity</h2>
              </div>
            </div>

            <div class="section-body">
              <p>
                We retain user records only as long as necessary to maintain active commercial relationships, comply with tax and audit obligations under Ghanaian commercial statutes, and preserve trade integrity across the Western Region corridor.
              </p>
              <ul>
                <li><strong>Active Account Data:</strong> Retained while your profile remains registered. You can update your information at any time via <Link href="/settings">Account Settings</Link>.</li>
                <li><strong>Transaction &amp; Escrow History:</strong> Maintained for a minimum of five (5) years in compliance with financial recordkeeping standards under Act 772 and Act 987.</li>
                <li><strong>Zero Data Deletion Guardrails:</strong> Our database operations follow strict additive migration rules; historical order records and rating scores are preserved against accidental erasure.</li>
              </ul>
            </div>
          </article>

          <!-- Section 8 -->
          <article id="rights" class="privacy-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                  <circle cx="12" cy="7" r="4"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 8</span>
                <h2 class="section-heading">Your Legal Rights Under Ghana's Data Protection Act (Act 843)</h2>
              </div>
            </div>

            <div class="section-body">
              <p>As a data subject under Act 843, you possess fundamental statutory rights concerning your personal information:</p>

              <div class="rights-list">
                <div class="right-item">
                  <h4>Right to Access</h4>
                  <p>You may request a copy of the personal information we maintain concerning your account, listed produce, and order logs.</p>
                </div>
                <div class="right-item">
                  <h4>Right to Rectification</h4>
                  <p>You can directly edit your name, phone number, location, and vehicle information at any time through the <Link href="/settings">Settings</Link> portal.</p>
                </div>
                <div class="right-item">
                  <h4>Right to Erasure / Deactivation</h4>
                  <p>You may request account deactivation and removal of your public marketplace profile by contacting the Western Region Corridor Desk.</p>
                </div>
                <div class="right-item">
                  <h4>Right to Object</h4>
                  <p>You have the right to object to the processing of your data for reasons outside direct order fulfillment and escrow release.</p>
                </div>
              </div>
            </div>
          </article>

          <!-- Section 9 -->
          <article id="cookies" class="privacy-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"/>
                  <path d="M12 2a10 10 0 0 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"/>
                  <path d="M8.5 8.5v.01"/>
                  <path d="M16 15.5v.01"/>
                  <path d="M12 18v.01"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 9</span>
                <h2 class="section-heading">Cookies &amp; Local Session Tracking</h2>
              </div>
            </div>

            <div class="section-body">
              <p>
                FarmLink utilizes minimal, strictly necessary cookies to operate the web application. We do <strong>not</strong> deploy third-party advertising trackers, cross-site profiling pixels, or behavioural advertising networks.
              </p>
              <ul>
                <li><strong>Session Cookie (`farmlink_session`):</strong> Maintains your authenticated user state as you navigate between produce listings, orders, and dashboards.</li>
                <li><strong>CSRF Security Token (`XSRF-TOKEN`):</strong> Verifies that form submissions and checkout requests originate directly from your browser to prevent malicious cross-site request forgery.</li>
              </ul>
            </div>
          </article>

          <!-- Section 10 -->
          <article id="contact" class="privacy-section">
            <div class="section-icon-header">
              <div class="section-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
              </div>
              <div>
                <span class="section-number">Section 10</span>
                <h2 class="section-heading">Policy Updates &amp; Corridor Data Protection Desk</h2>
              </div>
            </div>

            <div class="section-body">
              <p>
                We may periodically update this Privacy Policy as FarmLink scales from tomatoes to other staple crops across the Western Region. Substantive updates will be announced via platform notification banners.
              </p>
              <p>
                If you have questions regarding this Privacy Policy, your data rights under Act 843, or wish to report a privacy concern, please contact our data coordinators:
              </p>
              <div class="contact-details-box">
                <div class="contact-detail-row">
                  <strong>Desk Location:</strong>
                  <span>FarmLink Western Region Corridor Desk, Takoradi Market Circle, Western Region, Ghana</span>
                </div>
                <div class="contact-detail-row">
                  <strong>Corridor Belt:</strong>
                  <span>Daboase, Beposo &amp; Takoradi Market Trading Hub</span>
                </div>
                <div class="contact-detail-row">
                  <strong>Data Protection Officer:</strong>
                  <span>Legal &amp; Compliance Team • FarmLink Agricultural Pilot</span>
                </div>
              </div>
            </div>
          </article>

        </div>

        <!-- Support Callout Card -->
        <div class="support-card">
          <div class="support-card-content">
            <div class="support-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
              </svg>
            </div>
            <div>
              <h3 class="support-title">Have Questions About Your Privacy?</h3>
              <p class="support-desc">
                Review our comprehensive <Link href="/terms">Terms &amp; Conditions</Link> or visit the Western Region Corridor Desk at Takoradi Market Circle.
              </p>
            </div>
          </div>
          <div class="support-actions">
            <Link href="/terms" class="btn-support-secondary">View Terms &amp; Conditions</Link>
            <Link href="/" class="btn-support-primary">Back to Home</Link>
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
              <Link href="/terms" class="footer-link">Terms &amp; Conditions</Link>
              <Link href="/privacy" class="footer-link active-link">Privacy Policy</Link>
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
.privacy-page {
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
.privacy-hero {
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
.privacy-main {
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
.privacy-content {
  display: flex;
  flex-direction: column;
  gap: var(--space-6);
}

.privacy-section {
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

/* Data Cards Grid */
.data-cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: var(--space-4);
  margin: var(--space-5) 0;
}

.data-card {
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-neutral-200);
  border-radius: var(--radius-md);
  padding: var(--space-4);
}

.data-card-header {
  margin-bottom: var(--space-3);
}

.data-tag {
  display: inline-block;
  font-size: 11px;
  font-weight: var(--font-weight-bold);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  padding: 2px 8px;
  border-radius: var(--radius-pill);
  margin-bottom: 6px;
}

.account-tag {
  background-color: var(--color-primary-lighter);
  color: var(--color-primary-hover);
}

.produce-tag {
  background-color: var(--color-secondary-light);
  color: var(--color-secondary-dark);
}

.logistics-tag {
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary-hover);
}

.rating-tag {
  background-color: var(--color-neutral-200);
  color: var(--color-neutral-700);
}

.data-card h3 {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0;
}

.data-card ul {
  padding-left: var(--space-4);
  margin: 0;
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
}

.data-card li {
  margin-bottom: 6px;
}

/* Security Grid */
.security-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: var(--space-4);
  margin: var(--space-4) 0;
}

.security-item {
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-neutral-200);
  border-radius: var(--radius-md);
  padding: var(--space-4);
  display: flex;
  align-items: flex-start;
  gap: var(--space-3);
}

.security-item-icon {
  width: 36px;
  height: 36px;
  border-radius: var(--radius-md);
  background-color: var(--color-primary-subtle);
  color: var(--color-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.security-item h4 {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0 0 4px 0;
}

.security-item p {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-700);
  margin: 0;
  line-height: var(--line-height-base);
}

/* Rights List */
.rights-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: var(--space-4);
  margin: var(--space-4) 0;
}

.right-item {
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-neutral-200);
  border-radius: var(--radius-md);
  padding: var(--space-4);
}

.right-item h4 {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-primary);
  margin: 0 0 6px 0;
}

.right-item p {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
  margin: 0;
}

.right-item a {
  color: var(--color-primary);
  font-weight: var(--font-weight-semibold);
  text-decoration: underline;
}

/* Contact Details Box */
.contact-details-box {
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-neutral-200);
  border-radius: var(--radius-md);
  padding: var(--space-4);
  margin-top: var(--space-3);
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.contact-detail-row {
  display: flex;
  flex-direction: column;
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
}

.contact-detail-row strong {
  color: var(--color-neutral-900);
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
  white-space: nowrap;
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
  white-space: nowrap;
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
  .privacy-section {
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
