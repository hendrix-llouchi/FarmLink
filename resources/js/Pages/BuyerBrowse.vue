<template>
  <div class="browse-wrapper">
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
          <Link href="/buyer/browse" class="header-nav-link active">Browse</Link>
          <Link href="/buyer/orders" class="header-nav-link">My Orders</Link>
          <Link href="/logout" method="post" as="button" class="logout-link-btn">Log Out</Link>
        </div>
      </div>
    </header>

    <!-- Pinned Search & Filter Utility Bar (Jumia/Tonaton structural pattern) -->
    <section class="filter-bar">
      <div class="filter-content">
        <div class="search-input-wrapper">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6B6B63" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="search-icon">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
          <input 
            v-model="search" 
            @input="debounceSearch"
            type="text" 
            placeholder="Search produce..." 
            class="filter-input-search"
          />
        </div>
        
        <div class="selects-row">
          <select v-model="category" @change="applyFilters" class="filter-select">
            <option value="">All Categories</option>
            <option value="Vegetable">Vegetables</option>
            <option value="Leafy Green">Leafy Greens</option>
            <option value="Root/Tuber">Roots & Tubers</option>
            <option value="Other">Others</option>
          </select>

          <input 
            v-model="location" 
            @input="debounceSearch"
            type="text" 
            placeholder="Filter location..." 
            class="filter-input-location"
          />

          <button v-if="search || category || location" @click="clearFilters" class="btn-clear">
            Clear
          </button>
        </div>
      </div>
    </section>

    <!-- Main Content -->
    <main class="main-content">
      <div class="results-info">
        <h1 class="page-title">Browse Fresh Produce</h1>
        <span class="results-count">{{ products.length }} item(s) found</span>
      </div>

      <!-- Empty State -->
      <div v-if="products.length === 0" class="empty-state">
        <p class="empty-text">No listings match your search criteria.</p>
        <button @click="clearFilters" class="btn-reset">View All Listings</button>
      </div>

      <!-- 2-Column Mobile-First Grid Layout (Jumia/Tonaton pattern) -->
      <div v-else class="products-grid">
        <div v-for="product in products" :key="product.id" class="product-card">
          <!-- Image -->
          <div class="product-image-container">
            <img 
              v-if="product.image_path" 
              :src="'/storage/' + product.image_path" 
              :alt="product.name" 
              class="product-image"
            />
            <div v-else class="product-placeholder">
              🍅
            </div>
            <!-- Category Badge overlay -->
            <span class="category-badge">{{ product.category }}</span>
          </div>

          <!-- Content -->
          <div class="product-details">
            <div class="price-row">
              <span class="price">GH₵ {{ Number(product.price).toFixed(2) }}</span>
            </div>
            <h2 class="name">{{ product.name }}</h2>
            
            <div class="farmer-row">
              <span class="farmer-name">{{ product.user?.name }}</span>
              <span class="rating">
                ★ {{ Number(product.user?.average_rating || 0).toFixed(1) }}
              </span>
            </div>

            <div class="location-row">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>
              </svg>
              <span class="location-text">{{ product.user?.location }}</span>
            </div>

            <!-- Call To Action Button -->
            <button @click="openProductModal(product)" class="cta-button">
              Order Now
            </button>
          </div>
        </div>
      </div>
    </main>

    <!-- Product Details Modal (Overlay drawer) -->
    <div v-if="selectedProduct" class="modal-overlay" @click.self="closeProductModal">
      <div class="modal-card">
        <button class="close-btn" @click="closeProductModal">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>

        <div class="modal-body">
          <div class="modal-image-wrapper">
            <img 
              v-if="selectedProduct.image_path" 
              :src="'/storage/' + selectedProduct.image_path" 
              :alt="selectedProduct.name" 
              class="modal-image"
            />
            <div v-else class="modal-placeholder">🍅</div>
          </div>

          <div class="modal-info">
            <span class="modal-category">{{ selectedProduct.category }}</span>
            <h2 class="modal-title">{{ selectedProduct.name }}</h2>
            <div class="modal-price">GH₵ {{ Number(selectedProduct.price).toFixed(2) }}</div>

            <div class="modal-divider"></div>

            <!-- Farmer details -->
            <div class="modal-farmer-info">
              <div class="avatar">
                {{ selectedProduct.user?.name.charAt(0).toUpperCase() }}
              </div>
              <div class="farmer-meta">
                <span class="label">Listed by Farmer</span>
                <span class="name">{{ selectedProduct.user?.name }}</span>
                <div class="location-rating">
                  <span>⭐ {{ Number(selectedProduct.user?.average_rating || 0).toFixed(1) }}</span>
                  <span>•</span>
                  <span>{{ selectedProduct.user?.location }}</span>
                </div>
              </div>
            </div>

            <div class="modal-divider"></div>

            <div class="stock-info">
              <span class="label">Stock Available:</span>
              <span class="val">{{ selectedProduct.quantity }} units</span>
            </div>

            <!-- Quantity select and checkout actions -->
            <!-- Step-based Checkout Actions & Payment -->
            <div class="order-form">
              <!-- STEP 1: QUANTITY SELECTION -->
              <div v-if="checkoutStep === 1">
                <div class="quantity-control">
                  <label for="order-qty">Quantity</label>
                  <input 
                    id="order-qty" 
                    v-model.number="orderQuantity" 
                    type="number" 
                    min="1" 
                    :max="selectedProduct.quantity" 
                    class="qty-input"
                    :disabled="processing"
                  />
                </div>

                <!-- Error Display -->
                <div v-if="errorMessage" class="error-message">
                  {{ errorMessage }}
                </div>
                
                <button 
                  @click="checkoutStep = 2" 
                  class="btn-confirm-order" 
                  :disabled="processing || selectedProduct.quantity <= 0 || orderQuantity < 1 || orderQuantity > selectedProduct.quantity"
                >
                  Proceed to Pay (GH₵ {{ Number(selectedProduct.price * orderQuantity).toFixed(2) }})
                </button>
              </div>

              <!-- STEP 2: MOBILE MONEY PAYMENT FORM -->
              <div v-else-if="checkoutStep === 2 && !paymentProcessing && !paymentSuccess">
                <div class="payment-header-momo">
                  <span class="momo-title">Mobile Money Escrow Payment</span>
                  <span class="momo-subtitle">Funds are held securely in escrow until delivery is complete.</span>
                </div>

                <!-- Network Selection -->
                <div class="form-group-momo">
                  <label class="momo-label">Select Mobile Network</label>
                  <div class="momo-networks-grid">
                    <label class="network-option" :class="{ active: paymentNetwork === 'MTN' }">
                      <input type="radio" value="MTN" v-model="paymentNetwork" class="hidden-radio" />
                      <div class="network-logo mtn-logo"></div>
                      <span class="network-name">MTN MoMo</span>
                    </label>
                    <label class="network-option" :class="{ active: paymentNetwork === 'Telecel' }">
                      <input type="radio" value="Telecel" v-model="paymentNetwork" class="hidden-radio" />
                      <div class="network-logo telecel-logo"></div>
                      <span class="network-name">Telecel Cash</span>
                    </label>
                  </div>
                </div>

                <!-- MoMo Number -->
                <div class="form-group-momo">
                  <label for="momo-number" class="momo-label">Momo Number</label>
                  <input 
                    id="momo-number"
                    type="text" 
                    v-model="paymentNumber"
                    placeholder="e.g. 0541234567" 
                    maxlength="10"
                    class="momo-input"
                  />
                </div>

                <!-- 4-digit PIN -->
                <div class="form-group-momo">
                  <label for="momo-pin" class="momo-label">4-Digit PIN</label>
                  <input 
                    id="momo-pin"
                    type="password" 
                    v-model="paymentPin"
                    placeholder="••••" 
                    maxlength="4"
                    class="momo-input font-mono"
                  />
                </div>

                <!-- Error Display -->
                <div v-if="errorMessage" class="error-message">
                  {{ errorMessage }}
                </div>

                <!-- Action Buttons -->
                <div class="momo-actions">
                  <button @click="checkoutStep = 1; errorMessage = ''" class="btn-momo-back">
                    Back
                  </button>
                  <button @click="startMomoPayment" class="btn-momo-pay">
                    Pay GH₵ {{ Number(selectedProduct.price * orderQuantity).toFixed(2) }}
                  </button>
                </div>
              </div>

              <!-- SIMULATED PROCESSING STATE -->
              <div v-else-if="paymentProcessing" class="momo-status-container">
                <div class="spinner-momo"></div>
                <h3 class="momo-status-title">Authorizing Transaction...</h3>
                <p class="momo-status-desc">Simulating Mobile Money request. Please check your device for a prompt.</p>
              </div>

              <!-- SUCCESS TRANSACTION CONFIRMATION -->
              <div v-else-if="paymentSuccess" class="momo-status-container">
                <div class="success-icon-momo">
                  <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#2E7D32" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                  </svg>
                </div>
                <h3 class="momo-status-title text-success">Payment Approved</h3>
                <p class="momo-status-desc">GH₵ {{ Number(selectedProduct.price * orderQuantity).toFixed(2) }} held in Escrow.</p>
                <p class="momo-status-redirect">Redirecting to your orders...</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile Bottom Navigation (Design Brief requirement) -->
    <nav class="mobile-nav hide-desktop">
      <Link href="/buyer/browse" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <span class="nav-label">Browse</span>
      </Link>
      <Link href="/buyer/orders" class="nav-item">
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
      placeOrder
    };
  }
}
</script>

<style scoped>
* {
  box-sizing: border-box;
}

.browse-wrapper {
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

.error-message {
  color: #C62828;
  font-size: 13px;
  background-color: #FFEBEE;
  padding: 8px 12px;
  border-radius: 8px;
  border: 1px solid #FFCDD2;
  margin-top: 4px;
  margin-bottom: 4px;
  text-align: left;
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

/* Filter utility bar - Tonaton/Jumia pattern */
.filter-bar {
  background-color: #FFFFFF;
  border-bottom: 1px solid #E0E0DA;
  padding: 12px 16px;
  position: sticky;
  top: 49px;
  z-index: 9;
}

.filter-content {
  max-width: 1000px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

@media (min-width: 768px) {
  .filter-content {
    flex-direction: row;
    align-items: center;
  }
}

.search-input-wrapper {
  position: relative;
  flex: 1.5;
  min-width: 0;
}

.search-icon {
  position: absolute;
  left: 12px;
  top: 14px;
}

.filter-input-search {
  width: 100%;
  height: 44px;
  border: 1px solid #E0E0DA;
  border-radius: 8px;
  padding: 0 12px 0 36px;
  font-size: 14px;
  outline: none;
}

.filter-input-search:focus, .filter-select:focus, .filter-input-location:focus {
  border-color: #2E7D32;
}

.selects-row {
  display: flex;
  gap: 8px;
  width: 100%;
  min-width: 0;
}

@media (min-width: 768px) {
  .selects-row {
    width: auto;
    flex: 2;
  }
}

.filter-select {
  height: 44px;
  border: 1px solid #E0E0DA;
  border-radius: 8px;
  padding: 0 8px;
  font-size: 14px;
  flex: 1;
  background-color: #FFFFFF;
  outline: none;
  min-width: 0;
}

.filter-input-location {
  height: 44px;
  border: 1px solid #E0E0DA;
  border-radius: 8px;
  padding: 0 12px;
  font-size: 14px;
  flex: 1;
  outline: none;
  min-width: 0;
}

.btn-clear {
  height: 44px;
  border: 1px solid #C62828;
  color: #C62828;
  background-color: #FFFFFF;
  border-radius: 8px;
  padding: 0 12px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
}

/* Main Area */
.main-content {
  max-width: 1280px;
  margin: 0 auto;
  padding: 24px 16px;
}

.results-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.page-title {
  font-size: 18px;
  font-weight: 500;
  margin: 0;
  color: #1A1A1A;
}

.results-count {
  font-size: 13px;
  color: #6B6B63;
}

.empty-state {
  text-align: center;
  padding: 40px 16px;
  background-color: #FFFFFF;
  border: 1px solid #E0E0DA;
  border-radius: 12px;
}

.empty-text {
  color: #6B6B63;
  margin-bottom: 12px;
}

.btn-reset {
  background-color: #2E7D32;
  color: #FFFFFF;
  border: none;
  border-radius: 8px;
  height: 44px;
  padding: 0 20px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
}

/* 2-Column mobile layout, 3-Column tablet, 4-Column desktop */
.products-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 16px;
}

@media (min-width: 768px) {
  .products-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (min-width: 1024px) {
  .products-grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

.product-card {
  background-color: #FFFFFF;
  border: 1px solid #E0E0DA;
  border-radius: 12px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  box-shadow: 0 1px 2px rgba(0,0,0,0.06);
}

.product-image-container {
  height: 120px;
  position: relative;
  background-color: #F7F8F5;
  border-bottom: 1px solid #E0E0DA;
  display: flex;
  align-items: center;
  justify-content: center;
}

@media (min-width: 768px) {
  .product-image-container {
    height: 160px;
  }
}

.product-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.product-placeholder {
  font-size: 40px;
}

.category-badge {
  position: absolute;
  left: 8px;
  top: 8px;
  background-color: rgba(46, 125, 50, 0.9);
  color: #FFFFFF;
  font-size: 10px;
  font-weight: 500;
  padding: 2px 6px;
  border-radius: 4px;
}

.product-details {
  padding: 10px;
  display: flex;
  flex-direction: column;
  flex: 1;
}

.price-row {
  margin-bottom: 4px;
}

.price {
  font-size: 16px;
  font-weight: 500;
  color: #1B5E20;
}

.name {
  font-size: 13px;
  font-weight: 400;
  color: #1A1A1A;
  margin: 0 0 6px 0;
  line-height: 1.3;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  height: 34px;
}

.farmer-row {
  display: flex;
  justify-content: space-between;
  font-size: 11px;
  color: #6B6B63;
  margin-bottom: 4px;
}

.farmer-name {
  font-weight: 500;
}

.rating {
  color: #B8860B;
  font-weight: 500;
}

.location-row {
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: 11px;
  color: #6B6B63;
  margin-bottom: 10px;
}

.location-text {
  text-overflow: ellipsis;
  overflow: hidden;
  white-space: nowrap;
}

.cta-button {
  width: 100%;
  height: 38px;
  background-color: #2E7D32;
  color: #FFFFFF;
  border: none;
  border-radius: 8px;
  font-size: 13px;
  font-weight: 500;
  cursor: pointer;
  margin-top: auto;
  transition: background-color 0.2s ease;
}

.cta-button:hover {
  background-color: #1B5E20;
}

/* Modal details drawer */
.modal-overlay {
  position: fixed;
  inset: 0;
  background-color: rgba(0,0,0,0.5);
  display: flex;
  align-items: flex-end;
  justify-content: center;
  z-index: 100;
  overflow-y: auto;
}

@media (min-width: 768px) {
  .modal-overlay {
    align-items: center;
    padding: 24px;
  }
}

.modal-card {
  background-color: #FFFFFF;
  border-radius: 16px 16px 0 0;
  width: 100%;
  max-width: 500px;
  position: relative;
  box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
  animation: slide-up 0.2s ease-out;
  max-height: 90vh;
  display: flex;
  flex-direction: column;
}

@media (min-width: 768px) {
  .modal-card {
    border-radius: 12px;
    animation: zoom-in 0.2s ease-out;
    max-height: 85vh;
  }
}

@keyframes slide-up {
  from { transform: translateY(100%); }
  to { transform: translateY(0); }
}

@keyframes zoom-in {
  from { transform: scale(0.95); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}

.close-btn {
  position: absolute;
  right: 12px;
  top: 12px;
  background: #FFFFFF;
  border: 1px solid #E0E0DA;
  border-radius: 50%;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  z-index: 1;
}

.modal-body {
  padding: 16px;
  overflow-y: auto;
  flex: 1;
}

.modal-image-wrapper {
  height: 180px;
  background-color: #F7F8F5;
  border: 1px solid #E0E0DA;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  margin-bottom: 12px;
}

.modal-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.modal-placeholder {
  font-size: 60px;
}

.modal-info {
  display: flex;
  flex-direction: column;
}

.modal-category {
  font-size: 11px;
  color: #2E7D32;
  background-color: #E8F5E9;
  padding: 2px 6px;
  border-radius: 4px;
  font-weight: 500;
  width: fit-content;
  margin-bottom: 4px;
}

.modal-title {
  font-size: 20px;
  font-weight: 500;
  margin: 0 0 6px 0;
  color: #1A1A1A;
}

.modal-price {
  font-size: 22px;
  font-weight: 500;
  color: #1B5E20;
}

.modal-divider {
  height: 1px;
  background-color: #E0E0DA;
  margin: 12px 0;
}

.modal-farmer-info {
  display: flex;
  align-items: center;
  gap: 12px;
}

.modal-farmer-info .avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: #2E7D32;
  color: #FFFFFF;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 500;
  font-size: 18px;
}

.farmer-meta {
  display: flex;
  flex-direction: column;
}

.farmer-meta .label {
  font-size: 11px;
  color: #6B6B63;
}

.farmer-meta .name {
  font-size: 14px;
  font-weight: 500;
  color: #1A1A1A;
}

.location-rating {
  font-size: 11px;
  color: #6B6B63;
  display: flex;
  gap: 4px;
}

.stock-info {
  display: flex;
  justify-content: space-between;
  font-size: 14px;
  margin-bottom: 12px;
}

.stock-info .label {
  color: #6B6B63;
}

.stock-info .val {
  font-weight: 500;
  color: #1A1A1A;
}

.order-form {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.quantity-control {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.quantity-control label {
  font-size: 14px;
  font-weight: 500;
}

.qty-input {
  width: 70px;
  height: 38px;
  border: 1px solid #E0E0DA;
  border-radius: 8px;
  padding: 0 8px;
  font-size: 14px;
  text-align: center;
}

.btn-confirm-order {
  height: 44px;
  background-color: #2E7D32;
  color: #FFFFFF;
  border: none;
  border-radius: 8px;
  font-size: 15px;
  font-weight: 500;
  cursor: pointer;
  width: 100%;
}

.btn-confirm-order:hover {
  background-color: #1B5E20;
}

/* Mobile navigation */
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

/* Mobile Money Escrow Styles */
.payment-header-momo {
  margin-bottom: 16px;
  text-align: left;
}

.momo-title {
  display: block;
  font-size: 14px;
  font-weight: 500;
  color: #1A1A1A;
}

.momo-subtitle {
  display: block;
  font-size: 11px;
  color: #6B6B63;
  line-height: 1.4;
  margin-top: 4px;
}

.form-group-momo {
  margin-bottom: 14px;
  text-align: left;
}

.momo-label {
  display: block;
  font-size: 12px;
  font-weight: 500;
  color: #1A1A1A;
  margin-bottom: 6px;
}

.momo-networks-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
}

.network-option {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 6px;
  border: 1px solid #E0E0DA;
  border-radius: 8px;
  padding: 12px 6px;
  cursor: pointer;
  transition: all 0.2s ease;
  background-color: #FFFFFF;
}

.network-option:hover {
  border-color: #2E7D32;
}

.network-option.active {
  border-color: #2E7D32;
  background-color: #F1F8F2;
}

.hidden-radio {
  display: none;
}

.network-logo {
  width: 24px;
  height: 24px;
  border-radius: 6px;
}

.mtn-logo {
  background-color: #FFCC00;
  position: relative;
}

.mtn-logo::after {
  content: '';
  position: absolute;
  top: 4px;
  left: 4px;
  right: 4px;
  bottom: 4px;
  border-radius: 50%;
  border: 2px solid #003399;
}

.telecel-logo {
  background-color: #E60000;
  position: relative;
}

.telecel-logo::after {
  content: 't';
  color: #FFFFFF;
  font-family: sans-serif;
  font-size: 16px;
  font-weight: bold;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  line-height: 1;
}

.network-name {
  font-size: 11px;
  font-weight: 500;
  color: #1A1A1A;
}

.momo-input {
  width: 100%;
  height: 44px;
  padding: 0 12px;
  border: 1px solid #E0E0DA;
  border-radius: 8px;
  font-size: 14px;
  outline: none;
  background-color: #FFFFFF;
  color: #1A1A1A;
}

.momo-input:focus {
  border-color: #2E7D32;
}

.momo-actions {
  display: flex;
  gap: 10px;
  margin-top: 18px;
}

.btn-momo-back {
  flex: 1;
  height: 44px;
  border: 1px solid #E0E0DA;
  background-color: #FFFFFF;
  color: #1A1A1A;
  border-radius: 8px;
  cursor: pointer;
  font-size: 14px;
  font-weight: 500;
  transition: background-color 0.2s;
}

.btn-momo-back:hover {
  background-color: #F7F8F5;
}

.btn-momo-pay {
  flex: 2;
  height: 44px;
  border: none;
  background-color: #2E7D32;
  color: #FFFFFF;
  border-radius: 8px;
  cursor: pointer;
  font-size: 14px;
  font-weight: 500;
  transition: background-color 0.2s;
}

.btn-momo-pay:hover {
  background-color: #1B5E20;
}

.momo-status-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 24px 12px;
  text-align: center;
}

.spinner-momo {
  width: 44px;
  height: 44px;
  border: 4px solid #E8F5E9;
  border-top: 4px solid #2E7D32;
  border-radius: 50%;
  animation: spin-momo 1s linear infinite;
  margin-bottom: 16px;
}

@keyframes spin-momo {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.success-icon-momo {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background-color: #E8F5E9;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 16px;
}

.momo-status-title {
  font-size: 16px;
  font-weight: 500;
  color: #1A1A1A;
  margin-bottom: 6px;
}

.momo-status-desc {
  font-size: 12px;
  color: #6B6B63;
  max-width: 220px;
  line-height: 1.4;
  margin-bottom: 4px;
}

.momo-status-redirect {
  font-size: 11px;
  color: #2E7D32;
  font-weight: 500;
  margin-top: 8px;
}

.text-success {
  color: #2E7D32 !important;
}

.font-mono {
  font-family: monospace !important;
  letter-spacing: 0.2em;
}
</style>
