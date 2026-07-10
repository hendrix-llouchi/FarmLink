<template>
  <div class="welcome-container">
    <!-- Full-width Header -->
    <header class="app-header">
      <div class="header-inner">
        <div class="app-logo">
          <svg xmlns="http://www.w3.org/2000/svg" class="logo-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
          </svg>
          <span class="app-logo-text">FarmLink</span>
        </div>
        <nav class="header-nav">
          <a href="#" class="help-link" @click.prevent="triggerAlert('Help Center: FAQs, buyer guidebooks, and driver delivery tips.')">Help</a>
          <Link href="/login" class="nav-login-btn">Log In</Link>
          <Link href="/register" class="nav-register-btn">Register</Link>
        </nav>
      </div>
    </header>

    <!-- Main Content Area -->
    <main class="main-content">
      <!-- Hero Split Section -->
      <section class="hero-section">
        <div class="hero-inner">
          <div class="hero-text-content">
            <h1 class="hero-title">Empowering Ghana's Agriculture from <span class="highlight-text">Soil to Shelf</span>.</h1>
            <p class="hero-subtitle">The localized digital marketplace connecting smallholder farmers, bulk buyers, and reliable transporters in the Western Region.</p>
            <div class="hero-actions">
              <Link href="/register" class="get-started-btn">
                <span>Get Started</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline>
                </svg>
              </Link>
              <Link href="/login" class="secondary-login-btn">Log In</Link>
            </div>
          </div>
          <div class="hero-visual">
            <div class="hero-image-card"></div>
          </div>
        </div>
      </section>

      <!-- Features Grid Section -->
      <section class="features-section">
        <div class="features-inner">
          <div class="features-grid">
            <!-- Direct Trade Feature -->
            <div class="feature-card">
              <div class="feature-circle-icon green-bg">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                  <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
              </div>
              <h4>Direct Trade</h4>
              <p>Cut out middlemen and secure fair market prices directly with local farmers.</p>
            </div>

            <!-- Logistics Feature -->
            <div class="feature-card">
              <div class="feature-circle-icon orange-bg">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="1" y="3" width="15" height="13" />
                  <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                  <circle cx="5.5" cy="18.5" r="2.5" />
                  <circle cx="18.5" cy="18.5" r="2.5" />
                </svg>
              </div>
              <h4>Local Logistics</h4>
              <p>Reliable rural-to-urban transport networks tailored for agricultural goods.</p>
            </div>

            <!-- Trusted Ratings Feature -->
            <div class="feature-card">
              <div class="feature-circle-icon teal-bg">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                  <path d="m9 12 2 2 4-4"/>
                </svg>
              </div>
              <h4>Trusted Ratings</h4>
              <p>Verified profile reviews and scores to ensure security and confidence for both buyers and farmers.</p>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- Full-width Footer -->
    <footer class="welcome-footer">
      <div class="footer-inner">
        <span>Grounded Innovation for the Western Region.</span>
        <div class="footer-icons">
          <a href="#" class="footer-icon-link" @click.prevent="triggerAlert('FarmLink Global Website: Under construction.')">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
            </svg>
          </a>
          <a href="#" class="footer-icon-link" @click.prevent="triggerAlert('FarmLink Farmer Cooperatives network page: Under construction.')">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 2 2 4v4a4 4 0 0 1-4 4h-2a3 3 0 0 0-3 3v3z"/>
              <path d="M9 22v-4H7a2 2 0 0 1-2-2V8"/>
            </svg>
          </a>
          <a href="mailto:info@farmlinkgh.com" class="footer-icon-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
              <polyline points="22,6 12,13 2,6"/>
            </svg>
          </a>
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

/* Outer wrapper canvas */
.welcome-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background-color: var(--color-bg-page);
  font-family: var(--font-family);
}

/* Header bar */
.app-header {
  position: sticky;
  top: 0;
  z-index: 100;
  width: 100%;
  background-color: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(8px);
  border-bottom: 1px solid var(--color-neutral-100);
}

.header-inner {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 var(--space-6);
  height: 70px;
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
  font-weight: var(--font-weight-semibold);
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

/* Main Content Area */
.main-content {
  flex: 1;
}

/* Hero Section */
.hero-section {
  padding: var(--space-12) 0;
  display: flex;
  align-items: center;
}

.hero-inner {
  max-width: 1200px;
  width: 100%;
  margin: 0 auto;
  padding: 0 var(--space-6);
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: var(--space-12);
  align-items: center;
}

@media (max-width: 991px) {
  .hero-inner {
    grid-template-columns: 1fr;
    gap: var(--space-8);
    text-align: center;
  }
}

.hero-text-content {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

@media (max-width: 991px) {
  .hero-text-content {
    align-items: center;
  }
}

.hero-title {
  font-size: 46px;
  font-weight: 800;
  line-height: 1.2;
  color: var(--color-neutral-900);
  margin: 0 0 var(--space-4) 0;
  letter-spacing: -1.5px;
}

.highlight-text {
  color: var(--color-primary);
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 34px;
  }
}

.hero-subtitle {
  font-size: var(--font-size-lg);
  line-height: var(--line-height-relaxed);
  color: var(--color-neutral-500);
  margin: 0 0 var(--space-8) 0;
  max-width: 580px;
}

.hero-actions {
  display: flex;
  gap: var(--space-4);
  width: 100%;
}

@media (max-width: 991px) {
  .hero-actions {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .hero-actions {
    flex-direction: column;
    gap: var(--space-3);
  }
}

.get-started-btn {
  background-color: var(--color-primary);
  color: var(--color-white);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
  padding: 0 var(--space-8);
  height: 52px;
  border-radius: var(--radius-md);
  font-weight: var(--font-weight-bold);
  font-size: var(--font-size-base);
  border: none;
  cursor: pointer;
  text-decoration: none;
  transition: all var(--transition-fast);
  box-shadow: var(--shadow-sm);
}

.get-started-btn:hover {
  background-color: var(--color-primary-hover);
  transform: translateY(-1px);
  box-shadow: var(--shadow-md);
}

.secondary-login-btn {
  background-color: var(--color-white);
  color: var(--color-neutral-700);
  border: 1px solid var(--color-neutral-200);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0 var(--space-8);
  height: 52px;
  border-radius: var(--radius-md);
  font-weight: var(--font-weight-semibold);
  font-size: var(--font-size-base);
  text-decoration: none;
  transition: all var(--transition-fast);
}

.secondary-login-btn:hover {
  background-color: var(--color-neutral-100);
  border-color: var(--color-neutral-300);
  color: var(--color-neutral-900);
}

.hero-visual {
  width: 100%;
  display: flex;
  justify-content: center;
}

.hero-image-card {
  width: 100%;
  max-width: 460px;
  height: 360px;
  border-radius: var(--radius-xl);
  background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.6)), url('/images/welcome_hero_banner.png');
  background-size: cover;
  background-position: center;
  box-shadow: var(--shadow-lg);
  border: 1px solid rgba(255, 255, 255, 0.15);
  transition: transform var(--transition-slow);
}

.hero-image-card:hover {
  transform: scale(1.02);
}

@media (max-width: 991px) {
  .hero-image-card {
    max-width: 500px;
  }
}

@media (max-width: 768px) {
  .hero-image-card {
    height: 280px;
  }
}

/* Features Section */
.features-section {
  background-color: var(--color-white);
  border-top: 1px solid var(--color-neutral-100);
  border-bottom: 1px solid var(--color-neutral-100);
  padding: var(--space-12) 0;
}

.features-inner {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 var(--space-6);
}

.features-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-8);
}

@media (max-width: 991px) {
  .features-grid {
    grid-template-columns: 1fr;
    gap: var(--space-6);
  }
}

.feature-card {
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-neutral-100);
  border-radius: var(--radius-lg);
  padding: var(--space-6);
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  transition: all var(--transition-base);
  box-shadow: var(--shadow-xs);
}

.feature-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-md);
  border-color: var(--color-neutral-200);
}

.feature-circle-icon {
  width: 44px;
  height: 44px;
  border-radius: var(--radius-full);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: var(--space-4);
}

.feature-circle-icon svg {
  width: 20px;
  height: 20px;
}

.feature-card h4 {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0 0 var(--space-2) 0;
}

.feature-card p {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  margin: 0;
  line-height: var(--line-height-relaxed);
}

.green-bg {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary);
}

.orange-bg {
  background-color: var(--color-warning-light);
  color: var(--color-secondary-hover);
}

.teal-bg {
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary);
}

/* Footer Section */
.welcome-footer {
  background-color: var(--color-neutral-50);
  padding: var(--space-8) 0;
}

.footer-inner {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 var(--space-6);
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: var(--color-neutral-500);
  font-size: var(--font-size-sm);
}

@media (max-width: 768px) {
  .footer-inner {
    flex-direction: column;
    gap: var(--space-4);
    text-align: center;
  }
}

.footer-icons {
  display: flex;
  gap: var(--space-6);
}

.footer-icon-link {
  color: var(--color-neutral-500);
  transition: color var(--transition-fast);
}

.footer-icon-link:hover {
  color: var(--color-primary);
}

@media (max-width: 576px) {
  .header-inner {
    padding: 0 var(--space-3);
    height: 60px;
  }
  
  .app-logo-text {
    font-size: var(--font-size-base);
  }
  
  .header-nav {
    gap: var(--space-2);
  }
  
  .help-link,
  .nav-login-btn,
  .nav-register-btn {
    white-space: nowrap;
    font-size: var(--font-size-xs);
  }
  
  .nav-login-btn {
    padding: 6px 10px;
  }
  
  .nav-register-btn {
    padding: 6px 12px;
  }
}
</style>

