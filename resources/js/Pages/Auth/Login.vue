<template>
  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="header-area">
        <Link href="/" class="logo-link">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#2E7D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
          </svg>
          <span class="logo-text">FarmLink</span>
        </Link>
        <h1 class="title">Welcome Back</h1>
        <p class="subtitle">Log in to manage your listings and orders</p>
      </div>

      <form @submit.prevent="submit" class="form-container">
        <!-- Phone Number -->
        <div class="form-group">
          <label for="phone_number" class="form-label">Phone Number</label>
          <input
            id="phone_number"
            v-model="form.phone_number"
            type="tel"
            class="form-input"
            placeholder="e.g. 054XXXXXXX"
            :class="{ 'input-error': form.errors.phone_number }"
            required
            autofocus
          />
          <span v-if="form.errors.phone_number" class="error-message">{{ form.errors.phone_number }}</span>
        </div>

        <!-- Password -->
        <div class="form-group">
          <label for="password" class="form-label">Password</label>
          <input
            id="password"
            v-model="form.password"
            type="password"
            class="form-input"
            placeholder="Enter your password"
            :class="{ 'input-error': form.errors.password }"
            required
          />
          <span v-if="form.errors.password" class="error-message">{{ form.errors.password }}</span>
        </div>

        <!-- Remember Me -->
        <div class="remember-group">
          <input
            id="remember"
            v-model="form.remember"
            type="checkbox"
            class="form-checkbox"
          />
          <label for="remember" class="remember-label">Remember me</label>
        </div>

        <!-- Submit -->
        <button
          type="submit"
          class="submit-button"
          :disabled="form.processing"
        >
          {{ form.processing ? 'Logging in...' : 'Log In' }}
        </button>
      </form>

      <div class="footer-link">
        Don't have an account? 
        <Link href="/register" class="link-btn">Create Account</Link>
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
.auth-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 16px;
  background-color: #F7F8F5;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  color: #1A1A1A;
}

.auth-card {
  width: 100%;
  max-width: 400px;
  background-color: #FFFFFF;
  border: 1px solid #E0E0DA;
  border-radius: 12px;
  padding: 24px 20px;
  box-shadow: 0 1px 2px rgba(0,0,0,0.06);
}

.header-area {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  margin-bottom: 24px;
}

.logo-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
  margin-bottom: 12px;
}

.logo-text {
  font-size: 20px;
  font-weight: 500;
  color: #1B5E20;
}

.title {
  font-size: 24px;
  font-weight: 500;
  color: #1B5E20;
  margin: 0;
  margin-bottom: 4px;
}

.subtitle {
  font-size: 14px;
  font-weight: 400;
  color: #6B6B63;
  margin: 0;
}

.form-container {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.form-label {
  font-size: 14px;
  font-weight: 500;
  color: #1A1A1A;
}

.form-input {
  height: 44px;
  padding: 0 12px;
  font-size: 15px;
  border: 1px solid #E0E0DA;
  border-radius: 8px;
  background-color: #FFFFFF;
  color: #1A1A1A;
  transition: border-color 0.2s ease;
}

.form-input:focus {
  outline: none;
  border-color: #2E7D32;
}

.input-error {
  border-color: #C62828;
}

.error-message {
  font-size: 13px;
  color: #C62828;
}

.remember-group {
  display: flex;
  align-items: center;
  gap: 8px;
}

.form-checkbox {
  width: 16px;
  height: 16px;
  border: 1px solid #E0E0DA;
  border-radius: 4px;
  accent-color: #2E7D32;
  cursor: pointer;
}

.remember-label {
  font-size: 14px;
  color: #6B6B63;
  cursor: pointer;
}

.submit-button {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 44px;
  font-size: 16px;
  font-weight: 500;
  color: #FFFFFF;
  background-color: #2E7D32;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.2s ease;
  margin-top: 8px;
}

.submit-button:hover:not(:disabled) {
  background-color: #1B5E20;
}

.submit-button:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.footer-link {
  text-align: center;
  font-size: 14px;
  color: #6B6B63;
  margin-top: 20px;
}

.link-btn {
  color: #2E7D32;
  text-decoration: none;
  font-weight: 500;
  margin-left: 4px;
}

.link-btn:hover {
  color: #1B5E20;
}
</style>
