<template>
  <div class="rp-root">
    <div class="bg-blob bg-blob-1" />
    <div class="bg-blob bg-blob-2" />

    <div class="rp-card">

      <!-- Back link -->
      <Link href="/forgot-password" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>
        </svg>
        Back
      </Link>

      <!-- Icon -->
      <div class="icon-wrap">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
        </svg>
      </div>

      <!-- Header -->
      <div class="rp-header">
        <h1 class="rp-title">Reset Password</h1>
        <p class="rp-subtitle">Enter the 6-digit code you received and choose a new password.</p>
      </div>

      <form @submit.prevent="submit" class="rp-form" novalidate>

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

        <!-- Reset Code -->
        <div class="field-group">
          <label for="token" class="field-label">6-Digit Reset Code</label>
          <div class="input-wrapper" :class="{ 'has-error': form.errors.token }">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
              <circle cx="12" cy="16" r="1" fill="currentColor"/>
            </svg>
            <input
              id="token"
              v-model="form.token"
              type="text"
              inputmode="numeric"
              maxlength="6"
              class="field-input token-input"
              placeholder="000000"
              :class="{ 'input-error': form.errors.token }"
              required
            />
          </div>
          <span v-if="form.errors.token" class="error-text">{{ form.errors.token }}</span>
        </div>

        <!-- New Password -->
        <div class="field-group">
          <label for="password" class="field-label">New Password</label>
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
          <label for="password_confirmation" class="field-label">Confirm New Password</label>
          <div class="input-wrapper">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
            <input
              id="password_confirmation"
              v-model="form.password_confirmation"
              type="password"
              class="field-input"
              placeholder="Repeat new password"
              required
            />
          </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-primary" :disabled="form.processing">
          <svg v-if="form.processing" class="spinner-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
          </svg>
          {{ form.processing ? 'Resetting...' : 'Reset Password' }}
        </button>

      </form>

      <p class="footer-cta">
        Remember your password?
        <Link href="/login" class="cta-link">Log In</Link>
      </p>

      <Link href="/" class="brand">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
        </svg>
        <span>FarmLink</span>
      </Link>

    </div>
  </div>
</template>

<script>
import { useForm, Link } from '@inertiajs/vue3';

export default {
  name: 'ResetPassword',
  components: { Link },
  props: {
    phone: {
      type: String,
      default: '',
    },
  },
  setup(props) {
    const form = useForm({
      phone_number:          props.phone,
      token:                 '',
      password:              '',
      password_confirmation: '',
    });

    const submit = () => {
      form.post('/reset-password', {
        onFinish: () => form.reset('password', 'password_confirmation'),
      });
    };

    return { form, submit };
  }
}
</script>

<style scoped>
.rp-root {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: var(--space-6) var(--space-4);
  background-color: var(--color-bg-page);
  font-family: var(--font-family);
  position: relative;
  overflow: hidden;
}

.bg-blob {
  position: absolute;
  border-radius: var(--radius-full);
  filter: blur(80px);
  opacity: 0.10;
  pointer-events: none;
}

.bg-blob-1 {
  width: 500px; height: 500px;
  background: var(--color-tertiary);
  top: -180px; left: -150px;
}

.bg-blob-2 {
  width: 400px; height: 400px;
  background: var(--color-primary);
  bottom: -150px; right: -120px;
}

.rp-card {
  position: relative;
  z-index: 1;
  width: 100%;
  max-width: 420px;
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-xl);
  padding: var(--space-8);
  box-shadow: var(--shadow-md);
  display: flex;
  flex-direction: column;
  gap: var(--space-5);
}

.back-link {
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  color: var(--color-neutral-500);
  text-decoration: none;
  transition: color var(--transition-fast);
  width: fit-content;
  margin-bottom: calc(-1 * var(--space-2));
}
.back-link:hover { color: var(--color-primary); }

.icon-wrap {
  width: 60px; height: 60px;
  border-radius: var(--radius-lg);
  background: linear-gradient(135deg, var(--color-tertiary-subtle), var(--color-tertiary-light));
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-tertiary);
  margin-bottom: calc(-1 * var(--space-2));
}

.rp-header { display: flex; flex-direction: column; gap: var(--space-2); }

.rp-title {
  font-size: var(--font-size-2xl);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0;
}

.rp-subtitle {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  line-height: var(--line-height-relaxed);
  margin: 0;
}

.rp-form { display: flex; flex-direction: column; gap: var(--space-4); }

.field-group { display: flex; flex-direction: column; gap: var(--space-2); }

.field-label {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  color: var(--color-neutral-900);
}

.input-wrapper { position: relative; display: flex; align-items: center; }

.input-icon {
  position: absolute;
  left: var(--space-3);
  color: var(--color-neutral-400);
  pointer-events: none;
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
.field-input.input-error { border-color: var(--color-danger); }

/* Token input: bigger, monospace feel */
.token-input {
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-bold);
  letter-spacing: 0.25em;
  text-align: center;
  padding-left: var(--space-4);
}

.error-text { font-size: var(--font-size-xs); color: var(--color-danger); }

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
.btn-primary:active:not(:disabled) { transform: translateY(0); box-shadow: none; }
.btn-primary:disabled { opacity: 0.65; cursor: not-allowed; }

.spinner-icon { animation: spin 0.8s linear infinite; }
@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

.footer-cta {
  text-align: center;
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
}

.cta-link {
  font-weight: var(--font-weight-semibold);
  color: var(--color-primary);
  text-decoration: none;
  margin-left: var(--space-1);
  transition: color var(--transition-fast);
}
.cta-link:hover { color: var(--color-primary-hover); }

.brand {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
  color: var(--color-neutral-400);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-semibold);
  text-decoration: none;
  padding-top: var(--space-2);
  border-top: 1px solid var(--color-border);
  margin-top: var(--space-2);
  transition: color var(--transition-fast);
}
.brand:hover { color: var(--color-primary); }
</style>
