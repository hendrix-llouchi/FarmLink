<template>
  <div class="orders-wrapper">
    <!-- Topbar Header -->
    <header class="app-header">
      <div class="app-logo">
        <svg xmlns="http://www.w3.org/2000/svg" class="logo-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
        </svg>
        <span class="app-logo-text">FarmLink</span>
      </div>
      <div class="header-actions">
        <Link href="/notifications" class="icon-action-btn" style="position: relative; display: flex; align-items: center; justify-content: center;">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
          </svg>
          <span v-if="$page.props.auth?.unread_notifications_count > 0" class="badge-count-mobile" style="position: absolute; top: 2px; right: 2px; background-color: var(--color-danger); color: var(--color-white); font-size: 9px; font-weight: var(--font-weight-bold); min-width: 14px; height: 14px; border-radius: var(--radius-pill); display: flex; align-items: center; justify-content: center;">
            {{ $page.props.auth.unread_notifications_count }}
          </span>
        </Link>
        <Link href="/logout" method="post" as="button" class="icon-action-btn logout-header-btn" title="Log Out">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
          </svg>
        </Link>
      </div>
    </header>

    <!-- Main Content Body -->
    <main class="main-content">
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

      <!-- High-Fidelity Orders Cards List -->
      <div v-else class="orders-list">
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
            <div class="farmer-meta">
              <span class="farmer-label">Buyer:</span>
              <span class="farmer-name">{{ order.buyer?.name || 'Local Buyer' }}</span>
              <span class="farmer-location">📍 {{ order.buyer?.location || 'Takoradi' }}</span>
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
      <Link href="/settings" class="mobile-nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
        </svg>
        <span class="nav-label">Account</span>
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
.orders-wrapper {
  max-width: 480px;
  width: 100%;
  margin: 0 auto;
  background-color: var(--color-white);
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  position: relative;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
  padding-bottom: calc(var(--bottom-nav-height) + 20px);
  font-family: var(--font-family);
  color: var(--color-neutral-900);
}

/* Header bar */
.app-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 var(--space-4);
  background-color: var(--color-white);
  border-bottom: 1px solid var(--color-border);
  height: var(--topbar-height);
  position: sticky;
  top: 0;
  z-index: 50;
}

.app-logo {
  display: flex;
  align-items: center;
  gap: var(--space-2);
  color: var(--color-primary);
}

.logo-icon {
  color: var(--color-primary);
}

.app-logo-text {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  letter-spacing: -0.5px;
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

/* Main Content area */
.main-content {
  padding: var(--space-4);
  flex: 1;
  display: flex;
  flex-direction: column;
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

/* Orders Cards List */
.orders-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
}

.order-card {
  background-color: var(--color-white);
  border-radius: var(--radius-card);
  border: 1.5px solid var(--color-border);
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
  background-color: var(--color-secondary-light) !important;
  color: var(--color-secondary-dark);
  background: #FFF3CD;
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

.farmer-meta {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.farmer-label {
  font-size: 10px;
  color: var(--color-neutral-500);
  text-transform: uppercase;
}

.farmer-name {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-semibold);
}

.farmer-location {
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

.btn-icon {
  stroke-width: 2.2;
}

.order-timestamp {
  font-size: 10px;
  color: var(--color-neutral-500);
  margin-top: var(--space-3);
  text-align: right;
}

/* Bottom Nav bar */
.mobile-bottom-nav {
  position: fixed;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 100%;
  max-width: 480px;
  height: var(--bottom-nav-height);
  background-color: var(--color-white);
  border-top: 1px solid var(--color-border);
  display: flex;
  justify-content: space-around;
  align-items: center;
  z-index: 100;
  padding-bottom: env(safe-area-inset-bottom);
}

.mobile-nav-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 4px;
  text-decoration: none;
  color: var(--color-neutral-500);
  font-size: var(--font-size-xxs);
  font-weight: var(--font-weight-medium);
  transition: color var(--transition-fast);
  cursor: pointer;
}

.mobile-nav-item:hover {
  color: var(--color-primary);
}

.mobile-nav-item.active {
  color: var(--color-primary);
}

.nav-active-pill {
  display: flex;
  flex-direction: column;
  align-items: center;
  color: var(--color-primary);
  font-weight: var(--font-weight-bold);
}
</style>
