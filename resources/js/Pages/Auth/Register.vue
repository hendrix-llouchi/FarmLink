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
        <h1 class="title">Create Account</h1>
        <p class="subtitle">Join the Western Region direct agri-marketplace</p>
      </div>

      <form @submit.prevent="submit" class="form-container">
        <!-- Full Name -->
        <div class="form-group">
          <label for="name" class="form-label">Full Name</label>
          <input
            id="name"
            v-model="form.name"
            type="text"
            class="form-input"
            placeholder="e.g. Kojo Mensah"
            :class="{ 'input-error': form.errors.name }"
            required
          />
          <span v-if="form.errors.name" class="error-message">{{ form.errors.name }}</span>
        </div>

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
          />
          <span v-if="form.errors.phone_number" class="error-message">{{ form.errors.phone_number }}</span>
        </div>

        <!-- Role Selector (Cards) -->
        <div class="form-group">
          <label class="form-label">Select Your Role</label>
          <div class="role-cards-grid">
            <!-- Farmer -->
            <button
              type="button"
              class="role-card"
              :class="{ 'selected': form.role === 'farmer' }"
              @click="form.role = 'farmer'"
            >
              <div class="role-icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/>
                  <path d="M7 10a5 5 0 0 1 10 0"/>
                  <path d="M12 5v5"/>
                  <path d="M10 15h4"/>
                </svg>
              </div>
              <div class="role-info">
                <span class="role-title">Farmer</span>
                <span class="role-desc">Sell your fresh vegetables directly</span>
              </div>
            </button>

            <!-- Buyer -->
            <button
              type="button"
              class="role-card"
              :class="{ 'selected': form.role === 'buyer' }"
              @click="form.role = 'buyer'"
            >
              <div class="role-icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="9" cy="21" r="1"/>
                  <circle cx="20" cy="21" r="1"/>
                  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                </svg>
              </div>
              <div class="role-info">
                <span class="role-title">Buyer</span>
                <span class="role-desc">Source fresh produce locally</span>
              </div>
            </button>

            <!-- Driver -->
            <button
              type="button"
              class="role-card"
              :class="{ 'selected': form.role === 'driver' }"
              @click="form.role = 'driver'"
            >
              <div class="role-icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="1" y="3" width="15" height="13" rx="2" ry="2"/>
                  <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                  <circle cx="5.5" cy="18.5" r="2.5"/>
                  <circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
              </div>
              <div class="role-info">
                <span class="role-title">Transport Provider</span>
                <span class="role-desc">Deliver produce & earn money</span>
              </div>
            </button>
          </div>
          <span v-if="form.errors.role" class="error-message">{{ form.errors.role }}</span>
        </div>

        <!-- Location -->
        <div class="form-group">
          <label for="location" class="form-label">Primary Market Location</label>
          <input
            id="location"
            v-model="form.location"
            type="text"
            class="form-input"
            placeholder="e.g. Takoradi Market Circle or Tarkwa Station"
            :class="{ 'input-error': form.errors.location }"
            required
          />
          <span v-if="form.errors.location" class="error-message">{{ form.errors.location }}</span>
        </div>

        <!-- Password -->
        <div class="form-group">
          <label for="password" class="form-label">Password</label>
          <input
            id="password"
            v-model="form.password"
            type="password"
            class="form-input"
            placeholder="Min. 6 characters"
            :class="{ 'input-error': form.errors.password }"
            required
          />
          <span v-if="form.errors.password" class="error-message">{{ form.errors.password }}</span>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
          <label for="password_confirmation" class="form-label">Confirm Password</label>
          <input
            id="password_confirmation"
            v-model="form.password_confirmation"
            type="password"
            class="form-input"
            placeholder="Repeat password"
            required
          />
        </div>

        <!-- Submit -->
        <button
          type="submit"
          class="submit-button"
          :disabled="form.processing"
        >
          {{ form.processing ? 'Registering...' : 'Register' }}
        </button>
      </form>

      <div class="footer-link">
        Already have an account? 
        <Link href="/login" class="link-btn">Log In</Link>
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

.role-cards-grid {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.role-card {
  display: flex;
  align-items: center;
  gap: 12px;
  width: 100%;
  padding: 12px;
  text-align: left;
  background-color: #FFFFFF;
  border: 1px solid #E0E0DA;
  border-radius: 12px;
  cursor: pointer;
  transition: all 0.2s ease;
  color: #6B6B63;
}

.role-card:hover {
  border-color: #2E7D32;
  color: #2E7D32;
}

.role-card.selected {
  border-color: #2E7D32;
  background-color: #F1F8E9;
  color: #1B5E20;
}

.role-icon-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: 8px;
  background-color: #F7F8F5;
  flex-shrink: 0;
}

.role-card.selected .role-icon-wrapper {
  background-color: #E8F5E9;
}

.role-info {
  display: flex;
  flex-direction: column;
}

.role-title {
  font-size: 15px;
  font-weight: 500;
}

.role-desc {
  font-size: 12px;
  font-weight: 400;
  opacity: 0.8;
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
