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

        <Link href="/notifications" class="menu-item active">
          <div class="menu-item-badge-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
            <span class="menu-label">Alerts</span>
            <span v-if="unreadCount > 0" class="badge-count-sidebar">
              {{ unreadCount }}
            </span>
          </div>
        </Link>

        <Link href="/settings" class="menu-item">
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
      <div class="header-brand">
        <span class="logo-text">Alerts</span>
      </div>
      <div class="header-actions">
        <button 
          v-if="unreadCount > 0" 
          @click="markAllAsRead" 
          class="text-action-link"
        >
          Clear All
        </button>
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

        <div class="notifications-header">
          <div class="header-titles">
            <h1 class="page-title">Notifications</h1>
            <p class="page-subtitle">Stay updated on your orders, deliveries, and produce status.</p>
          </div>
          <AppButton 
            v-if="unreadCount > 0" 
            @click="markAllAsRead" 
            variant="secondary" 
            size="sm"
            class="desktop-only-btn"
          >
            Mark All as Read
          </AppButton>
        </div>

        <!-- Notifications List -->
        <div class="notifications-container">
          <div v-if="notifications.length === 0" class="empty-state">
            <div class="empty-icon-circle">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0"/>
              </svg>
            </div>
            <h3 class="empty-title">All caught up!</h3>
            <p class="empty-subtitle">You have no notifications at the moment.</p>
          </div>

          <div 
            v-else 
            v-for="item in notifications" 
            :key="item.id" 
            class="notification-item"
            :class="[item.type, { 'unread': !item.read_at }]"
          >
            <div class="notification-icon-wrap" :class="item.type">
              <!-- Order Update Icon (Shopping Bag) -->
              <svg v-if="item.type === 'order_update'" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
              </svg>

              <!-- Transport Update Icon (Truck) -->
              <svg v-else-if="item.type === 'transport_update'" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
              </svg>

              <!-- New Listing Icon (Plus Circle) -->
              <svg v-else xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/>
              </svg>
            </div>

            <div class="notification-body">
              <p class="notification-message">{{ item.message }}</p>
              <span class="notification-time">{{ formatTime(item.created_at) }}</span>
            </div>

            <div class="notification-actions">
              <button 
                v-if="!item.read_at" 
                @click="markAsRead(item.id)" 
                class="mark-read-btn" 
                title="Mark as read"
              >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span class="btn-text">Read</span>
              </button>
              <AppBadge v-else variant="neutral" size="sm">
                Read
              </AppBadge>
            </div>
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

      <Link href="/settings" class="mobile-nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
        </svg>
        <span class="nav-label">Settings</span>
      </Link>
    </nav>
  </div>
</template>

<script setup>
import { router, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppButton from '../Components/UI/AppButton.vue';
import AppBadge from '../Components/UI/AppBadge.vue';

const props = defineProps({
  notifications: {
    type: Array,
    required: true,
  },
});

const unreadCount = computed(() => {
  return props.notifications.filter(n => !n.read_at).length;
});

const homeRoute = computed(() => {
  const role = router.page.props.auth?.user?.role;
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

const formatTime = (timeString) => {
  const date = new Date(timeString);
  const now = new Date();
  const diffMs = now - date;
  const diffMins = Math.floor(diffMs / 60000);
  
  if (diffMins < 1) return 'Just now';
  if (diffMins < 60) return `${diffMins}m ago`;
  
  const diffHours = Math.floor(diffMins / 60);
  if (diffHours < 24) return `${diffHours}h ago`;
  
  return date.toLocaleDateString(undefined, { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' });
};

const markAsRead = (id) => {
  router.post(`/notifications/${id}/read`, {}, {
    preserveScroll: true,
  });
};

const markAllAsRead = () => {
  router.post('/notifications/read-all', {}, {
    preserveScroll: true,
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
  max-width: 800px;
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

/* Header Section */
.notifications-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: var(--space-6);
}

.page-title {
  font-size: var(--font-size-2xl);
  font-weight: var(--font-weight-bold);
  margin: 0 0 var(--space-1) 0;
}

.page-subtitle {
  font-size: var(--font-size-base);
  color: var(--color-neutral-500);
  margin: 0;
}

/* Notifications Box */
.notifications-container {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

.notification-item {
  display: flex;
  align-items: flex-start;
  gap: var(--space-4);
  background-color: var(--color-white);
  padding: var(--space-4) var(--space-5);
  border-radius: var(--radius-lg);
  border: 1px solid var(--color-border);
  box-shadow: var(--shadow-xs);
  transition: all var(--transition-fast);
}

/* Custom border hints for unread items */
.notification-item.unread {
  background-color: var(--color-primary-subtle);
  border-left: 4px solid var(--color-primary);
}

.notification-item.unread.transport_update {
  background-color: var(--color-tertiary-subtle);
  border-left-color: var(--color-tertiary);
}

.notification-item.unread.new_listing {
  background-color: var(--color-warning-light);
  border-left-color: var(--color-secondary);
}

.notification-icon-wrap {
  width: 40px;
  height: 40px;
  border-radius: var(--radius-full);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.notification-icon-wrap.order_update {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary);
}

.notification-icon-wrap.transport_update {
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary);
}

.notification-icon-wrap.new_listing {
  background-color: var(--color-warning-light);
  color: var(--color-secondary);
}

.notification-body {
  flex-grow: 1;
  min-width: 0;
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.notification-message {
  font-size: var(--font-size-base);
  margin: 0;
  line-height: var(--line-height-base);
  word-break: break-word;
}

.notification-time {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

.notification-actions {
  align-self: center;
  flex-shrink: 0;
}

.mark-read-btn {
  display: flex;
  align-items: center;
  gap: 4px;
  background-color: var(--color-white);
  border: 1.5px solid var(--color-neutral-300);
  color: var(--color-neutral-700);
  font-family: var(--font-family);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  padding: var(--space-1) var(--space-3);
  border-radius: var(--radius-pill);
  cursor: pointer;
  height: 28px;
  transition: all var(--transition-fast);
}

.mark-read-btn:hover {
  background-color: var(--color-primary-subtle);
  border-color: var(--color-primary);
  color: var(--color-primary);
}

/* Empty State */
.empty-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: var(--space-12) var(--space-6);
  text-align: center;
  background-color: var(--color-white);
  border-radius: var(--radius-lg);
  border: 1px solid var(--color-border);
  box-shadow: var(--shadow-xs);
}

.empty-icon-circle {
  width: 80px;
  height: 80px;
  border-radius: var(--radius-full);
  background-color: var(--color-neutral-50);
  color: var(--color-neutral-400);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: var(--space-4);
}

.empty-title {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  margin: 0 0 var(--space-2) 0;
}

.empty-subtitle {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  margin: 0;
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
}

@media (max-width: 768px) {
  .sidebar-nav {
    display: none;
  }
  .desktop-only-btn {
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
  .text-action-link {
    background: none;
    border: none;
    color: var(--color-primary);
    font-family: var(--font-family);
    font-size: var(--font-size-sm);
    font-weight: var(--font-weight-bold);
    cursor: pointer;
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
  .notification-actions .mark-read-btn .btn-text {
    display: none;
  }
  .notification-actions .mark-read-btn {
    padding: 0;
    width: 28px;
    justify-content: center;
  }
}
</style>
