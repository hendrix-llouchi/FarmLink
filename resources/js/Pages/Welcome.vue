<template>
  <Head title="FarmLink — Western Region Tomato Corridor" />
  <div class="welcome-container">
    <!-- Header Bar -->
    <header class="app-header">
      <div class="header-inner">
        <Link href="/" class="app-logo">
          <svg xmlns="http://www.w3.org/2000/svg" class="logo-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
          </svg>
          <span class="app-logo-text">FarmLink</span>
        </Link>

        <!-- Desktop Navigation -->
        <nav class="header-nav desktop-nav">
          <a href="#" class="help-link" @click.prevent="triggerAlert('Help Center: Western Region Corridor Guide, Buyer FAQ, and Driver Delivery Info.')">Help</a>
          <Link href="/login" class="nav-login-btn">Log In</Link>
          <Link href="/register" class="nav-register-btn">Register</Link>
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
          <a href="#" class="mobile-nav-link" @click.prevent="triggerAlert('Help Center: Western Region Corridor Guide, Buyer FAQ, and Driver Delivery Info.'); mobileMenuOpen = false;">Help</a>
          <Link href="/login" class="mobile-nav-link" @click="mobileMenuOpen = false">Log In</Link>
          <Link href="/register" class="mobile-nav-btn" @click="mobileMenuOpen = false">Get Started</Link>
        </div>
      </transition>
    </header>

    <!-- Main Content Area -->
    <main class="main-content">
      <!-- Section 1 — Hero Section (Farmer Background Image behind Text) -->
      <section class="hero-section">
        <div class="hero-inner hero-animate">
          <div class="hero-pill-badge">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/><circle cx="12" cy="10" r="3"/>
            </svg>
            <span>Western Region, Ghana</span>
          </div>

          <h1 class="hero-headline">
            Sell Your Tomatoes Before Harvest.
          </h1>

          <p class="hero-subheadline">
            Connect with verified buyers through secure pre-orders.
          </p>

          <div class="hero-cta-group">
            <Link href="/register" class="btn-hero-primary">
              <span>Get Started</span>
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </Link>
            <Link href="/login" class="btn-hero-secondary-link">
              Already have an account? Log in
            </Link>
          </div>

          <!-- Trust Badges -->
          <div class="hero-trust-badges">
            <div class="trust-badge">
              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
              <span>Verified Buyers</span>
            </div>
            <div class="trust-badge">
              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
              <span>Secure Payments</span>
            </div>
            <div class="trust-badge">
              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
              <span>Local Transport</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Section 2 — The Problem We Solve -->
      <section class="problem-section">
        <div class="section-container">
          <div class="section-header-text">
            <h2 class="section-title">The Problem We Solve</h2>
            <p class="section-subtitle">Addressing post-harvest losses and distress sales in the Daboase &amp; Beposo → Market Circle tomato corridor.</p>
          </div>

          <div class="problem-cards-grid">
            <!-- Card 1 -->
            <div class="problem-card card-accent-green">
              <div class="problem-icon-wrapper green-icon-bg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22C6.5 22 2 17.5 2 12S6.5 2 12 2s10 4.5 10 10-4.5 10-10 10z"/>
                  <path d="M12 6v6l4 2"/>
                  <path d="M16 2v4"/>
                </svg>
              </div>
              <h3 class="problem-card-title">Produce Lost Every Tuesday</h3>
              <p class="problem-card-body">
                Tomatoes harvested in Daboase and Beposo must sell on market day or be discarded. With no cold storage, every unsold crate is a financial loss.
              </p>
            </div>

            <!-- Card 2 -->
            <div class="problem-card card-accent-amber">
              <div class="problem-icon-wrapper amber-icon-bg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="2" y="5" width="20" height="14" rx="2"/>
                  <line x1="2" y1="10" x2="22" y2="10"/>
                  <path d="M12 14h.01"/>
                </svg>
              </div>
              <h3 class="problem-card-title">The Distress Sale Trap</h3>
              <p class="problem-card-body">
                Without pre-committed buyers, farmers slash prices at day's end. Market women wait specifically for this — exploiting the time pressure farmers face.
              </p>
            </div>

            <!-- Card 3 -->
            <div class="problem-card card-accent-teal">
              <div class="problem-icon-wrapper teal-icon-bg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="1" y="3" width="15" height="13" rx="2"/>
                  <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                  <circle cx="5.5" cy="18.5" r="2.5"/>
                  <circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
              </div>
              <h3 class="problem-card-title">Transport Cost Disputes</h3>
              <p class="problem-card-body">
                Aboboyaa transport costs are settled informally on the spot, with no advance agreement — absorbing unpredictable portions of the farmer's revenue.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Section 3 — The Supply Chain -->
      <section class="supply-chain-section">
        <div class="section-container">
          <div class="section-header-text">
            <h2 class="section-title">How Produce Moves</h2>
            <p class="section-subtitle">A transparent digital corridor connecting farm gate in Daboase &amp; Beposo to Takoradi Market Circle.</p>
          </div>

          <div class="chain-diagram-flex">
            <!-- Step 1 -->
            <div class="chain-step-card">
              <div class="chain-icon-box green-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 2 2 4v4a4 4 0 0 1-4 4h-2a3 3 0 0 0-3 3v3z"/>
                  <path d="M9 22v-4H7a2 2 0 0 1-2-2V8"/>
                </svg>
              </div>
              <span class="chain-step-number">Step 1</span>
              <h4 class="chain-step-title">Farm — Daboase / Beposo</h4>
              <p class="chain-step-desc">
                Farmer harvests tomatoes and lists them on FarmLink with harvest date, unit, and quality grade.
              </p>
            </div>

            <!-- Arrow 1 -->
            <div class="chain-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-desktop"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-mobile"><path d="M12 5v14"/><path d="m5 12 7 7 7-7"/></svg>
            </div>

            <!-- Step 2 -->
            <div class="chain-step-card">
              <div class="chain-icon-box amber-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                  <path d="m9 12 2 2 4-4"/>
                </svg>
              </div>
              <span class="chain-step-number">Step 2</span>
              <h4 class="chain-step-title">FarmLink Match</h4>
              <p class="chain-step-desc">
                Market trader browses, commits to a purchase — product price + estimated transport cost locked in escrow.
              </p>
            </div>

            <!-- Arrow 2 -->
            <div class="chain-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-desktop"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-mobile"><path d="M12 5v14"/><path d="m5 12 7 7 7-7"/></svg>
            </div>

            <!-- Step 3 -->
            <div class="chain-step-card">
              <div class="chain-icon-box teal-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="1" y="3" width="15" height="13" rx="2"/>
                  <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                  <circle cx="5.5" cy="18.5" r="2.5"/>
                  <circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
              </div>
              <span class="chain-step-number">Step 3</span>
              <h4 class="chain-step-title">Aboboyaa Transit</h4>
              <p class="chain-step-desc">
                FarmLink assigns an aboboyaa driver. Pickup confirmed digitally with full transport accountability.
              </p>
            </div>

            <!-- Arrow 3 -->
            <div class="chain-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-desktop"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-mobile"><path d="M12 5v14"/><path d="m5 12 7 7 7-7"/></svg>
            </div>

            <!-- Step 4 -->
            <div class="chain-step-card">
              <div class="chain-icon-box blue-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                  <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
              </div>
              <span class="chain-step-number">Step 4</span>
              <h4 class="chain-step-title">Market Circle</h4>
              <p class="chain-step-desc">
                Market trader receives fresh tomatoes. Farmer paid. Driver paid. Zero distress sales.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Section 4 — How It Works -->
      <section class="how-it-works-section">
        <div class="section-container">
          <div class="section-header-text">
            <h2 class="section-title">How FarmLink Works</h2>
            <p class="section-subtitle">Three simple steps to guaranteed sales and seamless logistics.</p>
          </div>

          <div class="how-it-works-list">
            <!-- Step 1 -->
            <div class="how-card">
              <div class="how-number">01</div>
              <div class="how-card-content">
                <h3 class="how-card-title">Farmer lists fresh tomatoes</h3>
                <p class="how-card-text">
                  Add your harvest with date, quality grade, and minimum order quantity. Buyers see exactly what they're getting before they commit.
                </p>
              </div>
            </div>

            <!-- Step 2 -->
            <div class="how-card">
              <div class="how-number">02</div>
              <div class="how-card-content">
                <h3 class="how-card-title">Market trader commits with escrow</h3>
                <p class="how-card-text">
                  Buyers pay via Mobile Money — product cost and transport cost locked in escrow. No more price negotiation under pressure.
                </p>
              </div>
            </div>

            <!-- Step 3 -->
            <div class="how-card">
              <div class="how-number">03</div>
              <div class="how-card-content">
                <h3 class="how-card-title">FarmLink arranges delivery</h3>
                <p class="how-card-text">
                  An aboboyaa driver on the Daboase &amp; Beposo → Market Circle corridor is matched and notified. Farmer gets paid. Driver gets paid. No waste.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Section 5 — Who It's For & Integrated CTA -->
      <section class="who-its-for-section">
        <div class="section-container">
          <div class="section-header-text light-header">
            <h2 class="section-title text-white">Built for the Western Region</h2>
            <p class="section-subtitle text-white-sub">Tailored solutions for every key player along the agricultural corridor.</p>
          </div>

          <div class="stakeholders-grid">
            <!-- Stakeholder 1 -->
            <div class="glass-card">
              <div class="glass-card-header">
                <div class="glass-icon-circle">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 2 2 4v4a4 4 0 0 1-4 4h-2a3 3 0 0 0-3 3v3z"/>
                    <path d="M9 22v-4H7a2 2 0 0 1-2-2V8"/>
                  </svg>
                </div>
                <h3>Farmers</h3>
              </div>
              <p>
                Smallholder tomato farmers in Daboase and Beposo who harvest and need guaranteed buyers before produce spoils.
              </p>
            </div>

            <!-- Stakeholder 2 -->
            <div class="glass-card">
              <div class="glass-card-header">
                <div class="glass-icon-circle">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                  </svg>
                </div>
                <h3>Market Traders</h3>
              </div>
              <p>
                Market women and traders at Takoradi Market Circle who want reliable, pre-arranged supply without traveling to Beposo every Tuesday.
              </p>
            </div>

            <!-- Stakeholder 3 -->
            <div class="glass-card">
              <div class="glass-card-header">
                <div class="glass-icon-circle">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="3" width="15" height="13" rx="2"/>
                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                    <circle cx="5.5" cy="18.5" r="2.5"/>
                    <circle cx="18.5" cy="18.5" r="2.5"/>
                  </svg>
                </div>
                <h3>Aboboyaa Drivers</h3>
              </div>
              <p>
                Transport operators on the Daboase &amp; Beposo → Market Circle corridor who want confirmed, pre-paid delivery jobs — not just waiting at the roadside.
              </p>
            </div>
          </div>

          <!-- Seamless Integrated CTA Box inside Green Section -->
          <div class="integrated-cta-box">
            <h3 class="integrated-cta-title">Ready to end the distress sale?</h3>
            <Link href="/register" class="btn-integrated-cta">
              Get Started — It's Free
            </Link>
          </div>
        </div>
      </section>
    </main>

    <!-- Clean Single Footer -->
    <footer class="welcome-footer">
      <div class="footer-inner">
        <span class="footer-brand-text">FarmLink</span>
        <span class="footer-dot">•</span>
        <span class="footer-copy-text">Daboase &amp; Beposo Tomato Corridor Pilot • Team Mythos</span>
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
}

/* Header */
.app-header {
  position: sticky;
  top: 0;
  z-index: 100;
  width: 100%;
  background-color: rgba(255, 255, 255, 0.85);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-bottom: 1px solid rgba(233, 236, 239, 0.8);
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
  gap: var(--space-2);
  color: var(--color-primary);
  text-decoration: none;
  flex-shrink: 0;
}

.logo-icon {
  color: var(--color-primary);
  flex-shrink: 0;
}

.app-logo-text {
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-bold);
  letter-spacing: -0.5px;
}

.header-nav {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  flex-shrink: 0;
}

.help-link {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  text-decoration: none;
  font-weight: var(--font-weight-medium);
  transition: color var(--transition-fast);
  white-space: nowrap;
  padding: 0 var(--space-2);
}

.help-link:hover {
  color: var(--color-primary);
}

.nav-login-btn {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
  text-decoration: none;
  font-weight: var(--font-weight-semibold);
  padding: var(--space-2) var(--space-3);
  border-radius: var(--radius-md);
  transition: all var(--transition-fast);
  white-space: nowrap;
}

.nav-login-btn:hover {
  background-color: var(--color-neutral-100);
  color: var(--color-neutral-900);
}

.nav-register-btn {
  font-size: var(--font-size-sm);
  color: var(--color-white);
  text-decoration: none;
  font-weight: var(--font-weight-bold);
  background-color: var(--color-primary);
  padding: var(--space-2) var(--space-4);
  border-radius: var(--radius-md);
  transition: background-color var(--transition-fast);
  white-space: nowrap;
}

.nav-register-btn:hover {
  background-color: var(--color-primary-hover);
}

/* Mobile Hamburger Menu Navigation */
.mobile-menu-btn {
  display: none;
  background: none;
  border: none;
  color: var(--color-neutral-700);
  cursor: pointer;
  padding: var(--space-2);
  border-radius: var(--radius-md);
  transition: color var(--transition-fast), background-color var(--transition-fast);
}

.mobile-menu-btn:hover {
  background-color: var(--color-neutral-100);
  color: var(--color-neutral-900);
}

.mobile-dropdown-nav {
  display: flex;
  flex-direction: column;
  padding: var(--space-3) var(--space-4) var(--space-4);
  background-color: var(--color-white);
  border-bottom: 1px solid var(--color-neutral-100);
  gap: var(--space-2);
}

.mobile-nav-link {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
  text-decoration: none;
  font-weight: var(--font-weight-medium);
  padding: var(--space-2.5) var(--space-3);
  border-radius: var(--radius-md);
  transition: background-color var(--transition-fast);
}

.mobile-nav-link:hover {
  background-color: var(--color-neutral-100);
  color: var(--color-primary);
}

.mobile-nav-btn {
  font-size: var(--font-size-sm);
  color: var(--color-white);
  text-decoration: none;
  font-weight: var(--font-weight-bold);
  background-color: var(--color-primary);
  padding: var(--space-2.5) var(--space-4);
  border-radius: var(--radius-md);
  text-align: center;
  margin-top: var(--space-1);
  transition: background-color var(--transition-fast);
}

.mobile-nav-btn:hover {
  background-color: var(--color-primary-hover);
}

/* Mobile menu animation */
.mobile-menu-enter-active,
.mobile-menu-leave-active {
  transition: all 0.25s ease-in-out;
  max-height: 200px;
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
  padding: var(--space-12) var(--space-6);
}

.section-header-text {
  text-align: center;
  margin-bottom: var(--space-10);
}

.section-title {
  font-size: var(--font-size-3xl);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0 0 var(--space-2) 0;
  letter-spacing: -0.5px;
}

.section-subtitle {
  font-size: var(--font-size-base);
  color: var(--color-neutral-500);
  margin: 0 auto;
  max-width: 620px;
}

/* Section 1 — Hero Section (Farmer Background Image with Lighter Green Overlay) */
.hero-section {
  min-height: auto;
  background: linear-gradient(180deg, rgba(27, 67, 50, 0.48) 0%, rgba(45, 106, 79, 0.65) 100%), url('/images/welcome_hero_banner.png') center/cover no-repeat;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 44px var(--space-6) 36px;
  text-align: center;
  position: relative;
}

.hero-inner {
  max-width: 780px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
  color: var(--color-white);
}

@keyframes heroFadeUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.hero-animate {
  animation: heroFadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.hero-pill-badge {
  background: rgba(255, 255, 255, 0.18);
  border: 1px solid rgba(255, 255, 255, 0.35);
  color: var(--color-white);
  border-radius: 9999px;
  padding: 5px 16px;
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  letter-spacing: 0.5px;
  margin-bottom: 14px;
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
}

.hero-headline {
  font-size: 46px;
  font-weight: 800;
  line-height: 1.12;
  color: var(--color-white);
  margin: 0 0 10px 0;
  letter-spacing: -1px;
  text-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
}

.hero-subheadline {
  font-size: 18px;
  line-height: 1.4;
  color: rgba(255, 255, 255, 0.95);
  margin: 0 0 16px 0;
  max-width: 580px;
  font-weight: var(--font-weight-medium);
  text-shadow: 0 1px 6px rgba(0, 0, 0, 0.3);
}

.hero-cta-group {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  justify-content: center;
  width: 100%;
  margin-bottom: 22px;
}

.btn-hero-primary {
  background-color: var(--color-white);
  color: var(--color-primary-hover);
  padding: 0 var(--space-8);
  height: 48px;
  border-radius: var(--radius-md);
  font-weight: var(--font-weight-bold);
  font-size: var(--font-size-base);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
  transition: all var(--transition-fast);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
}

.btn-hero-primary:hover {
  background-color: var(--color-neutral-50);
  transform: translateY(-2px);
  box-shadow: 0 6px 22px rgba(0, 0, 0, 0.25);
}

.btn-hero-secondary-link {
  color: var(--color-white);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  text-decoration: underline;
  text-underline-offset: 4px;
  opacity: 0.92;
  transition: opacity var(--transition-fast), color var(--transition-fast);
  padding: 4px 8px;
  display: inline-flex;
  align-items: center;
}

.btn-hero-secondary-link:hover {
  opacity: 1;
  color: var(--color-primary-lighter);
}

/* Trust Badges — Actual Pills with Blur & Opacity */
.hero-trust-badges {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  margin-top: 0;
  flex-wrap: wrap;
}

.trust-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 20px;
  background: rgba(255, 255, 255, 0.18);
  border: 1px solid rgba(255, 255, 255, 0.35);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border-radius: 9999px;
  font-size: 13.5px;
  font-weight: 600;
  color: var(--color-white);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
  transition: transform var(--transition-fast), background var(--transition-fast);
}

.trust-badge:hover {
  background: rgba(255, 255, 255, 0.26);
  transform: translateY(-1px);
}

.trust-badge svg {
  color: #52B788;
  flex-shrink: 0;
}


/* Section 2 — The Problem We Solve */
.problem-section {
  background-color: var(--color-white);
  border-bottom: 1px solid var(--color-neutral-100);
}

.problem-cards-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-6);
}

.problem-card {
  background-color: var(--color-white);
  border-radius: var(--radius-lg);
  padding: var(--space-6);
  border: 1px solid var(--color-border);
  box-shadow: var(--shadow-sm);
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  transition: all var(--transition-base);
}

.problem-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-md);
}

.card-accent-green { border-top: 4px solid var(--color-primary); }
.card-accent-amber { border-top: 4px solid var(--color-secondary); }
.card-accent-teal { border-top: 4px solid var(--color-tertiary); }

.problem-icon-wrapper {
  width: 46px;
  height: 46px;
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: var(--space-4);
}

.green-icon-bg { background-color: var(--color-primary-subtle); color: var(--color-primary); }
.amber-icon-bg { background-color: var(--color-warning-light); color: var(--color-secondary-dark); }
.teal-icon-bg { background-color: var(--color-tertiary-subtle); color: var(--color-tertiary); }

.problem-card-title {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0 0 var(--space-2) 0;
}

.problem-card-body {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  line-height: var(--line-height-relaxed);
  margin: 0;
}

/* Section 3 — The Supply Chain */
.supply-chain-section {
  background-color: var(--color-neutral-50);
  border-bottom: 1px solid var(--color-neutral-100);
}

.chain-diagram-flex {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-3);
}

.chain-step-card {
  flex: 1;
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-5);
  box-shadow: var(--shadow-xs);
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  min-height: 210px;
}

.chain-icon-box {
  width: 42px;
  height: 42px;
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: var(--space-3);
}

.green-box { background-color: var(--color-primary-subtle); color: var(--color-primary); }
.amber-box { background-color: var(--color-warning-light); color: var(--color-secondary-dark); }
.teal-box { background-color: var(--color-tertiary-subtle); color: var(--color-tertiary); }
.blue-box { background-color: #E0F2FE; color: #0284C7; }

.chain-step-number {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  color: var(--color-primary);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: var(--space-1);
}

.chain-step-title {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0 0 var(--space-2) 0;
}

.chain-step-desc {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  line-height: var(--line-height-base);
  margin: 0;
}

.chain-arrow {
  color: var(--color-primary-light);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.arrow-desktop { display: block; }
.arrow-mobile { display: none; }

/* Section 4 — How It Works */
.how-it-works-section {
  background-color: var(--color-white);
  border-bottom: 1px solid var(--color-neutral-100);
}

.how-it-works-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-6);
  max-width: 900px;
  margin: 0 auto;
}

.how-card {
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-6) var(--space-8);
  display: flex;
  align-items: center;
  gap: var(--space-6);
  box-shadow: var(--shadow-xs);
  transition: transform var(--transition-base);
}

.how-card:hover {
  transform: translateX(6px);
  box-shadow: var(--shadow-sm);
}

.how-number {
  font-size: 36px;
  font-weight: 800;
  color: var(--color-primary);
  min-width: 60px;
}

.how-card-content { flex: 1; }

.how-card-title {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0 0 var(--space-2) 0;
}

.how-card-text {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  line-height: var(--line-height-relaxed);
  margin: 0;
}

/* Section 5 — Who It's For & Integrated Seamless CTA */
.who-its-for-section {
  background: linear-gradient(160deg, #1B4332 0%, #2D6A4F 55%, #2A9D8F 100%);
  color: var(--color-white);
}

.light-header .text-white { color: var(--color-white); }
.light-header .text-white-sub { color: rgba(255, 255, 255, 0.85); }

.stakeholders-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-6);
}

.glass-card {
  background: rgba(255, 255, 255, 0.12);
  backdrop-filter: blur(8px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: var(--radius-lg);
  padding: var(--space-6);
  color: var(--color-white);
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
  transition: transform var(--transition-base);
}

.glass-card:hover {
  transform: translateY(-4px);
  background: rgba(255, 255, 255, 0.18);
}

.glass-card-header {
  display: flex;
  align-items: center;
  gap: var(--space-3);
}

.glass-icon-circle {
  width: 40px;
  height: 40px;
  border-radius: var(--radius-full);
  background: rgba(255, 255, 255, 0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-white);
}

.glass-card-header h3 {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  margin: 0;
  color: var(--color-white);
}

.glass-card p {
  font-size: var(--font-size-sm);
  color: rgba(255, 255, 255, 0.9);
  line-height: var(--line-height-relaxed);
  margin: 0;
}

/* Integrated CTA Box inside Green Section */
.integrated-cta-box {
  margin-top: var(--space-12);
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.25);
  border-radius: var(--radius-xl);
  padding: var(--space-8) var(--space-8);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-6);
}

.integrated-cta-title {
  font-size: var(--font-size-2xl);
  font-weight: var(--font-weight-bold);
  color: var(--color-white);
  margin: 0;
}

.btn-integrated-cta {
  background-color: var(--color-white);
  color: var(--color-primary-hover);
  padding: 0 var(--space-8);
  height: 50px;
  border-radius: var(--radius-md);
  font-weight: var(--font-weight-bold);
  font-size: var(--font-size-base);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  white-space: nowrap;
  transition: all var(--transition-fast);
  box-shadow: 0 4px 14px rgba(0,0,0,0.12);
}

.btn-integrated-cta:hover {
  background-color: var(--color-neutral-50);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.18);
}

/* Single Clean Footer */
.welcome-footer {
  background-color: #163628;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  padding: var(--space-6) var(--space-4);
  text-align: center;
}

.footer-inner {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
  color: rgba(255, 255, 255, 0.7);
  font-size: var(--font-size-xs);
  flex-wrap: wrap;
}

.footer-brand-text {
  font-weight: var(--font-weight-bold);
  color: var(--color-white);
}

.footer-dot {
  color: rgba(255, 255, 255, 0.4);
}

.footer-copy-text {
  color: rgba(255, 255, 255, 0.7);
}

/* Mobile Responsiveness & Layout Fixes */
@media (max-width: 768px) {
  .desktop-nav {
    display: none;
  }

  .mobile-menu-btn {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .header-inner {
    padding: 0 var(--space-4);
    height: 60px;
  }

  .app-logo-text {
    font-size: var(--font-size-lg);
  }

  .hero-section {
    padding: 28px var(--space-4) 24px;
    min-height: auto;
  }

  .hero-pill-badge {
    margin-bottom: 10px;
    padding: 4px 12px;
    font-size: 11px;
  }

  .hero-headline {
    font-size: 26px;
    margin-bottom: 8px;
    letter-spacing: -0.5px;
  }

  .hero-subheadline {
    font-size: 13.5px;
    line-height: 1.4;
    margin-bottom: 14px;
    max-width: 320px;
  }

  .hero-cta-group {
    flex-direction: column;
    align-items: center;
    gap: 8px;
    width: 100%;
    margin-bottom: 16px;
  }

  .btn-hero-primary {
    width: 100%;
    max-width: 290px;
    height: 44px;
    font-size: 15px;
    justify-content: center;
  }

  .btn-hero-secondary-link {
    font-size: 12.5px;
    padding: 4px;
  }

  .hero-trust-badges {
    gap: 8px;
  }

  .trust-badge {
    padding: 6px 14px;
    font-size: 11.5px;
  }

  .problem-cards-grid,
  .stakeholders-grid {
    grid-template-columns: 1fr;
  }

  .chain-diagram-flex {
    flex-direction: column;
    gap: var(--space-4);
  }

  .chain-arrow {
    margin: var(--space-2) 0;
  }

  .arrow-desktop { display: none; }
  .arrow-mobile { display: block; }

  .chain-step-card {
    width: 100%;
    min-height: auto;
  }

  .integrated-cta-box {
    flex-direction: column;
    text-align: center;
    padding: var(--space-6);
  }

  .integrated-cta-title {
    font-size: var(--font-size-xl);
  }
}

@media (max-width: 480px) {
  .header-inner {
    padding: 0 var(--space-3);
  }
  
  .app-logo-text {
    font-size: 15px;
  }

  .hero-headline { font-size: 23px; }
  .hero-subheadline { font-size: 12.5px; }
  .how-card { flex-direction: column; align-items: flex-start; padding: var(--space-5); gap: var(--space-2); }
  .how-number { font-size: 28px; }
}
</style>
