<template>
  <div class="browse-wrapper">
    <!-- Topbar Header -->
    <header class="app-header">
      <div class="app-logo">
        <svg xmlns="http://www.w3.org/2000/svg" class="logo-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
        </svg>
        <span class="app-logo-text">FarmLink</span>
      </div>
      <div class="header-actions">
        <button class="icon-action-btn" @click.prevent="triggerAlert('Notifications Center: Receive real-time alerts for delivery statuses and order receipts. (Scheduled for Phase 5)')">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
          </svg>
        </button>
        <Link href="/logout" method="post" as="button" class="icon-action-btn logout-header-btn" title="Log Out">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
          </svg>
        </Link>
      </div>
    </header>

    <!-- Search & Location Filters -->
    <section class="search-section">
      <div class="search-inputs-row">
        <div class="search-bar-wrapper">
          <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
          <input 
            v-model="search" 
            @input="debounceSearch"
            type="text" 
            placeholder="Search produce..." 
            class="search-input"
          />
        </div>
        
        <div class="location-filter-wrapper">
          <svg xmlns="http://www.w3.org/2000/svg" class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>
          </svg>
          <input 
            v-model="location" 
            @input="debounceSearch"
            type="text" 
            placeholder="Filter location..." 
            class="location-input"
          />
        </div>
      </div>

      <button v-if="search || category || location" @click="clearFilters" class="clear-filters-btn">
        Clear Filters
      </button>
    </section>

    <!-- Horizontal Categories Scroll Bar -->
    <div class="category-scroll-bar">
      <button 
        class="category-pill" 
        :class="{ active: category === '' }" 
        @click="category = ''; applyFilters();"
      >
        All Produce
      </button>
      <button 
        class="category-pill" 
        :class="{ active: category === 'Vegetable' }" 
        @click="category = 'Vegetable'; applyFilters();"
      >
        Vegetables
      </button>
      <button 
        class="category-pill" 
        :class="{ active: category === 'Leafy Green' }" 
        @click="category = 'Leafy Green'; applyFilters();"
      >
        Leafy Greens
      </button>
      <button 
        class="category-pill" 
        :class="{ active: category === 'Root/Tuber' }" 
        @click="category = 'Root/Tuber'; applyFilters();"
      >
        Roots &amp; Tubers
      </button>
      <button 
        class="category-pill" 
        :class="{ active: category === 'Other' }" 
        @click="category = 'Other'; applyFilters();"
      >
        Others
      </button>
    </div>

    <!-- Seasonal Promo Banner Card -->
    <div class="promo-banner-card">
      <div class="promo-badge">SEASONAL SPECIAL</div>
      <h3 class="promo-title">Bountiful Harvest: Up to 20% Off Bulk Grains</h3>
      <p class="promo-subtitle">Limited time offers from the Western Region.</p>
    </div>

    <!-- Main Results Section -->
    <main class="main-content">
      <div class="section-header">
        <h2 class="section-title">Available Near You</h2>
        <button v-if="search || category || location" class="see-all-btn" @click="clearFilters">See All</button>
      </div>

      <!-- Empty State -->
      <div v-if="products.length === 0" class="empty-state">
        <div class="empty-icon">🥬</div>
        <h3>No produce matches found</h3>
        <p>Try resetting filters or adjusting search queries.</p>
        <button @click="clearFilters" class="reset-filters-btn">Reset Filters</button>
      </div>

      <!-- Vertical Product List Cards -->
      <div v-else class="products-list-stacked">
        <div v-for="product in products" :key="product.id" class="product-card">
          <!-- Card Image & Price Overlay -->
          <div class="product-img-wrapper">
            <img 
              v-if="product.image_path" 
              :src="'/storage/' + product.image_path" 
              :alt="product.name" 
              class="product-image"
            />
            <div v-else class="product-placeholder">🥦</div>
            <div class="price-badge-overlay">GH₵ {{ Number(product.price).toFixed(2) }}</div>
          </div>

          <!-- Card Body details -->
          <div class="product-card-body">
            <div class="title-rating-row">
              <h3 class="product-name">{{ product.name }}</h3>
              <div class="rating-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                  <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                </svg>
                <span>{{ Number(product.user?.average_rating || 0).toFixed(1) }}</span>
              </div>
            </div>

            <div class="location-farmer-row">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="loc-icon">
                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>
              </svg>
              <span>{{ product.user?.location || 'Takoradi' }} • Listed by {{ product.user?.name }}</span>
            </div>

            <div class="tags-row-flex">
              <span class="category-pill-tag" :class="product.category.toLowerCase().replace('/', '-')">
                {{ product.category }}
              </span>
              <span class="custom-badge-tag">Grade A Quality</span>
            </div>

            <button @click="openProductModal(product)" class="place-order-btn">
              Place Order
            </button>
          </div>
        </div>
      </div>
    </main>

    <!-- Product Details Modal (Mobile Money Checkout Drawer) -->
    <div v-if="selectedProduct" class="modal-overlay" @click.self="closeProductModal">
      <div class="modal-card">
        <!-- Close button -->
        <button class="close-btn" @click="closeProductModal" aria-label="Close modal">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>

        <div class="modal-body">
          <div class="modal-img-container">
            <img 
              v-if="selectedProduct.image_path" 
              :src="'/storage/' + selectedProduct.image_path" 
              :alt="selectedProduct.name" 
              class="modal-image"
            />
            <div v-else class="modal-placeholder">🍅</div>
          </div>

          <div class="modal-info-content">
            <span class="modal-category-lbl">{{ selectedProduct.category }}</span>
            <h2 class="modal-title">{{ selectedProduct.name }}</h2>
            <div class="modal-price-lbl">GH₵ {{ Number(selectedProduct.price).toFixed(2) }}</div>

            <div class="modal-divider"></div>

            <!-- Farmer metadata details -->
            <div class="modal-farmer-profile">
              <div class="avatar-circle">
                {{ selectedProduct.user?.name.charAt(0).toUpperCase() }}
              </div>
              <div class="farmer-meta">
                <span class="farmer-label">Listed by Farmer</span>
                <span class="farmer-name">{{ selectedProduct.user?.name }}</span>
                <div class="farmer-location-rating">
                  <span>⭐ {{ Number(selectedProduct.user?.average_rating || 0).toFixed(1) }}</span>
                  <span>•</span>
                  <span>📍 {{ selectedProduct.user?.location || 'Takoradi' }}</span>
                </div>
              </div>
            </div>

            <div class="modal-divider"></div>

            <div class="stock-info-row">
              <span class="label">Stock Available:</span>
              <span class="val">{{ selectedProduct.quantity }} units</span>
            </div>

            <!-- Step-based Checkout form -->
            <div class="checkout-form-container">
              <!-- STEP 1: QUANTITY SELECTION -->
              <div v-if="checkoutStep === 1">
                <div class="input-form-group">
                  <label for="order-qty" class="form-input-label">Quantity to Order</label>
                  <input 
                    id="order-qty" 
                    v-model.number="orderQuantity" 
                    type="number" 
                    min="1" 
                    :max="selectedProduct.quantity" 
                    class="form-number-input"
                    :disabled="processing"
                  />
                </div>

                <!-- Error Display -->
                <div v-if="errorMessage" class="error-alert-text">
                  {{ errorMessage }}
                </div>
                
                <button 
                  @click="checkoutStep = 2" 
                  class="btn-checkout-primary" 
                  :disabled="processing || selectedProduct.quantity <= 0 || orderQuantity < 1 || orderQuantity > selectedProduct.quantity"
                >
                  Proceed to Pay (GH₵ {{ Number(selectedProduct.price * orderQuantity).toFixed(2) }})
                </button>
              </div>

              <!-- STEP 2: PAYMENT METHOD (MoMo) -->
              <div v-if="checkoutStep === 2">
                <div class="checkout-summary-box">
                  <div class="summary-line">
                    <span>Order:</span>
                    <span>{{ orderQuantity }}x {{ selectedProduct.name }}</span>
                  </div>
                  <div class="summary-line total">
                    <span>Total Amount:</span>
                    <span>GH₵ {{ Number(selectedProduct.price * orderQuantity).toFixed(2) }}</span>
                  </div>
                </div>

                <div class="input-form-group">
                  <label class="form-input-label">Mobile Money Network</label>
                  <div class="momo-networks-row">
                    <label class="network-option" :class="{ selected: paymentNetwork === 'MTN' }">
                      <input type="radio" value="MTN" v-model="paymentNetwork" class="hidden-radio" />
                      <span>MTN</span>
                    </label>
                    <label class="network-option" :class="{ selected: paymentNetwork === 'Vodafone' }">
                      <input type="radio" value="Vodafone" v-model="paymentNetwork" class="hidden-radio" />
                      <span>Telecel</span>
                    </label>
                    <label class="network-option" :class="{ selected: paymentNetwork === 'AirtelTigo' }">
                      <input type="radio" value="AirtelTigo" v-model="paymentNetwork" class="hidden-radio" />
                      <span>AT Money</span>
                    </label>
                  </div>
                </div>

                <div class="input-form-group">
                  <label for="momo-num" class="form-input-label">Momo Number</label>
                  <input 
                    id="momo-num" 
                    v-model="paymentNumber" 
                    type="tel" 
                    placeholder="e.g. 0244123456" 
                    class="form-text-input"
                    maxlength="10"
                    :disabled="processing"
                  />
                </div>

                <div class="input-form-group">
                  <label for="momo-pin" class="form-input-label">4-Digit PIN</label>
                  <input 
                    id="momo-pin" 
                    v-model="paymentPin" 
                    type="password" 
                    placeholder="••••" 
                    class="form-text-input"
                    maxlength="4"
                    :disabled="processing"
                  />
                </div>

                <!-- Error Display -->
                <div v-if="errorMessage" class="error-alert-text">
                  {{ errorMessage }}
                </div>

                <div class="momo-action-buttons">
                  <button 
                    @click="startMomoPayment" 
                    class="btn-checkout-primary"
                    :disabled="processing"
                  >
                    Pay GH₵ {{ Number(selectedProduct.price * orderQuantity).toFixed(2) }}
                  </button>
                  <button 
                    @click="checkoutStep = 1" 
                    class="btn-checkout-secondary"
                    :disabled="processing"
                  >
                    Back to Quantity
                  </button>
                </div>
              </div>

              <!-- STEP 3: TRANSACTION PROCESSING OVERLAY -->
              <div v-if="paymentProcessing" class="momo-loader-overlay">
                <div class="momo-spinner"></div>
                <p>Contacting {{ paymentNetwork }} Mobile Money Gateway...</p>
                <p class="subtext">Please check your phone for the PIN prompt request.</p>
              </div>

              <!-- STEP 4: SUCCESS OVERLAY -->
              <div v-if="paymentSuccess" class="momo-success-overlay">
                <div class="success-icon-box">✓</div>
                <h3>Payment Successful!</h3>
                <p>Escrow payment verified. Creating your order now...</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Mobile Bottom Navigation Bar (Stitch style) -->
    <nav class="mobile-bottom-nav">

      <Link href="/buyer/browse" class="mobile-nav-item active">
        <div class="nav-active-pill">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
          </svg>
          <span class="nav-label">Market</span>
        </div>
      </Link>
      <Link href="/buyer/orders" class="mobile-nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
          <line x1="3" y1="6" x2="21" y2="6"/>
          <path d="M16 10a4 4 0 0 1-8 0"/>
        </svg>
        <span class="nav-label">Orders</span>
      </Link>
      <Link href="/" class="mobile-nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
        </svg>
        <span class="nav-label">Account</span>
      </Link>
    </nav>
  </div>
</template>

<script>
import { router, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

export default {
  name: 'BuyerBrowse',
  components: {
    Link
  },
  props: {
    products: {
      type: Array,
      required: true
    },
    filters: {
      type: Object,
      default: () => ({})
    }
  },
  setup(props) {
    const search = ref(props.filters.search || '');
    const category = ref(props.filters.category || '');
    const location = ref(props.filters.location || '');

    const selectedProduct = ref(null);
    const orderQuantity = ref(1);
    const errorMessage = ref('');
    const processing = ref(false);

    // MoMo state variables
    const checkoutStep = ref(1);
    const paymentNetwork = ref('MTN');
    const paymentNumber = ref('');
    const paymentPin = ref('');
    const paymentProcessing = ref(false);
    const paymentSuccess = ref(false);

    let searchTimeout = null;

    const applyFilters = () => {
      router.get('/buyer/browse', {
        search: search.value,
        category: category.value,
        location: location.value
      }, {
        preserveState: true,
        replace: true
      });
    };

    const debounceSearch = () => {
      clearTimeout(searchTimeout);
      searchTimeout = setTimeout(() => {
        applyFilters();
      }, 400);
    };

    const clearFilters = () => {
      search.value = '';
      category.value = '';
      location.value = '';
      router.get('/buyer/browse', {}, {
        preserveState: true,
        replace: true
      });
    };

    const openProductModal = (product) => {
      selectedProduct.value = product;
      orderQuantity.value = 1;
      errorMessage.value = '';
      processing.value = false;
      checkoutStep.value = 1;
      paymentNetwork.value = 'MTN';
      paymentNumber.value = '';
      paymentPin.value = '';
      paymentProcessing.value = false;
      paymentSuccess.value = false;
      document.body.style.overflow = 'hidden';
    };

    const closeProductModal = () => {
      selectedProduct.value = null;
      errorMessage.value = '';
      processing.value = false;
      checkoutStep.value = 1;
      paymentNetwork.value = 'MTN';
      paymentNumber.value = '';
      paymentPin.value = '';
      paymentProcessing.value = false;
      paymentSuccess.value = false;
      document.body.style.overflow = '';
    };

    const startMomoPayment = () => {
      errorMessage.value = '';
      
      // Client-side validations
      if (!paymentNetwork.value) {
        errorMessage.value = 'Please select a Mobile Money network.';
        return;
      }
      if (!paymentNumber.value || !/^[0-9]{10}$/.test(paymentNumber.value)) {
        errorMessage.value = 'Please enter a valid 10-digit Momo Number.';
        return;
      }
      if (!paymentPin.value || !/^[0-9]{4}$/.test(paymentPin.value)) {
        errorMessage.value = 'Please enter a valid 4-digit PIN.';
        return;
      }

      paymentProcessing.value = true;
      processing.value = true;

      // Simulate 2-second processing delay
      setTimeout(() => {
        paymentProcessing.value = false;
        paymentSuccess.value = true;

        // Show successful transaction confirmation for 1.5 seconds, then call placeOrder
        setTimeout(() => {
          placeOrder();
        }, 1500);
      }, 2000);
    };

    const placeOrder = () => {
      router.post('/buyer/orders', {
        product_id: selectedProduct.value.id,
        quantity_ordered: orderQuantity.value,
        payment_network: paymentNetwork.value,
        payment_number: paymentNumber.value,
        payment_pin: paymentPin.value
      }, {
        onSuccess: () => {
          document.body.style.overflow = '';
          processing.value = false;
          closeProductModal();
        },
        onError: (errors) => {
          processing.value = false;
          paymentSuccess.value = false;
          // Go back to payment step to show errors if there's any validation errors
          checkoutStep.value = 2;
          
          if (errors.payment_network) {
            errorMessage.value = errors.payment_network;
          } else if (errors.payment_number) {
            errorMessage.value = errors.payment_number;
          } else if (errors.payment_pin) {
            errorMessage.value = errors.payment_pin;
          } else if (errors.quantity_ordered) {
            errorMessage.value = errors.quantity_ordered;
            checkoutStep.value = 1; // Quantity issue, go back to step 1
          } else {
            errorMessage.value = 'Payment validation failed. Please check your details.';
          }
        }
      });
    };

    const triggerAlert = (msg) => {
      alert(msg);
    };

    return {
      search,
      category,
      location,
      selectedProduct,
      orderQuantity,
      errorMessage,
      processing,
      checkoutStep,
      paymentNetwork,
      paymentNumber,
      paymentPin,
      paymentProcessing,
      paymentSuccess,
      applyFilters,
      debounceSearch,
      clearFilters,
      openProductModal,
      closeProductModal,
      startMomoPayment,
      placeOrder,
      triggerAlert
    };
  }
}
</script>

<style scoped>
@import "../../css/design-tokens.css";

/* Outer wrapper */
.browse-wrapper {
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

/* Search bar styling */
.search-section {
  padding: var(--space-4) var(--space-4) var(--space-2) var(--space-4);
  background-color: var(--color-white);
  display: flex;
  flex-direction: column;
  gap: var(--space-2);
}

.search-inputs-row {
  display: grid;
  grid-template-columns: 1.2fr 0.8fr;
  gap: var(--space-2);
}

.search-bar-wrapper, .location-filter-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.input-icon {
  position: absolute;
  left: var(--space-3);
  color: var(--color-neutral-500);
  width: 16px;
  height: 16px;
  pointer-events: none;
}

.search-input, .location-input {
  width: 100%;
  height: var(--input-height);
  padding: 0 var(--space-3) 0 36px;
  border: 1.5px solid var(--color-neutral-300);
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  color: var(--color-neutral-900);
  background-color: var(--color-neutral-50);
  transition: all var(--transition-fast);
}

.search-input:focus, .location-input:focus {
  border-color: var(--color-primary);
  background-color: var(--color-white);
  outline: none;
}

.clear-filters-btn {
  width: 100%;
  height: 32px;
  border-radius: var(--radius-sm);
  border: 1px solid var(--color-neutral-300);
  background-color: var(--color-neutral-100);
  color: var(--color-neutral-700);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
  transition: all var(--transition-fast);
}

.clear-filters-btn:hover {
  background-color: var(--color-neutral-200);
  color: var(--color-neutral-900);
}

/* Category Pills scrollbar */
.category-scroll-bar {
  display: flex;
  gap: var(--space-2);
  padding: var(--space-2) var(--space-4);
  overflow-x: auto;
  background-color: var(--color-white);
  scrollbar-width: none; /* hide scrollbars Firefox */
}

.category-scroll-bar::-webkit-scrollbar {
  display: none; /* hide scrollbars Chrome/Safari */
}

.category-pill {
  white-space: nowrap;
  padding: 8px var(--space-4);
  border-radius: var(--radius-pill);
  border: none;
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  color: var(--color-primary-hover);
  background-color: var(--color-primary-subtle);
  cursor: pointer;
  transition: all var(--transition-fast);
}

.category-pill.active {
  background-color: var(--color-primary);
  color: var(--color-white);
}

/* Promo Banner Card */
.promo-banner-card {
  margin: var(--space-3) var(--space-4);
  padding: var(--space-5) var(--space-4);
  border-radius: var(--radius-lg);
  background: linear-gradient(135deg, rgba(27, 67, 50, 0.95), rgba(45, 106, 79, 0.8)), url('/images/welcome_hero_banner.png');
  background-size: cover;
  background-position: center;
  color: var(--color-white);
  box-shadow: var(--shadow-sm);
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: var(--space-2);
}

.promo-badge {
  font-size: 9px;
  font-weight: var(--font-weight-bold);
  background-color: var(--color-secondary);
  color: var(--color-secondary-dark);
  padding: 2px var(--space-2);
  border-radius: var(--radius-sm);
  letter-spacing: 0.5px;
}

.promo-title {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-bold);
  line-height: var(--line-height-tight);
  margin: 0;
}

.promo-subtitle {
  font-size: var(--font-size-xs);
  color: rgba(255, 255, 255, 0.85);
  margin: 0;
}

/* Main Content Body */
.main-content {
  padding: var(--space-2) var(--space-4);
  flex: 1;
  display: flex;
  flex-direction: column;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: var(--space-4);
}

.section-title {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0;
}

.see-all-btn {
  background: none;
  border: none;
  color: var(--color-primary);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  cursor: pointer;
}

.see-all-btn:hover {
  text-decoration: underline;
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

.reset-filters-btn {
  background-color: var(--color-primary);
  color: var(--color-white);
  border: none;
  padding: var(--space-2) var(--space-4);
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
  transition: background-color var(--transition-fast);
}

.reset-filters-btn:hover {
  background-color: var(--color-primary-hover);
}

/* Stacked Products Lists */
.products-list-stacked {
  display: flex;
  flex-direction: column;
  gap: var(--space-5);
}

.product-card {
  background-color: var(--color-white);
  border: 1px solid var(--color-neutral-100);
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: var(--shadow-sm);
  display: flex;
  flex-direction: column;
}

.product-img-wrapper {
  width: 100%;
  aspect-ratio: 16 / 9;
  background-color: var(--color-neutral-50);
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.product-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.product-placeholder {
  font-size: var(--font-size-3xl);
}

.price-badge-overlay {
  position: absolute;
  top: var(--space-3);
  right: var(--space-3);
  background-color: var(--color-warning-light);
  color: var(--color-secondary-dark);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  padding: var(--space-1) var(--space-3);
  border-radius: var(--radius-sm);
  box-shadow: var(--shadow-xs);
}

.product-card-body {
  padding: var(--space-4);
  display: flex;
  flex-direction: column;
  gap: var(--space-2);
}

.title-rating-row {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: var(--space-2);
}

.product-name {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0;
  line-height: var(--line-height-tight);
}

.rating-badge {
  display: flex;
  align-items: center;
  gap: 2px;
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-neutral-100);
  padding: 2px var(--space-2);
  border-radius: var(--radius-sm);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  color: var(--color-secondary-dark);
  flex-shrink: 0;
}

.location-farmer-row {
  display: flex;
  align-items: center;
  gap: var(--space-1);
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-semibold);
}

.loc-icon {
  color: var(--color-neutral-500);
  flex-shrink: 0;
}

.tags-row-flex {
  display: flex;
  gap: var(--space-2);
  margin-top: 2px;
}

.category-pill-tag {
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  padding: 2px var(--space-2);
  border-radius: var(--radius-pill);
  text-transform: uppercase;
}

.category-pill-tag.vegetable {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary-hover);
}

.category-pill-tag.leafy-green {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary-hover);
}

.category-pill-tag.root-tuber {
  background-color: var(--color-warning-light);
  color: var(--color-secondary-dark);
}

.category-pill-tag.other {
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary);
}

.custom-badge-tag {
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  padding: 2px var(--space-2);
  border-radius: var(--radius-pill);
  background-color: var(--color-neutral-50);
  border: 1px solid var(--color-neutral-300);
  color: var(--color-neutral-700);
  text-transform: uppercase;
}

.place-order-btn {
  width: 100%;
  height: 40px;
  border-radius: var(--radius-md);
  background-color: var(--color-primary);
  color: var(--color-white);
  border: none;
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
  transition: background-color var(--transition-fast);
  margin-top: var(--space-2);
}

.place-order-btn:hover {
  background-color: var(--color-primary-hover);
}

/* Modals & Momo Checkout Overlay Drawer */
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
}

@keyframes slide-up {
  from { transform: translateY(100%); }
  to { transform: translateY(0); }
}

.close-btn {
  position: absolute;
  top: var(--space-4);
  right: var(--space-4);
  background: none;
  border: none;
  color: var(--color-neutral-500);
  cursor: pointer;
  padding: 4px;
  border-radius: var(--radius-full);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all var(--transition-fast);
  z-index: 10;
}

.close-btn:hover {
  background-color: var(--color-neutral-100);
  color: var(--color-neutral-900);
}

.modal-body {
  display: flex;
  flex-direction: column;
}

.modal-img-container {
  width: 100%;
  aspect-ratio: 16 / 9;
  background-color: var(--color-neutral-50);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.modal-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.modal-placeholder {
  font-size: var(--font-size-4xl);
}

.modal-info-content {
  padding: var(--space-5);
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
  position: relative;
}

.modal-category-lbl {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  color: var(--color-primary);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.modal-title {
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0;
  line-height: var(--line-height-tight);
}

.modal-price-lbl {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-secondary-dark);
}

.modal-divider {
  height: 1px;
  background-color: var(--color-neutral-100);
  margin: var(--space-1) 0;
}

.modal-farmer-profile {
  display: flex;
  align-items: center;
  gap: var(--space-3);
}

.modal-farmer-profile .avatar-circle {
  width: 44px;
  height: 44px;
  border-radius: var(--radius-full);
  background-color: var(--color-primary-subtle);
  color: var(--color-primary-hover);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: var(--font-weight-bold);
  font-size: var(--font-size-md);
  box-shadow: var(--shadow-xs);
}

.farmer-meta {
  display: flex;
  flex-direction: column;
}

.farmer-label {
  font-size: 10px;
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-semibold);
  text-transform: uppercase;
}

.farmer-name {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 1px 0;
}

.farmer-location-rating {
  display: flex;
  align-items: center;
  gap: var(--space-2);
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-semibold);
}

.stock-info-row {
  display: flex;
  justify-content: space-between;
  font-size: var(--font-size-sm);
  background-color: var(--color-neutral-50);
  padding: var(--space-3);
  border-radius: var(--radius-md);
  border: 1px solid var(--color-border);
}

.stock-info-row .label {
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-medium);
}

.stock-info-row .val {
  color: var(--color-neutral-900);
  font-weight: var(--font-weight-bold);
}

/* Checkout Form elements */
.checkout-form-container {
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
  margin-top: var(--space-2);
}

.input-form-group {
  display: flex;
  flex-direction: column;
  gap: var(--space-1);
}

.form-input-label {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-semibold);
  color: var(--color-neutral-900);
}

.form-number-input, .form-text-input {
  height: var(--input-height);
  border-radius: var(--radius-md);
  border: 1.5px solid var(--color-neutral-300);
  padding: 0 var(--space-3);
  font-size: var(--font-size-sm);
  color: var(--color-neutral-900);
  background-color: var(--color-neutral-50);
  width: 100%;
}

.form-number-input:focus, .form-text-input:focus {
  border-color: var(--color-primary);
  background-color: var(--color-white);
  outline: none;
}

.error-alert-text {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  color: var(--color-danger);
  background-color: var(--color-danger-light);
  border: 1px solid var(--color-danger);
  padding: var(--space-3);
  border-radius: var(--radius-md);
}

.btn-checkout-primary {
  width: 100%;
  height: 44px;
  background-color: var(--color-primary);
  color: var(--color-white);
  border: none;
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
  transition: background-color var(--transition-fast);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
}

.btn-checkout-primary:hover:not(:disabled) {
  background-color: var(--color-primary-hover);
}

.btn-checkout-primary:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.btn-checkout-secondary {
  width: 100%;
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

.btn-checkout-secondary:hover {
  background-color: var(--color-neutral-100);
  color: var(--color-neutral-900);
}

/* Step 2 summary */
.checkout-summary-box {
  background-color: var(--color-primary-subtle);
  border: 1.5px solid var(--color-primary-lighter);
  border-radius: var(--radius-md);
  padding: var(--space-3) var(--space-4);
  display: flex;
  flex-direction: column;
  gap: var(--space-1);
}

.summary-line {
  display: flex;
  justify-content: space-between;
  font-size: var(--font-size-xs);
  color: var(--color-primary-hover);
  font-weight: var(--font-weight-medium);
}

.summary-line.total {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  border-top: 1px dashed var(--color-primary-light);
  padding-top: var(--space-2);
  margin-top: 2px;
}

/* Radio buttons momo networks */
.momo-networks-row {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-2);
}

.network-option {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 40px;
  border-radius: var(--radius-md);
  border: 1.5px solid var(--color-neutral-300);
  cursor: pointer;
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  color: var(--color-neutral-700);
  background-color: var(--color-neutral-50);
  transition: all var(--transition-fast);
}

.network-option:hover {
  border-color: var(--color-primary-light);
}

.network-option.selected {
  border-color: var(--color-primary);
  background-color: var(--color-primary-subtle);
  color: var(--color-primary);
}

.hidden-radio {
  display: none !important;
}

.momo-action-buttons {
  display: flex;
  flex-direction: column;
  gap: var(--space-2);
}

/* Momo overlays */
.momo-loader-overlay, .momo-success-overlay {
  position: absolute;
  inset: 0;
  background-color: rgba(255, 255, 255, 0.98);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: var(--space-5);
  text-align: center;
  z-index: 50;
  animation: fade-in 0.2s ease-out;
}

@keyframes fade-in {
  from { opacity: 0; }
  to { opacity: 1; }
}

.momo-loader-overlay p {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: var(--space-4) 0 4px 0;
}

.momo-loader-overlay .subtext {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  margin: 0;
}

.momo-spinner {
  width: 48px;
  height: 48px;
  border: 4px solid var(--color-neutral-100);
  border-top-color: var(--color-primary);
  border-radius: var(--radius-full);
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.success-icon-box {
  width: 56px;
  height: 56px;
  border-radius: var(--radius-full);
  background-color: var(--color-success);
  color: var(--color-white);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 28px;
  font-weight: var(--font-weight-bold);
  margin-bottom: var(--space-4);
  box-shadow: 0 4px 10px rgba(46, 125, 50, 0.2);
}

.momo-success-overlay h3 {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin: 0 0 var(--space-2) 0;
}

.momo-success-overlay p {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  margin: 0;
  max-width: 250px;
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
