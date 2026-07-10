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
        <div class="user-avatar">
          {{ $page.props.auth?.user?.name?.charAt(0).toUpperCase() || 'F' }}
        </div>
        <div class="user-info">
          <span class="user-name">{{ $page.props.auth?.user?.name || 'Farmer' }}</span>
          <span class="user-role">Farmer Portal</span>
        </div>
      </div>

      <nav class="sidebar-menu">
        <Link href="/farmer/dashboard" class="menu-item">
          <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/>
          </svg>
          <span class="menu-label">Dashboard</span>
        </Link>
        <Link href="/farmer/orders" class="menu-item active">
          <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
          </svg>
          <span class="menu-label">Orders</span>
        </Link>
        <Link href="/notifications" class="menu-item">
          <div class="menu-item-badge-wrap" style="display: flex; align-items: center; width: 100%; gap: var(--space-3);">
            <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
            <span class="menu-label" style="display: inline;">Alerts</span>
            <span v-if="$page.props.auth?.unread_notifications_count > 0" class="badge-count-sidebar" style="margin-left: auto; background-color: var(--color-danger); color: var(--color-white); font-size: var(--font-size-xs); font-weight: var(--font-weight-bold); padding: 2px var(--space-2); border-radius: var(--radius-pill); min-width: 18px; text-align: center;">
              {{ $page.props.auth.unread_notifications_count }}
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
      <div class="header-brand" style="display: flex; align-items: center; gap: var(--space-2);">
        <span class="logo-text">FarmLink</span>
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
        <div class="page-title-row">
          <h1 class="page-title">Received Orders</h1>
          <span class="orders-count-badge">{{ orders.length }} order(s) received</span>
        </div>

        <!-- Flash Alert -->
        <div v-if="$page.props.flash?.message" class="flash-alert-wrapper" style="margin-bottom: var(--space-4);">
          <span class="flash-badge-inline">
            {{ $page.props.flash.message }}
          </span>
        </div>

        <!-- Empty State -->
        <div v-if="orders.length === 0" class="empty-state">
          <div class="empty-icon">📦</div>
          <h3>No orders received yet</h3>
          <p>Your products are listed on the marketplace. Once a buyer places an order, it will appear here.</p>
          <Link href="/farmer/dashboard" class="browse-btn-link">Manage Listings</Link>
        </div>

        <!-- High-Fidelity Orders Grid Layout -->
        <div v-else class="orders-grid">
          <div v-for="order in orders" :key="order.id" class="order-card" :class="order.status">
            <!-- Top Row: Order ID & Status Badge -->
            <div class="order-card-header">
              <span class="order-id">Order #{{ order.id }}</span>
              <span class="status-badge" :class="order.status">
                {{ formatStatus(order.status) }}
              </span>
            </div>

            <!-- Product Details Block -->
            <div class="order-card-body">
              <div class="product-info-row">
                <div class="product-img-box">
                  <img 
                    v-if="order.product?.image_path" 
                    :src="order.product.image_path.startsWith('http') ? order.product.image_path : '/storage/' + order.product.image_path" 
                    :alt="order.product.name" 
                    class="product-image"
                  />
                  <div v-else class="product-placeholder">🥦</div>
                </div>

                <div class="product-details">
                  <h3 class="product-name">{{ order.product?.name || 'Fresh Produce' }}</h3>
                  <span class="category-tag-pill" :class="order.product?.category?.toLowerCase().replace('/', '-')">
                    {{ order.product?.category || 'Vegetable' }}
                  </span>
                  <div class="price-calculations">
                    <span class="qty-lbl">Quantity: {{ order.quantity_ordered }}</span>
                    <span class="dot-divider">•</span>
                    <span class="price-unit-lbl">GH₵ {{ Number(order.product?.price || 0).toFixed(2) }} / unit</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-divider"></div>

            <!-- Buyer details & Total payout -->
            <div class="order-card-footer">
              <div class="buyer-meta">
                <span class="buyer-label">Buyer:</span>
                <span class="buyer-name">{{ order.buyer?.name || 'Local Buyer' }}</span>
                <span class="buyer-location">📍 {{ order.buyer?.location || 'Takoradi' }}</span>
              </div>
              <div class="total-paid-meta">
                <span class="total-label">Payout:</span>
                <span class="total-value">GH₵ {{ Number(order.total_price).toFixed(2) }}</span>
              </div>
            </div>

            <!-- Logistics Info & Action Row -->
            <div class="order-logistics-row">
              <div v-if="order.driver" class="driver-info-box">
                <div class="driver-avatar-mini">🚚</div>
                <div class="driver-meta-text">
                  <span class="driver-name-lbl">Driver: <strong>{{ order.driver.name }}</strong></span>
                  <span class="driver-loc-lbl">Location: {{ order.driver.location }}</span>
                </div>
                <span class="driver-cost-badge">Cost: GH₵{{ Number(order.estimated_transport_cost || 0).toFixed(2) }}</span>
              </div>
              <div v-else-if="order.transport_requested" class="searching-driver-box">
                <span class="pulse-indicator"></span>
                <span class="searching-txt">Searching for transporter...</span>
              </div>
              <div v-else class="request-transport-action-row">
                <button 
                  @click="requestTransport(order.id)" 
                  class="request-transport-btn"
                  :disabled="requestingId === order.id"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="3" width="15" height="13" />
                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                    <circle cx="5.5" cy="18.5" r="2.5" />
                    <circle cx="18.5" cy="18.5" r="2.5" />
                  </svg>
                  <span>{{ requestingId === order.id ? 'Requesting...' : 'Request Transport' }}</span>
                </button>
              </div>
            </div>

            <!-- Bottom Meta: Order Timestamp -->
            <div class="order-timestamp">
              Ordered on {{ formatDate(order.created_at) }}
            </div>
          </div>
        </div>
      </main>
    </div>

    <!-- Mobile Bottom Navigation Bar (Stitch style) -->
    <nav class="mobile-bottom-nav">
      <Link href="/farmer/dashboard" class="mobile-nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
          <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
        <span class="nav-label">Home</span>
      </Link>
      <Link href="/farmer/orders" class="mobile-nav-item active">
        <div class="nav-active-pill">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
            <line x1="3" y1="6" x2="21" y2="6"/>
            <path d="M16 10a4 4 0 0 1-8 0"/>
          </svg>
          <span class="nav-label">Orders</span>
        </div>
      </Link>
      <Link href="/notifications" class="mobile-nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
        </svg>
        <span class="nav-label">Alerts</span>
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

<script>
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

export default {
  name: 'FarmerOrders',
  components: {
    Link
  },
  props: {
    orders: {
      type: Array,
      required: true
    }
  },
  setup() {
    const requestingId = ref(null);

    const formatDate = (dateString) => {
      if (!dateString) return '';
      const date = new Date(dateString);
      return date.toLocaleDateString(undefined, {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
    };

    const formatStatus = (status) => {
      if (!status) return '';
      if (status === 'in_transit') return 'In Transit';
      if (status === 'awaiting_pickup') return 'Awaiting Pickup';
      return status.charAt(0).toUpperCase() + status.slice(1);
    };

    const requestTransport = (orderId) => {
      requestingId.value = orderId;
      router.post(`/farmer/orders/${orderId}/request-transport`, {}, {
        onFinish: () => {
          requestingId.value = null;
        }
      });
    };

    return {
      formatDate,
      formatStatus,
      requestingId,
      requestTransport
    };
  }
}
</script>

<style scoped>
@import "../../css/design-tokens.css";

/* Outer wrapper */
.dashboard-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background-color: var(--color-bg-page);
  color: var(--color-neutral-900);
  font-family: var(--font-family);
  overflow-x: hidden;
  width: 100%;
}

/* Sidebar navigation */
.sidebar-nav {
  display: none;
  flex-direction: column;
  background-color: var(--color-bg-sidebar);
  border-right: 1px solid var(--color-border);
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  flex-shrink: 0;
  transition: width var(--transition-base);
  z-index: 100;
  overflow-y: auto;
}

.sidebar-brand {
  height: var(--topbar-height);
  display: flex;
  align-items: center;
  gap: var(--space-3);
  padding: 0 var(--space-4);
  border-bottom: 1px solid var(--color-border);
  color: var(--color-primary);
  font-weight: var(--font-weight-bold);
  overflow: hidden;
}

.logo-icon {
  flex-shrink: 0;
  color: var(--color-primary);
}

.logo-text {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  letter-spacing: -0.5px;
}

.sidebar-user {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  padding: var(--space-4);
  margin: var(--space-3);
  background-color: var(--color-neutral-50);
  border-radius: var(--radius-md);
  overflow: hidden;
}

.user-avatar {
  width: 36px;
  height: 36px;
  background-color: var(--color-primary);
  color: var(--color-white);
  border-radius: var(--radius-full);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: var(--font-weight-bold);
  font-size: var(--font-size-base);
  flex-shrink: 0;
}

.user-info {
  display: flex;
  flex-direction: column;
  min-width: 0;
}

.user-name {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-semibold);
  color: var(--color-neutral-900);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.user-role {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

.sidebar-menu {
  display: flex;
  flex-direction: column;
  gap: var(--space-1);
  padding: var(--space-3);
  flex: 1;
}

.menu-item {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  padding: var(--space-3);
  color: var(--color-neutral-700);
  border-radius: var(--radius-md);
  text-decoration: none;
  font-weight: var(--font-weight-medium);
  font-size: var(--font-size-sm);
  transition: all var(--transition-fast);
  cursor: pointer;
}

.menu-item:hover:not(.disabled) {
  background-color: var(--color-neutral-100);
  color: var(--color-neutral-900);
}

.menu-item.active {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary);
}

.sidebar-footer {
  padding: var(--space-3);
  border-top: 1px solid var(--color-border);
}

.logout-btn-sidebar {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  width: 100%;
  padding: var(--space-3);
  background: none;
  border: none;
  color: var(--color-danger);
  font-weight: var(--font-weight-medium);
  font-size: var(--font-size-sm);
  border-radius: var(--radius-md);
  cursor: pointer;
  transition: background-color var(--transition-fast);
}

.logout-btn-sidebar:hover {
  background-color: var(--color-danger-light);
}

/* Mobile top header (Stitch style) */
.mobile-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: var(--topbar-height);
  padding: 0 var(--space-4);
  background-color: var(--color-white);
  border-bottom: 1px solid var(--color-border);
  position: sticky;
  top: 0;
  z-index: 50;
}

.mobile-header .logo-text {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-primary);
}

.header-actions {
  display: flex;
  align-items: center;
  gap: var(--space-2);
}

.icon-action-btn {
  background: none;
  border: none;
  color: var(--color-neutral-700);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: var(--radius-full);
  transition: background-color var(--transition-fast);
}

.icon-action-btn:hover {
  background-color: var(--color-neutral-100);
}

.icon-action-btn.logout-header-btn {
  color: var(--color-danger);
}

.icon-action-btn.logout-header-btn:hover {
  background-color: var(--color-danger-light);
}

/* Main Content layout wrapper */
.main-layout {
  flex: 1;
  display: flex;
  flex-direction: column;
  min-width: 0;
  width: 100%;
}

.content-body {
  flex: 1;
  padding: var(--space-4);
  max-width: 1200px;
  width: 100%;
  margin: 0 auto;
  padding-bottom: calc(var(--bottom-nav-height) + 30px);
}

.page-title-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: var(--space-5);
}

.page-title {
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.orders-count-badge {
  background-color: var(--color-primary-lighter);
  color: var(--color-primary-hover);
  padding: var(--space-1) var(--space-3);
  border-radius: var(--radius-pill);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
}

/* Flash alerts */
.flash-alert-wrapper {
  background-color: var(--color-primary-lighter);
  border-left: 4px solid var(--color-primary);
  border-radius: 4px;
  padding: var(--space-3) var(--space-4);
}

.flash-badge-inline {
  color: var(--color-primary-hover);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
}

/* Empty state styling */
.empty-state {
  text-align: center;
  padding: var(--space-10) var(--space-4);
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.empty-icon {
  font-size: var(--font-size-3xl);
  margin-bottom: var(--space-4);
}

.empty-state h3 {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  margin-bottom: var(--space-2);
}

.empty-state p {
  color: var(--color-neutral-500);
  font-size: var(--font-size-sm);
  max-width: 280px;
  margin: 0 auto var(--space-6);
  line-height: 1.5;
}

.browse-btn-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background-color: var(--color-primary);
  color: var(--color-white);
  font-weight: var(--font-weight-semibold);
  height: 44px;
  padding: 0 var(--space-6);
  border-radius: var(--radius-btn);
  text-decoration: none;
  transition: background-color var(--transition-fast);
}

.browse-btn-link:hover {
  background-color: var(--color-primary-hover);
}

/* Orders Grid Layout */
.orders-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: var(--space-4);
}

.order-card {
  background-color: var(--color-white);
  border-radius: var(--radius-card);
  border: 1px solid var(--color-border);
  box-shadow: var(--shadow-card);
  padding: var(--space-4);
  position: relative;
  transition: transform var(--transition-fast), border-color var(--transition-fast);
}

/* Status-based card borders */
.order-card.pending {
  border-left: 5px solid var(--color-secondary);
}

.order-card.processing {
  border-left: 5px solid var(--color-primary-light);
}

.order-card.in_transit {
  border-left: 5px solid var(--color-tertiary);
}

.order-card.delivered {
  border-left: 5px solid var(--color-primary);
}

.order-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: var(--space-3);
}

.order-id {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-500);
  letter-spacing: 0.5px;
}

.status-badge {
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  padding: 2px 8px;
  border-radius: var(--radius-pill);
  text-transform: uppercase;
}

.status-badge.pending {
  background-color: #FFF3CD;
  color: var(--color-secondary-dark);
}

.status-badge.processing {
  background-color: var(--color-primary-lighter);
  color: var(--color-primary-hover);
}

.status-badge.in_transit {
  background-color: var(--color-tertiary-light);
  color: var(--color-white);
  background: var(--color-tertiary);
}

.status-badge.delivered {
  background-color: var(--color-primary);
  color: var(--color-white);
}

/* Body and products */
.product-info-row {
  display: flex;
  gap: var(--space-3);
}

.product-img-box {
  width: 64px;
  height: 64px;
  border-radius: 8px;
  overflow: hidden;
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-border);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.product-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.product-placeholder {
  font-size: var(--font-size-xl);
}

.product-details {
  display: flex;
  flex-direction: column;
  justify-content: center;
  flex: 1;
}

.product-name {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  margin-bottom: var(--space-1);
}

.category-tag-pill {
  font-size: 9px;
  font-weight: var(--font-weight-semibold);
  color: var(--color-neutral-500);
  border: 1px solid var(--color-border-input);
  padding: 1px 6px;
  border-radius: var(--radius-pill);
  align-self: flex-start;
  margin-bottom: var(--space-2);
}

.price-calculations {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-700);
  display: flex;
  align-items: center;
  gap: var(--space-1);
}

.dot-divider {
  color: var(--color-neutral-300);
}

.card-divider {
  height: 1px;
  background-color: var(--color-border);
  margin: var(--space-3) 0;
}

/* Footer details */
.order-card-footer {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: var(--space-3);
}

.buyer-meta {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.buyer-label {
  font-size: 10px;
  color: var(--color-neutral-500);
  text-transform: uppercase;
}

.buyer-name {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-semibold);
}

.buyer-location {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-700);
}

.total-paid-meta {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 2px;
}

.total-label {
  font-size: 10px;
  color: var(--color-neutral-500);
  text-transform: uppercase;
}

.total-value {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-primary);
}

/* Logistics Row */
.order-logistics-row {
  background-color: var(--color-neutral-50);
  border-radius: 8px;
  padding: var(--space-3);
  margin-top: var(--space-2);
}

.driver-info-box {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  width: 100%;
}

.driver-avatar-mini {
  font-size: 20px;
}

.driver-meta-text {
  display: flex;
  flex-direction: column;
  flex: 1;
}

.driver-name-lbl {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-900);
}

.driver-loc-lbl {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

.driver-cost-badge {
  background-color: var(--color-primary-lighter);
  color: var(--color-primary-hover);
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  padding: var(--space-1) var(--space-2);
  border-radius: var(--radius-pill);
}

.searching-driver-box {
  display: flex;
  align-items: center;
  gap: var(--space-2);
  color: var(--color-neutral-500);
  font-size: var(--font-size-xs);
}

.pulse-indicator {
  width: 8px;
  height: 8px;
  background-color: var(--color-secondary);
  border-radius: var(--radius-full);
  display: inline-block;
  animation: pulse 1.5s infinite;
}

@keyframes pulse {
  0% {
    transform: scale(0.9);
    opacity: 1;
  }
  50% {
    transform: scale(1.3);
    opacity: 0.5;
  }
  100% {
    transform: scale(0.9);
    opacity: 1;
  }
}

.request-transport-action-row {
  display: flex;
  justify-content: flex-end;
}

.request-transport-btn {
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
  background-color: var(--color-secondary);
  color: var(--color-secondary-dark);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  height: 36px;
  padding: 0 var(--space-3);
  border: none;
  border-radius: var(--radius-btn);
  cursor: pointer;
  transition: opacity var(--transition-fast);
}

.request-transport-btn:hover {
  opacity: 0.9;
}

.request-transport-btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.order-timestamp {
  font-size: 10px;
  color: var(--color-neutral-500);
  margin-top: var(--space-3);
  text-align: right;
}

/* Mobile Bottom Nav bar (Stitch style) */
.mobile-bottom-nav {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  height: var(--bottom-nav-height);
  background-color: var(--color-white);
  border-top: 1px solid var(--color-border);
  display: flex;
  justify-content: space-around;
  align-items: center;
  z-index: 100;
  padding: 0 var(--space-2);
}

.mobile-nav-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: var(--color-neutral-500);
  text-decoration: none;
  width: 20%;
  height: 100%;
  font-weight: var(--font-weight-semibold);
  transition: all var(--transition-fast);
}

.mobile-nav-item .nav-label {
  font-size: 10px;
  margin-top: 2px;
}

.mobile-nav-item.active {
  color: var(--color-primary);
}

.mobile-nav-item.active .nav-active-pill {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
  background-color: var(--color-primary-subtle);
  color: var(--color-primary);
  padding: 8px var(--space-4);
  border-radius: var(--radius-pill);
}

.mobile-nav-item.active .nav-label {
  font-size: var(--font-size-xs);
  margin-top: 0;
}

/* Responsive Breakpoints */
@media (max-width: 767px) {
  .dashboard-container {
    padding-bottom: var(--bottom-nav-height);
    overflow-x: hidden;
  }
}

@media (min-width: 768px) {
  .dashboard-container {
    flex-direction: row;
  }
  .mobile-header {
    display: none;
  }
  .mobile-bottom-nav {
    display: none;
  }
  .sidebar-nav {
    display: flex;
    width: var(--sidebar-width-collapsed);
  }
  .main-layout {
    margin-left: var(--sidebar-width-collapsed);
  }
  .sidebar-user {
    padding: var(--space-2);
    margin: var(--space-2);
  }
  .user-info {
    display: none;
  }
  .logo-text, .menu-label, .logout-label {
    display: none;
  }
  .sidebar-brand {
    justify-content: center;
  }
  .menu-item {
    justify-content: center;
  }
  .logout-btn-sidebar {
    justify-content: center;
  }
  
  /* Desktop orders grid: multi-column list */
  .orders-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (min-width: 1025px) {
  .sidebar-nav {
    width: var(--sidebar-width);
  }
  .main-layout {
    margin-left: var(--sidebar-width);
  }
  .sidebar-brand {
    justify-content: flex-start;
  }
  .sidebar-user {
    padding: var(--space-4);
    margin: var(--space-3);
  }
  .user-info {
    display: flex;
  }
  .logo-text, .menu-label, .logout-label {
    display: inline;
  }
  .menu-item {
    justify-content: flex-start;
  }
  .logout-btn-sidebar {
    justify-content: flex-start;
  }
  
  .orders-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}
</style>
