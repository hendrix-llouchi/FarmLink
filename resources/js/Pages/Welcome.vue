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
      <!-- Section 1 — Hero -->
      <section class="hero-section">
        <div class="hero-inner hero-animate">
          <div class="hero-pill-badge">
            <span>🌾 Western Region, Ghana</span>
          </div>

          <h1 class="hero-headline">
            From Daboase Farm to Takoradi Market
            <span class="hero-headline-sub">— Fresh. Committed. Secured.</span>
          </h1>

          <p class="hero-subheadline">
            FarmLink helps smallholder tomato farmers in Daboase and Beposo move produce to market women at Takoradi Market Circle — eliminating distress sales through pre-committed, escrow-secured orders.
          </p>

          <div class="hero-cta-group">
            <Link href="/register" class="btn-hero-primary">
              Register as Farmer 🌾
            </Link>
            <Link href="/register" class="btn-hero-secondary">
              Register as Buyer 🏪
            </Link>
          </div>
        </div>
      </section>

      <!-- Section 2 — The Problem We Solve -->
      <section class="problem-section">
        <div class="section-container">
          <div class="section-header-text">
            <h2 class="section-title">The Problem We Solve</h2>
            <p class="section-subtitle">Addressing post-harvest losses and distress sales in the Daboase → Market Circle tomato corridor.</p>
          </div>

          <div class="problem-cards-grid">
            <!-- Card 1 -->
            <div class="problem-card card-accent-green">
              <div class="problem-icon-wrapper">
                <span class="emoji-icon">🍅</span>
              </div>
              <h3 class="problem-card-title">Produce Lost Every Tuesday</h3>
              <p class="problem-card-body">
                Tomatoes harvested in Daboase must sell on market day or be discarded. With no cold storage, every unsold crate is a loss.
              </p>
            </div>

            <!-- Card 2 -->
            <div class="problem-card card-accent-amber">
              <div class="problem-icon-wrapper">
                <span class="currency-icon">₵</span>
              </div>
              <h3 class="problem-card-title">The Distress Sale Trap</h3>
              <p class="problem-card-body">
                Without pre-committed buyers, farmers slash prices at day's end. Market women wait specifically for this — exploiting the time pressure farmers face.
              </p>
            </div>

            <!-- Card 3 -->
            <div class="problem-card card-accent-teal">
              <div class="problem-icon-wrapper">
                <span class="emoji-icon">🛺</span>
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
            <p class="section-subtitle">A transparent digital corridor connecting farm gate to retail market.</p>
          </div>

          <div class="chain-diagram-flex">
            <!-- Step 1 -->
            <div class="chain-step-card">
              <div class="chain-step-icon-bg">🌾</div>
              <span class="chain-step-number">Step 1</span>
              <h4 class="chain-step-title">Farm — Daboase/Beposo</h4>
              <p class="chain-step-desc">
                Farmer harvests tomatoes and lists them on FarmLink with harvest date and quality grade.
              </p>
            </div>

            <!-- Arrow 1 -->
            <div class="chain-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-desktop"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-mobile"><path d="M12 5v14"/><path d="m5 12 7 7 7-7"/></svg>
            </div>

            <!-- Step 2 -->
            <div class="chain-step-card">
              <div class="chain-step-icon-bg">📱</div>
              <span class="chain-step-number">Step 2</span>
              <h4 class="chain-step-title">FarmLink Match</h4>
              <p class="chain-step-desc">
                Market trader browses, commits to a purchase — product price + transport cost locked in escrow.
              </p>
            </div>

            <!-- Arrow 2 -->
            <div class="chain-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-desktop"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-mobile"><path d="M12 5v14"/><path d="m5 12 7 7 7-7"/></svg>
            </div>

            <!-- Step 3 -->
            <div class="chain-step-card">
              <div class="chain-step-icon-bg">🛺</div>
              <span class="chain-step-number">Step 3</span>
              <h4 class="chain-step-title">Aboboyaa Transit</h4>
              <p class="chain-step-desc">
                FarmLink assigns a driver. Pickup confirmed digitally. Farmer hands over produce with accountability.
              </p>
            </div>

            <!-- Arrow 3 -->
            <div class="chain-arrow">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-desktop"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow-mobile"><path d="M12 5v14"/><path d="m5 12 7 7 7-7"/></svg>
            </div>

            <!-- Step 4 -->
            <div class="chain-step-card">
              <div class="chain-step-icon-bg">🏪</div>
              <span class="chain-step-number">Step 4</span>
              <h4 class="chain-step-title">Market Circle</h4>
              <p class="chain-step-desc">
                Market trader receives fresh tomatoes. Farmer paid. Driver paid. No distress sale.
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
                  An aboboyaa driver on the Daboase → Market Circle corridor is matched and notified. Farmer gets paid. Driver gets paid. No waste.
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
                <span class="glass-icon">🌾</span>
                <h3>Farmers</h3>
              </div>
              <p>
                Smallholder tomato farmers in Daboase and Beposo who harvest and need guaranteed buyers before produce spoils.
              </p>
            </div>

            <!-- Stakeholder 2 -->
            <div class="glass-card">
              <div class="glass-card-header">
                <span class="glass-icon">🏪</span>
                <h3>Market Traders</h3>
              </div>
              <p>
                Market women and traders at Takoradi Market Circle who want reliable, pre-arranged supply without traveling to Beposo every Tuesday.
              </p>
            </div>

            <!-- Stakeholder 3 -->
            <div class="glass-card">
              <div class="glass-card-header">
                <span class="glass-icon">🛺</span>
                <h3>Aboboyaa Drivers</h3>
              </div>
              <p>
                Transport operators on the Daboase → Market Circle corridor who want confirmed, pre-paid delivery jobs — not just waiting at the roadside.
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
        <div class="footer-left">
          <span class="footer-brand">FarmLink</span>
          <span class="footer-copy">• Western Region Tomato Corridor Pilot • Team Mythos</span>
        </div>
        <div class="footer-links">
          <Link href="/login" class="footer-link">Log In</Link>
          <Link href="/register" class="footer-link">Register</Link>
        </div>
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
  background-color: rgba(255, 255, 255, 0.92);
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
}

.app-logo {
  display: flex;
  align-items: center;
  gap: var(--space-2);
  color: var(--color-primary);
  text-decoration: none;
}

.logo-icon {
  color: var(--color-primary);
}

.app-logo-text {
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-bold);
  letter-spacing: -0.5px;
}

.header-nav {
  display: flex;
  align-items: center;
  gap: var(--space-4);
}

.help-link {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  text-decoration: none;
  font-weight: var(--font-weight-medium);
  transition: color var(--transition-fast);
}

.help-link:hover {
  color: var(--color-primary);
}

.nav-login-btn {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
  text-decoration: none;
  font-weight: var(--font-weight-semibold);
  padding: var(--space-2) var(--space-4);
  border-radius: var(--radius-md);
  transition: all var(--transition-fast);
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
  padding: var(--space-2) var(--space-5);
  border-radius: var(--radius-md);
  transition: background-color var(--transition-fast);
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
  margin: 0;
  max-width: 600px;
  margin: 0 auto;
}

/* Section 1 — Hero */
.hero-section {
  min-height: calc(100vh - 68px);
  background: linear-gradient(160deg, #1B4332 0%, #2D6A4F 50%, #2A9D8F 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: var(--space-12) var(--space-6);
  text-align: center;
  position: relative;
  overflow: hidden;
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
    transform: translateY(24px);
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
  font-size: 32px;
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
  justify-content: center;
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
  transform: translateY(-2px);
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

.card-accent-green {
  border-top: 4px solid var(--color-primary);
}

.card-accent-amber {
  border-top: 4px solid var(--color-secondary);
}

.card-accent-teal {
  border-top: 4px solid var(--color-tertiary);
}

.problem-icon-wrapper {
  margin-bottom: var(--space-4);
}

.emoji-icon {
  font-size: 32px;
  display: inline-block;
}

.currency-icon {
  font-size: 32px;
  font-weight: 800;
  color: var(--color-secondary-dark);
  display: inline-block;
}

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
  min-height: 200px;
}

.chain-step-icon-bg {
  font-size: 28px;
  margin-bottom: var(--space-2);
}

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

.arrow-desktop {
  display: block;
}

.arrow-mobile {
  display: none;
}

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

.how-card-content {
  flex: 1;
}

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
  background: linear-gradient(160deg, #1B4332 0%, #2D6A4F 50%, #2A9D8F 100%);
  color: var(--color-white);
}

.light-header .text-white {
  color: var(--color-white);
}

.light-header .text-white-sub {
  color: rgba(255, 255, 255, 0.85);
}

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

.glass-icon {
  font-size: 28px;
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

/* Footer */
.welcome-footer {
  background-color: var(--color-neutral-900);
  border-top: 1px solid var(--color-neutral-700);
  padding: var(--space-6) 0;
}

.footer-inner {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 var(--space-6);
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: var(--color-neutral-400);
  font-size: var(--font-size-xs);
}

.footer-left {
  display: flex;
  align-items: center;
  gap: var(--space-2);
}

.footer-brand {
  font-weight: var(--font-weight-bold);
  color: var(--color-white);
}

.footer-links {
  display: flex;
  gap: var(--space-4);
}

.footer-link {
  color: var(--color-neutral-400);
  text-decoration: none;
  transition: color var(--transition-fast);
}

.footer-link:hover {
  color: var(--color-white);
}

/* Media Queries & Responsiveness (320px scale up) */
@media (max-width: 991px) {
  .hero-headline {
    font-size: 38px;
  }
  
  .hero-headline-sub {
    font-size: 24px;
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

  .arrow-desktop {
    display: none;
  }

  .arrow-mobile {
    display: block;
  }

  .chain-step-card {
    width: 100%;
    min-height: auto;
  }

  .cta-strip-inner {
    flex-direction: column;
    text-align: center;
  }
}

@media (max-width: 600px) {
  .hero-headline {
    font-size: 30px;
  }

  .hero-headline-sub {
    font-size: 20px;
  }

  .hero-subheadline {
    font-size: var(--font-size-base);
  }

  .hero-cta-group {
    flex-direction: column;
    width: 100%;
  }

  .btn-hero-primary,
  .btn-hero-secondary {
    width: 100%;
  }

  .how-card {
    flex-direction: column;
    align-items: flex-start;
    padding: var(--space-5);
    gap: var(--space-2);
  }

  .how-number {
    font-size: 28px;
  }

  .footer-inner {
    flex-direction: column;
    gap: var(--space-3);
    text-align: center;
  }
}
</style>
