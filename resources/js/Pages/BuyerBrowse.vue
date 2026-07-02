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
            <div class="order-form">
              <div class="quantity-control">
                <label for="order-qty">Quantity</label>
                <input 
                  id="order-qty" 
                  v-model.number="orderQuantity" 
                  type="number" 
                  min="1" 
                  :max="selectedProduct.quantity" 
                  class="qty-input"
                />
              </div>
              
              <button @click="placeMockOrder" class="btn-confirm-order">
                Confirm Order (GH₵ {{ Number(selectedProduct.price * orderQuantity).toFixed(2) }})
              </button>
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
      <a href="#" class="nav-item disabled">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
        </svg>
        <span class="nav-label">Orders</span>
      </a>
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
    };

    const closeProductModal = () => {
      selectedProduct.value = null;
    };

    const placeMockOrder = () => {
      alert(`Order placement confirmation is successfully connected to the frontend! Ordered ${orderQuantity.value}x ${selectedProduct.value.name} for a total of GH₵ ${(selectedProduct.value.price * orderQuantity.value).toFixed(2)}.`);
      closeProductModal();
    };

    return {
      search,
      category,
      location,
      selectedProduct,
      orderQuantity,
      applyFilters,
      debounceSearch,
      clearFilters,
      openProductModal,
      closeProductModal,
      placeMockOrder
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
}

@media (min-width: 768px) {
  .modal-overlay {
    align-items: center;
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
}

@media (min-width: 768px) {
  .modal-card {
    border-radius: 12px;
    animation: zoom-in 0.2s ease-out;
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
</style>
