<template>
  <div class="register-root">

    <!-- ── Left Panel: Hero ───────────────────────────────── -->
    <div class="hero-panel">
      <div class="hero-overlay" />
      <div class="hero-content">
        <div class="hero-logo">
          <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
          </svg>
          <span>FarmLink</span>
        </div>

        <div class="hero-body">
          <div class="hero-badge">Join the Community</div>
          <h2 class="hero-headline">Empowering Ghanaian Agriculture Through Direct Connections</h2>
          <p class="hero-sub">Connect with local farmers, source fresh produce, and help move Ghana's food forward — all in one place.</p>

          <div class="role-previews">
            <div class="role-preview-item">
              <div class="role-preview-icon role-preview-farmer">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M2 22c1.25-.987 2.27-1.975 3.9-2.975a9 9 0 0 1 9.2 0C16.73 20.025 17.75 21.013 19 22"/>
                  <path d="M12 2C8 2 6 6 6 10c0 4 6 10 6 10s6-6 6-10c0-4-2-8-6-8z"/>
                </svg>
              </div>
              <div>
                <p class="role-preview-title">Farmers</p>
                <p class="role-preview-sub">List & sell your produce</p>
              </div>
            </div>
            <div class="role-preview-item">
              <div class="role-preview-icon role-preview-buyer">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                </svg>
              </div>
              <div>
                <p class="role-preview-title">Buyers</p>
                <p class="role-preview-sub">Source produce directly</p>
              </div>
            </div>
            <div class="role-preview-item">
              <div class="role-preview-icon role-preview-transport">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="1" y="3" width="15" height="13" rx="2" ry="2"/>
                  <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                  <circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
              </div>
              <div>
                <p class="role-preview-title">Transporters</p>
                <p class="role-preview-sub">Deliver & earn income</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ── Right Panel: Form ──────────────────────────────── -->
    <div class="form-panel">
      <div class="form-inner">

        <!-- Mobile logo -->
        <Link href="/" class="mobile-logo">
          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
          </svg>
          <span>FarmLink</span>
        </Link>

        <div class="form-header">
          <h1 class="form-title">Create Account</h1>
          <p class="form-subtitle">Join the Western Region direct agri-marketplace</p>
        </div>

        <form @submit.prevent="submit" class="auth-form" novalidate>

          <!-- ── Section: Basic Info ── -->
          <div class="form-section">
            <p class="section-label">Basic Information</p>

            <!-- Full Name -->
            <div class="field-group">
              <label for="name" class="field-label">Full Name</label>
              <div class="input-wrapper" :class="{ 'has-error': form.errors.name }">
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                  <circle cx="12" cy="7" r="4"/>
                </svg>
                <input
                  id="name"
                  v-model="form.name"
                  type="text"
                  class="field-input"
                  placeholder="e.g. Kojo Mensah"
                  :class="{ 'input-error': form.errors.name }"
                  required
                />
              </div>
              <span v-if="form.errors.name" class="error-text">{{ form.errors.name }}</span>
            </div>

            <!-- Phone Number -->
            <div class="field-group">
              <label for="phone_number" class="field-label">Phone Number</label>
              <div class="input-wrapper" :class="{ 'has-error': form.errors.phone_number }">
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.69a16 16 0 0 0 6 6l1.88-1.88a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                <input
                  id="phone_number"
                  v-model="form.phone_number"
                  type="tel"
                  class="field-input"
                  placeholder="e.g. 054 XXX XXXX"
                  :class="{ 'input-error': form.errors.phone_number }"
                  required
                />
              </div>
              <span v-if="form.errors.phone_number" class="error-text">{{ form.errors.phone_number }}</span>
            </div>
          </div>

          <!-- ── Section: Role ── -->
          <div class="form-section">
            <p class="section-label">Select Your Role</p>
            <div class="role-grid">

              <!-- Farmer -->
              <button
                type="button"
                class="role-card"
                :class="{ 'role-farmer': form.role === 'farmer' }"
                @click="form.role = 'farmer'"
              >
                <div class="role-icon-box" :class="{ 'role-icon-farmer': form.role === 'farmer' }">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/>
                    <path d="M7 10a5 5 0 0 1 10 0"/><path d="M12 5v5"/><path d="M10 15h4"/>
                  </svg>
                </div>
                <div class="role-text">
                  <span class="role-name">Farmer</span>
                  <span class="role-desc">Sell your fresh produce directly</span>
                </div>
                <div v-if="form.role === 'farmer'" class="role-check">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                  </svg>
                </div>
              </button>

              <!-- Buyer -->
              <button
                type="button"
                class="role-card"
                :class="{ 'role-buyer': form.role === 'buyer' }"
                @click="form.role = 'buyer'"
              >
                <div class="role-icon-box" :class="{ 'role-icon-buyer': form.role === 'buyer' }">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                  </svg>
                </div>
                <div class="role-text">
                  <span class="role-name">Buyer</span>
                  <span class="role-desc">Source fresh produce locally</span>
                </div>
                <div v-if="form.role === 'buyer'" class="role-check role-check-buyer">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                  </svg>
                </div>
              </button>

              <!-- Transport Provider -->
              <button
                type="button"
                class="role-card"
                :class="{ 'role-driver': form.role === 'driver' }"
                @click="form.role = 'driver'"
              >
                <div class="role-icon-box" :class="{ 'role-icon-driver': form.role === 'driver' }">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="3" width="15" height="13" rx="2" ry="2"/>
                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                    <circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
                  </svg>
                </div>
                <div class="role-text">
                  <span class="role-name">Transport Provider</span>
                  <span class="role-desc">Deliver produce &amp; earn money</span>
                </div>
                <div v-if="form.role === 'driver'" class="role-check role-check-driver">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                  </svg>
                </div>
              </button>

            </div>
            <span v-if="form.errors.role" class="error-text">{{ form.errors.role }}</span>
          </div>

          <!-- ── Section: Location & Password ── -->
          <div class="form-section">
            <p class="section-label">Location & Security</p>

            <!-- Location -->
            <div class="field-group">
              <label for="location" class="field-label">Primary Market Location</label>
              <div class="input-wrapper" :class="{ 'has-error': form.errors.location }">
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/>
                  <circle cx="12" cy="10" r="3"/>
                </svg>
                <input
                  id="location"
                  v-model="form.location"
                  type="text"
                  class="field-input"
                  placeholder="e.g. Takoradi Market Circle or Tarkwa Station"
                  :class="{ 'input-error': form.errors.location }"
                  required
                />
              </div>
              <span v-if="form.errors.location" class="error-text">{{ form.errors.location }}</span>
            </div>

            <!-- Password -->
            <div class="field-group">
              <label for="password" class="field-label">Password</label>
              <div class="input-wrapper" :class="{ 'has-error': form.errors.password }">
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                  <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                  <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                <input
                  id="password"
                  v-model="form.password"
                  type="password"
                  class="field-input"
                  placeholder="Min. 6 characters"
                  :class="{ 'input-error': form.errors.password }"
                  required
                />
              </div>
              <span v-if="form.errors.password" class="error-text">{{ form.errors.password }}</span>
            </div>

            <!-- Confirm Password -->
            <div class="field-group">
              <label for="password_confirmation" class="field-label">Confirm Password</label>
              <div class="input-wrapper">
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
                <input
                  id="password_confirmation"
                  v-model="form.password_confirmation"
                  type="password"
                  class="field-input"
                  placeholder="Repeat your password"
                  required
                />
              </div>
            </div>
          </div>

          <!-- Submit -->
          <button
            type="submit"
            class="btn-primary"
            :disabled="form.processing"
          >
            <svg v-if="form.processing" class="spinner-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
            </svg>
            {{ form.processing ? 'Creating Account...' : 'Create Account' }}
          </button>

        </form>

        <p class="login-cta">
          Already have an account?
          <Link href="/login" class="cta-link">Log In</Link>
        </p>

      </div>
    </div>

  </div>
</template>

<script>
import { useForm, Link } from '@inertiajs/vue3';

export default {
  name: 'Register',
  components: {
    Link
  },
  setup() {
    const form = useForm({
      name: '',
      phone_number: '',
      role: 'farmer', // default to farmer
      location: '',
      password: '',
      password_confirmation: '',
    });

    const submit = () => {
      form.post('/register', {
        onFinish: () => form.reset('password', 'password_confirmation'),
      });
    };

    return {
      form,
      submit
    };
  }
}
</script>

<style scoped>
/* ── Root Layout ─────────────────────────────────────────── */
.register-root {
  display: flex;
  min-height: 100vh;
  background-color: var(--color-bg-page);
  font-family: var(--font-family);
}

/* ── Hero Panel ──────────────────────────────────────────── */
.hero-panel {
  display: none;
  position: relative;
  flex: 1;
  background-image: url('/images/auth/farmland-hero.jpg');
  background-size: cover;
  background-position: center top;
  overflow: hidden;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    150deg,
    rgba(27, 67, 50, 0.88) 0%,
    rgba(45, 106, 79, 0.75) 45%,
    rgba(244, 162, 97, 0.35) 100%
  );
}

.hero-content {
  position: relative;
  z-index: 1;
  display: flex;
  flex-direction: column;
  height: 100%;
  padding: var(--space-8) var(--space-10);
  color: var(--color-white);
}

.hero-logo {
  display: flex;
  align-items: center;
  gap: var(--space-2);
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-bold);
  color: var(--color-white);
  margin-bottom: auto;
}

.hero-body {
  padding-bottom: var(--space-10);
}

.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
  background: rgba(244, 162, 97, 0.25);
  border: 1px solid rgba(244, 162, 97, 0.45);
  color: var(--color-secondary);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  letter-spacing: 0.06em;
  text-transform: uppercase;
  border-radius: var(--radius-pill);
  padding: 4px var(--space-3);
  margin-bottom: var(--space-4);
}

.hero-headline {
  font-size: var(--font-size-2xl);
  font-weight: var(--font-weight-bold);
  line-height: var(--line-height-tight);
  color: var(--color-white);
  max-width: 360px;
  margin-bottom: var(--space-3);
}

.hero-sub {
  font-size: var(--font-size-base);
  color: rgba(255,255,255,0.78);
  line-height: var(--line-height-relaxed);
  max-width: 340px;
  margin-bottom: var(--space-8);
}

/* Role previews */
.role-previews {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

.role-preview-item {
  display: flex;
  align-items: center;
  gap: var(--space-3);
}

.role-preview-icon {
  width: 38px;
  height: 38px;
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.role-preview-farmer { background: rgba(82, 183, 136, 0.25); color: var(--color-primary-light); }
.role-preview-buyer  { background: rgba(244, 162, 97, 0.25); color: var(--color-secondary); }
.role-preview-transport { background: rgba(42, 157, 143, 0.25); color: var(--color-tertiary-light); }

.role-preview-title {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-semibold);
  color: var(--color-white);
  margin: 0;
  display: block;
}

.role-preview-sub {
  font-size: var(--font-size-xs);
  color: rgba(255,255,255,0.65);
  margin: 0;
  display: block;
}

/* ── Form Panel ──────────────────────────────────────────── */
.form-panel {
  width: 100%;
  display: flex;
  align-items: flex-start;
  justify-content: center;
  padding: var(--space-8) var(--space-4);
  background-color: var(--color-white);
  overflow-y: auto;
}

.form-inner {
  width: 100%;
  max-width: 440px;
  padding: var(--space-2) 0 var(--space-8);
}

/* Mobile logo */
.mobile-logo {
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
  color: var(--color-primary);
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  text-decoration: none;
  margin-bottom: var(--space-6);
}

/* Form header */
.form-header {
  margin-bottom: var(--space-6);
}

.form-title {
  font-size: var(--font-size-2xl);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin-bottom: var(--space-1);
}

.form-subtitle {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
}

/* Form sections */
.auth-form {
  display: flex;
  flex-direction: column;
  gap: var(--space-6);
}

.form-section {
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
}

.section-label {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  text-transform: uppercase;
  letter-spacing: 0.07em;
  color: var(--color-neutral-400);
  margin: 0;
  padding-bottom: var(--space-1);
  border-bottom: 1px solid var(--color-border);
}

/* Fields */
.field-group {
  display: flex;
  flex-direction: column;
  gap: var(--space-2);
}

.field-label {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  color: var(--color-neutral-900);
}

.input-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.input-icon {
  position: absolute;
  left: var(--space-3);
  color: var(--color-neutral-400);
  pointer-events: none;
  flex-shrink: 0;
}

.field-input {
  width: 100%;
  height: var(--input-height);
  padding: 0 var(--space-4) 0 calc(var(--space-3) + 18px + var(--space-2));
  font-size: var(--font-size-base);
  font-family: var(--font-family);
  color: var(--color-neutral-900);
  background-color: var(--color-neutral-50);
  border: 1.5px solid var(--color-border-input);
  border-radius: var(--radius-md);
  transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
}

.field-input::placeholder { color: var(--color-neutral-400); }

.field-input:focus {
  border-color: var(--color-primary);
  box-shadow: 0 0 0 3px var(--color-primary-subtle);
  background-color: var(--color-white);
}

.has-error .field-input,
.field-input.input-error {
  border-color: var(--color-danger);
}

.has-error .field-input:focus {
  box-shadow: 0 0 0 3px var(--color-danger-light);
}

.error-text {
  font-size: var(--font-size-xs);
  color: var(--color-danger);
}

/* ── Role Cards ──────────────────────────────────────────── */
.role-grid {
  display: flex;
  flex-direction: column;
  gap: var(--space-2);
}

.role-card {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  width: 100%;
  padding: var(--space-3) var(--space-4);
  text-align: left;
  background-color: var(--color-white);
  border: 1.5px solid var(--color-border-input);
  border-radius: var(--radius-lg);
  cursor: pointer;
  transition: all var(--transition-fast);
  color: var(--color-neutral-700);
}

.role-card:hover {
  border-color: var(--color-neutral-400);
  box-shadow: var(--shadow-xs);
}

/* Farmer selected */
.role-card.role-farmer {
  border-color: var(--color-primary);
  background-color: var(--color-primary-subtle);
  color: var(--color-primary-hover);
}

/* Buyer selected */
.role-card.role-buyer {
  border-color: var(--color-secondary);
  background-color: var(--color-secondary-light);
  color: var(--color-secondary-dark);
}

/* Driver selected */
.role-card.role-driver {
  border-color: var(--color-tertiary);
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary-hover);
}

.role-icon-box {
  width: 42px;
  height: 42px;
  border-radius: var(--radius-md);
  background-color: var(--color-neutral-100);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  transition: background-color var(--transition-fast);
}

.role-icon-farmer { background-color: var(--color-primary-lighter); color: var(--color-primary); }
.role-icon-buyer  { background-color: var(--color-secondary-light);  color: var(--color-secondary-dark); }
.role-icon-driver { background-color: var(--color-tertiary-subtle);  color: var(--color-tertiary); }

.role-text {
  display: flex;
  flex-direction: column;
  gap: 2px;
  flex: 1;
}

.role-name {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-semibold);
}

.role-desc {
  font-size: var(--font-size-xs);
  opacity: 0.75;
}

.role-check {
  width: 22px;
  height: 22px;
  border-radius: var(--radius-full);
  background-color: var(--color-primary);
  color: var(--color-white);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.role-check-buyer  { background-color: var(--color-secondary); }
.role-check-driver { background-color: var(--color-tertiary); }

/* ── Submit Button ───────────────────────────────────────── */
.btn-primary {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
  width: 100%;
  height: var(--input-height);
  font-family: var(--font-family);
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-semibold);
  color: var(--color-white);
  background-color: var(--color-primary);
  border: none;
  border-radius: var(--radius-md);
  cursor: pointer;
  transition: background-color var(--transition-fast), transform var(--transition-fast), box-shadow var(--transition-fast);
  margin-top: var(--space-2);
}

.btn-primary:hover:not(:disabled) {
  background-color: var(--color-primary-hover);
  box-shadow: var(--shadow-sm);
  transform: translateY(-1px);
}

.btn-primary:active:not(:disabled) {
  transform: translateY(0);
  box-shadow: none;
}

.btn-primary:disabled {
  opacity: 0.65;
  cursor: not-allowed;
}

.spinner-icon {
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  from { transform: rotate(0deg); }
  to   { transform: rotate(360deg); }
}

/* Login CTA */
.login-cta {
  text-align: center;
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  margin-top: var(--space-6);
}

.cta-link {
  font-weight: var(--font-weight-semibold);
  color: var(--color-primary);
  text-decoration: none;
  margin-left: var(--space-1);
  transition: color var(--transition-fast);
}
.cta-link:hover { color: var(--color-primary-hover); }

/* ── Responsive ──────────────────────────────────────────── */
@media (min-width: 768px) {
  .hero-panel { display: flex; }

  .form-panel {
    width: 500px;
    flex-shrink: 0;
    padding: var(--space-8) var(--space-10);
    align-items: center;
  }

  .mobile-logo { display: none; }
}

@media (min-width: 1024px) {
  .form-panel {
    width: 540px;
    padding: var(--space-10) var(--space-12);
  }
}
</style>
