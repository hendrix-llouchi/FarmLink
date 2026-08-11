<template>
  <Head title="FarmLink — Western Region Tomato Corridor" />
  <div class="welcome-container">
    <!-- Header Bar -->
    <header class="app-header">
      <div class="header-inner">
        <Link href="/" class="app-logo">
          <svg xmlns="http://www.w3.org/2000/svg" class="logo-icon" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
          </svg>
          <span class="app-logo-text">FarmLink</span>
        </Link>

        <!-- Desktop Navigation -->
        <nav class="header-nav desktop-nav">
          <a href="#how-it-works" @click.prevent="scrollToSection('how-it-works')" class="nav-link">How It Works</a>
          <a href="#built-for" @click.prevent="scrollToSection('built-for')" class="nav-link">Built For You</a>
          <a href="#why-farmlink" @click.prevent="scrollToSection('why-farmlink')" class="nav-link">Why FarmLink</a>
          <a href="#preview" @click.prevent="scrollToSection('preview')" class="nav-link">Platform Preview</a>
          <Link href="/login" class="nav-login-btn">Log In</Link>
          <Link href="/register" class="nav-register-btn">Get Started</Link>
        </nav>

        <!-- Mobile Hamburger Button -->
        <button 
          type="button" 
          class="mobile-menu-btn" 
          @click="mobileMenuOpen = !mobileMenuOpen"
          :aria-expanded="mobileMenuOpen"
          aria-label="Toggle navigation menu"
        >
          <svg v-if="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="4" y1="6" x2="20" y2="6"/>
            <line x1="4" y1="12" x2="20" y2="12"/>
            <line x1="4" y1="18" x2="20" y2="18"/>
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>

      <!-- Mobile Dropdown Navigation -->
      <transition name="mobile-menu">
        <div v-if="mobileMenuOpen" class="mobile-dropdown-nav">
          <a href="#how-it-works" class="mobile-nav-link" @click.prevent="scrollToSection('how-it-works')">How It Works</a>
          <a href="#built-for" class="mobile-nav-link" @click.prevent="scrollToSection('built-for')">Built For You</a>
          <a href="#why-farmlink" class="mobile-nav-link" @click.prevent="scrollToSection('why-farmlink')">Why FarmLink</a>
          <a href="#preview" class="mobile-nav-link" @click.prevent="scrollToSection('preview')">Platform Preview</a>
          <div class="mobile-divider"></div>
          <Link href="/login" class="mobile-nav-link" @click="mobileMenuOpen = false">Log In</Link>
          <Link href="/register" class="mobile-nav-btn" @click="mobileMenuOpen = false">Get Started</Link>
        </div>
      </transition>
    </header>

    <!-- Main Content Area (9 Sections) -->
    <main class="main-content">
      <!-- 1. HERO SECTION -->
      <section class="hero-section">
        <div class="hero-inner hero-animate">
          <!-- Corridor Location Badge -->
          <div class="hero-pill-badge">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
            <span>Western Region, Ghana</span>
          </div>

          <!-- Hero Headline -->
          <h1 class="hero-headline">
            Sell Your Tomatoes Before Harvest.
          </h1>

          <!-- Hero Subheadline -->
          <p class="hero-subheadline">
            Connect with verified buyers through secure pre-orders.
          </p>

          <!-- Hero CTA Group -->
          <div class="hero-cta-group">
            <Link href="/register" class="btn-hero-primary">
              <span>Get Started</span>
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </Link>

            <Link href="/login" class="btn-hero-secondary-link">
              Already have an account? Log in
            </Link>
          </div>

          <!-- Trust Badges (Glass Pills) -->
          <div class="hero-trust-badges">
            <div class="trust-badge">
              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
              <span>Verified Buyers</span>
            </div>
            <div class="trust-badge">
              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
              <span>Secure Payments</span>
            </div>
            <div class="trust-badge">
              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
              <span>Local Transport</span>
            </div>
          </div>
        </div>
      </section>

      <!-- 2. STATISTICS SECTION (Compact Trust Strip) -->
      <section class="stats-bar-section">
        <div class="stats-container">
          <div class="stat-item">
            <div class="stat-value">250+</div>
            <div class="stat-label">Farmers connected</div>
          </div>
          <div class="stat-divider"></div>
          <div class="stat-item">
            <div class="stat-value">45+</div>
            <div class="stat-label">Verified buyers</div>
          </div>
          <div class="stat-divider"></div>
          <div class="stat-item">
            <div class="stat-value">1,200+</div>
            <div class="stat-label">Crates sold</div>
          </div>
          <div class="stat-divider"></div>
          <div class="stat-item">
            <div class="stat-value">98%</div>
            <div class="stat-label">Reliable delivery</div>
          </div>
        </div>
        <div class="stats-disclaimer">
          <span>*Pilot corridor prototype metrics — Daboase &amp; Beposo to Takoradi Market Circle</span>
        </div>
      </section>

      <!-- 3. PROBLEM SECTION -->
      <section id="problem" class="problem-section">
        <div class="section-container">
          <div class="section-header-text">
            <div class="section-tag-badge warning-tag">Corridor Challenge</div>
            <h2 class="section-title">The Problem We Solve</h2>
            <p class="section-subtitle">Addressing post-harvest losses and distress sales in the Daboase &amp; Beposo → Market Circle tomato corridor.</p>
          </div>

          <div class="problem-cards-grid">
            <!-- Problem 1 -->
            <div class="problem-card">
              <div class="problem-icon-wrapper danger-bg">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"/>
                  <polyline points="12 6 12 12 16 14"/>
                  <path d="M12 2v2M12 20v2M2 12h2M20 12h2"/>
                </svg>
              </div>
              <h3 class="problem-card-title">Produce Lost Every Tuesday</h3>
              <p class="problem-card-body">
                Unsold tomatoes spoil within days when market day passes without committed buyers ready at harvest.
              </p>
            </div>

            <!-- Problem 2 -->
            <div class="problem-card">
              <div class="problem-icon-wrapper warning-bg">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4"/>
                  <path d="M4 6v12c0 1.1.9 2 2 2h14v-4"/>
                  <path d="M18 12a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4v-4h-4z"/>
                  <circle cx="18" cy="14" r="0.5"/>
                </svg>
              </div>
              <h3 class="problem-card-title">The Distress Sale Trap</h3>
              <p class="problem-card-body">
                Farmers are forced to slash prices at day's end to avoid carrying heavy unsold crates back to the farm.
              </p>
            </div>

            <!-- Problem 3 -->
            <div class="problem-card">
              <div class="problem-icon-wrapper accent-bg">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="1" y="3" width="15" height="13" rx="2"/>
                  <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                  <circle cx="5.5" cy="18.5" r="2.5"/>
                  <circle cx="18.5" cy="18.5" r="2.5"/>
                  <line x1="1" y1="9" x2="5" y2="9"/>
                </svg>
              </div>
              <h3 class="problem-card-title">Transport Cost Disputes</h3>
              <p class="problem-card-body">
                Unpredictable delivery costs and driver availability absorb farmer profits before produce even leaves the gate.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- 4. HOW PRODUCE MOVES SECTION -->
      <section id="how-it-works" class="supply-chain-section">
        <div class="section-container">
          <div class="section-header-text">
            <div class="section-tag-badge primary-tag">Guaranteed Corridor Workflow</div>
            <h2 class="section-title">How Produce Moves</h2>
            <p class="section-subtitle">From harvest to market in 4 steps — pricing locked before the truck leaves.</p>
          </div>

          <div class="chain-diagram-flex">
            <!-- Step 1 -->
            <div class="chain-step-card">
              <div class="chain-step-header">
                <span class="chain-step-number">01</span>
                <div class="chain-icon-circle green-circle">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 21h18"/>
                    <path d="M4 21V10l8-6 8 6v11"/>
                    <path d="M9 21v-8h6v8"/>
                    <path d="M9 10h6"/>
                    <circle cx="12" cy="7" r="1.5"/>
                  </svg>
                </div>
              </div>
              <h4 class="chain-step-title">Farm Gate</h4>
              <p class="chain-step-desc">
                Farmer lists harvest date, quantity, and grade before picking.
              </p>
            </div>

            <div class="chain-arrow">
              <span class="desktop-arrow">→</span>
              <span class="mobile-arrow">↓</span>
            </div>

            <!-- Step 2 -->
            <div class="chain-step-card">
              <div class="chain-step-header">
                <span class="chain-step-number">02</span>
                <div class="chain-icon-circle amber-circle">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="6" width="20" height="12" rx="2"/>
                    <circle cx="12" cy="12" r="2.5"/>
                    <path d="M6 12h.01M18 12h.01"/>
                    <path d="M4 18v2a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-2"/>
                    <path d="M4 6V4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2"/>
                  </svg>
                </div>
              </div>
              <h4 class="chain-step-title">Escrow Commit</h4>
              <p class="chain-step-desc">
                Trader commits to purchase with Mobile Money escrow lock.
              </p>
            </div>

            <div class="chain-arrow">
              <span class="desktop-arrow">→</span>
              <span class="mobile-arrow">↓</span>
            </div>

            <!-- Step 3 -->
            <div class="chain-step-card">
              <div class="chain-step-header">
                <span class="chain-step-number">03</span>
                <div class="chain-icon-circle teal-circle">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="3" width="15" height="13" rx="2"/>
                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                    <circle cx="5.5" cy="18.5" r="2.5"/>
                    <circle cx="18.5" cy="18.5" r="2.5"/>
                    <line x1="1" y1="9" x2="5" y2="9"/>
                  </svg>
                </div>
              </div>
              <h4 class="chain-step-title">Aboboyaa Transit</h4>
              <p class="chain-step-desc">
                Aboboyaa driver assigned with pre-paid delivery fare.
              </p>
            </div>

            <div class="chain-arrow">
              <span class="desktop-arrow">→</span>
              <span class="mobile-arrow">↓</span>
            </div>

            <!-- Step 4 -->
            <div class="chain-step-card">
              <div class="chain-step-header">
                <span class="chain-step-number">04</span>
                <div class="chain-icon-circle green-circle">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l1-5h16l1 5"/>
                    <path d="M3 9a3 3 0 0 0 6 0 3 3 0 0 0 6 0 3 3 0 0 0 6 0"/>
                    <path d="M4 12v8a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-8"/>
                    <path d="M9 21v-7h6v7"/>
                  </svg>
                </div>
              </div>
              <h4 class="chain-step-title">Market Circle</h4>
              <p class="chain-step-desc">
                Produce delivered, funds released instantly to farmer &amp; driver.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- 5. BUILT FOR THE WESTERN REGION SECTION -->
      <section id="built-for" class="who-its-for-section">
        <div class="section-container">
          <div class="section-header-text">
            <div class="section-tag-badge secondary-tag">Localized Ecosystem</div>
            <h2 class="section-title">Built for the Western Region</h2>
            <p class="section-subtitle">Tailored solutions for every key player along the agricultural corridor.</p>
          </div>

          <div class="stakeholders-grid">
            <!-- Farmers (Forest Green Accent) -->
            <div class="role-card role-card-farmer">
              <div class="role-card-top">
                <div class="role-icon-box farmer-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 21h18"/>
                    <path d="M4 21V10l8-6 8 6v11"/>
                    <path d="M9 21v-8h6v8"/>
                    <path d="M9 10h6"/>
                    <circle cx="12" cy="7" r="1.5"/>
                  </svg>
                </div>
                <div class="role-header-info">
                  <span class="role-pill farmer-pill">Producer</span>
                  <h3 class="role-title">Farmers</h3>
                </div>
              </div>
              <blockquote class="role-quote">
                "Sell before your produce spoils."
              </blockquote>
              <p class="role-desc">
                Smallholder tomato farmers in Daboase &amp; Beposo who need guaranteed buyers and locked-in pricing before harvest day.
              </p>
            </div>

            <!-- Market Traders (Harvest Gold Accent) -->
            <div class="role-card role-card-trader">
              <div class="role-card-top">
                <div class="role-icon-box trader-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l1-5h16l1 5"/>
                    <path d="M3 9a3 3 0 0 0 6 0 3 3 0 0 0 6 0 3 3 0 0 0 6 0"/>
                    <path d="M4 12v8a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-8"/>
                    <path d="M9 21v-7h6v7"/>
                  </svg>
                </div>
                <div class="role-header-info">
                  <span class="role-pill trader-pill">Buyer</span>
                  <h3 class="role-title">Market Traders</h3>
                </div>
              </div>
              <blockquote class="role-quote">
                "Secure reliable tomato supply."
              </blockquote>
              <p class="role-desc">
                Takoradi Market Circle traders who want pre-arranged, quality produce delivered directly without traveling to distant farms.
              </p>
            </div>

            <!-- Aboboyaa Drivers (Soft Teal Accent) -->
            <div class="role-card role-card-driver">
              <div class="role-card-top">
                <div class="role-icon-box driver-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="3" width="15" height="13" rx="2"/>
                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                    <circle cx="5.5" cy="18.5" r="2.5"/>
                    <circle cx="18.5" cy="18.5" r="2.5"/>
                    <line x1="1" y1="9" x2="5" y2="9"/>
                  </svg>
                </div>
                <div class="role-header-info">
                  <span class="role-pill driver-pill">Logistics</span>
                  <h3 class="role-title">Aboboyaa Drivers</h3>
                </div>
              </div>
              <blockquote class="role-quote">
                "Get confirmed delivery jobs."
              </blockquote>
              <p class="role-desc">
                Local tricycle transport operators who want confirmed, pre-paid delivery jobs along fixed corridor routes.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- 6. WHY FARMERS CHOOSE FARMLINK SECTION -->
      <section id="why-farmlink" class="why-section">
        <div class="section-container">
          <div class="section-header-text">
            <div class="section-tag-badge primary-tag">Core Advantage</div>
            <h2 class="section-title">Why Farmers Choose FarmLink</h2>
            <p class="section-subtitle">Designed specifically to protect farmer earnings and eliminate harvest uncertainty.</p>
          </div>

          <div class="benefits-grid">
            <!-- Benefit 1 -->
            <div class="benefit-card">
              <div class="benefit-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                  <circle cx="9" cy="7" r="4"/>
                  <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
              </div>
              <div class="benefit-content">
                <h3 class="benefit-title">Guaranteed Buyers</h3>
                <p class="benefit-quote">"No more waiting until market day to find a buyer."</p>
                <p class="benefit-body">
                  Pre-orders lock in verified buyers before picking starts, eliminating distress price cuts.
                </p>
              </div>
            </div>

            <!-- Benefit 2 -->
            <div class="benefit-card">
              <div class="benefit-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="2" y="5" width="20" height="14" rx="2"/>
                  <line x1="2" y1="10" x2="22" y2="10"/>
                  <path d="M7 15h.01M11 15h2"/>
                  <path d="M12 2v3"/>
                </svg>
              </div>
              <div class="benefit-content">
                <h3 class="benefit-title">Secure Payments</h3>
                <p class="benefit-quote">"Payment is committed before delivery."</p>
                <p class="benefit-body">
                  Mobile Money funds are held securely in escrow upfront and released upon produce confirmation.
                </p>
              </div>
            </div>

            <!-- Benefit 3 -->
            <div class="benefit-card">
              <div class="benefit-icon-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="1" y="3" width="15" height="13" rx="2"/>
                  <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                  <circle cx="5.5" cy="18.5" r="2.5"/>
                  <circle cx="18.5" cy="18.5" r="2.5"/>
                  <line x1="1" y1="9" x2="5" y2="9"/>
                </svg>
              </div>
              <div class="benefit-content">
                <h3 class="benefit-title">Reliable Transport</h3>
                <p class="benefit-quote">"Know who is moving your produce and where it is going."</p>
                <p class="benefit-body">
                  Dedicated Aboboyaa drivers coordinate directly for fast, transparent farm-to-market dispatch.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- 7. PLATFORM PREVIEW SECTION (MOST IMPORTANT FOR HACKATHON) -->
      <section id="preview" class="platform-preview-section">
        <div class="section-container">
          <div class="section-header-text">
            <div class="section-tag-badge secondary-tag">Product Demonstration</div>
            <h2 class="section-title">Everything You Need to Move Produce</h2>
            <p class="section-subtitle">A simple, powerful digital platform built for real-world agricultural commerce in Ghana.</p>
          </div>

          <!-- Preview Showcase Cards -->
          <div class="preview-grid">
            <!-- Farmer Interface Card -->
            <div class="preview-card">
              <div class="preview-card-header">
                <div class="preview-user-badge farmer-user">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 2 2 4v4a4 4 0 0 1-4 4h-2a3 3 0 0 0-3 3v3z"/>
                  </svg>
                  <span>Farmer Experience</span>
                </div>
                <h3 class="preview-role-heading">List &amp; Lock Harvest</h3>
              </div>

              <div class="mock-device-frame">
                <div class="mock-screen-header">
                  <span class="mock-status-pill green-pill">Escrow Committed</span>
                  <span class="mock-time">15 Crates</span>
                </div>
                <div class="mock-screen-body">
                  <div class="mock-product-row">
                    <span class="mock-label">Produce:</span>
                    <span class="mock-val">Grade A Tomatoes</span>
                  </div>
                  <div class="mock-product-row">
                    <span class="mock-label">Location:</span>
                    <span class="mock-val">Daboase Corridor Farm</span>
                  </div>
                  <div class="mock-product-row">
                    <span class="mock-label">Secured Amount:</span>
                    <span class="mock-val highlight-val">GH₵ 450.00</span>
                  </div>
                  <div class="mock-action-btn primary-mock">Confirm Order &amp; Dispatch</div>
                </div>
              </div>

              <div class="preview-steps-flow">
                <span class="flow-step">List harvest</span>
                <span class="flow-arrow">→</span>
                <span class="flow-step">Find buyer</span>
                <span class="flow-arrow">→</span>
                <span class="flow-step">Confirm order</span>
              </div>
            </div>

            <!-- Trader Marketplace Card -->
            <div class="preview-card">
              <div class="preview-card-header">
                <div class="preview-user-badge trader-user">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                  </svg>
                  <span>Trader Marketplace</span>
                </div>
                <h3 class="preview-role-heading">Browse &amp; Commit</h3>
              </div>

              <div class="mock-device-frame">
                <div class="mock-screen-header">
                  <span class="mock-status-pill amber-pill">Ready for Pre-Order</span>
                  <span class="mock-time">Beposo Farm</span>
                </div>
                <div class="mock-screen-body">
                  <div class="mock-product-row">
                    <span class="mock-label">Batch Size:</span>
                    <span class="mock-val">20 Large Crates</span>
                  </div>
                  <div class="mock-product-row">
                    <span class="mock-label">Harvest Date:</span>
                    <span class="mock-val">This Tuesday</span>
                  </div>
                  <div class="mock-product-row">
                    <span class="mock-label">Price / Crate:</span>
                    <span class="mock-val highlight-val">GH₵ 30.00</span>
                  </div>
                  <div class="mock-action-btn secondary-mock">Commit MoMo Payment</div>
                </div>
              </div>

              <div class="preview-steps-flow">
                <span class="flow-step">Browse produce</span>
                <span class="flow-arrow">→</span>
                <span class="flow-step">Commit</span>
                <span class="flow-arrow">→</span>
                <span class="flow-step">Secure payment</span>
              </div>
            </div>

            <!-- Driver Logistics Card -->
            <div class="preview-card">
              <div class="preview-card-header">
                <div class="preview-user-badge driver-user">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="3" width="15" height="13" rx="2"/>
                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                  </svg>
                  <span>Driver Logistics</span>
                </div>
                <h3 class="preview-role-heading">Accept &amp; Deliver</h3>
              </div>

              <div class="mock-device-frame">
                <div class="mock-screen-header">
                  <span class="mock-status-pill teal-pill">Confirmed Job</span>
                  <span class="mock-time">Aboboyaa Trip</span>
                </div>
                <div class="mock-screen-body">
                  <div class="mock-product-row">
                    <span class="mock-label">Route:</span>
                    <span class="mock-val">Daboase → Market Circle</span>
                  </div>
                  <div class="mock-product-row">
                    <span class="mock-label">Cargo:</span>
                    <span class="mock-val">15 Crates Tomatoes</span>
                  </div>
                  <div class="mock-product-row">
                    <span class="mock-label">Guaranteed Fare:</span>
                    <span class="mock-val highlight-val">GH₵ 60.00</span>
                  </div>
                  <div class="mock-action-btn teal-mock">Start Delivery Trip</div>
                </div>
              </div>

              <div class="preview-steps-flow">
                <span class="flow-step">Receive job</span>
                <span class="flow-arrow">→</span>
                <span class="flow-step">Pick up</span>
                <span class="flow-arrow">→</span>
                <span class="flow-step">Deliver</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- 8. FINAL CTA SECTION -->
      <section class="final-cta-section">
        <div class="section-container">
          <div class="integrated-cta-box">
            <div class="cta-text-content">
              <h2 class="integrated-cta-title">Ready to sell with less risk?</h2>
              <p class="integrated-cta-subtext">
                Connect with buyers, secure payment, and arrange delivery before your tomatoes reach the market.
              </p>
            </div>
            <Link href="/register" class="btn-integrated-cta">
              Get Started — It's Free
            </Link>
          </div>
        </div>
      </section>
    </main>

    <!-- 9. CLEAN RESPONSIVE FOOTER -->
    <footer class="welcome-footer">
      <div class="footer-container">
        <div class="footer-top-row">
          <div class="footer-brand">
            <Link href="/" class="footer-logo">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
              </svg>
              <span>FarmLink</span>
            </Link>
            <p class="footer-tagline">Connecting tomato farmers, market traders, and tricycle drivers across Western Region, Ghana.</p>
          </div>

          <div class="footer-links-grid">
            <div class="footer-link-group">
              <span class="footer-group-title">Platform</span>
              <a href="#how-it-works" @click.prevent="scrollToSection('how-it-works')" class="footer-link">How It Works</a>
              <a href="#built-for" @click.prevent="scrollToSection('built-for')" class="footer-link">Corridor Ecosystem</a>
              <a href="#preview" @click.prevent="scrollToSection('preview')" class="footer-link">Platform Preview</a>
            </div>

            <div class="footer-link-group">
              <span class="footer-group-title">Account</span>
              <Link href="/login" class="footer-link">Log In</Link>
              <Link href="/register" class="footer-link">Register Account</Link>
              <a href="#why-farmlink" @click.prevent="scrollToSection('why-farmlink')" class="footer-link">Why FarmLink</a>
            </div>

            <div class="footer-link-group">
              <span class="footer-group-title">Information</span>
              <a href="#" @click.prevent="triggerAlert('FarmLink Western Region Pilot: Daboase & Beposo to Takoradi Market Circle Corridor.')" class="footer-link">About Pilot</a>
              <a href="#" @click.prevent="triggerAlert('Support & Contact: Western Region Corridor Desk — Takoradi Market Circle.')" class="footer-link">Contact Desk</a>
              <a href="#" @click.prevent="triggerAlert('Privacy Policy: All transactions are processed securely via Mobile Money escrow.')" class="footer-link">Privacy Policy</a>
              <a href="#" @click.prevent="triggerAlert('Terms of Service: Standard marketplace & escrow pilot terms apply.')" class="footer-link">Terms</a>
            </div>
          </div>
        </div>

        <div class="footer-bottom-row">
          <span class="footer-copy">© 2026 FarmLink • Daboase &amp; Beposo Tomato Corridor Pilot • Team Mythos</span>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import { Link, Head } from '@inertiajs/vue3';

export default {
  name: 'Welcome',
  components: {
    Link,
    Head
  },
  data() {
    return {
      mobileMenuOpen: false
    };
  },
  methods: {
    triggerAlert(msg) {
      alert(msg);
    },
    scrollToSection(id) {
      this.mobileMenuOpen = false;
      const el = document.getElementById(id);
      if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
      }
    }
  }
}
</script>

<style scoped>
@import "../../css/design-tokens.css";

/* Wrapper */
.welcome-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background-color: var(--color-bg-page);
  font-family: var(--font-family);
  color: var(--color-neutral-900);
  overflow-x: hidden;
}

/* Header */
.app-header {
  position: sticky;
  top: 0;
  z-index: 100;
  width: 100%;
  background-color: rgba(255, 255, 255, 0.94);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-bottom: 1px solid rgba(233, 236, 239, 0.9);
}

.header-inner {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 var(--space-6);
  height: 68px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: var(--space-4);
}

.app-logo {
  display: flex;
  align-items: center;
  gap: 10px;
  color: var(--color-primary);
  text-decoration: none;
  flex-shrink: 0;
}

.logo-icon {
  color: var(--color-primary);
  flex-shrink: 0;
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
  flex-shrink: 0;
}

.nav-link {
  font-size: 15px;
  color: var(--color-neutral-700);
  text-decoration: none;
  font-weight: 500;
  transition: color var(--transition-fast);
  padding: 8px 10px;
  border-radius: var(--radius-md);
}

.nav-link:hover {
  color: var(--color-primary);
}

.nav-login-btn {
  font-size: 15px;
  color: var(--color-neutral-900);
  text-decoration: none;
  font-weight: 600;
  padding: 8px 16px;
  border-radius: var(--radius-md);
  transition: all var(--transition-fast);
}

.nav-login-btn:hover {
  background-color: var(--color-neutral-100);
  color: var(--color-primary);
}

.nav-register-btn {
  font-size: 15px;
  color: var(--color-white);
  text-decoration: none;
  font-weight: 700;
  background-color: var(--color-primary);
  padding: 10px 20px;
  border-radius: var(--radius-md);
  transition: all var(--transition-fast);
  box-shadow: 0 2px 8px rgba(45, 106, 79, 0.25);
}

.nav-register-btn:hover {
  background-color: var(--color-primary-hover);
  transform: translateY(-1px);
}

/* Mobile Hamburger Menu */
.mobile-menu-btn {
  display: none;
  background: none;
  border: none;
  color: var(--color-neutral-900);
  cursor: pointer;
  padding: 8px;
  border-radius: var(--radius-md);
  min-height: 44px;
  min-width: 44px;
  align-items: center;
  justify-content: center;
}

.mobile-dropdown-nav {
  display: flex;
  flex-direction: column;
  padding: 16px 20px 24px;
  background-color: var(--color-white);
  border-bottom: 1px solid var(--color-neutral-200);
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
  gap: 4px;
}

.mobile-nav-link {
  font-size: 16px;
  color: var(--color-neutral-900);
  text-decoration: none;
  font-weight: 500;
  padding: 12px 6px;
  min-height: 44px;
  display: flex;
  align-items: center;
}

.mobile-divider {
  height: 1px;
  background-color: var(--color-neutral-100);
  margin: 8px 0;
}

.mobile-nav-btn {
  font-size: 16px;
  color: var(--color-white);
  text-decoration: none;
  font-weight: 700;
  background-color: var(--color-primary);
  height: 48px;
  border-radius: 9999px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 8px;
  box-shadow: 0 4px 12px rgba(45, 106, 79, 0.25);
}

/* Mobile Menu Animation */
.mobile-menu-enter-active,
.mobile-menu-leave-active {
  transition: all 0.25s ease-in-out;
  max-height: 340px;
  opacity: 1;
  overflow: hidden;
}

.mobile-menu-enter-from,
.mobile-menu-leave-to {
  max-height: 0;
  opacity: 0;
  padding-top: 0;
  padding-bottom: 0;
}

/* Main */
.main-content {
  flex: 1;
}

/* Section Shared Layout */
.section-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 72px 24px;
}

.section-header-text {
  text-align: center;
  margin-bottom: 48px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.section-tag-badge {
  display: inline-block;
  padding: 4px 14px;
  border-radius: 9999px;
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  margin-bottom: 12px;
}

.primary-tag {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary-hover);
}

.secondary-tag {
  background-color: var(--color-warning-light);
  color: var(--color-secondary-dark);
}

.warning-tag {
  background-color: #FEE2E2;
  color: #991B1B;
}

.section-title {
  font-size: 32px;
  font-weight: 800;
  color: var(--color-neutral-900);
  margin: 0 0 12px 0;
  letter-spacing: -0.5px;
  line-height: 1.25;
}

.section-subtitle {
  font-size: 16px;
  color: var(--color-neutral-500);
  margin: 0 auto;
  max-width: 640px;
  line-height: 1.6;
}

/* ===================================================
   1. HERO SECTION & IMAGE OVERLAY
   =================================================== */
.hero-section {
  min-height: auto;
  /* Ghanaian agricultural field background with ~38-44% overlay for vibrant photo visibility */
  background: linear-gradient(180deg, rgba(15, 38, 27, 0.38) 0%, rgba(27, 67, 50, 0.44) 100%), url('/images/welcome_hero_banner.png') center/cover no-repeat;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 60px 24px 48px;
  text-align: center;
  position: relative;
}

.hero-inner {
  max-width: 800px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
  color: var(--color-white);
}

@keyframes heroFadeUp {
  from {
    opacity: 0;
    transform: translateY(18px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.hero-animate {
  animation: heroFadeUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.hero-pill-badge {
  background: rgba(255, 255, 255, 0.24);
  border: 1px solid rgba(255, 255, 255, 0.45);
  color: #FFFFFF;
  border-radius: 9999px;
  padding: 6px 18px;
  font-size: 12px;
  font-weight: 600;
  letter-spacing: 0.5px;
  margin-bottom: 18px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.hero-headline {
  font-size: 46px;
  font-weight: 800;
  line-height: 1.15;
  color: #FFFFFF;
  margin: 0 0 18px 0;
  letter-spacing: -1px;
  text-shadow: 0 2px 14px rgba(0, 0, 0, 0.45);
}

.hero-subheadline {
  font-size: 19px;
  line-height: 1.45;
  color: rgba(255, 255, 255, 0.96);
  margin: 0 0 24px 0;
  max-width: 600px;
  font-weight: 500;
  text-shadow: 0 1px 8px rgba(0, 0, 0, 0.4);
}

.hero-cta-group {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  justify-content: center;
  width: 100%;
  margin-bottom: 22px;
}

.btn-hero-primary {
  background-color: var(--color-white);
  color: var(--color-primary-hover);
  padding: 0 34px;
  height: 52px;
  min-height: 48px;
  border-radius: 10px;
  font-weight: 800;
  font-size: 16px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
}

.btn-hero-primary:hover {
  background-color: var(--color-neutral-50);
  transform: translateY(-2px);
  box-shadow: 0 8px 26px rgba(0, 0, 0, 0.3);
}

.btn-hero-primary:active {
  transform: translateY(0);
}

.btn-hero-secondary-link {
  color: #FFFFFF;
  font-size: 14.5px;
  font-weight: 500;
  text-decoration: underline;
  text-underline-offset: 4px;
  opacity: 0.92;
  transition: all var(--transition-fast);
  padding: 6px 12px;
  min-height: 44px;
  display: inline-flex;
  align-items: center;
}

.btn-hero-secondary-link:hover {
  opacity: 1;
  color: var(--color-primary-lighter);
}

/* Trust Badges — Glass Pills */
.hero-trust-badges {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  margin-top: 14px;
  flex-wrap: wrap;
}

.trust-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 18px;
  background: rgba(255, 255, 255, 0.2);
  border: 1px solid rgba(255, 255, 255, 0.38);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border-radius: 9999px;
  font-size: 13.5px;
  font-weight: 600;
  color: #FFFFFF;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
  transition: all var(--transition-fast);
}

.trust-badge:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: translateY(-1px);
}

.trust-badge svg {
  color: #52B788;
  flex-shrink: 0;
}

/* ===================================================
   2. STATISTICS SECTION (Compact Trust Strip)
   =================================================== */
.stats-bar-section {
  background-color: var(--color-white);
  border-bottom: 1px solid var(--color-neutral-100);
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
  padding: 24px 20px;
}

.stats-container {
  max-width: 1100px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-around;
  gap: 16px;
}

.stat-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  flex: 1;
}

.stat-value {
  font-size: 26px;
  font-weight: 800;
  color: var(--color-primary);
  line-height: 1.15;
}

.stat-label {
  font-size: 13px;
  font-weight: 600;
  color: var(--color-neutral-500);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-top: 4px;
}

.stat-divider {
  width: 1px;
  height: 40px;
  background-color: var(--color-neutral-200);
}

.stats-disclaimer {
  text-align: center;
  margin-top: 14px;
  font-size: 11.5px;
  color: var(--color-neutral-500);
}

/* ===================================================
   3. PROBLEM SECTION
   =================================================== */
.problem-section {
  background-color: #F8F9FA;
  border-bottom: 1px solid var(--color-neutral-100);
}

.problem-cards-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}

.problem-card {
  background-color: var(--color-white);
  border-radius: var(--radius-xl);
  padding: 32px 26px;
  border: 1px solid var(--color-neutral-200);
  box-shadow: var(--shadow-sm);
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  position: relative;
  overflow: hidden;
}

.problem-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: var(--color-warning);
}

.problem-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-md);
}

.problem-icon-wrapper {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
}

.danger-bg { background-color: #FEE2E2; color: #DC3545; }
.warning-bg { background-color: #FEF3C7; color: #D97706; }
.accent-bg { background-color: #E0F2FE; color: #0284C7; }

.problem-card-title {
  font-size: 19px;
  font-weight: 700;
  color: var(--color-neutral-900);
  margin: 0 0 10px 0;
  line-height: 1.3;
}

.problem-card-body {
  font-size: 15px;
  color: var(--color-neutral-700);
  line-height: 1.6;
  margin: 0;
}

/* ===================================================
   4. HOW PRODUCE MOVES (SUPPLY CHAIN)
   =================================================== */
.supply-chain-section {
  background-color: var(--color-white);
  border-bottom: 1px solid var(--color-neutral-100);
}

.chain-diagram-flex {
  display: flex;
  align-items: stretch;
  justify-content: space-between;
  gap: 12px;
  margin-top: 20px;
}

.chain-step-card {
  flex: 1;
  background-color: #F8F9FA;
  border: 1px solid var(--color-neutral-200);
  border-radius: var(--radius-lg);
  padding: 24px 20px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.chain-step-card:hover {
  background-color: var(--color-white);
  transform: translateY(-3px);
  box-shadow: var(--shadow-md);
  border-color: var(--color-primary-light);
}

.chain-step-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  margin-bottom: 16px;
}

.chain-step-number {
  font-size: 13px;
  font-weight: 800;
  color: var(--color-primary);
  background-color: var(--color-primary-subtle);
  padding: 3px 10px;
  border-radius: 9999px;
}

.chain-icon-circle {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background-color: var(--color-primary-subtle);
  color: var(--color-primary);
  display: flex;
  align-items: center;
  justify-content: center;
}

.amber-circle { background-color: var(--color-warning-light); color: var(--color-secondary-dark); }
.teal-circle { background-color: var(--color-tertiary-subtle); color: var(--color-tertiary-hover); }
.green-circle { background-color: #D1E7DD; color: #0F5132; }

.chain-step-title {
  font-size: 17px;
  font-weight: 700;
  color: var(--color-neutral-900);
  margin: 0 0 8px 0;
  line-height: 1.3;
}

.chain-step-desc {
  font-size: 14px;
  color: var(--color-neutral-700);
  line-height: 1.5;
  margin: 0;
}

.chain-arrow {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  font-size: 20px;
  color: var(--color-neutral-400);
  font-weight: 600;
}

.desktop-arrow { display: inline-block; }
.mobile-arrow { display: none; }

/* ===================================================
   5. BUILT FOR THE WESTERN REGION (ROLE CARDS)
   =================================================== */
.who-its-for-section {
  background-color: #F8F9FA;
  border-bottom: 1px solid var(--color-neutral-100);
}

.stakeholders-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}

.role-card {
  background-color: var(--color-white);
  border-radius: var(--radius-xl);
  padding: 32px 24px;
  display: flex;
  flex-direction: column;
  border: 1px solid var(--color-neutral-200);
  box-shadow: var(--shadow-sm);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  position: relative;
}

.role-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-md);
}

.role-card-farmer { border-top: 4px solid var(--color-primary); }
.role-card-trader { border-top: 4px solid var(--color-secondary); }
.role-card-driver { border-top: 4px solid var(--color-tertiary); }

.role-card-top {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 16px;
}

.role-icon-box {
  width: 52px;
  height: 52px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.farmer-icon { background-color: var(--color-primary-subtle); color: var(--color-primary); }
.trader-icon { background-color: var(--color-warning-light); color: var(--color-secondary-dark); }
.driver-icon { background-color: var(--color-tertiary-subtle); color: var(--color-tertiary-hover); }

.role-header-info {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.role-pill {
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  width: fit-content;
}

.farmer-pill { color: var(--color-primary); }
.trader-pill { color: var(--color-secondary-dark); }
.driver-pill { color: var(--color-tertiary-hover); }

.role-title {
  font-size: 20px;
  font-weight: 800;
  color: var(--color-neutral-900);
  margin: 0;
}

.role-quote {
  font-size: 15px;
  font-weight: 700;
  font-style: italic;
  color: var(--color-neutral-900);
  margin: 0 0 12px 0;
  padding: 0;
}

.role-desc {
  font-size: 15px;
  color: var(--color-neutral-700);
  line-height: 1.6;
  margin: 0;
}

/* ===================================================
   6. WHY FARMERS CHOOSE FARMLINK
   =================================================== */
.why-section {
  background-color: var(--color-white);
  border-bottom: 1px solid var(--color-neutral-100);
}

.benefits-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}

.benefit-card {
  background-color: #F8F9FA;
  border: 1px solid var(--color-neutral-200);
  border-radius: var(--radius-xl);
  padding: 32px 26px;
  display: flex;
  flex-direction: column;
  gap: 16px;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.benefit-card:hover {
  background-color: var(--color-white);
  transform: translateY(-3px);
  box-shadow: var(--shadow-md);
  border-color: var(--color-primary-light);
}

.benefit-icon-badge {
  width: 52px;
  height: 52px;
  border-radius: 14px;
  background-color: var(--color-primary-subtle);
  color: var(--color-primary);
  display: flex;
  align-items: center;
  justify-content: center;
}

.benefit-title {
  font-size: 20px;
  font-weight: 800;
  color: var(--color-neutral-900);
  margin: 0 0 6px 0;
}

.benefit-quote {
  font-size: 14.5px;
  font-weight: 700;
  color: var(--color-primary-hover);
  margin: 0 0 8px 0;
}

.benefit-body {
  font-size: 15px;
  color: var(--color-neutral-700);
  line-height: 1.6;
  margin: 0;
}

/* ===================================================
   7. PLATFORM PREVIEW SECTION
   =================================================== */
.platform-preview-section {
  background-color: #F8F9FA;
  border-bottom: 1px solid var(--color-neutral-100);
}

.preview-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}

.preview-card {
  background-color: var(--color-white);
  border-radius: var(--radius-xl);
  border: 1px solid var(--color-neutral-200);
  padding: 26px 22px;
  box-shadow: var(--shadow-sm);
  display: flex;
  flex-direction: column;
  gap: 20px;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.preview-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-md);
}

.preview-card-header {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.preview-user-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 9999px;
  width: fit-content;
}

.farmer-user { background-color: var(--color-primary-subtle); color: var(--color-primary); }
.trader-user { background-color: var(--color-warning-light); color: var(--color-secondary-dark); }
.driver-user { background-color: var(--color-tertiary-subtle); color: var(--color-tertiary-hover); }

.preview-role-heading {
  font-size: 19px;
  font-weight: 800;
  color: var(--color-neutral-900);
  margin: 0;
}

.mock-device-frame {
  background-color: #111827;
  border-radius: 16px;
  padding: 16px;
  color: #FFFFFF;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.22);
}

.mock-screen-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
  padding-bottom: 8px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.12);
}

.mock-status-pill {
  font-size: 10px;
  font-weight: 700;
  padding: 3px 8px;
  border-radius: 9999px;
  text-transform: uppercase;
}

.green-pill { background-color: #059669; color: #FFFFFF; }
.amber-pill { background-color: #D97706; color: #FFFFFF; }
.teal-pill { background-color: #0D9488; color: #FFFFFF; }

.mock-time {
  font-size: 11px;
  color: rgba(255, 255, 255, 0.65);
}

.mock-screen-body {
  display: flex;
  flex-direction: column;
  gap: 9px;
}

.mock-product-row {
  display: flex;
  justify-content: space-between;
  font-size: 13px;
}

.mock-label { color: rgba(255, 255, 255, 0.65); }
.mock-val { color: #FFFFFF; font-weight: 600; }
.highlight-val { color: #52B788; font-weight: 700; }

.mock-action-btn {
  margin-top: 8px;
  padding: 10px;
  border-radius: 8px;
  font-size: 12px;
  font-weight: 700;
  text-align: center;
}

.primary-mock { background-color: var(--color-primary); color: #FFFFFF; }
.secondary-mock { background-color: var(--color-secondary); color: #FFFFFF; }
.teal-mock { background-color: var(--color-tertiary); color: #FFFFFF; }

.preview-steps-flow {
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 12px;
  font-weight: 600;
  color: var(--color-neutral-500);
}

.flow-step { color: var(--color-neutral-700); }
.flow-arrow { color: var(--color-primary); font-weight: 800; }

/* ===================================================
   8. FINAL CTA SECTION
   =================================================== */
.final-cta-section {
  background-color: var(--color-white);
  padding: 24px 0 72px;
}

.integrated-cta-box {
  background: linear-gradient(165deg, #1B4332 0%, #2D6A4F 100%);
  border-radius: 20px;
  padding: 48px 40px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 32px;
  box-shadow: 0 12px 32px rgba(27, 67, 50, 0.25);
  color: #FFFFFF;
}

.cta-text-content {
  max-width: 620px;
}

.integrated-cta-title {
  font-size: 32px;
  font-weight: 800;
  color: #FFFFFF;
  margin: 0 0 10px 0;
  letter-spacing: -0.5px;
}

.integrated-cta-subtext {
  font-size: 16px;
  color: rgba(255, 255, 255, 0.92);
  line-height: 1.5;
  margin: 0;
}

.btn-integrated-cta {
  background-color: var(--color-white);
  color: var(--color-primary-hover);
  padding: 0 34px;
  height: 52px;
  min-height: 48px;
  border-radius: 10px;
  font-weight: 800;
  font-size: 16px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  white-space: nowrap;
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
}

.btn-integrated-cta:hover {
  background-color: var(--color-neutral-50);
  transform: translateY(-2px);
  box-shadow: 0 8px 22px rgba(0, 0, 0, 0.22);
}

/* ===================================================
   9. FOOTER
   =================================================== */
.welcome-footer {
  background-color: #143325;
  color: rgba(255, 255, 255, 0.8);
  padding: 56px 24px 28px;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-container {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 40px;
}

.footer-top-row {
  display: flex;
  justify-content: space-between;
  gap: 48px;
  flex-wrap: wrap;
}

.footer-brand {
  max-width: 340px;
}

.footer-logo {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: #FFFFFF;
  font-size: 20px;
  font-weight: 800;
  text-decoration: none;
  margin-bottom: 12px;
}

.footer-tagline {
  font-size: 14px;
  color: rgba(255, 255, 255, 0.72);
  line-height: 1.6;
  margin: 0;
}

.footer-links-grid {
  display: flex;
  gap: 48px;
  flex-wrap: wrap;
}

.footer-link-group {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.footer-group-title {
  font-size: 12px;
  font-weight: 700;
  color: #FFFFFF;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  margin-bottom: 4px;
}

.footer-link {
  font-size: 14.5px;
  color: rgba(255, 255, 255, 0.72);
  text-decoration: none;
  transition: color var(--transition-fast);
  padding: 4px 0;
  min-height: 32px;
  display: inline-flex;
  align-items: center;
}

.footer-link:hover {
  color: var(--color-primary-light);
}

.footer-bottom-row {
  padding-top: 24px;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  text-align: center;
  font-size: 13px;
  color: rgba(255, 255, 255, 0.55);
}

/* ===================================================
   MOBILE RESPONSIVENESS & TOUCH TARGET FIXES
   =================================================== */
@media (max-width: 1024px) {
  .problem-cards-grid,
  .stakeholders-grid,
  .benefits-grid,
  .preview-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .chain-diagram-flex {
    flex-direction: column;
    gap: 16px;
  }

  .desktop-arrow { display: none; }
  .mobile-arrow { display: block; }
}

@media (max-width: 768px) {
  .desktop-nav { display: none; }
  .mobile-menu-btn { display: flex; }

  .header-inner {
    padding: 0 16px;
    height: 62px;
  }

  .hero-section {
    padding: 40px 16px 36px;
  }

  .hero-headline {
    font-size: 30px;
    margin-bottom: 14px;
  }

  .hero-subheadline {
    font-size: 15px;
    margin-bottom: 20px;
    max-width: 340px;
  }

  .btn-hero-primary {
    width: 100%;
    max-width: 320px;
    height: 48px;
    justify-content: center;
  }

  .hero-trust-badges {
    gap: 8px;
  }

  .trust-badge {
    padding: 6px 14px;
    font-size: 12px;
  }

  .stats-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    padding: 16px 8px;
  }

  .stat-value { font-size: 22px; }
  .stat-label { font-size: 11.5px; }

  .stat-divider { display: none; }

  .section-container {
    padding: 48px 16px;
  }

  .section-title {
    font-size: 26px;
  }

  .problem-cards-grid,
  .stakeholders-grid,
  .benefits-grid,
  .preview-grid {
    grid-template-columns: 1fr;
    gap: 18px;
  }

  .integrated-cta-box {
    flex-direction: column;
    text-align: center;
    padding: 32px 20px;
  }

  .btn-integrated-cta {
    width: 100%;
  }

  .footer-top-row {
    flex-direction: column;
    gap: 32px;
  }

  .footer-links-grid {
    gap: 28px;
  }
}

@media (max-width: 412px) {
  .hero-headline {
    font-size: 26px;
  }

  .hero-subheadline {
    font-size: 14.5px;
  }

  .app-logo-text {
    font-size: 18px;
  }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
  .hero-animate,
  .problem-card,
  .chain-step-card,
  .role-card,
  .benefit-card,
  .preview-card,
  .btn-hero-primary,
  .btn-integrated-cta {
    animation: none !important;
    transition: none !important;
    transform: none !important;
  }
}
</style>
