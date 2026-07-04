<template>
  <div class="dashboard-wrapper">
    <!-- Header -->
    <header class="header">
      <div class="header-content">
        <div class="brand">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2E7D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
          </svg>
          <span class="logo-text">FarmLink</span>
        </div>
        <div class="user-greeting">
          <span class="greeting-text">Driver Portal</span>
          <Link href="/logout" method="post" as="button" class="logout-link-btn">Log Out</Link>
        </div>
      </div>
    </header>

    <!-- Main Content Wrapped in Responsive Container -->
    <main class="main-content">
      <div class="dashboard-container max-w-6xl mx-auto px-4 py-6">
        <!-- Flash Alert -->
        <div v-if="$page.props.flash?.message" class="flash-alert">
          <p>{{ $page.props.flash.message }}</p>
        </div>

        <!-- Active Trips Section -->
        <div class="active-trips-section mb-10">
          <div class="section-header mb-4">
            <h2 class="section-title text-xl font-medium text-gray-800" style="font-weight: 500; font-size: 20px; margin: 0 0 4px 0;">Active Trips</h2>
            <p class="section-subtitle text-sm text-gray-500" style="color: #6B6B63; font-size: 14px; margin: 0;">Your current delivery tasks. Complete these to drop off produce.</p>
          </div>

          <div v-if="activeTrips.length === 0" class="empty-state-active" style="background-color: #FFFFFF; border: 1px solid #E0E0DA; border-radius: 12px; padding: 24px; text-align: center; box-shadow: 0 1px 2px rgba(0,0,0,0.06); margin-bottom: 24px;">
            <div style="font-size: 32px; margin-bottom: 8px;">📍</div>
            <h3 style="font-size: 15px; font-weight: 500; margin: 0 0 4px 0; color: #1A1A1A;">No Active Trips</h3>
            <p style="font-size: 13px; color: #6B6B63; margin: 0;">Accept an available job below to begin a delivery transit.</p>
          </div>

          <div v-else class="jobs-grid mb-8" style="margin-bottom: 32px;">
            <div v-for="order in activeTrips" :key="order.id" class="job-card border-active">
              <!-- Header Row: ID and Cost -->
              <div class="job-card-header">
                <div class="job-header-left">
                  <span class="job-id">Trip #{{ order.id }}</span>
                  <span class="active-badge">Active</span>
                </div>
                <div class="job-payout" v-if="order.estimated_transport_cost">
                  <span class="payout-label">Payout:</span>
                  <span class="payout-value">GH₵ {{ Number(order.estimated_transport_cost).toFixed(2) }}</span>
                </div>
                <div class="job-payout-est" v-else>
                  <span class="payout-label">Order Value:</span>
                  <span class="payout-value">GH₵ {{ Number(order.total_price).toFixed(2) }}</span>
                </div>
              </div>

              <!-- Body: Pickup and Destination -->
              <div class="job-card-body">
                <!-- Pickup -->
                <div class="location-step">
                  <div class="step-indicator">
                    <div class="dot pickup-dot"></div>
                    <div class="line"></div>
                  </div>
                  <div class="step-content">
                    <span class="step-label">Pickup Location (Farmer)</span>
                    <h3 class="location-name">{{ order.product?.user?.location || 'Takoradi Market' }}</h3>
                    <p class="party-name">{{ order.product?.user?.name || 'Local Farmer' }}</p>
                  </div>
                </div>

                <!-- Destination -->
                <div class="location-step">
                  <div class="step-indicator">
                    <div class="dot dropoff-dot"></div>
                  </div>
                  <div class="step-content">
                    <span class="step-label">Delivery Destination (Buyer)</span>
                    <h3 class="location-name">{{ order.buyer?.location || 'Tarkwa Center' }}</h3>
                    <p class="party-name">{{ order.buyer?.name || 'Local Buyer' }}</p>
                  </div>
                </div>

                <!-- Cargo Details -->
                <div class="cargo-details">
                  <span class="cargo-label">Produce Cargo:</span>
                  <span class="cargo-value">{{ order.quantity_ordered }}x {{ order.product?.name || 'Produce' }}</span>
                </div>
              </div>

              <!-- Action Button -->
              <div class="job-card-actions">
                <button 
                  @click="completeJob(order.id)" 
                  :disabled="processingId === order.id"
                  class="btn-complete"
                >
                  <span v-if="processingId === order.id">Updating...</span>
                  <span v-else>Mark as Delivered</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div style="height: 1px; background-color: #E0E0DA; margin-bottom: 32px; width: 100%;"></div>

        <div class="page-header">
          <div>
            <h1 class="page-title">Available Deliveries</h1>
            <p class="page-subtitle">Accept jobs to coordinate local vegetable transport</p>
          </div>
          <span class="jobs-count-badge">{{ orders.length }} delivery job(s) available</span>
        </div>

        <!-- Empty State -->
        <div v-if="orders.length === 0" class="empty-state">
          <div class="empty-icon">🚚</div>
          <h2 class="empty-title">No Deliveries Available</h2>
          <p class="empty-text">There are currently no pending orders awaiting a driver. Check back later.</p>
        </div>

        <!-- Jobs Grid -->
        <div v-else class="jobs-grid">
          <div v-for="order in orders" :key="order.id" class="job-card">
            <!-- Header Row: ID and Cost -->
            <div class="job-card-header">
              <span class="job-id">Job #{{ order.id }}</span>
              <div class="job-payout" v-if="order.estimated_transport_cost">
                <span class="payout-label">Payout:</span>
                <span class="payout-value">GH₵ {{ Number(order.estimated_transport_cost).toFixed(2) }}</span>
              </div>
              <div class="job-payout-est" v-else>
                <span class="payout-label">Order Value:</span>
                <span class="payout-value">GH₵ {{ Number(order.total_price).toFixed(2) }}</span>
              </div>
            </div>

            <!-- Body: Pickup and Destination -->
            <div class="job-card-body">
              <!-- Pickup -->
              <div class="location-step">
                <div class="step-indicator">
                  <div class="dot pickup-dot"></div>
                  <div class="line"></div>
                </div>
                <div class="step-content">
                  <span class="step-label">Pickup Location (Farmer)</span>
                  <h3 class="location-name">{{ order.product?.user?.location || 'Takoradi Market' }}</h3>
                  <p class="party-name">{{ order.product?.user?.name || 'Local Farmer' }}</p>
                </div>
              </div>

              <!-- Destination -->
              <div class="location-step">
                <div class="step-indicator">
                  <div class="dot dropoff-dot"></div>
                </div>
                <div class="step-content">
                  <span class="step-label">Delivery Destination (Buyer)</span>
                  <h3 class="location-name">{{ order.buyer?.location || 'Tarkwa Center' }}</h3>
                  <p class="party-name">{{ order.buyer?.name || 'Local Buyer' }}</p>
                </div>
              </div>

              <!-- Cargo Details -->
              <div class="cargo-details">
                <span class="cargo-label">Produce Cargo:</span>
                <span class="cargo-value">{{ order.quantity_ordered }}x {{ order.product?.name || 'Produce' }}</span>
              </div>
            </div>

            <!-- Action Button -->
            <div class="job-card-actions">
              <button 
                @click="acceptJob(order.id)" 
                :disabled="processingId === order.id"
                class="btn-accept"
              >
                <span v-if="processingId === order.id">Accepting...</span>
                <span v-else>Accept Delivery</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Mobile Bottom Navigation (Design Brief requirement) -->
    <nav class="mobile-nav hide-desktop">
      <Link href="/driver/dashboard" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
        </svg>
        <span class="nav-label">Deliveries</span>
      </Link>
      <a href="#" class="nav-item disabled">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0"/>
        </svg>
        <span class="nav-label">Alerts</span>
      </a>
      <Link href="/" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
        </svg>
        <span class="nav-label">Profile</span>
      </Link>
    </nav>
  </div>
</template>

<script>
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

export default {
  name: 'DriverDashboard',
  components: {
    Link
  },
  props: {
    orders: {
      type: Array,
      required: true
    },
    activeTrips: {
      type: Array,
      required: true
    }
  },
  setup() {
    const processingId = ref(null);

    const acceptJob = (orderId) => {
      processingId.value = orderId;
      router.post(`/driver/orders/${orderId}/accept`, {}, {
        onFinish: () => {
          processingId.value = null;
        }
      });
    };

    const completeJob = (orderId) => {
      processingId.value = orderId;
      router.post(`/driver/orders/${orderId}/complete`, {}, {
        onFinish: () => {
          processingId.value = null;
        }
      });
    };

    return {
      processingId,
      acceptJob,
      completeJob
    };
  }
}
</script>

<style scoped>
* {
  box-sizing: border-box;
}

.dashboard-wrapper {
  min-height: 100vh;
  background-color: #F7F8F5;
  color: #1A1A1A;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  padding-bottom: 80px; /* space for mobile nav */
}

/* Header Styling */
.header {
  background-color: #FFFFFF;
  border-bottom: 1px solid #E0E0DA;
  position: sticky;
  top: 0;
  z-index: 10;
}

.header-content {
  max-width: 1200px;
  margin: 0 auto;
  padding: 12px 16px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.brand {
  display: flex;
  align-items: center;
  gap: 8px;
}

.logo-text {
  font-size: 20px;
  font-weight: 500;
  color: #1B5E20;
}

.user-greeting {
  display: flex;
  align-items: center;
  gap: 12px;
}

.greeting-text {
  font-size: 14px;
  color: #2E7D32;
  font-weight: 500;
  background-color: #E8F5E9;
  padding: 4px 8px;
  border-radius: 6px;
}

.logout-link-btn {
  color: #C62828;
  background: none;
  border: none;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  padding: 4px 8px;
}

/* Main Layout */
.main-content {
  padding-top: 16px;
}

.page-header {
  display: flex;
  flex-direction: column;
  gap: 12px;
  margin-bottom: 24px;
}

@media (min-width: 768px) {
  .page-header {
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
  }
}

.page-title {
  font-size: 24px;
  font-weight: 500;
  color: #1A1A1A;
  margin: 0;
}

.page-subtitle {
  font-size: 14px;
  color: #6B6B63;
  margin: 4px 0 0 0;
}

.jobs-count-badge {
  font-size: 13px;
  font-weight: 500;
  color: #2E7D32;
  background-color: #E8F5E9;
  padding: 6px 12px;
  border-radius: 20px;
  align-self: flex-start;
}

/* Flash Alert */
.flash-alert {
  background-color: #E8F5E9;
  border: 1px solid #2E7D32;
  color: #1B5E20;
  padding: 12px 16px;
  border-radius: 8px;
  margin-bottom: 20px;
  font-size: 14px;
}

/* Empty State */
.empty-state {
  background-color: #FFFFFF;
  border: 1px solid #E0E0DA;
  border-radius: 12px;
  padding: 48px 24px;
  text-align: center;
  box-shadow: 0 1px 2px rgba(0,0,0,0.06);
}

.empty-icon {
  font-size: 48px;
  margin-bottom: 16px;
}

.empty-title {
  font-size: 18px;
  font-weight: 500;
  color: #1A1A1A;
  margin: 0 0 8px 0;
}

.empty-text {
  font-size: 14px;
  color: #6B6B63;
  margin: 0;
}

/* Jobs Grid */
.jobs-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 20px;
}

@media (min-width: 768px) {
  .jobs-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

.job-card {
  background-color: #FFFFFF;
  border: 1px solid #E0E0DA;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 1px 2px rgba(0,0,0,0.06);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.job-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-bottom: 12px;
  border-bottom: 1px solid #E0E0DA;
  margin-bottom: 16px;
}

.job-id {
  font-size: 15px;
  font-weight: 500;
  color: #1A1A1A;
}

.job-payout, .job-payout-est {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}

.payout-label {
  font-size: 10px;
  color: #6B6B63;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.payout-value {
  font-size: 16px;
  font-weight: 500;
  color: #2E7D32;
}

/* Pickup and Dropoff Steps */
.job-card-body {
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.location-step {
  display: flex;
  gap: 12px;
}

.step-indicator {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 12px;
}

.dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  margin-top: 5px;
}

.pickup-dot {
  background-color: #2E7D32;
}

.dropoff-dot {
  background-color: #B8860B;
}

.line {
  width: 2px;
  background-color: #E0E0DA;
  flex-grow: 1;
  margin: 4px 0;
}

.step-content {
  display: flex;
  flex-direction: column;
}

.step-label {
  font-size: 11px;
  color: #6B6B63;
  text-transform: uppercase;
}

.location-name {
  font-size: 15px;
  font-weight: 500;
  color: #1A1A1A;
  margin: 2px 0 0 0;
}

.party-name {
  font-size: 13px;
  color: #6B6B63;
  margin: 2px 0 0 0;
}

/* Cargo Details */
.cargo-details {
  border-top: 1px dashed #E0E0DA;
  padding-top: 12px;
  margin-top: 4px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 13px;
}

.cargo-label {
  color: #6B6B63;
}

.cargo-value {
  font-weight: 500;
  color: #1A1A1A;
}

/* Actions */
.job-card-actions {
  margin-top: 20px;
}

.btn-accept {
  width: 100%;
  height: 44px; /* Generous tap target */
  background-color: #2E7D32;
  color: #FFFFFF;
  border: none;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: background-color 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-accept:hover:not(:disabled) {
  background-color: #1B5E20;
}

.btn-accept:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

/* Mobile Bottom Navigation */
.mobile-nav {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  height: 60px;
  background-color: #FFFFFF;
  border-top: 1px solid #E0E0DA;
  display: flex;
  justify-content: space-around;
  align-items: center;
  z-index: 10;
}

.nav-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: #6B6B63;
  text-decoration: none;
  font-size: 10px;
  gap: 2px;
  width: 33.33%;
  height: 100%;
}

.nav-item.active {
  color: #2E7D32;
}

.nav-item.disabled {
  opacity: 0.4;
  cursor: not-allowed;
  pointer-events: none;
}

.nav-label {
  font-weight: 500;
}

.hide-desktop {
  display: flex;
}

@media (min-width: 768px) {
  .hide-desktop {
    display: none !important;
  }
}

/* Active Trips Custom Styling */
.active-trips-section {
  margin-bottom: 40px;
}

.border-active {
  border: 1.5px solid #2E7D32 !important;
  box-shadow: 0 2px 4px rgba(46, 125, 50, 0.08) !important;
}

.job-header-left {
  display: flex;
  align-items: center;
}

.active-badge {
  font-size: 11px;
  font-weight: 500;
  color: #2E7D32;
  background-color: #E8F5E9;
  padding: 2px 8px;
  border-radius: 12px;
  margin-left: 8px;
  text-transform: uppercase;
}

.btn-complete {
  width: 100%;
  height: 44px; /* Generous tap target */
  background-color: #2E7D32;
  color: #FFFFFF;
  border: none;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: background-color 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-complete:hover:not(:disabled) {
  background-color: #1B5E20;
}

.btn-complete:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}
</style>
