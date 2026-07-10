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
        <Link href="/farmer/dashboard" class="menu-item active">
          <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/>
          </svg>
          <span class="menu-label">Dashboard</span>
        </Link>
        <Link href="/farmer/orders" class="menu-item">
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
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
          </svg>
          <span class="menu-label">Profile</span>
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
      <div class="header-brand">
        <span class="logo-text">FarmLink</span>
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

    <!-- Main Content Layout wrapper -->
    <div class="main-layout">
      <main class="content-body">
        <!-- Flash Alert -->
        <div v-if="$page.props.flash?.message" class="flash-alert-wrapper">
          <AppBadge variant="success" size="md" class="flash-badge">
            {{ $page.props.flash.message }}
          </AppBadge>
        </div>

        <!-- Metrics Section (Stitch layout) -->
        <div class="metrics-grid">
          <!-- Total Sales Hero Card -->
          <AppCard class="metric-card hero-metric-card" variant="flat">
            <div class="metric-details-hero">
              <span class="metric-label">Total Sales</span>
              <span class="metric-value">₵{{ Number(metrics.total_revenue || 0).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }}</span>
              <span class="hero-metric-subtext">
                <span class="trend-arrow">↗</span> +12.5% from last month
              </span>
            </div>
            <!-- Cash Bill illustration watermark -->
            <svg class="cash-illustration" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
              <rect x="2" y="6" width="20" height="12" rx="2" />
              <circle cx="12" cy="12" r="2" />
              <path d="M6 12h.01M18 12h.01" />
            </svg>
          </AppCard>

          <!-- Active Listings Sub-Card -->
          <AppCard class="metric-card sub-metric-card" variant="flat">
            <div class="sub-metric-icon orange-bg">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="m7.5 4.27 9 5.15"/>
                <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                <path d="m3.3 7 8.7 5 8.7-5"/>
                <path d="M12 22V12"/>
              </svg>
            </div>
            <div class="metric-info">
              <span class="metric-value">{{ String(localProducts.length).padStart(2, '0') }}</span>
              <span class="metric-label">Active Listings</span>
            </div>
          </AppCard>

          <!-- Pending Orders Sub-Card -->
          <AppCard class="metric-card sub-metric-card" variant="flat">
            <div class="sub-metric-icon blue-bg">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                <path d="M9 14h6"/>
                <path d="M9 18h6"/>
                <path d="M9 10h6"/>
              </svg>
            </div>
            <div class="metric-info">
              <span class="metric-value">{{ String(metrics.pending_orders).padStart(2, '0') }}</span>
              <span class="metric-label">Pending Orders</span>
            </div>
          </AppCard>

          <!-- Delivered Orders Sub-Card -->
          <AppCard class="metric-card sub-metric-card" variant="flat">
            <div class="sub-metric-icon green-bg">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
              </svg>
            </div>
            <div class="metric-info">
              <span class="metric-value">{{ String(metrics.completed_deliveries).padStart(2, '0') }}</span>
              <span class="metric-label">Delivered Orders</span>
            </div>
          </AppCard>

          <!-- Seller Rating Sub-Card -->
          <AppCard class="metric-card sub-metric-card" variant="flat">
            <div class="sub-metric-icon gold-bg">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
              </svg>
            </div>
            <div class="metric-info">
              <span class="metric-value">{{ Number(metrics.average_rating || 0).toFixed(1) }}</span>
              <span class="metric-label">Seller Rating</span>
            </div>
          </AppCard>
        </div>

        <!-- Split Layout: Listings & Form -->
        <div class="layout-columns">
          <!-- Left Column (Listings & Orders) -->
          <div class="listings-column">
            
            <!-- My Listings Section -->
            <div class="listings-section">
              <div class="column-header">
                <h2>Active Listings</h2>
                <a href="#" class="view-all-link" @click.prevent="scrollToForm">View all &rarr;</a>
              </div>

              <div v-if="localProducts.length === 0" class="empty-listings-card">
                <div class="empty-icon-box">🥦</div>
                <h3>No produce listed yet</h3>
                <p>List your vegetables now to connect with nearby buyers.</p>
                <AppButton variant="primary" size="md" @click="scrollToForm">List Your First Produce</AppButton>
              </div>

              <div v-else class="listings-grid">
                <AppCard v-for="product in localProducts" :key="product.id" class="product-card" paddingSize="sm">
                  <div class="product-img-box">
                    <img v-if="product.image_path" :src="product.image_path.startsWith('data:') || product.image_path.startsWith('http') ? product.image_path : '/storage/' + product.image_path" :alt="product.name" class="product-image" />
                    <div v-else class="product-placeholder">🥦</div>
                    <div class="badge-overlay">
                      <AppBadge :variant="product.quantity > 0 ? 'success' : 'danger'" size="sm">
                        {{ product.quantity > 0 ? 'Available' : 'Sold Out' }}
                      </AppBadge>
                    </div>
                  </div>
                  <div class="product-card-body">
                    <div class="product-info-top">
                      <h3 class="product-title">{{ product.name }}</h3>
                      <span class="price-pill">₵{{ Number(product.price).toFixed(2) }}/unit</span>
                    </div>
                    <p class="product-avail-text">{{ product.quantity }} units available</p>
                    
                    <!-- Outlined Action Buttons (Stitch layout) -->
                    <div class="product-actions">
                      <button class="action-btn edit-btn" @click="editProduct(product)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                        <span>Edit</span>
                      </button>
                      <button class="action-btn delete-btn" @click="deleteProduct(product.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        <span>Delete</span>
                      </button>
                    </div>
                  </div>
                </AppCard>
              </div>
            </div>

            <!-- Pending Orders Section (Stitch layout) -->
            <div class="pending-orders-section">
              <div class="column-header">
                <h2>Pending Orders</h2>
              </div>
              
              <div class="orders-list-wrapper">
                <div v-if="pendingOrders.length === 0" class="empty-listings-card" style="padding: var(--space-6); text-align: center;">
                  <div class="empty-icon-box" style="margin-bottom: var(--space-2);">📦</div>
                  <h3 style="font-size: var(--font-size-sm); margin-bottom: var(--space-1);">No pending orders</h3>
                  <p style="font-size: var(--font-size-xs); color: var(--color-neutral-500); margin: 0;">Once a buyer places an order, it will appear here.</p>
                </div>
                <AppCard v-else v-for="order in pendingOrders" :key="order.id" class="order-item-card" variant="default" paddingSize="md" style="margin-bottom: var(--space-3);">
                  <div class="order-top-row">
                    <span class="status-pill-badge pending" style="background: #FFF3CD; color: var(--color-secondary-dark); font-size: 10px; font-weight: bold; padding: 2px 8px; border-radius: var(--radius-pill);">
                      PENDING
                    </span>
                    <span class="order-number-lbl" style="font-size: var(--font-size-xs); font-weight: bold; color: var(--color-neutral-500);">#{{ order.id }}</span>
                  </div>
                  <div class="order-middle-row" style="margin: var(--space-2) 0;">
                    <h4 class="buyer-name-title" style="font-size: var(--font-size-sm); font-weight: bold; margin: 0 0 var(--space-1) 0;">{{ order.buyer?.name || 'Local Buyer' }}</h4>
                    <p class="order-desc-detail" style="font-size: var(--font-size-xs); color: var(--color-neutral-700); margin: 0;">{{ order.quantity_ordered }}x {{ order.product?.name || 'Produce' }} • {{ order.buyer?.location || 'Takoradi' }}</p>
                  </div>
                  <button v-if="!order.transport_requested" class="transport-btn-custom" @click="requestTransport(order.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon-svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <rect x="1" y="3" width="15" height="13" />
                      <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                      <circle cx="5.5" cy="18.5" r="2.5" />
                      <circle cx="18.5" cy="18.5" r="2.5" />
                    </svg>
                    <span>Request Transport</span>
                  </button>
                  <div v-else style="display: flex; align-items: center; gap: 8px; color: var(--color-primary); font-size: var(--font-size-xs); font-weight: bold;">
                    <span>🚚 Transport Requested</span>
                  </div>
                </AppCard>
              </div>
            </div>

          </div>

          <!-- Right Column (Add Produce Form) -->
          <div ref="addFormSection" class="form-column">
            <AppCard class="sticky-form-card" paddingSize="lg">
              <template #header>
                <h2 class="form-card-title">{{ editingProductId ? 'Edit Produce Listing' : 'Add New Listing' }}</h2>
                <p class="form-card-subtitle">{{ editingProductId ? 'Modify produce parameters below.' : 'Fill in the details to publish your produce to the marketplace.' }}</p>
              </template>

              <form @submit.prevent="submit" class="produce-form">
                <!-- Photo Upload FIRST (Design Brief requirement) -->
                <div class="form-group-custom">
                  <label class="custom-label">Produce Photo</label>
                  <div 
                    class="custom-dropzone"
                    :class="{ 'has-preview': imagePreview, 'has-error': form.errors.image }"
                    @click="triggerFileInput"
                  >
                    <input
                      ref="fileInput"
                      type="file"
                      accept="image/*"
                      class="hidden-file-input"
                      @change="handleFileChange"
                    />
                    <div v-if="!imagePreview" class="dropzone-empty-state">
                      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="upload-icon-svg">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/>
                      </svg>
                      <span class="dropzone-title">Upload Produce Image</span>
                      <span class="dropzone-subtitle">Tap to browse (Max 2MB)</span>
                    </div>
                    <div v-else class="dropzone-preview-state">
                      <img :src="imagePreview" alt="Produce preview" class="preview-img" />
                      <div class="preview-hover-overlay">
                        <span>Change Photo</span>
                      </div>
                    </div>
                  </div>
                  <span v-if="form.errors.image" class="error-validation-text">{{ form.errors.image }}</span>
                </div>

                <!-- Vegetable Name -->
                <AppInput
                  id="name"
                  v-model="form.name"
                  label="Vegetable Name"
                  placeholder="e.g. Fresh Red Tomatoes"
                  required
                  :error="form.errors.name"
                />

                <!-- Category -->
                <AppInput
                  id="category"
                  v-model="form.category"
                  type="select"
                  label="Category"
                  required
                  :error="form.errors.category"
                >
                  <option value="" disabled>Select category</option>
                  <option value="Vegetable">Vegetable (General)</option>
                  <option value="Leafy Green">Leafy Green</option>
                  <option value="Root/Tuber">Root / Tuber</option>
                  <option value="Other">Other</option>
                </AppInput>

                <!-- Quantity -->
                <AppInput
                  id="quantity"
                  v-model="form.quantity"
                  type="number"
                  min="1"
                  label="Quantity Available"
                  placeholder="e.g. 10"
                  required
                  :error="form.errors.quantity"
                />

                <!-- Price -->
                <AppInput
                  id="price"
                  v-model="form.price"
                  type="number"
                  step="0.01"
                  min="0.01"
                  label="Unit Price (GH₵)"
                  placeholder="e.g. 45.00"
                  required
                  :error="form.errors.price"
                />

                <!-- Submit button -->
                <AppButton
                  type="submit"
                  variant="primary"
                  class="w-full-btn"
                  :loading="form.processing"
                >
                  {{ editingProductId ? 'Save Changes' : 'Publish Listing' }}
                </AppButton>

                <!-- Cancel Edit button -->
                <AppButton
                  v-if="editingProductId"
                  type="button"
                  variant="outlined"
                  class="w-full-btn"
                  style="margin-top: 8px;"
                  @click="cancelEdit"
                >
                  Cancel Edit
                </AppButton>
              </form>
            </AppCard>
          </div>
        </div>
      </main>
    </div>

    <!-- Floating Action Button for adding listings (mobile only) -->
    <button class="fab-btn" @click="scrollToForm" aria-label="Add New Listing">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
    </button>

    <!-- Mobile Bottom Navigation Bar (Stitch design layout) -->
    <nav class="mobile-bottom-nav">
      <Link href="/farmer/dashboard" class="mobile-nav-item active">
        <div class="nav-active-pill">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9 22 9 12 15 12 15 22"/>
          </svg>
          <span class="nav-label">Home</span>
        </div>
      </Link>

      <Link href="/farmer/orders" class="mobile-nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
          <line x1="3" y1="6" x2="21" y2="6"/>
          <path d="M16 10a4 4 0 0 1-8 0"/>
        </svg>
        <span class="nav-label">Orders</span>
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
import { useForm, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import AppButton from '../Components/UI/AppButton.vue';
import AppInput from '../Components/UI/AppInput.vue';
import AppCard from '../Components/UI/AppCard.vue';
import AppBadge from '../Components/UI/AppBadge.vue';

export default {
  name: 'FarmerDashboard',
  components: {
    Link,
    AppButton,
    AppInput,
    AppCard,
    AppBadge
  },
  props: {
    products: {
      type: Array,
      required: true
    },
    pendingOrders: {
      type: Array,
      required: true
    },
    metrics: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    const fileInput = ref(null);
    const imagePreview = ref(null);
    const addFormSection = ref(null);

    // Frontend Reactive copy of products to support mock edit/delete in prototype
    const localProducts = ref([...props.products]);
    const editingProductId = ref(null);

    // Watch for props updates from backend (e.g. normal Inertia post redirects)
    watch(() => props.products, (newProducts) => {
      localProducts.value = [...newProducts];
    }, { deep: true });

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

    // Populates listing into the form for editing (Frontend Mock)
    const editProduct = (product) => {
      editingProductId.value = product.id;
      form.name = product.name;
      form.category = product.category;
      form.quantity = String(product.quantity);
      form.price = String(product.price);
      imagePreview.value = product.image_path ? (product.image_path.startsWith('data:') || product.image_path.startsWith('http') ? product.image_path : '/storage/' + product.image_path) : null;
      scrollToForm();
    };

    const cancelEdit = () => {
      editingProductId.value = null;
      form.reset();
      imagePreview.value = null;
    };

    // Deletes product from the local list (Frontend Mock)
    const deleteProduct = (productId) => {
      if (confirm('Are you sure you want to delete this listing? (Frontend Demo Only)')) {
        localProducts.value = localProducts.value.filter(p => p.id !== productId);
        alert('Produce listing deleted successfully (Frontend Mock).');
      }
    };

    const triggerAlert = (msg) => {
      alert(msg);
    };

    const submit = () => {
      if (editingProductId.value) {
        // Frontend Mock Save (Hackathon support)
        const idx = localProducts.value.findIndex(p => p.id === editingProductId.value);
        if (idx !== -1) {
          // If a new photo preview is uploaded, we save it in the local item
          const newImgPath = imagePreview.value || localProducts.value[idx].image_path;
          
          localProducts.value[idx] = {
            ...localProducts.value[idx],
            name: form.name,
            category: form.category,
            quantity: Number(form.quantity),
            price: Number(form.price),
            image_path: (newImgPath.startsWith('/storage/') ? newImgPath.replace('/storage/', '') : newImgPath)
          };
        }
        editingProductId.value = null;
        form.reset();
        imagePreview.value = null;
        if (fileInput.value) {
          fileInput.value.value = '';
        }
        alert('Produce listing updated successfully (Frontend Mock).');
      } else {
        // Original Create flow posting to the backend
        form.post('/farmer/products', {
          onSuccess: () => {
            form.reset();
            imagePreview.value = null;
            if (fileInput.value) {
              fileInput.value.value = '';
            }
          }
        });
      }
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
      scrollToForm,
      localProducts,
      editingProductId,
      editProduct,
      cancelEdit,
      deleteProduct,
      triggerAlert,
      requestTransport: (orderId) => {
        router.post(`/farmer/orders/${orderId}/request-transport`);
      }
    };
  }
}
</script>

<style scoped>
/* Top-level structure */
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

.menu-item.disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.badge-coming {
  font-size: 9px;
  background-color: var(--color-neutral-200);
  color: var(--color-neutral-700);
  padding: 1px 4px;
  border-radius: var(--radius-sm);
  margin-left: auto;
  font-weight: var(--font-weight-semibold);
  text-transform: uppercase;
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
  color: var(--color-neutral-900);
}

.icon-action-btn.logout-header-btn {
  color: var(--color-danger);
}

.icon-action-btn.logout-header-btn:hover {
  background-color: var(--color-danger-light);
  color: var(--color-danger);
}

.icon-action-btn.disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

/* Main Layout content */
.main-layout {
  flex: 1;
  min-width: 0;
  display: flex;
  flex-direction: column;
  margin-left: 0;
}

.content-body {
  padding: var(--space-4);
  flex: 1;
  max-width: 1200px;
  width: 100%;
  margin: 0 auto;
}

/* Flash alerts */
.flash-alert-wrapper {
  margin-bottom: var(--space-4);
}

.flash-badge {
  width: 100%;
  justify-content: flex-start;
  padding: var(--space-3) var(--space-4);
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  border: 1px solid var(--color-success);
}

/* Metrics Section (Stitch Style) */
.metrics-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: var(--space-3);
  margin-bottom: var(--space-5);
}

.hero-metric-card {
  grid-column: span 2;
  position: relative;
  overflow: hidden;
  background: linear-gradient(135deg, var(--color-primary), var(--color-primary-hover));
  color: var(--color-white);
  border: none !important;
  border-radius: var(--radius-lg);
  padding: var(--space-5) !important;
  display: flex;
  flex-direction: column;
  justify-content: center;
  min-height: 110px;
  box-shadow: var(--shadow-sm);
}

.hero-metric-card .metric-label {
  color: rgba(255, 255, 255, 0.8) !important;
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  text-transform: none;
  letter-spacing: normal;
}

.hero-metric-card .metric-value {
  color: var(--color-white) !important;
  font-size: var(--font-size-2xl) !important;
  font-weight: var(--font-weight-bold);
  margin-top: var(--space-1);
}

.hero-metric-subtext {
  font-size: var(--font-size-xs);
  color: rgba(255, 255, 255, 0.9);
  display: flex;
  align-items: center;
  gap: 4px;
  margin-top: var(--space-2);
  font-weight: var(--font-weight-medium);
}

.trend-arrow {
  color: var(--color-primary-light);
}

.cash-illustration {
  position: absolute;
  right: -10px;
  bottom: -15px;
  width: 90px;
  height: 90px;
  opacity: 0.15;
  color: var(--color-white);
  transform: rotate(-15deg);
  pointer-events: none;
}

/* Sub-metrics cards */
.sub-metric-card {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: var(--space-3);
  padding: var(--space-4) !important;
  border-radius: var(--radius-lg);
  border: 1px solid var(--color-border);
  box-shadow: var(--shadow-xs);
}

.sub-metric-icon {
  width: 36px;
  height: 36px;
  border-radius: var(--radius-md);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.sub-metric-icon svg {
  width: 18px;
  height: 18px;
}

.sub-metric-icon.orange-bg {
  background-color: var(--color-warning-light);
  color: var(--color-secondary-dark);
}

.sub-metric-icon.blue-bg {
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary);
}

.sub-metric-icon.green-bg {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary);
}

.sub-metric-icon.gold-bg {
  background-color: var(--color-warning-light);
  color: var(--color-secondary-dark);
}

.sub-metric-card .metric-info {
  display: flex;
  flex-direction: column;
}

.sub-metric-card .metric-value {
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  line-height: var(--line-height-tight);
}

.sub-metric-card .metric-label {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-semibold);
  margin-top: var(--space-1);
}

/* Columns Layout */
.layout-columns {
  display: grid;
  grid-template-columns: 1fr;
  gap: var(--space-5);
}

.listings-column {
  display: flex;
  flex-direction: column;
  gap: var(--space-5);
}

.listings-section, .pending-orders-section {
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
}

.column-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.column-header h2 {
  font-size: var(--font-size-lg);
  color: var(--color-neutral-900);
  font-weight: var(--font-weight-bold);
}

.view-all-link {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-semibold);
  transition: color var(--transition-fast);
}

.view-all-link:hover {
  color: var(--color-primary);
}

/* Empty states */
.empty-listings-card {
  background-color: var(--color-white);
  border: 1.5px dashed var(--color-neutral-300);
  border-radius: var(--radius-lg);
  padding: var(--space-10) var(--space-4);
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: var(--space-3);
}

.empty-icon-box {
  font-size: var(--font-size-3xl);
}

.empty-listings-card h3 {
  font-size: var(--font-size-md);
  color: var(--color-neutral-900);
  font-weight: var(--font-weight-semibold);
}

.empty-listings-card p {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  max-width: 300px;
  margin-bottom: var(--space-2);
}

/* Listings Grid */
.listings-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: var(--space-4);
}

.product-card {
  display: flex;
  flex-direction: column;
  height: 100%;
}

.product-img-box {
  aspect-ratio: 16 / 9;
  background-color: var(--color-neutral-50);
  border-bottom: 1px solid var(--color-border);
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  border-radius: var(--radius-md);
  margin-bottom: var(--space-3);
}

.product-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.product-placeholder {
  font-size: var(--font-size-3xl);
}

.badge-overlay {
  position: absolute;
  top: var(--space-2);
  right: var(--space-2);
}

.product-card-body {
  display: flex;
  flex-direction: column;
  flex: 1;
}

.product-info-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: var(--space-2);
  margin-bottom: var(--space-1);
}

.product-title {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  line-height: var(--line-height-tight);
}

.price-pill {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  color: var(--color-secondary-dark);
  background-color: var(--color-secondary-light);
  padding: 2px var(--space-2);
  border-radius: var(--radius-sm);
  white-space: nowrap;
}

.product-avail-text {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-medium);
}

/* Outlined listing actions (Stitch design) */
.product-actions {
  display: flex;
  gap: var(--space-2);
  margin-top: var(--space-3);
  border-top: 1px solid var(--color-border);
  padding-top: var(--space-3);
}

.action-btn {
  flex: 1;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-1);
  height: 36px;
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  cursor: pointer;
  transition: all var(--transition-fast);
  background-color: var(--color-white);
  border: 1px solid var(--color-neutral-300);
  color: var(--color-neutral-700);
}

.action-btn.edit-btn:hover {
  border-color: var(--color-primary);
  color: var(--color-primary);
  background-color: var(--color-primary-subtle);
}

.action-btn.delete-btn {
  border-color: #F8D7DA;
  color: var(--color-danger);
}

.action-btn.delete-btn:hover {
  background-color: var(--color-danger-light);
  border-color: var(--color-danger);
}

/* Pending Orders list section */
.orders-list-wrapper {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

.order-item-card {
  transition: all var(--transition-base);
}

.order-item-card:has(.preparing) {
  border-left: 4px solid var(--color-tertiary);
}

.order-item-card:has(.awaiting_pickup) {
  border-left: 4px solid var(--color-secondary);
}

.order-top-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: var(--space-2);
}

.status-pill-badge {
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  padding: 2px var(--space-2);
  border-radius: var(--radius-sm);
  text-transform: uppercase;
}

.status-pill-badge.preparing {
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary-hover);
}

.status-pill-badge.awaiting_pickup {
  background-color: var(--color-warning-light);
  color: var(--color-secondary-dark);
}

.order-number-lbl {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-semibold);
}

.order-middle-row {
  margin-bottom: var(--space-3);
}

.buyer-name-title {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin-bottom: 2px;
}

.order-desc-detail {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
}

.transport-btn-custom {
  width: 100%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
  height: 40px;
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  cursor: pointer;
  transition: all var(--transition-fast);
  background-color: var(--color-secondary-dark) !important;
  color: var(--color-white) !important;
  border: none !important;
}

.transport-btn-custom:hover {
  background-color: #5C2D0C !important;
}

/* Form column */
.form-column {
  width: 100%;
}

.sticky-form-card {
  position: relative;
}

.form-card-title {
  font-size: var(--font-size-lg);
  color: var(--color-neutral-900);
  font-weight: var(--font-weight-bold);
  margin-bottom: 2px;
}

.form-card-subtitle {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

.produce-form {
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
}

/* Upload dropzone custom styling */
.form-group-custom {
  display: flex;
  flex-direction: column;
  gap: var(--space-1);
}

.custom-label {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  color: var(--color-neutral-900);
}

.custom-dropzone {
  border: 2px dashed var(--color-neutral-300);
  border-radius: var(--radius-md);
  height: 140px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  background-color: var(--color-neutral-50);
  position: relative;
  overflow: hidden;
  transition: all var(--transition-base);
}

.custom-dropzone:hover {
  border-color: var(--color-primary);
  background-color: var(--color-primary-subtle);
}

.custom-dropzone.has-error {
  border-color: var(--color-danger);
  background-color: var(--color-danger-light);
}

.hidden-file-input {
  display: none !important;
}

.dropzone-empty-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  padding: var(--space-4);
  color: var(--color-neutral-700);
}

.upload-icon-svg {
  color: var(--color-neutral-500);
  margin-bottom: var(--space-2);
  transition: color var(--transition-fast);
}

.custom-dropzone:hover .upload-icon-svg {
  color: var(--color-primary);
}

.dropzone-title {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-semibold);
  color: var(--color-neutral-900);
}

.dropzone-subtitle {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  margin-top: 2px;
}

.dropzone-preview-state {
  width: 100%;
  height: 100%;
  position: relative;
}

.preview-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.preview-hover-overlay {
  position: absolute;
  inset: 0;
  background-color: rgba(27, 67, 50, 0.6);
  color: var(--color-white);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  opacity: 0;
  transition: opacity var(--transition-fast);
}

.custom-dropzone:hover .preview-hover-overlay {
  opacity: 1;
}

.error-validation-text {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-medium);
  color: var(--color-danger);
  margin-top: 2px;
}

.w-full-btn {
  width: 100%;
  margin-top: var(--space-2);
}

/* Floating Action Button (FAB) */
.fab-btn {
  position: fixed;
  bottom: calc(var(--bottom-nav-height) + 16px);
  right: 16px;
  width: 56px;
  height: 56px;
  border-radius: var(--radius-full);
  background-color: var(--color-primary);
  color: var(--color-white);
  border: none;
  box-shadow: var(--shadow-md);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  z-index: 99;
  transition: transform var(--transition-fast), background-color var(--transition-fast);
}

.fab-btn:hover {
  background-color: var(--color-primary-hover);
  transform: scale(1.05);
}

.fab-btn:active {
  transform: scale(0.95);
}

/* Mobile Bottom Navigation Bar (Stitch style) */
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

.mobile-nav-item.disabled {
  opacity: 0.4;
  cursor: not-allowed;
  pointer-events: none;
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
  .logo-text, .menu-label, .logout-label, .badge-coming {
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
  
  .layout-columns {
    grid-template-columns: 1.5fr 1fr;
    align-items: start;
  }
  
  /* Desktop metrics grid: Hero card left, 2x2 grid next to it */
  .metrics-grid {
    grid-template-columns: 2fr 1fr 1fr;
  }
  .hero-metric-card {
    grid-column: span 1;
    grid-row: span 2;
    min-height: 100%;
  }
  
  .listings-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .sticky-form-card {
    position: sticky;
    top: calc(var(--space-4) + 10px);
  }
  .fab-btn {
    display: none;
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
  .badge-coming {
    display: inline-block;
  }
  .menu-item {
    justify-content: flex-start;
  }
  .logout-btn-sidebar {
    justify-content: flex-start;
  }
}
</style>
