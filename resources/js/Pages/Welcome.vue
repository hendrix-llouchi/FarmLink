<template>
  <div class="welcome-container">
    <main class="welcome-card">
      <div class="logo-area">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#2E7D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="logo-icon">
          <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
        </svg>
        <h1 class="title">FarmLink</h1>
      </div>
      <p class="subtitle">Connecting Western Region smallholders directly to vegetable buyers and transport providers.</p>
      
      <!-- Flash Message -->
      <div v-if="$page.props.flash?.message" class="flash-box">
        <p class="flash-text">{{ $page.props.flash.message }}</p>
      </div>

      <!-- Authenticated State -->
      <div v-if="$page.props.auth?.user" class="auth-state">
        <div class="user-profile">
          <div class="avatar-circle">
            {{ $page.props.auth.user.name.charAt(0).toUpperCase() }}
          </div>
          <h2 class="user-name">{{ $page.props.auth.user.name }}</h2>
          <span class="user-role-badge">{{ formatRole($page.props.auth.user.role) }}</span>
        </div>

        <div class="user-details">
          <div class="detail-item">
            <span class="detail-label">Phone</span>
            <span class="detail-val">{{ $page.props.auth.user.phone_number }}</span>
          </div>
          <div class="detail-item">
            <span class="detail-label">Location</span>
            <span class="detail-val">{{ $page.props.auth.user.location }}</span>
          </div>
          <div class="detail-item">
            <span class="detail-label">Rating</span>
            <span class="detail-val">⭐ {{ Number($page.props.auth.user.average_rating).toFixed(2) }}</span>
          </div>
        </div>

        <Link href="/logout" method="post" as="button" class="logout-btn">
          Log Out
        </Link>
      </div>

      <!-- Guest State -->
      <div v-else class="guest-state">
        <div class="action-buttons">
          <Link href="/login" class="btn-primary">Log In</Link>
          <Link href="/register" class="btn-secondary">Create Account</Link>
        </div>
      </div>


    </main>
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
    formatRole(role) {
      if (!role) return '';
      if (role === 'driver') return 'Transport Provider';
      return role.charAt(0).toUpperCase() + role.slice(1);
    }
  }
}
</script>

<style scoped>
.welcome-container {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 16px;
  background-color: #F7F8F5;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  color: #1A1A1A;
}

.welcome-card {
  width: 100%;
  max-width: 400px;
  background-color: #FFFFFF;
  border: 1px solid #E0E0DA;
  border-radius: 12px;
  padding: 32px 24px;
  text-align: center;
  box-shadow: 0 1px 2px rgba(0,0,0,0.06);
}

.logo-area {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 20px;
}

.logo-icon {
  margin-bottom: 12px;
}

.title {
  font-size: 28px;
  font-weight: 500;
  color: #1B5E20;
  margin: 0;
}

.subtitle {
  font-size: 15px;
  font-weight: 400;
  color: #6B6B63;
  line-height: 1.5;
  margin-top: 0;
  margin-bottom: 24px;
}

.flash-box {
  background-color: #E8F5E9;
  border-radius: 8px;
  padding: 8px 12px;
  margin-bottom: 20px;
}

.flash-text {
  font-size: 14px;
  font-weight: 500;
  color: #2E7D32;
  margin: 0;
}

.guest-state {
  margin-bottom: 28px;
}

.action-buttons {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.btn-primary, .btn-secondary {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 44px;
  font-size: 16px;
  font-weight: 500;
  border-radius: 8px;
  text-decoration: none;
  transition: all 0.2s ease;
}

.btn-primary {
  color: #FFFFFF;
  background-color: #2E7D32;
  border: none;
}

.btn-primary:hover {
  background-color: #1B5E20;
}

.btn-secondary {
  color: #2E7D32;
  background-color: #FFFFFF;
  border: 1px solid #2E7D32;
}

.btn-secondary:hover {
  background-color: #F7F8F5;
  color: #1B5E20;
  border-color: #1B5E20;
}

.auth-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
  margin-bottom: 28px;
  background-color: #F7F8F5;
  border-radius: 12px;
  padding: 20px 16px;
  border: 1px solid #E0E0DA;
}

.user-profile {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
}

.avatar-circle {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background-color: #2E7D32;
  color: #FFFFFF;
  font-size: 24px;
  font-weight: 500;
}

.user-name {
  font-size: 18px;
  font-weight: 500;
  margin: 0;
  color: #1A1A1A;
}

.user-role-badge {
  font-size: 12px;
  font-weight: 500;
  color: #2E7D32;
  background-color: #E8F5E9;
  padding: 4px 8px;
  border-radius: 6px;
}

.user-details {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 8px;
  border-top: 1px solid #E0E0DA;
  padding-top: 12px;
}

.detail-item {
  display: flex;
  justify-content: space-between;
  font-size: 14px;
}

.detail-label {
  color: #6B6B63;
}

.detail-val {
  color: #1A1A1A;
  font-weight: 500;
}

.logout-btn {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 44px;
  font-size: 15px;
  font-weight: 500;
  color: #C62828;
  background-color: #FFFFFF;
  border: 1px solid #C62828;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.2s ease;
}

.logout-btn:hover {
  background-color: #FFEBEE;
}

</style>
