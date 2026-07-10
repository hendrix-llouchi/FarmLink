<template>
  <div class="dashboard-container">
    <!-- Desktop & Tablet Sidebar Navigation -->
    <aside class="sidebar-nav">
      <div class="sidebar-brand">
        <svg xmlns="http://www.w3.org/2000/svg" class="logo-icon" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
        </svg>
        <span class="logo-text">FarmLink</span>
      </div>

      <!-- User Profile Summary in Sidebar -->
      <div class="sidebar-user">
        <div class="user-avatar" :class="$page.props.auth?.user?.role">
          {{ $page.props.auth?.user?.name?.charAt(0).toUpperCase() || 'U' }}
        </div>
        <div class="user-info">
          <span class="user-name">{{ $page.props.auth?.user?.name || 'User' }}</span>
          <span class="user-role">{{ formatRole($page.props.auth?.user?.role) }}</span>
        </div>
      </div>

      <nav class="sidebar-menu">
        <Link :href="homeRoute" class="menu-item">
          <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
          </svg>
          <span class="menu-label">Home</span>
        </Link>

        <Link v-if="$page.props.auth?.user?.role === 'buyer'" href="/buyer/orders" class="menu-item">
          <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
          </svg>
          <span class="menu-label">Orders</span>
        </Link>

        <Link v-if="$page.props.auth?.user?.role === 'farmer'" href="/farmer/orders" class="menu-item">
          <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
          </svg>
          <span class="menu-label">Orders</span>
        </Link>

        <Link href="/notifications" class="menu-item">
          <div class="menu-item-badge-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
            <span class="menu-label">Alerts</span>
            <span v-if="$page.props.auth?.unread_notifications_count > 0" class="badge-count-sidebar">
              {{ $page.props.auth.unread_notifications_count }}
            </span>
          </div>
        </Link>

        <Link href="/settings" class="menu-item active">
          <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
          </svg>
          <span class="menu-label">Settings</span>
        </Link>
      </nav>

      <div class="sidebar-footer">
        <Link href="/logout" method="post" as="button" class="logout-btn-sidebar">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
          </svg>
          <span class="logout-label">Log Out</span>
        </Link>
      </div>
    </aside>

    <!-- Mobile Top Header -->
    <header class="mobile-header">
      <div class="header-brand" style="display: flex; align-items: center; gap: var(--space-2);">
        <span class="logo-text">Settings</span>
        <span class="mobile-user-name" style="font-size: var(--font-size-xs); color: var(--color-neutral-500); border-left: 1.5px solid var(--color-border); padding-left: var(--space-2); margin-left: var(--space-1); font-weight: var(--font-weight-medium);">
          {{ $page.props.auth?.user?.name }}
        </span>
      </div>
      <div class="header-actions">
        <Link href="/logout" method="post" as="button" class="icon-action-btn logout-header-btn" title="Log Out">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
          </svg>
        </Link>
      </div>
    </header>

    <!-- Main Content Layout wrapper -->
    <div class="main-layout">
      <main class="content-body">
        <!-- Flash Alert -->
        <div v-if="$page.props.flash?.message" class="flash-alert-wrapper">
          <AppBadge variant="success" size="md" class="flash-badge">
            {{ $page.props.flash.message }}
          </AppBadge>
        </div>

        <div class="settings-grid">
          <!-- Left side: forms -->
          <div class="forms-column">
            <!-- Profile Card -->
            <AppCard class="settings-card">
              <h2 class="section-title">Profile Information</h2>
              <p class="section-subtitle">Update your personal account details and marketplace location.</p>
              
              <form @submit.prevent="submitProfile" class="settings-form">
                <AppInput
                  v-model="profileForm.name"
                  id="profile-name"
                  label="Full Name"
                  required
                  placeholder="Enter your name"
                  :error="profileForm.errors.name"
                />

                <AppInput
                  v-model="profileForm.phone_number"
                  id="profile-phone"
                  label="Phone Number"
                  required
                  placeholder="e.g. 0244111222"
                  :error="profileForm.errors.phone_number"
                />

                <AppInput
                  v-model="profileForm.location"
                  id="profile-location"
                  label="Primary Location (Ghana Western Region)"
                  required
                  placeholder="e.g. Takoradi Market Circle or Tarkwa"
                  :error="profileForm.errors.location"
                />

                <div class="form-actions">
                  <AppButton 
                    type="submit" 
                    variant="primary" 
                    :loading="profileForm.processing"
                  >
                    Save Changes
                  </AppButton>
                </div>
              </form>
            </AppCard>

            <!-- Password Card -->
            <AppCard class="settings-card mt-6">
              <h2 class="section-title">Change Password</h2>
              <p class="section-subtitle">Ensure your account is using a secure, long password.</p>

              <form @submit.prevent="submitPassword" class="settings-form">
                <AppInput
                  v-model="passwordForm.current_password"
                  id="current-password"
                  type="password"
                  label="Current Password"
                  required
                  placeholder="••••••••"
                  :error="passwordForm.errors.current_password"
                />

                <AppInput
                  v-model="passwordForm.password"
                  id="new-password"
                  type="password"
                  label="New Password"
                  required
                  placeholder="••••••••"
                  :error="passwordForm.errors.password"
                />

                <AppInput
                  v-model="passwordForm.password_confirmation"
                  id="confirm-password"
                  type="password"
                  label="Confirm New Password"
                  required
                  placeholder="••••••••"
                  :error="passwordForm.errors.password_confirmation"
                />

                <div class="form-actions">
                  <AppButton 
                    type="submit" 
                    variant="primary" 
                    :loading="passwordForm.processing"
                  >
                    Update Password
                  </AppButton>
                </div>
              </form>
            </AppCard>
          </div>

          <!-- Right side: card summary -->
          <div class="summary-column">
            <AppCard class="profile-summary-card">
              <div class="summary-avatar-section">
                <div class="large-avatar" :class="user.role">
                  {{ user.name?.charAt(0).toUpperCase() }}
                </div>
                <h3 class="summary-name">{{ user.name }}</h3>
                <AppBadge :variant="roleBadgeVariant(user.role)" size="md" class="summary-role-badge">
                  {{ formatRole(user.role) }}
                </AppBadge>
              </div>

              <div class="summary-details">
                <div class="detail-item">
                  <svg xmlns="http://www.w3.org/2000/svg" class="detail-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                  </svg>
                  <span>{{ user.phone_number }}</span>
                </div>
                <div class="detail-item">
                  <svg xmlns="http://www.w3.org/2000/svg" class="detail-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                  </svg>
                  <span>{{ user.location }}</span>
                </div>
              </div>

              <!-- Ratings box if Farmer or Driver -->
              <div v-if="user.role === 'farmer' || user.role === 'driver'" class="rating-display-box">
                <span class="rating-box-title">Average Platform Rating</span>
                <div class="rating-box-score">
                  <span class="score-number">{{ Number(user.average_rating || 0).toFixed(1) }}</span>
                  <div class="score-stars">
                    <svg 
                      v-for="star in 5" 
                      :key="star" 
                      xmlns="http://www.w3.org/2000/svg" 
                      width="18" 
                      height="18" 
                      viewBox="0 0 24 24" 
                      :fill="star <= Math.round(user.average_rating) ? 'var(--color-secondary)' : 'none'" 
                      :stroke="star <= Math.round(user.average_rating) ? 'var(--color-secondary)' : 'var(--color-neutral-400)'" 
                      stroke-width="2" 
                      stroke-linecap="round" 
                      stroke-linejoin="round"
                      class="star-icon"
                    >
                      <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                  </div>
                </div>
                <span class="rating-box-subtitle">Recalculated on completed deliveries.</span>
              </div>
            </AppCard>
          </div>
        </div>
      </main>
    </div>

    <!-- Mobile Bottom Navigation Bar (Stitch design layout) -->
    <nav class="mobile-bottom-nav">
      <Link :href="homeRoute" class="mobile-nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
          <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
        <span class="nav-label">Home</span>
      </Link>

      <Link v-if="$page.props.auth?.user?.role === 'buyer'" href="/buyer/orders" class="mobile-nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
          <line x1="3" y1="6" x2="21" y2="6"/>
          <path d="M16 10a4 4 0 0 1-8 0"/>
        </svg>
        <span class="nav-label">Orders</span>
      </Link>

      <Link v-if="$page.props.auth?.user?.role === 'farmer'" href="/farmer/orders" class="mobile-nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
          <line x1="3" y1="6" x2="21" y2="6"/>
          <path d="M16 10a4 4 0 0 1-8 0"/>
        </svg>
        <span class="nav-label">Orders</span>
      </Link>

      <Link href="/notifications" class="mobile-nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
        </svg>
        <span class="nav-label">Alerts</span>
      </Link>

      <Link href="/settings" class="mobile-nav-item active">
        <div class="nav-active-pill">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
          </svg>
          <span class="nav-label">Settings</span>
        </div>
      </Link>
    </nav>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppButton from '../Components/UI/AppButton.vue';
import AppInput from '../Components/UI/AppInput.vue';
import AppCard from '../Components/UI/AppCard.vue';
import AppBadge from '../Components/UI/AppBadge.vue';

const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
});

const profileForm = useForm({
  name: props.user.name,
  phone_number: props.user.phone_number,
  location: props.user.location,
});

const passwordForm = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
});

const homeRoute = computed(() => {
  const role = props.user.role;
  if (role === 'farmer') return '/farmer/dashboard';
  if (role === 'buyer') return '/buyer/browse';
  if (role === 'driver') return '/driver/dashboard';
  return '/';
});

const formatRole = (role) => {
  if (role === 'farmer') return 'Farmer';
  if (role === 'buyer') return 'Buyer';
  if (role === 'driver') return 'Driver / Transporter';
  return role;
};

const roleBadgeVariant = (role) => {
  if (role === 'farmer') return 'success';
  if (role === 'buyer') return 'warning';
  if (role === 'driver') return 'info';
  return 'neutral';
};

const submitProfile = () => {
  profileForm.post('/settings/profile', {
    preserveScroll: true,
    onSuccess: () => {
      // Form values automatically update via Inertia props
    },
  });
};

const submitPassword = () => {
  passwordForm.post('/settings/password', {
    preserveScroll: true,
    onSuccess: () => {
      passwordForm.reset();
    },
  });
};
</script>

<style scoped>
.dashboard-container {
  display: flex;
  min-height: 100vh;
  background-color: var(--color-bg-page);
  font-family: var(--font-family);
  color: var(--color-neutral-900);
}

/* Sidebar Layout */
.sidebar-nav {
  width: var(--sidebar-width);
  background-color: var(--color-bg-card);
  border-right: 1px solid var(--color-border);
  display: flex;
  flex-direction: column;
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 100;
  transition: width var(--transition-base);
}

.sidebar-brand {
  height: var(--topbar-height);
  display: flex;
  align-items: center;
  gap: var(--space-3);
  padding: 0 var(--space-5);
  border-bottom: 1px solid var(--color-border);
}

.logo-icon {
  color: var(--color-primary);
}

.logo-text {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  letter-spacing: -0.5px;
}

.sidebar-user {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  padding: var(--space-4) var(--space-5);
  border-bottom: 1px solid var(--color-border);
}

.user-avatar {
  width: 36px;
  height: 36px;
  border-radius: var(--radius-full);
  background-color: var(--color-primary-light);
  color: var(--color-white);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: var(--font-weight-bold);
  font-size: var(--font-size-md);
}

.user-avatar.buyer {
  background-color: var(--color-secondary);
}

.user-avatar.driver {
  background-color: var(--color-tertiary);
}

.user-info {
  display: flex;
  flex-direction: column;
}

.user-name {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.user-role {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

.sidebar-menu {
  padding: var(--space-4) var(--space-3);
  display: flex;
  flex-direction: column;
  gap: var(--space-1);
  flex-grow: 1;
}

.menu-item {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  padding: var(--space-3) var(--space-4);
  color: var(--color-neutral-700);
  border-radius: var(--radius-md);
  text-decoration: none;
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  transition: all var(--transition-fast);
}

.menu-item:hover {
  background-color: var(--color-neutral-50);
  color: var(--color-neutral-900);
}

.menu-item.active {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary);
  font-weight: var(--font-weight-semibold);
}

.menu-icon {
  flex-shrink: 0;
}

.menu-item-badge-wrap {
  display: flex;
  align-items: center;
  width: 100%;
  gap: var(--space-3);
}

.badge-count-sidebar {
  margin-left: auto;
  background-color: var(--color-danger);
  color: var(--color-white);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  padding: 2px var(--space-2);
  border-radius: var(--radius-pill);
  min-width: 18px;
  text-align: center;
}

.sidebar-footer {
  padding: var(--space-4) var(--space-3);
  border-top: 1px solid var(--color-border);
}

.logout-btn-sidebar {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  padding: var(--space-3) var(--space-4);
  color: var(--color-danger);
  border-radius: var(--radius-md);
  text-decoration: none;
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  background: none;
  border: none;
  cursor: pointer;
  width: 100%;
  text-align: left;
}

.logout-btn-sidebar:hover {
  background-color: var(--color-danger-light);
}

/* Main Layout Wrapper */
.main-layout {
  flex-grow: 1;
  margin-left: var(--sidebar-width);
  display: flex;
  flex-direction: column;
  min-width: 0;
}

.content-body {
  padding: var(--space-6);
  max-width: 1200px;
  width: 100%;
  margin: 0 auto;
  box-sizing: border-box;
}

/* Mobile top header & bottom nav */
.mobile-header {
  display: none;
}

.mobile-bottom-nav {
  display: none;
}

/* Settings Form Grid */
.settings-grid {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: var(--space-6);
  margin-top: var(--space-4);
}

.section-title {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  margin: 0 0 var(--space-1) 0;
  color: var(--color-neutral-900);
}

.section-subtitle {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  margin: 0 0 var(--space-5) 0;
}

.settings-card {
  padding: var(--space-6);
}

.settings-form {
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
}

.form-actions {
  display: flex;
  justify-content: flex-start;
  margin-top: var(--space-2);
}

.mt-6 {
  margin-top: var(--space-6);
}

/* Profile Summary Column */
.profile-summary-card {
  padding: var(--space-6);
  text-align: center;
  position: sticky;
  top: var(--space-6);
}

.summary-avatar-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: var(--space-6);
}

.large-avatar {
  width: 80px;
  height: 80px;
  border-radius: var(--radius-full);
  background-color: var(--color-primary-light);
  color: var(--color-white);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: var(--font-size-3xl);
  font-weight: var(--font-weight-bold);
  margin-bottom: var(--space-4);
  box-shadow: var(--shadow-sm);
}

.large-avatar.buyer {
  background-color: var(--color-secondary);
}

.large-avatar.driver {
  background-color: var(--color-tertiary);
}

.summary-name {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  margin: 0 0 var(--space-2) 0;
}

.summary-role-badge {
  display: inline-block;
}

.summary-details {
  border-top: 1px solid var(--color-border);
  border-bottom: 1px solid var(--color-border);
  padding: var(--space-4) 0;
  margin-bottom: var(--space-6);
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

.detail-item {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  color: var(--color-neutral-700);
  font-size: var(--font-size-sm);
  text-align: left;
}

.detail-icon {
  color: var(--color-neutral-500);
}

.rating-display-box {
  background-color: var(--color-neutral-50);
  padding: var(--space-4);
  border-radius: var(--radius-md);
  border: 1px solid var(--color-border);
}

.rating-box-title {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  color: var(--color-neutral-500);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  display: block;
  margin-bottom: var(--space-2);
}

.rating-box-score {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-3);
  margin-bottom: var(--space-1);
}

.score-number {
  font-size: var(--font-size-2xl);
  font-weight: var(--font-weight-bold);
}

.score-stars {
  display: flex;
  gap: 2px;
}

.rating-box-subtitle {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  display: block;
}

/* Flash alerts formatting */
.flash-alert-wrapper {
  margin-bottom: var(--space-5);
  display: flex;
  justify-content: flex-start;
}

.flash-badge {
  font-size: var(--font-size-base) !important;
  padding: var(--space-3) var(--space-4) !important;
  border-radius: var(--radius-md) !important;
  width: 100%;
}

/* Responsive Breakpoints */
@media (max-width: 1024px) {
  .sidebar-nav {
    width: var(--sidebar-width-collapsed);
  }
  .logo-text, .user-info, .menu-label, .logout-label, .badge-count-sidebar {
    display: none;
  }
  .sidebar-brand, .sidebar-user {
    justify-content: center;
    padding: 0;
  }
  .sidebar-brand {
    height: var(--topbar-height);
  }
  .sidebar-user {
    padding: var(--space-3) 0;
  }
  .menu-item {
    justify-content: center;
    padding: var(--space-3);
  }
  .logout-btn-sidebar {
    justify-content: center;
    padding: var(--space-3);
  }
  .main-layout {
    margin-left: var(--sidebar-width-collapsed);
  }
  .settings-grid {
    grid-template-columns: 1fr;
  }
  .summary-column {
    order: -1;
  }
  .profile-summary-card {
    position: static;
  }
}

@media (max-width: 768px) {
  .sidebar-nav {
    display: none;
  }
  .mobile-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: var(--topbar-height);
    background-color: var(--color-bg-card);
    border-bottom: 1px solid var(--color-border);
    padding: 0 var(--space-4);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 100;
  }
  .mobile-header .logo-text {
    font-size: var(--font-size-lg);
  }
  .main-layout {
    margin-left: 0;
    margin-top: var(--topbar-height);
    margin-bottom: var(--bottom-nav-height);
  }
  .content-body {
    padding: var(--space-4);
  }
  .mobile-bottom-nav {
    display: flex;
    justify-content: space-around;
    align-items: center;
    height: var(--bottom-nav-height);
    background-color: var(--color-bg-card);
    border-top: 1px solid var(--color-border);
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 100;
    box-sizing: border-box;
  }
  .mobile-nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    color: var(--color-neutral-500);
    text-decoration: none;
    font-size: var(--font-size-xs);
    font-weight: var(--font-weight-medium);
    flex: 1;
    height: 100%;
  }
  .mobile-nav-item.active {
    color: var(--color-primary);
  }
  .mobile-nav-item.active .nav-active-pill {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-1);
    background-color: var(--color-primary-subtle);
    color: var(--color-primary);
    padding: 6px var(--space-3);
    border-radius: var(--radius-pill);
  }
  .mobile-nav-item.active .nav-label {
    font-size: 10px;
    margin-top: 0;
  }
  .icon-action-btn {
    background: none;
    border: none;
    padding: var(--space-2);
    color: var(--color-neutral-700);
    cursor: pointer;
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .icon-action-btn:hover {
    background-color: var(--color-neutral-50);
  }
  .badge-count-mobile {
    position: absolute;
    top: 2px;
    right: 2px;
    background-color: var(--color-danger);
    color: var(--color-white);
    font-size: 9px;
    font-weight: var(--font-weight-bold);
    min-width: 14px;
    height: 14px;
    border-radius: var(--radius-pill);
    display: flex;
    align-items: center;
    justify-content: center;
  }
}
</style>
