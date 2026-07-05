<template>
  <div class="dashboard-wrapper">
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
          <span class="greeting-text">Farmer Portal</span>
          <Link href="/logout" method="post" as="button" class="logout-link-btn">Log Out</Link>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Flash Alert -->
      <div v-if="$page.props.flash?.message" class="flash-alert">
        <p>{{ $page.props.flash.message }}</p>
      </div>

      <!-- Metrics Grid -->
      <section class="metrics-grid">
        <div class="metric-card">
          <div class="metric-icon-wrapper active-bg">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2E7D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
            </svg>
          </div>
          <div class="metric-details">
            <span class="metric-label">Active Listings</span>
            <span class="metric-value">{{ metrics.active_listings }}</span>
          </div>
        </div>

        <div class="metric-card">
          <div class="metric-icon-wrapper pending-bg">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#B8860B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
            </svg>
          </div>
          <div class="metric-details">
            <span class="metric-label">Pending Orders</span>
            <span class="metric-value">{{ metrics.pending_orders }}</span>
          </div>
        </div>

        <div class="metric-card">
          <div class="metric-icon-wrapper completed-bg">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2E7D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
          </div>
          <div class="metric-details">
            <span class="metric-label">Delivered Orders</span>
            <span class="metric-value">{{ metrics.completed_deliveries }}</span>
          </div>
        </div>

        <div class="metric-card">
          <div class="metric-icon-wrapper active-bg">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2E7D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="4" width="20" height="16" rx="2"></rect>
              <line x1="12" y1="10" x2="12" y2="14"></line>
              <circle cx="12" cy="12" r="2"></circle>
            </svg>
          </div>
          <div class="metric-details">
            <span class="metric-label">Total Revenue</span>
            <span class="metric-value">GH₵ {{ Number(metrics.total_revenue || 0).toFixed(2) }}</span>
          </div>
        </div>

        <div class="metric-card">
          <div class="metric-icon-wrapper rating-bg">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#B8860B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
            </svg>
          </div>
          <div class="metric-details">
            <span class="metric-label">Seller Rating</span>
            <span class="metric-value">{{ Number(metrics.average_rating).toFixed(1) }}</span>
          </div>
        </div>
      </section>

      <!-- Grid for Listings & Add Form -->
      <div class="content-layout">
        <!-- Listings Section -->
        <section class="listings-section">
          <div class="section-header">
            <h2 class="section-title">My Vegetable Listings</h2>
            <button @click="scrollToForm" class="btn-scroll-add hide-desktop">
              + Add New
            </button>
          </div>

          <div v-if="products.length === 0" class="empty-state">
            <p>You have not listed any vegetables yet.</p>
            <p class="empty-subtext">Use the form to list your first batch.</p>
          </div>

          <div v-else class="listings-list">
            <div v-for="product in products" :key="product.id" class="product-item-card">
              <div class="product-img-wrapper">
                <img 
                  v-if="product.image_path" 
                  :src="'/storage/' + product.image_path" 
                  :alt="product.name" 
                  class="product-thumb"
                />
                <div v-else class="product-thumb-placeholder">
                  🍅
                </div>
              </div>
              <div class="product-info">
                <div class="product-header">
                  <h3 class="product-name">{{ product.name }}</h3>
                  <span class="category-tag">{{ product.category }}</span>
                </div>
                <div class="product-stats">
                  <div class="stat">
                    <span class="stat-label">Qty Left:</span>
                    <span class="stat-value" :class="{ 'text-danger': product.quantity === 0 }">
                      {{ product.quantity }}
                    </span>
                  </div>
                  <div class="stat">
                    <span class="stat-label">Price:</span>
                    <span class="stat-value">GH₵ {{ Number(product.price).toFixed(2) }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Form Section -->
        <section ref="addFormSection" class="form-section">
          <div class="form-card">
            <h2 class="form-title">Add New Listing</h2>
            
            <form @submit.prevent="submit" class="form-container">
              <!-- Photo Upload FIRST (Design Brief requirement) -->
              <div class="form-group">
                <label class="form-label">Produce Photo</label>
                <div 
                  class="upload-dropzone" 
                  :class="{ 'has-file': imagePreview, 'input-error': form.errors.image }"
                  @click="triggerFileInput"
                >
                  <input
                    ref="fileInput"
                    type="file"
                    accept="image/*"
                    class="hidden-file-input"
                    @change="handleFileChange"
                  />
                  <div v-if="!imagePreview" class="upload-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#6B6B63" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="upload-icon">
                      <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/>
                    </svg>
                    <span class="upload-text">Tap to upload produce image</span>
                    <span class="upload-hint">JPEG, PNG or WEBP (Max 2MB)</span>
                  </div>
                  <div v-else class="preview-container">
                    <img :src="imagePreview" alt="Upload Preview" class="upload-preview" />
                    <div class="change-overlay">
                      <span>Tap to change image</span>
                    </div>
                  </div>
                </div>
                <span v-if="form.errors.image" class="error-message">{{ form.errors.image }}</span>
              </div>

              <!-- Product Name -->
              <div class="form-group">
                <label for="name" class="form-label">Vegetable Name</label>
                <input
                  id="name"
                  v-model="form.name"
                  type="text"
                  class="form-input"
                  placeholder="e.g. Fresh Red Tomatoes"
                  :class="{ 'input-error': form.errors.name }"
                  required
                />
                <span v-if="form.errors.name" class="error-message">{{ form.errors.name }}</span>
              </div>

              <!-- Category -->
              <div class="form-group">
                <label for="category" class="form-label">Category</label>
                <select
                  id="category"
                  v-model="form.category"
                  class="form-select"
                  :class="{ 'input-error': form.errors.category }"
                  required
                >
                  <option value="" disabled>Select category</option>
                  <option value="Vegetable">Vegetable (General)</option>
                  <option value="Leafy Green">Leafy Green</option>
                  <option value="Root/Tuber">Root / Tuber</option>
                  <option value="Other">Other</option>
                </select>
                <span v-if="form.errors.category" class="error-message">{{ form.errors.category }}</span>
              </div>

              <!-- Quantity -->
              <div class="form-group">
                <label for="quantity" class="form-label">Quantity Available (Bags / kg)</label>
                <input
                  id="quantity"
                  v-model="form.quantity"
                  type="number"
                  min="1"
                  class="form-input"
                  placeholder="e.g. 10"
                  :class="{ 'input-error': form.errors.quantity }"
                  required
                />
                <span v-if="form.errors.quantity" class="error-message">{{ form.errors.quantity }}</span>
              </div>

              <!-- Price -->
              <div class="form-group">
                <label for="price" class="form-label">Unit Price (GH₵ per Bag / kg)</label>
                <input
                  id="price"
                  v-model="form.price"
                  type="number"
                  step="0.01"
                  min="0.01"
                  class="form-input"
                  placeholder="e.g. 45.00"
                  :class="{ 'input-error': form.errors.price }"
                  required
                />
                <span v-if="form.errors.price" class="error-message">{{ form.errors.price }}</span>
              </div>

              <!-- Submit -->
              <button
                type="submit"
                class="submit-button"
                :disabled="form.processing"
              >
                {{ form.processing ? 'Creating Listing...' : 'Publish Listing' }}
              </button>
            </form>
          </div>
        </section>
      </div>
    </main>

    <!-- Mobile Bottom Navigation (Design Brief requirement) -->
    <nav class="mobile-nav hide-desktop">
      <Link href="/farmer/dashboard" class="nav-item active">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/>
        </svg>
        <span class="nav-label">Dashboard</span>
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
import { useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

export default {
  name: 'FarmerDashboard',
  components: {
    Link
  },
  props: {
    products: {
      type: Array,
      required: true
    },
    metrics: {
      type: Object,
      required: true
    }
  },
  setup() {
    const fileInput = ref(null);
    const imagePreview = ref(null);
    const addFormSection = ref(null);

    const form = useForm({
      name: '',
      category: '',
      quantity: '',
      price: '',
      image: null
    });

    const triggerFileInput = () => {
      fileInput.value.click();
    };

    const handleFileChange = (e) => {
      const file = e.target.files[0];
      if (file) {
        form.image = file;
        const reader = new FileReader();
        reader.onload = (event) => {
          imagePreview.value = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    };

    const submit = () => {
      form.post('/farmer/products', {
        onSuccess: () => {
          form.reset();
          imagePreview.value = null;
          if (fileInput.value) {
            fileInput.value.value = '';
          }
        }
      });
    };

    const scrollToForm = () => {
      if (addFormSection.value) {
        addFormSection.value.scrollIntoView({ behavior: 'smooth' });
      }
    };

    return {
      form,
      fileInput,
      imagePreview,
      addFormSection,
      triggerFileInput,
      handleFileChange,
      submit,
      scrollToForm
    };
  }
}
</script>

<style scoped>
.dashboard-wrapper {
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

/* Main Layout */
.main-content {
  max-width: 1000px;
  margin: 0 auto;
  padding: 16px;
}

.flash-alert {
  background-color: #E8F5E9;
  border: 1px solid #2E7D32;
  border-radius: 8px;
  padding: 12px;
  margin-bottom: 16px;
  color: #2E7D32;
  font-size: 14px;
  font-weight: 500;
}

/* Metrics row */
.metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 12px;
  margin-bottom: 20px;
}

@media (min-width: 768px) {
  .metrics-grid {
    grid-template-columns: repeat(5, 1fr);
  }
}

.metric-card {
  background-color: #FFFFFF;
  border: 1px solid #E0E0DA;
  border-radius: 12px;
  padding: 12px 16px;
  display: flex;
  align-items: center;
  gap: 12px;
  box-shadow: 0 1px 2px rgba(0,0,0,0.06);
}

.metric-icon-wrapper {
  width: 36px;
  height: 36px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.active-bg { background-color: #E8F5E9; }
.pending-bg { background-color: #FFF8E1; }
.completed-bg { background-color: #E8F5E9; }
.rating-bg { background-color: #FFF8E1; }

.metric-details {
  display: flex;
  flex-direction: column;
}

.metric-label {
  font-size: 11px;
  color: #6B6B63;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.metric-value {
  font-size: 18px;
  font-weight: 500;
  color: #1A1A1A;
}

/* Dashboard structure */
.content-layout {
  display: grid;
  grid-template-columns: 1fr;
  gap: 20px;
}

@media (min-width: 768px) {
  .content-layout {
    grid-template-columns: 1.5fr 1fr;
  }
}

/* Listings list section */
.listings-section {
  background-color: #FFFFFF;
  border: 1px solid #E0E0DA;
  border-radius: 12px;
  padding: 16px;
  box-shadow: 0 1px 2px rgba(0,0,0,0.06);
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.section-title {
  font-size: 18px;
  font-weight: 500;
  color: #1B5E20;
  margin: 0;
}

.btn-scroll-add {
  background-color: #2E7D32;
  color: #FFFFFF;
  border: none;
  font-size: 13px;
  font-weight: 500;
  height: 32px;
  padding: 0 12px;
  border-radius: 8px;
  cursor: pointer;
}

.empty-state {
  text-align: center;
  padding: 40px 16px;
  color: #6B6B63;
}

.empty-subtext {
  font-size: 13px;
  margin-top: 4px;
}

.listings-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.product-item-card {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px;
  border: 1px solid #E0E0DA;
  border-radius: 8px;
  background-color: #FFFFFF;
}

.product-img-wrapper {
  width: 64px;
  height: 64px;
  border-radius: 8px;
  overflow: hidden;
  background-color: #F7F8F5;
  border: 1px solid #E0E0DA;
  display: flex;
  align-items: center;
  justify-content: center;
}

.product-thumb {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.product-thumb-placeholder {
  font-size: 28px;
}

.product-info {
  flex: 1;
}

.product-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 4px;
}

.product-name {
  font-size: 15px;
  font-weight: 500;
  margin: 0;
  color: #1A1A1A;
}

.category-tag {
  font-size: 11px;
  color: #2E7D32;
  background-color: #E8F5E9;
  padding: 2px 6px;
  border-radius: 4px;
  font-weight: 500;
}

.product-stats {
  display: flex;
  gap: 16px;
}

.stat {
  font-size: 13px;
  display: flex;
  gap: 4px;
}

.stat-label {
  color: #6B6B63;
}

.stat-value {
  color: #1A1A1A;
  font-weight: 500;
}

.text-danger {
  color: #C62828;
}

/* Form section */
.form-section {
  background-color: #FFFFFF;
  border: 1px solid #E0E0DA;
  border-radius: 12px;
  padding: 20px 16px;
  box-shadow: 0 1px 2px rgba(0,0,0,0.06);
}

.form-title {
  font-size: 18px;
  font-weight: 500;
  color: #1B5E20;
  margin: 0 0 16px 0;
}

.form-container {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.form-label {
  font-size: 14px;
  font-weight: 500;
  color: #1A1A1A;
}

/* Custom upload zone */
.upload-dropzone {
  border: 2px dashed #E0E0DA;
  border-radius: 8px;
  height: 120px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  background-color: #F7F8F5;
  overflow: hidden;
  position: relative;
  transition: border-color 0.2s ease;
}

.upload-dropzone:hover {
  border-color: #2E7D32;
}

.hidden-file-input {
  display: none;
}

.upload-placeholder {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  padding: 12px;
}

.upload-text {
  font-size: 13px;
  font-weight: 500;
  color: #1A1A1A;
  margin-top: 4px;
}

.upload-hint {
  font-size: 11px;
  color: #6B6B63;
  margin-top: 2px;
}

.preview-container {
  width: 100%;
  height: 100%;
  position: relative;
}

.upload-preview {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.change-overlay {
  position: absolute;
  inset: 0;
  background-color: rgba(0,0,0,0.4);
  color: #FFFFFF;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  font-weight: 500;
  opacity: 0;
  transition: opacity 0.2s ease;
}

.upload-dropzone:hover .change-overlay {
  opacity: 1;
}

.form-input, .form-select {
  height: 44px;
  border: 1px solid #E0E0DA;
  border-radius: 8px;
  padding: 0 12px;
  font-size: 15px;
  color: #1A1A1A;
  background-color: #FFFFFF;
  transition: border-color 0.2s ease;
}

.form-input:focus, .form-select:focus {
  outline: none;
  border-color: #2E7D32;
}

.input-error {
  border-color: #C62828 !important;
}

.error-message {
  font-size: 12px;
  color: #C62828;
  font-weight: 500;
}

.submit-button {
  background-color: #2E7D32;
  color: #FFFFFF;
  border: none;
  border-radius: 8px;
  height: 44px;
  font-size: 15px;
  font-weight: 500;
  cursor: pointer;
  margin-top: 8px;
  transition: background-color 0.2s ease;
}

.submit-button:hover:not(:disabled) {
  background-color: #1B5E20;
}

.submit-button:disabled {
  opacity: 0.6;
  cursor: not-allowed;
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
