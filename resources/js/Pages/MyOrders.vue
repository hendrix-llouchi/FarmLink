<template>
  <div class="orders-wrapper">
    <!-- Header -->
    <header class="header">
      <div class="header-content">
        <div class="brand">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2E7D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
          </svg>
          <span class="logo-text">FarmLink</span>
        </div>
        <div class="user-greeting">
          <span class="greeting-text">Buyer Portal</span>
          <Link href="/buyer/browse" class="header-nav-link">Browse</Link>
          <Link href="/buyer/orders" class="header-nav-link active">My Orders</Link>
          <Link href="/logout" method="post" as="button" class="logout-link-btn">Log Out</Link>
        </div>
      </div>
    </header>

    <!-- Main Content Wrapped in Responsive Container -->
    <main class="main-content">
      <div class="orders-container">
        <div class="page-header">
          <h1 class="page-title">My Orders</h1>
          <span class="orders-count">{{ orders.length }} order(s) placed</span>
        </div>

        <!-- Empty State -->
        <div v-if="orders.length === 0" class="empty-state">
          <div class="empty-icon">🛒</div>
          <p class="empty-text">You haven't placed any orders yet.</p>
          <Link href="/buyer/browse" class="btn-primary-link">Browse Fresh Produce</Link>
        </div>

        <!-- Orders List -->
        <div v-else class="orders-list">
          <div v-for="order in orders" :key="order.id" class="order-card">
            <!-- Header Row: ID and Status -->
            <div class="order-card-header">
              <span class="order-id">Order #{{ order.id }}</span>
              <span class="status-badge" :class="order.status">
                {{ formatStatus(order.status) }}
              </span>
            </div>

            <!-- Body: Product Info and Image -->
            <div class="order-card-body">
              <div class="product-info-row">
                <div class="product-image-wrapper">
                  <img 
                    v-if="order.product?.image_path" 
                    :src="'/storage/' + order.product.image_path" 
                    :alt="order.product.name" 
                    class="product-image"
                  />
                  <div v-else class="product-placeholder">🍅</div>
                </div>

                <div class="product-details">
                  <h2 class="product-name">{{ order.product?.name || 'Unknown Produce' }}</h2>
                  <span class="category-tag">{{ order.product?.category || 'General' }}</span>
                  <div class="price-calculations">
                    <span class="qty">Qty: {{ order.quantity_ordered }}</span>
                    <span class="divider">•</span>
                    <span class="unit-price">GH₵ {{ Number(order.product?.price || 0).toFixed(2) }} / unit</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Divider -->
            <div class="card-divider"></div>

            <!-- Footer: Farmer and Total Price -->
            <div class="order-card-footer">
              <div class="farmer-details">
                <span class="farmer-label">Farmer:</span>
                <span class="farmer-name">{{ order.product?.user?.name || 'Local Farmer' }}</span>
                <span class="farmer-location">📍 {{ order.product?.user?.location || 'Takoradi' }}</span>
              </div>
              <div class="total-price-section">
                <span class="total-label">Total Paid:</span>
                <span class="total-price">GH₵ {{ Number(order.total_price).toFixed(2) }}</span>
              </div>
            </div>

            <!-- Action Row: Rate Order -->
            <div v-if="order.status === 'delivered'" class="order-actions-row">
              <div v-if="order.buyer_rating" class="rating-display">
                <span class="rating-stars">⭐ Rated: {{ order.buyer_rating.score }}/5</span>
                <span class="rating-comment" v-if="order.buyer_rating.comment">"{{ order.buyer_rating.comment }}"</span>
              </div>
              <button 
                v-else 
                @click="openRateModal(order)"
                class="btn-rate-order"
              >
                Rate Order
              </button>
            </div>

            <!-- Subtext: Order Date -->
            <div class="order-date-row">
              Ordered on {{ formatDate(order.created_at) }}
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Rating Modal -->
    <div v-if="isModalOpen" class="modal-overlay">
      <div class="modal-card">
        <div class="modal-header">
          <h2 class="modal-title">Rate Order #{{ selectedOrder?.id }}</h2>
          <button @click="closeRateModal" class="btn-close-modal">&times;</button>
        </div>
        <div class="modal-body">
          <p class="modal-instructions">Rate your experience with <strong>{{ selectedOrder?.product?.user?.name }}</strong>:</p>
          
          <!-- Star selection -->
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
          <span v-if="errors.score" class="form-error" style="text-align: center; display: block;">{{ errors.score }}</span>

          <!-- Optional comment -->
          <div class="form-group">
            <label for="comment-input" class="form-label">Review Comment (Optional)</label>
            <textarea 
              id="comment-input" 
              v-model="ratingForm.comment" 
              placeholder="Tell us about the quality of the produce or delivery..."
              class="form-textarea"
              rows="3"
            ></textarea>
            <span v-if="errors.comment" class="form-error">{{ errors.comment }}</span>
          </div>
        </div>
        <div class="modal-footer">
          <button @click="closeRateModal" class="btn-secondary" :disabled="isSubmitting">Cancel</button>
          <button @click="submitRating" class="btn-submit" :disabled="isSubmitting || !ratingForm.score">
            {{ isSubmitting ? 'Submitting...' : 'Submit Feedback' }}
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Bottom Navigation (Design Brief requirement) -->
    <nav class="mobile-nav hide-desktop">
      <Link href="/buyer/browse" class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <span class="nav-label">Browse</span>
      </Link>
      <Link href="/buyer/orders" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
        </svg>
        <span class="nav-label">Orders</span>
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
      submitRating
    };
  }
}
</script>

<style scoped>
* {
  box-sizing: border-box;
}

.orders-wrapper {
  min-height: 100vh;
  background-color: #F7F8F5;
  color: #1A1A1A;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  padding-bottom: 80px; /* space for mobile nav */
}

/* Header styling */
.header {
  background-color: #FFFFFF;
  border-bottom: 1px solid #E0E0DA;
  position: sticky;
  top: 0;
  z-index: 10;
}

.header-content {
  max-width: 1000px;
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

.header-nav-link {
  font-size: 14px;
  font-weight: 500;
  color: #6B6B63;
  text-decoration: none;
  padding: 4px 8px;
  border-radius: 6px;
  transition: all 0.2s ease;
}

.header-nav-link:hover {
  color: #2E7D32;
  background-color: #F7F8F5;
}

.header-nav-link.active {
  color: #2E7D32;
  background-color: #E8F5E9;
}

.greeting-text {
  font-size: 14px;
  color: #6B6B63;
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

/* Container constraints for layout stretching prevention */
.orders-container {
  max-width: 448px; /* max-w-md */
  margin: 0 auto;
  padding: 0 16px;
  width: 100%;
}

@media (min-width: 768px) {
  .orders-container {
    max-width: 896px; /* md:max-w-4xl */
  }
}

.main-content {
  padding-top: 24px;
  padding-bottom: 24px;
}

.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.page-title {
  font-size: 24px;
  font-weight: 500;
  color: #1A1A1A;
  margin: 0;
}

.orders-count {
  font-size: 14px;
  color: #6B6B63;
}

/* Empty State */
.empty-state {
  background-color: #FFFFFF;
  border: 1px solid #E0E0DA;
  border-radius: 12px;
  padding: 40px 20px;
  text-align: center;
  box-shadow: 0 1px 2px rgba(0,0,0,0.06);
}

.empty-icon {
  font-size: 48px;
  margin-bottom: 16px;
}

.empty-text {
  font-size: 16px;
  color: #6B6B63;
  margin-bottom: 20px;
}

.btn-primary-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  height: 44px;
  padding: 0 24px;
  font-size: 15px;
  font-weight: 500;
  color: #FFFFFF;
  background-color: #2E7D32;
  border-radius: 8px;
  text-decoration: none;
  transition: background-color 0.2s ease;
}

.btn-primary-link:hover {
  background-color: #1B5E20;
}

/* Orders List & Card */
.orders-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.order-card {
  background-color: #FFFFFF;
  border: 1px solid #E0E0DA;
  border-radius: 12px;
  padding: 16px;
  box-shadow: 0 1px 2px rgba(0,0,0,0.06);
  display: flex;
  flex-direction: column;
}

.order-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}

.order-id {
  font-size: 14px;
  font-weight: 500;
  color: #1A1A1A;
}

/* Status Badge colors matching design.md */
.status-badge {
  font-size: 12px;
  font-weight: 500;
  padding: 4px 8px;
  border-radius: 6px;
}

.status-badge.pending {
  background-color: #FFF8E1;
  color: #B8860B; /* amber warning color */
}

.status-badge.processing {
  background-color: #E3F2FD;
  color: #1976D2;
}

.status-badge.in_transit {
  background-color: #E0F7FA;
  color: #00796B;
}

.status-badge.delivered {
  background-color: #E8F5E9;
  color: #2E7D32; /* success green color */
}

.order-card-body {
  margin-bottom: 12px;
}

.product-info-row {
  display: flex;
  gap: 12px;
}

.product-image-wrapper {
  width: 60px;
  height: 60px;
  border-radius: 8px;
  overflow: hidden;
  background-color: #F7F8F5;
  border: 1px solid #E0E0DA;
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
  font-size: 28px;
}

.product-details {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.product-name {
  font-size: 16px;
  font-weight: 500;
  color: #1A1A1A;
  margin: 0 0 2px 0;
}

.category-tag {
  font-size: 11px;
  color: #6B6B63;
  background-color: #F7F8F5;
  padding: 2px 6px;
  border-radius: 4px;
  width: fit-content;
  margin-bottom: 4px;
}

.price-calculations {
  font-size: 13px;
  color: #6B6B63;
  display: flex;
  gap: 6px;
  align-items: center;
}

.divider {
  color: #E0E0DA;
}

.card-divider {
  height: 1px;
  background-color: #E0E0DA;
  margin-bottom: 12px;
}

.order-card-footer {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  flex-wrap: wrap;
  gap: 12px;
}

.farmer-details {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.farmer-label {
  font-size: 11px;
  color: #6B6B63;
}

.farmer-name {
  font-size: 13px;
  font-weight: 500;
  color: #1A1A1A;
}

.farmer-location {
  font-size: 11px;
  color: #6B6B63;
}

.total-price-section {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}

.total-label {
  font-size: 11px;
  color: #6B6B63;
}

.total-price {
  font-size: 18px;
  font-weight: 500;
  color: #2E7D32;
}

.order-date-row {
  margin-top: 12px;
  font-size: 11px;
  color: #6B6B63;
  border-top: 1px dashed #E0E0DA;
  padding-top: 8px;
  text-align: right;
}

/* Mobile bottom nav */
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
  width: 25%;
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

/* Modal overlay backdrop */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 50;
  padding: 16px;
}

/* Modal Card */
.modal-card {
  background-color: #FFFFFF;
  border-radius: 12px;
  max-width: 400px;
  width: 100%;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px;
  border-bottom: 1px solid #E0E0DA;
}

.modal-title {
  font-size: 18px;
  font-weight: 500;
  color: #1A1A1A;
  margin: 0;
}

.btn-close-modal {
  background: none;
  border: none;
  font-size: 24px;
  color: #6B6B63;
  cursor: pointer;
  padding: 4px;
}

.modal-body {
  padding: 16px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.modal-instructions {
  font-size: 14px;
  color: #6B6B63;
  margin: 0;
}

/* Stars rating */
.stars-rating-container {
  display: flex;
  gap: 8px;
  justify-content: center;
  padding: 8px 0;
}

.star-btn {
  background: none;
  border: none;
  font-size: 36px;
  color: #E0E0DA;
  cursor: pointer;
  transition: color 0.15s ease;
  padding: 4px;
}

.star-btn.active {
  color: #FFB300; /* Amber star color */
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.form-label {
  font-size: 13px;
  font-weight: 500;
  color: #1A1A1A;
}

.form-textarea {
  width: 100%;
  border: 1px solid #E0E0DA;
  border-radius: 8px;
  padding: 10px;
  font-size: 14px;
  font-family: inherit;
  resize: vertical;
  outline: none;
}

.form-textarea:focus {
  border-color: #2E7D32;
}

.form-error {
  font-size: 12px;
  color: #C62828;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 12px;
  padding: 16px;
  border-top: 1px solid #E0E0DA;
  background-color: #F7F8F5;
}

.btn-secondary {
  height: 44px;
  padding: 0 16px;
  border: 1px solid #E0E0DA;
  border-radius: 8px;
  background-color: #FFFFFF;
  color: #1A1A1A;
  font-weight: 500;
  cursor: pointer;
}

.btn-submit {
  height: 44px;
  padding: 0 20px;
  border: none;
  border-radius: 8px;
  background-color: #2E7D32;
  color: #FFFFFF;
  font-weight: 500;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.btn-submit:hover:not(:disabled) {
  background-color: #1B5E20;
}

.btn-submit:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

/* Order action row inside card */
.order-actions-row {
  margin-top: 16px;
  border-top: 1px solid #E0E0DA;
  padding-top: 12px;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.btn-rate-order {
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

.btn-rate-order:hover {
  background-color: #1B5E20;
}

.rating-display {
  display: flex;
  flex-direction: column;
  gap: 4px;
  background-color: #F7F8F5;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #E0E0DA;
}

.rating-stars {
  font-size: 14px;
  font-weight: 500;
  color: #2E7D32;
}

.rating-comment {
  font-size: 13px;
  color: #6B6B63;
  font-style: italic;
}
</style>
