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
        <h1 class="page-title">My Orders</h1>
        <span class="orders-count-badge">{{ orders.length }} order(s) placed</span>
      </div>

      <!-- Empty State -->
      <div v-if="orders.length === 0" class="empty-state">
        <div class="empty-icon">🛒</div>
        <h3>No orders placed yet</h3>
        <p>You haven't purchased any fresh produce from local smallholders yet.</p>
        <Link href="/buyer/browse" class="browse-btn-link">Browse Produce</Link>
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
                  :src="'/storage/' + order.product.image_path" 
                  :alt="order.product.name" 
                  class="product-image"
                />
                <div v-else class="product-placeholder">🥦</div>
              </div>

              <div class="product-details">
                <h3 class="product-name">{{ order.product?.name || 'Fresh Produce' }}</h3>
                <span class="category-tag-pill" :class="order.product?.category.toLowerCase().replace('/', '-')">
                  {{ order.product?.category || 'Vegetable' }}
                </span>
                <div class="price-calculations">
                  <span class="qty-lbl">Qty: {{ order.quantity_ordered }}</span>
                  <span class="dot-divider">•</span>
                  <span class="price-unit-lbl">GH₵ {{ Number(order.product?.price || 0).toFixed(2) }} / unit</span>
                </div>
              </div>
            </div>
          </div>

          <div class="card-divider"></div>

          <!-- Farmer details & Total payment -->
          <div class="order-card-footer">
            <div class="farmer-meta">
              <span class="farmer-label">Farmer:</span>
              <span class="farmer-name">{{ order.product?.user?.name || 'Local Farmer' }}</span>
              <span class="farmer-location">📍 {{ order.product?.user?.location || 'Takoradi' }}</span>
            </div>
            <div class="total-paid-meta">
              <span class="total-label">Total Paid:</span>
              <span class="total-value">GH₵ {{ Number(order.total_price).toFixed(2) }}</span>
            </div>
          </div>

          <!-- Rating Action Row (Delivered orders) -->
          <div v-if="order.status === 'delivered'" class="order-actions-row">
            <div v-if="order.buyer_rating" class="rating-display-box">
              <div class="rated-stars-row">
                <span class="star-rating-icon">⭐</span>
                <span class="rated-score">Rated {{ order.buyer_rating.score }}/5</span>
              </div>
              <p class="rated-comment" v-if="order.buyer_rating.comment">"{{ order.buyer_rating.comment }}"</p>
            </div>
            <button 
              v-else 
              @click="openRateModal(order)"
              class="rate-order-btn"
            >
              Rate Order
            </button>
          </div>

          <!-- Bottom Meta: Order Timestamp -->
          <div class="order-timestamp">
            Ordered on {{ formatDate(order.created_at) }}
          </div>
        </div>
      </div>
    </main>

    <!-- Escrow Feedback / Rating Modal Dialog -->
    <div v-if="isModalOpen" class="modal-overlay" @click.self="closeRateModal">
      <div class="modal-card">
        <div class="modal-header">
          <h2 class="modal-title">Rate Order #{{ selectedOrder?.id }}</h2>
          <button @click="closeRateModal" class="btn-close-modal" aria-label="Close modal">&times;</button>
        </div>
        
        <div class="modal-body">
          <p class="modal-instructions">Rate your experience with farmer <strong>{{ selectedOrder?.product?.user?.name }}</strong>:</p>
          
          <!-- Interactive Star Selector -->
          <div class="stars-rating-container">
            <button 
              v-for="star in 5" 
              :key="star" 
              type="button"
              @click="ratingForm.score = star" 
              class="star-btn"
              :class="{ active: star <= ratingForm.score }"
            >
              ★
            </button>
          </div>
          <span v-if="errors.score" class="error-validation-text">{{ errors.score }}</span>

          <!-- Optional Review Comment -->
          <div class="form-group-custom">
            <label for="comment-input" class="form-input-label">Review Comment (Optional)</label>
            <textarea 
              id="comment-input" 
              v-model="ratingForm.comment" 
              placeholder="Tell us about the quality of the produce or delivery..."
              class="form-textarea-input"
              rows="3"
            ></textarea>
            <span v-if="errors.comment" class="error-validation-text">{{ errors.comment }}</span>
          </div>
        </div>
        
        <div class="modal-footer-actions">
          <button @click="closeRateModal" class="btn-checkout-secondary" :disabled="isSubmitting">Cancel</button>
          <button @click="submitRating" class="btn-checkout-primary" :disabled="isSubmitting || !ratingForm.score">
            {{ isSubmitting ? 'Submitting...' : 'Submit Feedback' }}
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Bottom Navigation Bar (Stitch style) -->
    <nav class="mobile-bottom-nav">

      <Link href="/buyer/browse" class="mobile-nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
        </svg>
        <span class="nav-label">Market</span>
      </Link>
      <Link href="/buyer/orders" class="mobile-nav-item active">
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
import { ref, reactive } from 'vue';

export default {
  name: 'MyOrders',
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
    const isModalOpen = ref(false);
    const selectedOrder = ref(null);
    const isSubmitting = ref(false);
    const errors = reactive({
      score: null,
      comment: null
    });

    const ratingForm = reactive({
      score: 0,
      comment: ''
    });

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

    const openRateModal = (order) => {
      selectedOrder.value = order;
      ratingForm.score = 0;
      ratingForm.comment = '';
      errors.score = null;
      errors.comment = null;
      isModalOpen.value = true;
    };

    const closeRateModal = () => {
      isModalOpen.value = false;
      selectedOrder.value = null;
    };

    const submitRating = () => {
      if (!ratingForm.score) {
        errors.score = 'Please select a rating score.';
        return;
      }

      isSubmitting.value = true;
      router.post(`/buyer/orders/${selectedOrder.value.id}/rate`, {
        score: ratingForm.score,
        comment: ratingForm.comment
      }, {
        onSuccess: () => {
          closeRateModal();
        },
        onError: (err) => {
          errors.score = err.score || null;
          errors.comment = err.comment || err.order || null;
        },
        onFinish: () => {
          isSubmitting.value = false;
        }
      });
    };

    const triggerAlert = (msg) => {
      alert(msg);
    };

    return {
      formatDate,
      formatStatus,
      isModalOpen,
      selectedOrder,
      ratingForm,
      isSubmitting,
      errors,
      openRateModal,
      closeRateModal,
      submitRating,
      triggerAlert
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
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0;
}

.orders-count-badge {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-semibold);
}

/* Empty State */
.empty-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: var(--space-10) var(--space-4);
  gap: var(--space-2);
}

.empty-icon {
  font-size: var(--font-size-3xl);
}

.empty-state h3 {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0;
}

.empty-state p {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  margin: 0 var(--space-2) var(--space-4) var(--space-2);
}

.browse-btn-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background-color: var(--color-primary);
  color: var(--color-white);
  padding: 0 var(--space-4);
  height: 40px;
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  text-decoration: none;
  transition: background-color var(--transition-fast);
}

.browse-btn-link:hover {
  background-color: var(--color-primary-hover);
}

/* Stacked Orders List */
.orders-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
}

.order-card {
  background-color: var(--color-white);
  border: 1px solid var(--color-neutral-100);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-sm);
  padding: var(--space-4);
  display: flex;
  flex-direction: column;
  transition: border-left var(--transition-base);
}

/* Status-based left borders */
.order-card.preparing {
  border-left: 4px solid var(--color-tertiary);
}
.order-card.awaiting_pickup {
  border-left: 4px solid var(--color-secondary);
}
.order-card.in_transit {
  border-left: 4px solid var(--color-primary-light);
}
.order-card.delivered {
  border-left: 4px solid var(--color-primary);
}
.order-card.cancelled {
  border-left: 4px solid var(--color-danger);
}

.order-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: var(--space-3);
}

.order-id {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.status-badge {
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  padding: 2px var(--space-2);
  border-radius: var(--radius-sm);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.status-badge.preparing {
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary-hover);
}

.status-badge.awaiting_pickup {
  background-color: var(--color-warning-light);
  color: var(--color-secondary-dark);
}

.status-badge.in_transit {
  background-color: var(--color-primary-lighter);
  color: var(--color-primary-hover);
}

.status-badge.delivered {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary-hover);
}

.status-badge.cancelled {
  background-color: var(--color-danger-light);
  color: var(--color-danger);
}

/* Card Body detail section */
.order-card-body {
  margin-bottom: var(--space-3);
}

.product-info-row {
  display: flex;
  gap: var(--space-3);
}

.product-img-box {
  width: 56px;
  height: 56px;
  border-radius: var(--radius-md);
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-neutral-100);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  flex-shrink: 0;
}

.product-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.product-placeholder {
  font-size: var(--font-size-lg);
}

.product-details {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 2px;
}

.product-name {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0;
  line-height: var(--line-height-tight);
}

.category-tag-pill {
  font-size: 9px;
  font-weight: var(--font-weight-bold);
  padding: 1px var(--space-2);
  border-radius: var(--radius-pill);
  text-transform: uppercase;
}

.category-tag-pill.vegetable {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary-hover);
}

.category-tag-pill.leafy-green {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary-hover);
}

.category-tag-pill.root-tuber {
  background-color: var(--color-warning-light);
  color: var(--color-secondary-dark);
}

.category-tag-pill.other {
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary);
}

.price-calculations {
  display: flex;
  align-items: center;
  gap: var(--space-1);
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-semibold);
  margin-top: 1px;
}

.dot-divider {
  color: var(--color-neutral-300);
}

.card-divider {
  height: 1px;
  background-color: var(--color-neutral-100);
  margin-bottom: var(--space-3);
}

/* Card footer details */
.order-card-footer {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: var(--space-3);
}

.farmer-meta {
  display: flex;
  flex-direction: column;
  gap: 1px;
}

.farmer-label {
  font-size: 9px;
  text-transform: uppercase;
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-bold);
}

.farmer-name {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.farmer-location {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-medium);
}

.total-paid-meta {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 1px;
}

.total-label {
  font-size: 9px;
  text-transform: uppercase;
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-bold);
}

.total-value {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-bold);
  color: var(--color-primary-hover);
}

/* Ratings displays & Actions */
.order-actions-row {
  margin-top: var(--space-4);
  border-top: 1px solid var(--color-neutral-100);
  padding-top: var(--space-3);
}

.rate-order-btn {
  width: 100%;
  height: 38px;
  border-radius: var(--radius-md);
  background-color: var(--color-primary);
  color: var(--color-white);
  border: none;
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
  transition: background-color var(--transition-fast);
}

.rate-order-btn:hover {
  background-color: var(--color-primary-hover);
}

.rating-display-box {
  display: flex;
  flex-direction: column;
  gap: 2px;
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-border);
  padding: var(--space-3);
  border-radius: var(--radius-md);
}

.rated-stars-row {
  display: flex;
  align-items: center;
  gap: var(--space-1);
}

.star-rating-icon {
  font-size: var(--font-size-xs);
}

.rated-score {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  color: var(--color-secondary-dark);
}

.rated-comment {
  font-size: var(--font-size-xs);
  font-style: italic;
  color: var(--color-neutral-700);
  margin: 2px 0 0 0;
  line-height: var(--line-height-base);
}

.order-timestamp {
  font-size: 10px;
  color: var(--color-neutral-500);
  margin-top: var(--space-3);
  text-align: right;
  font-weight: var(--font-weight-medium);
}

/* Modals & Rating Drawer Overlay */
.modal-overlay {
  position: fixed;
  inset: 0;
  background-color: rgba(33, 37, 41, 0.6);
  z-index: 1000;
  display: flex;
  align-items: flex-end;
  justify-content: center;
}

.modal-card {
  width: 100%;
  max-width: 480px;
  background-color: var(--color-white);
  border-radius: var(--radius-lg) var(--radius-lg) 0 0;
  max-height: 90vh;
  overflow-y: auto;
  position: relative;
  display: flex;
  flex-direction: column;
  box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
  animation: slide-up 0.3s ease-out;
  padding: var(--space-5);
}

@keyframes slide-up {
  from { transform: translateY(100%); }
  to { transform: translateY(0); }
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: var(--space-4);
}

.modal-title {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0;
}

.btn-close-modal {
  background: none;
  border: none;
  font-size: var(--font-size-2xl);
  color: var(--color-neutral-500);
  cursor: pointer;
  line-height: 1;
  padding: 0;
}

.btn-close-modal:hover {
  color: var(--color-neutral-900);
}

.modal-body {
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
  margin-bottom: var(--space-5);
}

.modal-instructions {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-700);
  margin: 0;
}

.stars-rating-container {
  display: flex;
  justify-content: center;
  gap: var(--space-2);
}

.star-btn {
  background: none;
  border: none;
  font-size: 32px;
  color: var(--color-neutral-300);
  cursor: pointer;
  transition: color var(--transition-fast);
}

.star-btn.active {
  color: #FFC107;
}

.form-group-custom {
  display: flex;
  flex-direction: column;
  gap: var(--space-1);
}

.form-input-label {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-semibold);
  color: var(--color-neutral-900);
}

.form-textarea-input {
  border-radius: var(--radius-md);
  border: 1.5px solid var(--color-neutral-300);
  padding: var(--space-3);
  font-size: var(--font-size-sm);
  color: var(--color-neutral-900);
  background-color: var(--color-neutral-50);
  width: 100%;
  resize: vertical;
}

.form-textarea-input:focus {
  border-color: var(--color-primary);
  background-color: var(--color-white);
  outline: none;
}

.error-validation-text {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  color: var(--color-danger);
  margin-top: 2px;
}

.modal-footer-actions {
  display: flex;
  gap: var(--space-3);
}

.btn-checkout-primary {
  flex: 1.5;
  height: 44px;
  background-color: var(--color-primary);
  color: var(--color-white);
  border: none;
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
  transition: background-color var(--transition-fast);
}

.btn-checkout-primary:hover:not(:disabled) {
  background-color: var(--color-primary-hover);
}

.btn-checkout-primary:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.btn-checkout-secondary {
  flex: 1;
  height: 44px;
  background-color: var(--color-white);
  color: var(--color-neutral-700);
  border: 1px solid var(--color-neutral-300);
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-semibold);
  cursor: pointer;
  transition: all var(--transition-fast);
}

.btn-checkout-secondary:hover:not(:disabled) {
  background-color: var(--color-neutral-100);
}

/* Mobile Bottom Navigation Bar (Stitch style) */
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
  width: 25%;
  height: 100%;
  font-weight: var(--font-weight-semibold);
  transition: all var(--transition-fast);
}

.mobile-nav-item .nav-label {
  font-size: 9px;
  margin-top: 2px;
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
</style>
