<template>
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
        <nav class="header-nav">
          <a href="#" class="help-link" @click.prevent="triggerAlert('Help Center: Western Region Corridor Guide, Buyer FAQ, and Driver Delivery Info.')">Help</a>
          <Link href="/login" class="nav-login-btn">Log In</Link>
          <Link href="/register" class="nav-register-btn">Register</Link>
        </nav>
      </div>
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
            From Daboase &amp; Beposo Farms to Takoradi Market
            <span class="hero-headline-sub">— Fresh. Committed. Secured.</span>
          </h1>

          <p class="hero-subheadline">
            FarmLink connects smallholder tomato farmers in Daboase and Beposo directly to market women at Takoradi Market Circle — eliminating distress sales through pre-committed, escrow-secured orders.
          </p>

          <div class="hero-cta-group">
            <Link href="/register" class="btn-hero-primary">
              <span>Get Started</span>
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </Link>
            <Link href="/login" class="btn-hero-secondary">
              Log In
            </Link>
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

      <!-- Section 5 — Who It's For -->
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
        </div>
      </section>

      <!-- Final CTA Strip -->
      <section class="final-cta-strip">
        <div class="cta-strip-inner">
          <h3 class="cta-strip-headline">Ready to end the distress sale?</h3>
          <Link href="/register" class="btn-cta-strip">
            Get Started — It's Free
          </Link>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <footer class="welcome-footer">
      <div class="footer-inner">
        <span class="footer-brand-text">FarmLink</span>
        <span class="footer-copy-text">Daboase &amp; Beposo Tomato Corridor Pilot • Team Mythos</span>
      </div>
    </footer>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
  name: 'Welcome',
  components: {
    Link
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
  background-color: rgba(255, 255, 255, 0.96);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid var(--color-neutral-100);
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

/* Section 1 — Hero Section with Farmer Image Background */
.hero-section {
  min-height: 85vh;
  background: linear-gradient(180deg, rgba(27, 67, 50, 0.88) 0%, rgba(27, 67, 50, 0.95) 100%), url('/images/welcome_hero_banner.png') center/cover no-repeat;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: var(--space-12) var(--space-6);
  text-align: center;
  position: relative;
}

.hero-inner {
  max-width: 860px;
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
  background: rgba(255, 255, 255, 0.15);
  border: 1px solid rgba(255, 255, 255, 0.3);
  color: var(--color-white);
  border-radius: var(--radius-pill);
  padding: 6px 18px;
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  letter-spacing: 0.5px;
  margin-bottom: var(--space-6);
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
  backdrop-filter: blur(4px);
}

.hero-headline {
  font-size: 48px;
  font-weight: 800;
  line-height: 1.15;
  color: var(--color-white);
  margin: 0 0 var(--space-6) 0;
  letter-spacing: -1px;
}

.hero-headline-sub {
  display: block;
  font-size: 30px;
  font-weight: 600;
  color: var(--color-primary-lighter);
  margin-top: var(--space-2);
}

.hero-subheadline {
  font-size: var(--font-size-lg);
  line-height: var(--line-height-relaxed);
  color: rgba(255, 255, 255, 0.9);
  margin: 0 0 var(--space-8) 0;
  max-width: 740px;
  font-weight: var(--font-weight-regular);
}

.hero-cta-group {
  display: flex;
  gap: var(--space-4);
  justify-content: center;
  width: 100%;
}

.btn-hero-primary {
  background-color: var(--color-white);
  color: var(--color-primary-hover);
  padding: 0 var(--space-8);
  height: 52px;
  border-radius: var(--radius-md);
  font-weight: var(--font-weight-bold);
  font-size: var(--font-size-base);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
  transition: all var(--transition-fast);
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
}

.btn-hero-primary:hover {
  background-color: var(--color-neutral-50);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}

.btn-hero-secondary {
  background-color: transparent;
  color: var(--color-white);
  border: 1.5px solid rgba(255, 255, 255, 0.7);
  padding: 0 var(--space-8);
  height: 52px;
  border-radius: var(--radius-md);
  font-weight: var(--font-weight-bold);
  font-size: var(--font-size-base);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: all var(--transition-fast);
}

.btn-hero-secondary:hover {
  background-color: rgba(255, 255, 255, 0.15);
  border-color: var(--color-white);
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

/* Section 5 — Who It's For */
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

/* Final CTA Strip */
.final-cta-strip {
  background-color: var(--color-neutral-900);
  padding: var(--space-8) var(--space-6);
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.cta-strip-inner {
  max-width: 900px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-6);
}

.cta-strip-headline {
  font-size: var(--font-size-2xl);
  font-weight: var(--font-weight-bold);
  color: var(--color-white);
  margin: 0;
}

.btn-cta-strip {
  background-color: var(--color-secondary);
  color: var(--color-secondary-dark);
  padding: 0 var(--space-8);
  height: 48px;
  border-radius: var(--radius-md);
  font-weight: var(--font-weight-bold);
  font-size: var(--font-size-base);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  white-space: nowrap;
  transition: all var(--transition-fast);
}

.btn-cta-strip:hover {
  background-color: var(--color-secondary-hover);
  color: var(--color-white);
  transform: translateY(-1px);
}

/* Footer (Clean & Non-redundant) */
.welcome-footer {
  background-color: var(--color-neutral-900);
  border-top: 1px solid var(--color-neutral-700);
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
  color: var(--color-neutral-400);
  font-size: var(--font-size-xs);
  flex-wrap: wrap;
}

.footer-brand-text {
  font-weight: var(--font-weight-bold);
  color: var(--color-white);
}

.footer-copy-text {
  color: var(--color-neutral-400);
}

/* Mobile Responsiveness & Layout Fixes */
@media (max-width: 768px) {
  .header-inner {
    padding: 0 var(--space-4);
    height: 60px;
  }

  .app-logo-text {
    font-size: var(--font-size-base);
  }

  .header-nav {
    gap: var(--space-2);
  }

  .help-link {
    font-size: 12px;
    padding: 0 4px;
  }

  .nav-login-btn {
    padding: 4px 8px;
    font-size: 12px;
  }

  .nav-register-btn {
    padding: 6px 12px;
    font-size: 12px;
  }

  .hero-headline {
    font-size: 32px;
  }

  .hero-headline-sub {
    font-size: 22px;
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

  .cta-strip-inner {
    flex-direction: column;
    text-align: center;
  }
}

@media (max-width: 480px) {
  .header-inner {
    padding: 0 var(--space-3);
  }
  
  .app-logo-text {
    font-size: 14px;
  }

  .hero-headline { font-size: 26px; }
  .hero-headline-sub { font-size: 18px; }
  .hero-subheadline { font-size: var(--font-size-base); }
  .hero-cta-group { flex-direction: column; width: 100%; }
  .btn-hero-primary, .btn-hero-secondary { width: 100%; justify-content: center; }
  .how-card { flex-direction: column; align-items: flex-start; padding: var(--space-5); gap: var(--space-2); }
  .how-number { font-size: 28px; }
}
</style>
