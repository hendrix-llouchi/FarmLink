<template>
  <div class="driver-wrapper">

    <!-- Sticky Top Header -->
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
        <Link href="/logout" method="post" as="button" class="icon-action-btn" title="Log Out">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
          </svg>
        </Link>
      </div>
    </header>

    <!-- Flash message -->
    <div v-if="$page.props.flash?.message" class="flash-alert">
      {{ $page.props.flash.message }}
    </div>

    <!-- Main Scrollable Body -->
    <main class="main-content">

      <!-- ═══ ACTIVE TRIP SECTION ═══ -->
      <section class="section-block">
        <div class="section-header">
          <h2 class="section-title">Active Trip</h2>
        </div>

        <!-- Empty Active Trip State -->
        <div v-if="activeTrips.length === 0" class="empty-active-card">
          <svg xmlns="http://www.w3.org/2000/svg" class="empty-state-svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
            <circle cx="12" cy="10" r="3"/>
          </svg>
          <h3 class="empty-title">No Active Trips</h3>
          <p class="empty-sub">Accept an available job below to begin a delivery transit.</p>
        </div>

        <!-- Active Trip Cards -->
        <div v-else class="active-trips-list">
          <div v-for="order in activeTrips" :key="order.id" class="active-trip-card">
            <!-- Status & Payout Row -->
            <div class="trip-status-row">
              <span class="in-progress-badge">IN PROGRESS</span>
              <div class="payout-col">
                <span class="payout-label-sm">Estimated Payout</span>
                <span class="payout-amount">
                  GHS {{ order.estimated_transport_cost
                    ? Number(order.estimated_transport_cost).toFixed(2)
                    : Number(order.total_price).toFixed(2) }}
                </span>
              </div>
            </div>

            <!-- Progress Steps: Farm → Transit → Market -->
            <div class="progress-steps-row">
              <div class="progress-step completed">
                <div class="step-icon-circle">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                  </svg>
                </div>
                <span class="step-name">Farm</span>
              </div>
              <div class="step-connector"></div>
              <div class="progress-step active">
                <div class="step-icon-circle">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <rect x="1" y="3" width="15" height="13"/>
                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                    <circle cx="5.5" cy="18.5" r="2.5"/>
                    <circle cx="18.5" cy="18.5" r="2.5"/>
                  </svg>
                </div>
                <span class="step-name">Transit</span>
              </div>
              <div class="step-connector"></div>
              <div class="progress-step pending">
                <div class="step-icon-circle">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z"/>
                  </svg>
                </div>
                <span class="step-name">Market</span>
              </div>
            </div>

            <!-- Pickup & Drop-off -->
            <div class="route-info-block">
              <div class="route-row">
                <span class="route-type-tag pickup-tag">PICKUP</span>
                <div class="route-detail">
                  <span class="route-location">{{ order.product?.user?.location || 'Takoradi Market' }}</span>
                  <span class="route-party">{{ order.product?.user?.name || 'Local Farmer' }}</span>
                </div>
              </div>
              <div class="route-connector-line"></div>
              <div class="route-row">
                <span class="route-type-tag dropoff-tag">DROP-OFF</span>
                <div class="route-detail">
                  <span class="route-location">{{ order.buyer?.location || 'Tarkwa Center' }}</span>
                  <span class="route-party">{{ order.buyer?.name || 'Local Buyer' }}</span>
                </div>
              </div>
            </div>

            <!-- Cargo Info -->
            <div class="cargo-chip">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
              </svg>
              {{ order.quantity_ordered }}x {{ order.product?.name || 'Fresh Produce' }}
            </div>

            <!-- Action Buttons: Picked Up + Delivered -->
            <div class="trip-action-buttons">
              <button class="btn-picked-up" :disabled="processingId === order.id" @click.prevent="triggerAlert('Picked Up: This marks that you have collected the produce from the farm pickup point. Full logistics tracking integration is scheduled for Phase 4 completion.')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
                Picked Up
              </button>
              <button
                class="btn-delivered"
                @click="completeJob(order.id)"
                :disabled="processingId === order.id"
              >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
                <span v-if="processingId === order.id">Updating...</span>
                <span v-else>Delivered</span>
              </button>
            </div>
          </div>
        </div>
      </section>

      <div class="section-divider"></div>

      <!-- ═══ AVAILABLE DELIVERY JOBS SECTION ═══ -->
      <section class="section-block">
        <div class="section-header">
          <div>
            <h2 class="section-title">Available Delivery Jobs</h2>
            <p class="section-subtitle">Accept jobs to coordinate local vegetable transport</p>
          </div>
          <span class="nearby-badge">{{ orders.length }} NEARBY</span>
        </div>

        <!-- Empty Jobs State -->
        <div v-if="orders.length === 0" class="empty-jobs-card">
          <svg xmlns="http://www.w3.org/2000/svg" class="empty-state-svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="1" y="3" width="15" height="13"/>
            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
            <circle cx="5.5" cy="18.5" r="2.5"/>
            <circle cx="18.5" cy="18.5" r="2.5"/>
          </svg>
          <h3 class="empty-title">No Deliveries Available</h3>
          <p class="empty-sub">There are currently no pending orders awaiting a driver. Check back later.</p>
        </div>

        <!-- Available Jobs List -->
        <div v-else class="jobs-list">
          <div v-for="order in orders" :key="order.id" class="job-card">
            <!-- Top Row: Payout + Distance -->
            <div class="job-top-row">
              <div class="job-payout-block">
                <span class="est-payout-label">EST. PAYOUT</span>
                <span class="est-payout-amount">
                  GHS {{ order.estimated_transport_cost
                    ? Number(order.estimated_transport_cost).toFixed(2)
                    : Number(order.total_price).toFixed(2) }}
                </span>
              </div>
              <span class="distance-badge">↕ ~{{ Math.floor(Math.random() * 20 + 3) }}.{{ Math.floor(Math.random() * 9) }} km</span>
            </div>

            <!-- Route Block -->
            <div class="job-route-block">
              <div class="job-route-row">
                <span class="pickup-dot-icon"></span>
                <div class="job-route-text">
                  <span class="job-route-label">From:</span>
                  <span class="job-route-value">{{ order.product?.user?.location || 'Takoradi Market' }}</span>
                  <span class="job-cargo-sub">{{ order.quantity_ordered }}x {{ order.product?.name || 'Produce' }}</span>
                </div>
              </div>
              <div class="job-route-line"></div>
              <div class="job-route-row">
                <span class="dropoff-dot-icon"></span>
                <div class="job-route-text">
                  <span class="job-route-label">To:</span>
                  <span class="job-route-value">{{ order.buyer?.location || 'Tarkwa Center' }}</span>
                </div>
              </div>
            </div>

            <!-- Accept Job Button -->
            <button
              @click="acceptJob(order.id)"
              :disabled="processingId === order.id"
              class="btn-accept-job"
            >
              <span v-if="processingId === order.id">Accepting...</span>
              <span v-else>Accept Job</span>
            </button>
          </div>
        </div>
      </section>
    </main>

    <!-- Mobile Bottom Navigation Bar (Stitch style — teal accent) -->
    <nav class="mobile-bottom-nav">
      <Link href="/driver/dashboard" class="mobile-nav-item active">
        <div class="nav-active-pill">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="1" y="3" width="15" height="13"/>
            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
            <circle cx="5.5" cy="18.5" r="2.5"/>
            <circle cx="18.5" cy="18.5" r="2.5"/>
          </svg>
          <span class="nav-label">Deliveries</span>
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

    const triggerAlert = (msg) => {
      alert(msg);
    };

    return {
      processingId,
      acceptJob,
      completeJob,
      triggerAlert
    };
  }
}
</script>

<style scoped>
@import "../../css/design-tokens.css";

/* ── Outer Wrapper ── */
.driver-wrapper {
  max-width: 480px;
  width: 100%;
  margin: 0 auto;
  background-color: var(--color-neutral-50);
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  position: relative;
  box-shadow: 0 0 20px rgba(0,0,0,0.05);
  padding-bottom: calc(var(--bottom-nav-height) + var(--space-4));
  font-family: var(--font-family);
  color: var(--color-neutral-900);
}

/* ── Header ── */
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
  color: var(--color-tertiary);
}

.logo-icon { color: var(--color-tertiary); }

.app-logo-text {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  letter-spacing: -0.5px;
  color: var(--color-neutral-900);
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

.icon-action-btn:hover { background-color: var(--color-neutral-100); }

/* ── Flash ── */
.flash-alert {
  margin: var(--space-3) var(--space-4);
  padding: var(--space-3) var(--space-4);
  background-color: var(--color-tertiary-subtle);
  border: 1px solid var(--color-tertiary-light);
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  color: var(--color-tertiary);
  font-weight: var(--font-weight-semibold);
}

/* ── Main ── */
.main-content {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.section-block {
  padding: var(--space-4);
}

.section-divider {
  height: 6px;
  background-color: var(--color-neutral-100);
  border-top: 1px solid var(--color-border);
  border-bottom: 1px solid var(--color-border);
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: var(--space-4);
}

.section-title {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0 0 2px 0;
}

.section-subtitle {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  margin: 0;
}

/* ── Nearby Badge ── */
.nearby-badge {
  background-color: var(--color-tertiary);
  color: var(--color-white);
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  padding: 3px var(--space-2);
  border-radius: var(--radius-sm);
  letter-spacing: 0.5px;
  white-space: nowrap;
  flex-shrink: 0;
}

/* ── Empty States ── */
.empty-active-card {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-8) var(--space-4);
  text-align: center;
  box-shadow: var(--shadow-xs);
}

.empty-jobs-card {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-10) var(--space-4);
  text-align: center;
  box-shadow: var(--shadow-xs);
}

.empty-state-svg {
  color: var(--color-neutral-300);
  margin-bottom: var(--space-3);
}

.empty-title {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0 0 var(--space-2) 0;
}

.empty-sub {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  margin: 0;
  max-width: 260px;
  margin: 0 auto;
}

/* ── Active Trip Card ── */
.active-trips-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
}

.active-trip-card {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-4);
  box-shadow: var(--shadow-sm);
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
  border-left: 4px solid var(--color-tertiary);
}

/* Status & Payout Row */
.trip-status-row {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.in-progress-badge {
  background-color: var(--color-tertiary);
  color: var(--color-white);
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  padding: 4px var(--space-2);
  border-radius: var(--radius-sm);
  letter-spacing: 0.8px;
}

.payout-col {
  text-align: right;
  display: flex;
  flex-direction: column;
}

.payout-label-sm {
  font-size: 9px;
  text-transform: uppercase;
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-bold);
  letter-spacing: 0.5px;
}

.payout-amount {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

/* Progress Steps */
.progress-steps-row {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0;
}

.progress-step {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 4px;
  flex-shrink: 0;
}

.step-icon-circle {
  width: 36px;
  height: 36px;
  border-radius: var(--radius-full);
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid var(--color-border);
  background-color: var(--color-neutral-50);
  color: var(--color-neutral-500);
}

.progress-step.completed .step-icon-circle {
  background-color: var(--color-tertiary-subtle);
  border-color: var(--color-tertiary);
  color: var(--color-tertiary);
}

.progress-step.active .step-icon-circle {
  background-color: var(--color-tertiary);
  border-color: var(--color-tertiary);
  color: var(--color-white);
  box-shadow: 0 0 0 3px rgba(42,157,143,0.2);
}

.step-name {
  font-size: 9px;
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-500);
  text-transform: uppercase;
  letter-spacing: 0.3px;
}

.progress-step.active .step-name { color: var(--color-tertiary); }
.progress-step.completed .step-name { color: var(--color-tertiary); }

.step-connector {
  flex: 1;
  height: 2px;
  background: linear-gradient(to right, var(--color-tertiary), var(--color-border));
  margin-bottom: 18px;
  min-width: 24px;
}

/* Route Info */
.route-info-block {
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-md);
  padding: var(--space-3);
  display: flex;
  flex-direction: column;
  gap: 0;
}

.route-row {
  display: flex;
  align-items: flex-start;
  gap: var(--space-3);
}

.route-type-tag {
  font-size: 9px;
  font-weight: var(--font-weight-bold);
  padding: 2px var(--space-2);
  border-radius: var(--radius-sm);
  letter-spacing: 0.5px;
  white-space: nowrap;
  flex-shrink: 0;
  margin-top: 2px;
}

.pickup-tag {
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary);
}

.dropoff-tag {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary-hover);
}

.route-connector-line {
  width: 2px;
  height: 12px;
  background-color: var(--color-border);
  margin: 4px 0 4px 22px;
}

.route-detail {
  display: flex;
  flex-direction: column;
  gap: 1px;
}

.route-location {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.route-party {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

/* Cargo chip */
.cargo-chip {
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
  background-color: var(--color-primary-subtle);
  color: var(--color-primary-hover);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  padding: 4px var(--space-3);
  border-radius: var(--radius-pill);
  border: 1px solid var(--color-primary-lighter);
}

/* Trip Action Buttons */
.trip-action-buttons {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-3);
}

.btn-picked-up {
  height: 40px;
  background-color: var(--color-secondary);
  color: var(--color-white);
  border: none;
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
  transition: opacity var(--transition-fast);
}

.btn-picked-up:hover { opacity: 0.9; }
.btn-picked-up:disabled { opacity: 0.5; cursor: not-allowed; }

.btn-delivered {
  height: 40px;
  background-color: var(--color-tertiary);
  color: var(--color-white);
  border: none;
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
  transition: opacity var(--transition-fast);
}

.btn-delivered:hover { opacity: 0.9; }
.btn-delivered:disabled { opacity: 0.5; cursor: not-allowed; }

/* ── Available Job Cards ── */
.jobs-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
}

.job-card {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-4);
  box-shadow: var(--shadow-sm);
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

.job-top-row {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.job-payout-block {
  display: flex;
  flex-direction: column;
  gap: 1px;
}

.est-payout-label {
  font-size: 9px;
  text-transform: uppercase;
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-500);
  letter-spacing: 0.5px;
}

.est-payout-amount {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-secondary);
}

.distance-badge {
  background-color: var(--color-neutral-100);
  color: var(--color-neutral-700);
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  padding: 3px var(--space-2);
  border-radius: var(--radius-sm);
  border: 1px solid var(--color-border);
  flex-shrink: 0;
}

/* Job route block */
.job-route-block {
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-md);
  padding: var(--space-3);
  display: flex;
  flex-direction: column;
  gap: 0;
}

.job-route-row {
  display: flex;
  align-items: flex-start;
  gap: var(--space-3);
}

.pickup-dot-icon, .dropoff-dot-icon {
  width: 10px;
  height: 10px;
  border-radius: var(--radius-full);
  flex-shrink: 0;
  margin-top: 4px;
}

.pickup-dot-icon {
  background-color: var(--color-tertiary);
  box-shadow: 0 0 0 3px rgba(42,157,143,0.2);
}

.dropoff-dot-icon {
  background-color: var(--color-primary);
  box-shadow: 0 0 0 3px rgba(45,106,79,0.2);
}

.job-route-line {
  width: 2px;
  height: 14px;
  background-color: var(--color-border);
  margin: 4px 0 4px 4px;
}

.job-route-text {
  display: flex;
  flex-direction: column;
  gap: 1px;
}

.job-route-label {
  font-size: 9px;
  text-transform: uppercase;
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-bold);
  letter-spacing: 0.5px;
}

.job-route-value {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.job-cargo-sub {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

/* Accept Job Button */
.btn-accept-job {
  width: 100%;
  height: 42px;
  background-color: var(--color-primary-hover);
  color: var(--color-white);
  border: none;
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
  transition: opacity var(--transition-fast);
  letter-spacing: 0.3px;
}

.btn-accept-job:hover { opacity: 0.9; }
.btn-accept-job:disabled { opacity: 0.5; cursor: not-allowed; }

/* ── Mobile Bottom Navigation Bar ── */
.mobile-bottom-nav {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  max-width: 480px;
  margin: 0 auto;
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
  width: 33.33%;
  height: 100%;
  font-weight: var(--font-weight-semibold);
  transition: all var(--transition-fast);
  background: none;
  border: none;
  cursor: pointer;
}

.mobile-nav-item .nav-label {
  font-size: 9px;
  margin-top: 2px;
}

.mobile-nav-item.active {
  color: var(--color-tertiary);
}

.mobile-nav-item.active .nav-active-pill {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-1);
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary);
  padding: 6px var(--space-3);
  border-radius: var(--radius-pill);
}

.mobile-nav-item.active .nav-label {
  font-size: 10px;
  margin-top: 0;
}
</style>
