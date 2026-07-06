<template>
  <div class="login-root">

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
        <h2 class="hero-headline">Ghana's Agricultural Connection Hub</h2>
        <p class="hero-sub">Connecting Ghanaian farmers with buyers and traders through direct connections and modern trade.</p>
        <div class="hero-stats">
          <div class="stat-item">
            <span class="stat-number">2,100+</span>
            <span class="stat-label">Farmers</span>
          </div>
          <div class="stat-divider" />
          <div class="stat-item">
            <span class="stat-number">850+</span>
            <span class="stat-label">Buyers</span>
          </div>
          <div class="stat-divider" />
          <div class="stat-item">
            <span class="stat-number">12</span>
            <span class="stat-label">Districts</span>
          </div>
        </div>
      </div>
    </div>

    <!-- ── Right Panel: Form ──────────────────────────────── -->
    <div class="form-panel">
      <div class="form-inner">

        <!-- Mobile logo (shown only on small screens) -->
        <Link href="/" class="mobile-logo">
          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
          </svg>
          <span>FarmLink</span>
        </Link>

        <div class="form-header">
          <h1 class="form-title">Welcome Back</h1>
          <p class="form-subtitle">Enter your credentials to access your dashboard</p>
        </div>

        <!-- Status message (e.g. password reset success) -->
        <div v-if="status" class="status-banner">
          {{ status }}
        </div>

        <form @submit.prevent="submit" class="auth-form" novalidate>

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
                autofocus
              />
            </div>
            <span v-if="form.errors.phone_number" class="error-text">{{ form.errors.phone_number }}</span>
          </div>

          <!-- Password -->
          <div class="field-group">
            <div class="label-row">
              <label for="password" class="field-label">Password</label>
              <Link v-if="canResetPassword" href="/forgot-password" class="forgot-link">Forgot password?</Link>
            </div>
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
                placeholder="Enter your password"
                :class="{ 'input-error': form.errors.password }"
                required
              />
            </div>
            <span v-if="form.errors.password" class="error-text">{{ form.errors.password }}</span>
          </div>

          <!-- Remember Me -->
          <div class="remember-row">
            <label class="checkbox-label">
              <input
                id="remember"
                v-model="form.remember"
                type="checkbox"
                class="checkbox-input"
              />
              <span class="checkbox-custom" />
              <span class="checkbox-text">Remember me for 30 days</span>
            </label>
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
            {{ form.processing ? 'Logging in...' : 'Log In' }}
          </button>

        </form>

        <p class="register-cta">
          Don't have an account?
          <Link href="/register" class="cta-link">Create Account</Link>
        </p>

      </div>
    </div>

  </div>
</template>

<script>
import { useForm, Link } from '@inertiajs/vue3';

export default {
  name: 'Login',
  components: {
    Link
  },
  props: {
    canResetPassword: Boolean,
    status: String,
  },
  setup() {
    const form = useForm({
      phone_number: '',
      password: '',
      remember: false,
    });

    const submit = () => {
      form.post('/login', {
        onFinish: () => form.reset('password'),
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
.login-root {
  display: flex;
  min-height: 100vh;
  background-color: var(--color-bg-page);
  font-family: var(--font-family);
}

/* ── Hero Panel ──────────────────────────────────────────── */
.hero-panel {
  display: none; /* hidden on mobile */
  position: relative;
  flex: 1;
  background-image: url('/images/auth/farmland-hero.jpg');
  background-size: cover;
  background-position: center;
  overflow: hidden;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    160deg,
    rgba(27, 67, 50, 0.82) 0%,
    rgba(45, 106, 79, 0.70) 50%,
    rgba(42, 157, 143, 0.45) 100%
  );
}

.hero-content {
  position: relative;
  z-index: 1;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  height: 100%;
  padding: var(--space-12) var(--space-10);
  color: var(--color-white);
}

.hero-logo {
  display: flex;
  align-items: center;
  gap: var(--space-2);
  position: absolute;
  top: var(--space-8);
  left: var(--space-10);
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-bold);
  color: var(--color-white);
}

.hero-headline {
  font-size: var(--font-size-2xl);
  font-weight: var(--font-weight-bold);
  line-height: var(--line-height-tight);
  color: var(--color-white);
  margin-bottom: var(--space-3);
  max-width: 380px;
}

.hero-sub {
  font-size: var(--font-size-base);
  color: rgba(255,255,255,0.80);
  line-height: var(--line-height-relaxed);
  max-width: 360px;
  margin-bottom: var(--space-8);
}

.hero-stats {
  display: flex;
  align-items: center;
  gap: var(--space-5);
  background: rgba(255,255,255,0.12);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,0.20);
  border-radius: var(--radius-lg);
  padding: var(--space-4) var(--space-6);
  width: fit-content;
}

.stat-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 2px;
}

.stat-number {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-white);
}

.stat-label {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-medium);
  color: rgba(255,255,255,0.70);
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.stat-divider {
  width: 1px;
  height: 32px;
  background-color: rgba(255,255,255,0.25);
}

/* ── Form Panel ──────────────────────────────────────────── */
.form-panel {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: var(--space-6) var(--space-4);
  background-color: var(--color-white);
}

.form-inner {
  width: 100%;
  max-width: 420px;
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
  margin-bottom: var(--space-8);
}

/* Form header */
.form-header {
  margin-bottom: var(--space-8);
}

.form-title {
  font-size: var(--font-size-2xl);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin-bottom: var(--space-2);
}

.form-subtitle {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  line-height: var(--line-height-relaxed);
}

/* Status banner */
.status-banner {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary-hover);
  border: 1px solid var(--color-primary-lighter);
  border-radius: var(--radius-md);
  padding: var(--space-3) var(--space-4);
  font-size: var(--font-size-sm);
  margin-bottom: var(--space-5);
}

/* Form */
.auth-form {
  display: flex;
  flex-direction: column;
  gap: var(--space-5);
}

.field-group {
  display: flex;
  flex-direction: column;
  gap: var(--space-2);
}

.label-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.field-label {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  color: var(--color-neutral-900);
}

.forgot-link {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  color: var(--color-primary);
  text-decoration: none;
  transition: color var(--transition-fast);
}
.forgot-link:hover { color: var(--color-primary-hover); }

/* Input with icon */
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

.field-input::placeholder {
  color: var(--color-neutral-400);
}

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

/* Remember me */
.remember-row {
  margin-top: calc(-1 * var(--space-2));
}

.checkbox-label {
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
  cursor: pointer;
}

.checkbox-input {
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

.checkbox-custom {
  width: 18px;
  height: 18px;
  border: 1.5px solid var(--color-border-input);
  border-radius: var(--radius-sm);
  background-color: var(--color-white);
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background-color var(--transition-fast), border-color var(--transition-fast);
}

.checkbox-input:checked + .checkbox-custom {
  background-color: var(--color-primary);
  border-color: var(--color-primary);
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: center;
}

.checkbox-text {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
}

/* Submit button */
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

/* Register CTA */
.register-cta {
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
  .form-panel {
    width: 480px;
    flex-shrink: 0;
    padding: var(--space-10) var(--space-10);
  }

  .mobile-logo {
    display: none;
  }
}

@media (min-width: 768px) {
  .hero-panel {
    display: flex;
  }
}

@media (min-width: 1024px) {
  .form-panel {
    width: 520px;
    padding: var(--space-12) var(--space-12);
  }
}
</style>
