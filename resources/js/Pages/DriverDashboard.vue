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
        <div class="user-avatar driver">
          {{ driverDetails.name.charAt(0).toUpperCase() }}
        </div>
        <div class="user-info">
          <span class="user-name">{{ driverDetails.name }}</span>
          <span class="user-role">{{ driverDetails.model }}</span>
        </div>
      </div>

      <!-- Sidebar Menu Tabs -->
      <nav class="sidebar-menu">
        <button 
          @click="activeTab = 'jobs'" 
          class="menu-item" 
          :class="{ active: activeTab === 'jobs' }"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="1" y="3" width="15" height="13"/>
            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
            <circle cx="5.5" cy="18.5" r="2.5"/>
            <circle cx="18.5" cy="18.5" r="2.5"/>
          </svg>
          <span class="menu-label">Available Jobs</span>
        </button>

        <button 
          @click="activeTab = 'history'" 
          class="menu-item" 
          :class="{ active: activeTab === 'history' }"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
          </svg>
          <span class="menu-label">Trip History</span>
        </button>

        <button 
          @click="activeTab = 'earnings'" 
          class="menu-item" 
          :class="{ active: activeTab === 'earnings' }"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="6" width="20" height="12" rx="2"/>
            <circle cx="12" cy="12" r="2"/>
            <path d="M6 12h.01M18 12h.01"/>
          </svg>
          <span class="menu-label">Earnings Overview</span>
        </button>

        <button 
          @click="activeTab = 'profile'" 
          class="menu-item" 
          :class="{ active: activeTab === 'profile' }"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
          <span class="menu-label">Driver Profile</span>
        </button>

        <Link href="/notifications" class="menu-item">
          <div class="menu-item-badge-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="menu-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
            <span class="menu-label">Alerts</span>
            <span v-if="$page.props.auth?.unread_notifications_count > 0" class="badge-count-sidebar">
              {{ $page.props.auth.unread_notifications_count }}
            </span>
          </div>
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
        <span class="mobile-user-name">
          {{ driverDetails.name }}
        </span>
      </div>
      <div class="header-actions">
        <button class="status-pill-toggle" @click="isOnline = !isOnline" :class="{ online: isOnline }">
          <span class="toggle-dot"></span>
          <span class="toggle-label">{{ isOnline ? 'ONLINE' : 'OFFLINE' }}</span>
        </button>
      </div>
    </header>

    <!-- Main Content Body -->
    <div class="main-layout">
      <main class="content-body">
        <div class="main-content">

          <!-- ══════════════════════════════════════════════════════════════ -->
          <!-- SCREEN 1: JOBS TAB (Real Available Jobs & Active Deliveries)   -->
          <!-- ══════════════════════════════════════════════════════════════ -->
          <div v-if="activeTab === 'jobs'" class="tab-content-view">
            <!-- Top Controls Row: Status Toggle + Rating Badge -->
            <div class="top-status-bar">
              <div class="status-control-box">
                <span class="control-sublabel">DRIVER STATUS</span>
                <button class="online-switch" :class="{ is_active: isOnline }" @click="isOnline = !isOnline">
                  <span class="switch-knob"></span>
                  <span class="switch-text">{{ isOnline ? 'ONLINE' : 'OFFLINE' }}</span>
                </button>
              </div>

              <div class="rating-control-box">
                <span class="control-sublabel">RATING</span>
                <div class="rating-badge-pill">
                  <span class="rating-num">{{ driverRatingFormatted }}</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#F4A261" stroke="none">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Revenue Today Banner -->
            <div class="revenue-banner-card">
              <div class="banner-info">
                <span class="banner-subtitle">Earnings Today</span>
                <h1 class="banner-amount">GHS {{ todayEarningsCalculated }}</h1>
              </div>
              <div class="banner-icon-watermark">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                  <rect x="2" y="6" width="20" height="12" rx="2"/>
                  <circle cx="12" cy="12" r="2"/>
                  <path d="M6 12h.01M18 12h.01"/>
                </svg>
              </div>
            </div>

            <!-- Active Trip Section -->
            <section v-if="activeTrips && activeTrips.length > 0" class="section-block active-section">
              <div class="section-header">
                <h2 class="section-title">Active Delivery</h2>
                <span class="active-pulse-badge">IN TRANSIT</span>
              </div>

              <div v-for="order in activeTrips" :key="order.id" class="active-trip-card">
                <div class="trip-status-row">
                  <div class="payout-col">
                    <span class="payout-label-sm">Transport Fee</span>
                    <span class="payout-amount">
                      GHS {{ order.estimated_transport_cost ? Number(order.estimated_transport_cost).toFixed(2) : Number(order.total_price).toFixed(2) }}
                    </span>
                  </div>
                </div>

                <!-- Delivery Steps -->
                <div class="progress-steps-row">
                  <div class="progress-step" :class="{ completed: order.status === 'in_transit' || order.status === 'delivered', active: order.status === 'processing' }">
                    <div class="step-icon-circle">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                    </div>
                    <span class="step-name">Farm Gate</span>
                  </div>
                  <div class="step-connector" :class="{ completed: order.status === 'in_transit' || order.status === 'delivered' }"></div>
                  <div class="progress-step" :class="{ completed: order.status === 'delivered', active: order.status === 'in_transit' }">
                    <div class="step-icon-circle">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    </div>
                    <span class="step-name">Transit</span>
                  </div>
                  <div class="step-connector" :class="{ completed: order.status === 'delivered' }"></div>
                  <div class="progress-step" :class="{ completed: order.status === 'delivered', pending: order.status !== 'delivered' }">
                    <div class="step-icon-circle">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z"/></svg>
                    </div>
                    <span class="step-name">Market</span>
                  </div>
                </div>

                <!-- Route info -->
                <div class="route-info-block">
                  <div class="route-row">
                    <span class="route-type-tag pickup-tag">PICKUP</span>
                    <div class="route-detail">
                      <span class="route-location">{{ order.product?.user?.location || 'Farm Location' }}</span>
                      <span class="route-party">Farmer: {{ order.product?.user?.name || 'Local Farmer' }}</span>
                    </div>
                  </div>
                  <div class="route-connector-line"></div>
                  <div class="route-row">
                    <span class="route-type-tag dropoff-tag">DROP-OFF</span>
                    <div class="route-detail">
                      <span class="route-location">{{ order.buyer?.location || 'Buyer Location' }}</span>
                      <span class="route-party">Buyer: {{ order.buyer?.name || 'Local Buyer' }}</span>
                    </div>
                  </div>
                </div>

                <!-- Cargo info chip -->
                <div class="cargo-chip">
                  📦 {{ order.quantity_ordered }}x {{ order.product?.name || 'Produce' }}
                </div>

                <div class="trip-action-buttons">
                  <button 
                    class="btn-picked-up" 
                    :class="{ 'picked-up': order.status === 'in_transit' || order.status === 'delivered' }"
                    :disabled="processingId === order.id || order.status === 'in_transit' || order.status === 'delivered'" 
                    @click.prevent="pickupJob(order.id)"
                  >
                    <span v-if="processingId === order.id && order.status !== 'in_transit'">Updating...</span>
                    <span v-else-if="order.status === 'in_transit' || order.status === 'delivered'">Picked Up ✓</span>
                    <span v-else>Picked Up</span>
                  </button>
                  <button
                    class="btn-delivered"
                    @click="completeJob(order.id)"
                    :disabled="processingId === order.id || order.status !== 'in_transit'"
                  >
                    <span v-if="processingId === order.id && order.status === 'in_transit'">Updating...</span>
                    <span v-else>Delivered</span>
                  </button>
                </div>
              </div>
            </section>

            <!-- Available Delivery Jobs Section -->
            <section class="section-block">
              <div class="section-header-flex">
                <h2 class="section-title">Available Delivery Jobs</h2>
                <span v-if="orders && orders.length > 0" class="nearby-badge">{{ orders.length }} AVAILABLE</span>
              </div>

              <!-- Empty Jobs State -->
              <div v-if="!orders || orders.length === 0" class="empty-state-card">
                <svg xmlns="http://www.w3.org/2000/svg" class="empty-icon" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                  <rect x="1" y="3" width="15" height="13"/>
                  <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                  <circle cx="5.5" cy="18.5" r="2.5"/>
                  <circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
                <h3 class="empty-title">No Available Jobs</h3>
                <p class="empty-desc">There are currently no pending produce orders awaiting an Aboboyaa driver. New delivery requests from farmers will appear here automatically.</p>
              </div>

              <!-- Real Jobs Feed List -->
              <div v-else class="jobs-feed-list">
                <div v-for="order in orders" :key="order.id" class="job-card-styled">
                  <div class="job-header-row">
                    <div class="produce-badge">
                      <span class="produce-name">{{ order.product?.name?.toUpperCase() || 'PRODUCE' }}</span>
                      <span class="produce-qty">{{ order.quantity_ordered }} {{ order.product?.unit || 'units' }}</span>
                    </div>
                    <div class="job-payout-box">
                      <span class="payout-sub">Est. Transport Fee</span>
                      <span class="payout-val">GHS {{ order.estimated_transport_cost ? Number(order.estimated_transport_cost).toFixed(2) : '40.00' }}</span>
                    </div>
                  </div>

                  <div class="route-preview">
                    <div class="route-pin-item">
                      <span class="pin-dot green"></span>
                      <span class="pin-text">Pickup: {{ order.product?.user?.location || 'Farm Gate' }} (Farmer: {{ order.product?.user?.name }})</span>
                    </div>
                    <div class="route-dot-connector"></div>
                    <div class="route-pin-item">
                      <span class="pin-dot orange"></span>
                      <span class="pin-text">Drop-off: {{ order.buyer?.location || 'Buyer Location' }} (Buyer: {{ order.buyer?.name }})</span>
                    </div>
                  </div>

                  <div class="driver-payout-line">
                    <span>🛺 Your payout for this trip: <strong>Est. ₵{{ order.estimated_transport_cost ? Number(order.estimated_transport_cost).toFixed(2) : '40.00' }}</strong></span>
                  </div>

                  <button 
                    @click="acceptJob(order.id)" 
                    :disabled="processingId === order.id" 
                    class="btn-accept-primary"
                  >
                    <span v-if="processingId === order.id">Accepting...</span>
                    <span v-else>Accept Job</span>
                  </button>
                </div>
              </div>
            </section>
          </div>


          <!-- ══════════════════════════════════════════════════════════════ -->
          <!-- SCREEN 2: TRIP HISTORY TAB                                     -->
          <!-- ══════════════════════════════════════════════════════════════ -->
          <div v-else-if="activeTab === 'history'" class="tab-content-view">
            <div class="section-header-flex">
              <h2 class="page-main-title">Trip History</h2>
            </div>

            <!-- Search Bar -->
            <div v-if="completedTrips && completedTrips.length > 0" class="search-input-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
              </svg>
              <input 
                type="text" 
                v-model="historyQuery" 
                placeholder="Search by produce or location..." 
                class="search-text-input"
              />
            </div>

            <!-- Empty History State -->
            <div v-if="!completedTrips || completedTrips.length === 0" class="empty-state-card">
              <svg xmlns="http://www.w3.org/2000/svg" class="empty-icon" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
              <h3 class="empty-title">No Trip History Yet</h3>
              <p class="empty-desc">Completed deliveries will be archived here with full route breakdown and transport earnings.</p>
            </div>

            <!-- Real Completed Trips List -->
            <div v-else class="history-trips-list">
              <div v-for="trip in filteredHistory" :key="trip.id" class="history-item-card">
                <div class="history-card-top">
                  <span class="history-date">{{ formatDate(trip.updated_at || trip.created_at) }}</span>
                  <span class="delivered-status-chip">DELIVERED</span>
                </div>
                <h3 class="history-cargo-title">{{ trip.quantity_ordered }}x {{ trip.product?.name || 'Produce' }}</h3>

                <div class="route-preview history-route">
                  <div class="route-pin-item">
                    <span class="pin-dot green"></span>
                    <span class="pin-text">{{ trip.product?.user?.location || 'Farm Gate' }}</span>
                  </div>
                  <div class="route-dot-connector"></div>
                  <div class="route-pin-item">
                    <span class="pin-dot orange"></span>
                    <span class="pin-text">{{ trip.buyer?.location || 'Buyer Destination' }}</span>
                  </div>
                </div>

                <div class="history-card-footer">
                  <span class="history-payout">GHS {{ Number(trip.estimated_transport_cost || 40.00).toFixed(2) }}</span>
                  <div v-if="trip.ratings && trip.ratings.length > 0" class="history-rating-pill">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="#F4A261" stroke="none">
                      <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                    <span>{{ trip.ratings[0].score }} (Rating)</span>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- ══════════════════════════════════════════════════════════════ -->
          <!-- SCREEN 3: EARNINGS OVERVIEW TAB (Using Real Order Data)        -->
          <!-- ══════════════════════════════════════════════════════════════ -->
          <div v-else-if="activeTab === 'earnings'" class="tab-content-view">
            <div class="earnings-header-block">
              <h2 class="page-main-title">Earnings Overview</h2>
              <p class="page-subtitle">Track your farm-to-market delivery revenue.</p>
            </div>

            <!-- Total Payout Banner Card -->
            <div class="total-payout-hero">
              <span class="payout-hero-label">TOTAL PAYOUT EARNED</span>
              <h1 class="payout-hero-amount">GHS {{ totalEarningsCalculated }}</h1>
            </div>

            <!-- Two Metric Stat Cards Grid -->
            <div class="metrics-two-col">
              <div class="metric-card-box">
                <span class="metric-sub">TODAY'S EARNINGS</span>
                <div class="metric-val-row">
                  <span class="metric-value">GHS {{ todayEarningsCalculated }}</span>
                </div>
              </div>

              <div class="metric-card-box">
                <span class="metric-sub">COMPLETED DELIVERIES</span>
                <div class="metric-val-row">
                  <span class="metric-value">{{ completedTrips ? completedTrips.length : 0 }} Trips</span>
                </div>
              </div>
            </div>

            <!-- Recent Payouts Section (Derived Dynamically from Real Completed Orders) -->
            <section class="section-block margin-top-lg">
              <div class="section-header-flex">
                <h3 class="section-subheading">Recent Payouts</h3>
                <button v-if="recentPayoutsList.length > 0" class="view-all-link" @click="triggerViewAllPayouts">View All</button>
              </div>

              <!-- Empty Recent Payouts State -->
              <div v-if="recentPayoutsList.length === 0" class="empty-state-card">
                <svg xmlns="http://www.w3.org/2000/svg" class="empty-icon" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                  <rect x="2" y="6" width="20" height="12" rx="2"/>
                  <circle cx="12" cy="12" r="2"/>
                  <path d="M6 12h.01M18 12h.01"/>
                </svg>
                <h3 class="empty-title">No Payout Records Yet</h3>
                <p class="empty-desc">Payout transactions for completed farm deliveries will be recorded here automatically.</p>
              </div>

              <!-- Real Payout Feed List -->
              <div v-else class="recent-payouts-feed">
                <div v-for="(payout, idx) in recentPayoutsList" :key="idx" class="payout-card-item">
                  <div class="payout-left-box">
                    <div class="payout-icon-avatar" :class="{ processing: payout.status === 'PROCESSING' }">
                      <svg v-if="payout.status === 'SETTLED'" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="6" width="20" height="12" rx="2"/>
                        <circle cx="12" cy="12" r="2"/>
                        <path d="M6 12h.01M18 12h.01"/>
                      </svg>
                      <svg v-else xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="1"/>
                        <circle cx="17" cy="12" r="1"/>
                        <circle cx="7" cy="12" r="1"/>
                      </svg>
                    </div>

                    <div class="payout-details-col">
                      <h4 class="payout-trip-id">Trip ID: {{ payout.id }}</h4>
                      <span class="payout-meta-sub">{{ payout.date }} • {{ payout.method }}</span>
                    </div>
                  </div>

                  <div class="payout-right-box">
                    <div class="payout-amount-text">
                      <span class="currency-tag">GHS</span>
                      <span class="amount-number">{{ payout.amount }}</span>
                    </div>
                    <span class="status-pill" :class="payout.status.toLowerCase()">{{ payout.status }}</span>
                  </div>
                </div>
              </div>
            </section>
          </div>


          <!-- ══════════════════════════════════════════════════════════════ -->
          <!-- SCREEN 4: DRIVER PROFILE TAB                                   -->
          <!-- ══════════════════════════════════════════════════════════════ -->
          <div v-else-if="activeTab === 'profile'" class="tab-content-view">
            <!-- Driver Header Card -->
            <div class="driver-profile-hero">
              <div class="profile-avatar-wrapper">
                <div class="profile-avatar-circle">
                  {{ driverDetails.name.charAt(0).toUpperCase() }}
                </div>
              </div>
              <div class="profile-hero-info">
                <h2 class="driver-full-name">{{ driverDetails.name }}</h2>
                <span class="driver-vehicle-subtitle">{{ driverDetails.model }}</span>
                <div class="profile-rating-pill">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="#F4A261" stroke="none">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                  </svg>
                  <span>{{ driverRatingFormatted }}</span>
                </div>
              </div>
            </div>

            <!-- Stats Overview 2-Col Grid -->
            <div class="metrics-two-col margin-top-md">
              <div class="profile-metric-box">
                <span class="profile-metric-label">Total Earnings</span>
                <span class="profile-metric-val green-text">GHS {{ totalEarningsCalculated }}</span>
              </div>
              <div class="profile-metric-box">
                <span class="profile-metric-label">Deliveries Completed</span>
                <span class="profile-metric-val teal-text">{{ completedTrips ? completedTrips.length : (driverDetails.jobsDone || 0) }}</span>
              </div>
            </div>

            <!-- Document Status Card -->
            <div class="profile-section-card">
              <div class="card-section-header">
                <h3 class="card-section-title">Document Status</h3>
                <button class="edit-link-btn" @click="openEditModal">Edit</button>
              </div>

              <div class="doc-status-list">
                <div class="doc-item-row">
                  <div class="doc-info">
                    <div class="doc-icon-box">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="16" rx="2"/>
                        <line x1="7" y1="8" x2="17" y2="8"/>
                        <line x1="7" y1="12" x2="13" y2="12"/>
                      </svg>
                    </div>
                    <div class="doc-text-block">
                      <span class="doc-name">Driver's License</span>
                      <span class="doc-expiry">Exp: {{ driverDetails.licenseExpiry }}</span>
                    </div>
                  </div>
                  <span class="status-verified-badge">VERIFIED</span>
                </div>

                <div class="doc-item-row">
                  <div class="doc-info">
                    <div class="doc-icon-box">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                      </svg>
                    </div>
                    <div class="doc-text-block">
                      <span class="doc-name">Vehicle Insurance</span>
                      <span class="doc-expiry">Exp: {{ driverDetails.insuranceExpiry }}</span>
                    </div>
                  </div>
                  <span class="status-verified-badge">VERIFIED</span>
                </div>
              </div>
            </div>

            <!-- Vehicle Details Grid -->
            <div class="profile-section-card">
              <div class="card-section-header">
                <h3 class="card-section-title">Vehicle Details</h3>
                <button class="edit-link-btn" @click="openEditModal">Edit</button>
              </div>

              <div class="vehicle-specs-grid">
                <div class="spec-cell">
                  <span class="spec-label">MODEL</span>
                  <span class="spec-value">{{ driverDetails.model }}</span>
                </div>
                <div class="spec-cell">
                  <span class="spec-label">PLATE</span>
                  <span class="spec-value">{{ driverDetails.plate }}</span>
                </div>
                <div class="spec-cell">
                  <span class="spec-label">CAPACITY</span>
                  <span class="spec-value">{{ driverDetails.capacity }}</span>
                </div>
                <div class="spec-cell">
                  <span class="spec-label">FUEL TYPE</span>
                  <span class="spec-value">{{ driverDetails.fuelType }}</span>
                </div>
              </div>
            </div>

            <!-- Logout Button Action -->
            <div class="logout-wrapper">
              <Link href="/logout" method="post" as="button" class="btn-logout-account">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
                </svg>
                <span>Logout Account</span>
              </Link>
            </div>

            <div class="version-footer-text">
              FarmLink Driver Portal • Western Region
            </div>
          </div>

        </div>
      </main>
    </div>

    <!-- Edit Driver & Vehicle Details Modal -->
    <div v-if="showEditModal" class="modal-overlay" @click.self="showEditModal = false">
      <div class="modal-card">
        <div class="modal-header">
          <h3 class="modal-title">Edit Driver & Vehicle Details</h3>
          <button class="btn-close-modal" @click="showEditModal = false">&times;</button>
        </div>

        <form @submit.prevent="saveDriverDetails" class="modal-form">
          <div class="form-group">
            <label class="form-label">Full Name</label>
            <input type="text" v-model="editForm.name" class="form-input" required />
          </div>

          <div class="form-group">
            <label class="form-label">Vehicle Model / Type</label>
            <input type="text" v-model="editForm.model" class="form-input" placeholder="e.g. Aboboyaa Motor Tricycle" required />
          </div>

          <div class="form-row-2col">
            <div class="form-group">
              <label class="form-label">License Plate</label>
              <input type="text" v-model="editForm.plate" class="form-input" placeholder="e.g. GW-492-23" required />
            </div>
            <div class="form-group">
              <label class="form-label">Capacity (KG)</label>
              <input type="text" v-model="editForm.capacity" class="form-input" placeholder="e.g. 1,200 KG" required />
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Fuel Type</label>
            <select v-model="editForm.fuelType" class="form-input">
              <option value="Petrol">Petrol</option>
              <option value="Diesel">Diesel</option>
              <option value="Electric">Electric</option>
            </select>
          </div>

          <div class="form-row-2col">
            <div class="form-group">
              <label class="form-label">License Expiry</label>
              <input type="text" v-model="editForm.licenseExpiry" class="form-input" placeholder="e.g. 12 Dec 2026" />
            </div>
            <div class="form-group">
              <label class="form-label">Insurance Expiry</label>
              <input type="text" v-model="editForm.insuranceExpiry" class="form-input" placeholder="e.g. 18 Oct 2026" />
            </div>
          </div>

          <div class="modal-actions">
            <button type="button" class="btn-cancel" @click="showEditModal = false">Cancel</button>
            <button type="submit" class="btn-save-primary">Save Details</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Mobile Bottom Navigation Bar (4-Tab Capsule) -->
    <nav class="mobile-bottom-nav">
      <button 
        @click="activeTab = 'jobs'" 
        class="mobile-nav-item" 
        :class="{ active: activeTab === 'jobs' }"
      >
        <div class="nav-icon-wrap">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <rect x="1" y="3" width="15" height="13"/>
            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
            <circle cx="5.5" cy="18.5" r="2.5"/>
            <circle cx="18.5" cy="18.5" r="2.5"/>
          </svg>
        </div>
        <span class="nav-label">Jobs</span>
      </button>

      <button 
        @click="activeTab = 'earnings'" 
        class="mobile-nav-item" 
        :class="{ active: activeTab === 'earnings' }"
      >
        <div class="nav-icon-wrap">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <rect x="2" y="6" width="20" height="12" rx="2"/>
            <circle cx="12" cy="12" r="2"/>
            <path d="M6 12h.01M18 12h.01"/>
          </svg>
        </div>
        <span class="nav-label">Earnings</span>
      </button>

      <button 
        @click="activeTab = 'history'" 
        class="mobile-nav-item" 
        :class="{ active: activeTab === 'history' }"
      >
        <div class="nav-icon-wrap">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
          </svg>
        </div>
        <span class="nav-label">History</span>
      </button>

      <button 
        @click="activeTab = 'profile'" 
        class="mobile-nav-item" 
        :class="{ active: activeTab === 'profile' }"
      >
        <div class="nav-icon-wrap">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
        </div>
        <span class="nav-label">Profile</span>
      </button>
    </nav>

  </div>
</template>

<script>
import { Link, router, usePage } from '@inertiajs/vue3';
import { ref, computed, reactive, onMounted, onUnmounted } from 'vue';

export default {
  name: 'DriverDashboard',
  components: {
    Link
  },
  props: {
    orders: {
      type: Array,
      default: () => []
    },
    activeTrips: {
      type: Array,
      default: () => []
    },
    completedTrips: {
      type: Array,
      default: () => []
    }
  },
  setup(props) {
    const page = usePage();
    const activeTab = ref('jobs');
    const isOnline = ref(true);
    const processingId = ref(null);
    const historyQuery = ref('');
    const showEditModal = ref(false);

    let pollInterval = null;

    onMounted(() => {
      pollInterval = setInterval(() => {
        router.reload({ preserveScroll: true, only: ['orders', 'activeTrips', 'completedTrips'] });
      }, 5000);
    });

    onUnmounted(() => {
      if (pollInterval) clearInterval(pollInterval);
    });

    // Reactive Driver & Vehicle Details
    const driverDetails = reactive({
      name: page.props.auth?.user?.name || 'Emmanuel Mensah',
      model: 'Aboboyaa Motor Tricycle',
      plate: 'GW-492-23',
      capacity: '1,200 KG',
      fuelType: 'Petrol',
      licenseExpiry: '12 Dec 2026',
      insuranceExpiry: '18 Oct 2026',
      jobsDone: 0
    });

    const editForm = reactive({ ...driverDetails });

    const openEditModal = () => {
      Object.assign(editForm, driverDetails);
      showEditModal.value = true;
    };

    const saveDriverDetails = () => {
      Object.assign(driverDetails, editForm);
      showEditModal.value = false;
    };

    const driverRatingFormatted = computed(() => '5.0');

    const formatDate = (dateStr) => {
      if (!dateStr) return 'Recently';
      const d = new Date(dateStr);
      return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    };

    // REAL DATA: Recent Payouts derived dynamically from driver's actual completed orders
    const recentPayoutsList = computed(() => {
      if (!props.completedTrips || props.completedTrips.length === 0) {
        return [];
      }
      return props.completedTrips.map(order => ({
        id: `#ADG-${order.id}`,
        date: formatDate(order.updated_at || order.created_at),
        method: 'Mobile Money',
        amount: Number(order.estimated_transport_cost || 40.00).toFixed(2),
        status: order.payment_status === 'released' || order.status === 'delivered' ? 'SETTLED' : 'PROCESSING'
      }));
    });

    const triggerViewAllPayouts = () => {
      alert('Viewing complete Mobile Money & Bank payout history statement...');
    };

    // Total earnings calculated dynamically from real completed orders
    const totalEarningsCalculated = computed(() => {
      if (!props.completedTrips || props.completedTrips.length === 0) {
        return '0.00';
      }
      const sum = props.completedTrips.reduce((acc, item) => {
        return acc + Number(item.estimated_transport_cost || 40.00);
      }, 0);
      return sum.toFixed(2);
    });

    const todayEarningsCalculated = computed(() => {
      if (!props.completedTrips || props.completedTrips.length === 0) {
        return '0.00';
      }
      const todayStr = new Date().toISOString().split('T')[0];
      const sum = props.completedTrips.reduce((acc, item) => {
        const itemDate = (item.updated_at || item.created_at || '').split('T')[0];
        if (itemDate === todayStr) {
          return acc + Number(item.estimated_transport_cost || 40.00);
        }
        return acc;
      }, 0);
      return sum.toFixed(2);
    });

    const filteredHistory = computed(() => {
      if (!props.completedTrips) return [];
      if (!historyQuery.value.trim()) return props.completedTrips;
      const q = historyQuery.value.toLowerCase();
      return props.completedTrips.filter(trip => {
        const produce = (trip.product?.name || '').toLowerCase();
        const pickup = (trip.product?.user?.location || '').toLowerCase();
        const dropoff = (trip.buyer?.location || '').toLowerCase();
        return produce.includes(q) || pickup.includes(q) || dropoff.includes(q);
      });
    });

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

    const pickupJob = (orderId) => {
      processingId.value = orderId;
      router.post(`/driver/orders/${orderId}/pickup`, {}, {
        onFinish: () => {
          processingId.value = null;
        }
      });
    };

    return {
      activeTab,
      isOnline,
      processingId,
      historyQuery,
      driverDetails,
      editForm,
      showEditModal,
      openEditModal,
      saveDriverDetails,
      driverRatingFormatted,
      recentPayoutsList,
      triggerViewAllPayouts,
      totalEarningsCalculated,
      todayEarningsCalculated,
      filteredHistory,
      formatDate,
      acceptJob,
      pickupJob,
      completeJob
    };
  }
}
</script>

<style scoped>
@import "../../css/design-tokens.css";

.dashboard-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background-color: var(--color-bg-page);
  color: var(--color-neutral-900);
  font-family: var(--font-family);
  padding-bottom: 72px;
}

.sidebar-nav {
  display: none;
}

.mobile-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: var(--space-3) var(--space-4);
  background-color: var(--color-white);
  border-bottom: 1px solid var(--color-border);
  position: sticky;
  top: 0;
  z-index: 20;
}

.header-brand {
  display: flex;
  align-items: center;
  gap: var(--space-2);
}

.logo-text {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-primary);
}

.mobile-user-name {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  border-left: 1.5px solid var(--color-border);
  padding-left: var(--space-2);
  margin-left: var(--space-1);
}

.status-pill-toggle {
  display: flex;
  align-items: center;
  gap: var(--space-2);
  background-color: var(--color-neutral-100);
  padding: 4px var(--space-3);
  border-radius: var(--radius-pill);
  border: 1px solid var(--color-border);
  cursor: pointer;
}

.status-pill-toggle.online {
  background-color: var(--color-primary-subtle);
  border-color: var(--color-primary-light);
}

.toggle-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background-color: var(--color-neutral-500);
}

.status-pill-toggle.online .toggle-dot {
  background-color: var(--color-primary);
}

.toggle-label {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-700);
}

.main-layout {
  flex: 1;
  display: flex;
  justify-content: center;
  width: 100%;
}

.content-body {
  width: 100%;
  max-width: 600px;
  padding: var(--space-4);
}

.top-status-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: var(--color-white);
  padding: var(--space-3) var(--space-4);
  border-radius: var(--radius-lg);
  border: 1px solid var(--color-border);
  box-shadow: var(--shadow-xs);
  margin-bottom: var(--space-4);
}

.control-sublabel {
  display: block;
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-500);
  letter-spacing: 0.5px;
  margin-bottom: 2px;
}

.online-switch {
  display: flex;
  align-items: center;
  gap: var(--space-2);
  background: none;
  border: none;
  cursor: pointer;
}

.switch-knob {
  width: 14px;
  height: 14px;
  border-radius: 50%;
  background-color: var(--color-neutral-400);
}

.online-switch.is_active .switch-knob {
  background-color: var(--color-primary);
}

.switch-text {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.rating-badge-pill {
  display: flex;
  align-items: center;
  gap: 4px;
  background-color: var(--color-warning-light);
  padding: 2px 8px;
  border-radius: var(--radius-pill);
}

.rating-num {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-secondary-dark);
}

.revenue-banner-card {
  position: relative;
  background: linear-gradient(135deg, #1B4332 0%, #2D6A4F 100%);
  color: var(--color-white);
  padding: var(--space-5);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-md);
  margin-bottom: var(--space-5);
  overflow: hidden;
}

.banner-subtitle {
  font-size: var(--font-size-xs);
  color: var(--color-primary-lighter);
  font-weight: var(--font-weight-medium);
}

.banner-amount {
  font-size: var(--font-size-2xl);
  font-weight: var(--font-weight-bold);
  color: #FFFFFF !important;
  margin-top: 4px;
}

.banner-icon-watermark {
  position: absolute;
  right: var(--space-4);
  bottom: var(--space-3);
  opacity: 0.18;
}

.section-block {
  margin-bottom: var(--space-5);
}

.margin-top-lg {
  margin-top: var(--space-5);
}

.section-header-flex {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: var(--space-3);
}

.section-title, .section-subheading {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.view-all-link {
  background: none;
  border: none;
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-500);
  cursor: pointer;
}

.view-all-link:hover {
  color: var(--color-primary);
}

.nearby-badge {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary-hover);
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  padding: 2px 8px;
  border-radius: var(--radius-pill);
}

.recent-payouts-feed {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

.payout-card-item {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-3) var(--space-4);
  display: flex;
  align-items: center;
  justify-content: space-between;
  box-shadow: var(--shadow-xs);
}

.payout-left-box {
  display: flex;
  align-items: center;
  gap: var(--space-3);
}

.payout-icon-avatar {
  width: 42px;
  height: 42px;
  border-radius: var(--radius-md);
  background-color: #E6F4F1;
  color: #1E7268;
  display: flex;
  align-items: center;
  justify-content: center;
}

.payout-icon-avatar.processing {
  background-color: #FDF4E7;
  color: #D97706;
}

.payout-details-col {
  display: flex;
  flex-direction: column;
}

.payout-trip-id {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.payout-meta-sub {
  font-size: 11px;
  color: var(--color-neutral-500);
  margin-top: 2px;
}

.payout-right-box {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 2px;
}

.payout-amount-text {
  display: flex;
  align-items: baseline;
  gap: 4px;
}

.payout-amount-text .currency-tag {
  font-size: 11px;
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.payout-amount-text .amount-number {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.status-pill {
  font-size: 9px;
  font-weight: var(--font-weight-bold);
  padding: 2px 8px;
  border-radius: var(--radius-pill);
  letter-spacing: 0.5px;
}

.status-pill.settled {
  background-color: #D1FAE5;
  color: #065F46;
}

.status-pill.processing {
  background-color: #FEF3C7;
  color: #92400E;
}

.empty-state-card {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-6) var(--space-4);
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.empty-icon {
  color: var(--color-neutral-400);
  margin-bottom: var(--space-3);
}

.empty-title {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.empty-desc {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  max-width: 380px;
  margin-top: 4px;
  line-height: var(--line-height-base);
}

.active-section {
  background-color: var(--color-white);
  border: 1.5px solid var(--color-primary-light);
  border-radius: var(--radius-lg);
  padding: var(--space-4);
  box-shadow: var(--shadow-sm);
}

.active-pulse-badge {
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary-hover);
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  padding: 2px var(--space-2);
  border-radius: var(--radius-pill);
}

.active-trip-card {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

.payout-label-sm {
  font-size: 10px;
  color: var(--color-neutral-500);
  text-transform: uppercase;
}

.payout-amount {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-primary);
}

.progress-steps-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: var(--space-2) 0;
}

.progress-step {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 4px;
}

.step-icon-circle {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background-color: var(--color-neutral-100);
  color: var(--color-neutral-500);
  display: flex;
  align-items: center;
  justify-content: center;
}

.progress-step.completed .step-icon-circle {
  background-color: var(--color-primary);
  color: var(--color-white);
}

.progress-step.active .step-icon-circle {
  background-color: var(--color-secondary);
  color: var(--color-white);
}

.step-name {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-medium);
}

.step-connector {
  flex: 1;
  height: 2px;
  background-color: var(--color-neutral-200);
  margin: 0 4px 16px;
}

.step-connector.completed {
  background-color: var(--color-primary);
}

.route-info-block {
  background-color: var(--color-neutral-50);
  padding: var(--space-3);
  border-radius: var(--radius-md);
  display: flex;
  flex-direction: column;
  gap: var(--space-2);
}

.route-row {
  display: flex;
  align-items: center;
  gap: var(--space-3);
}

.route-type-tag {
  font-size: 9px;
  font-weight: var(--font-weight-bold);
  padding: 2px 6px;
  border-radius: 4px;
}

.pickup-tag { background-color: var(--color-primary-subtle); color: var(--color-primary-hover); }
.dropoff-tag { background-color: var(--color-warning-light); color: var(--color-secondary-dark); }

.route-detail {
  display: flex;
  flex-direction: column;
}

.route-location {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-semibold);
}

.route-party {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

.route-connector-line {
  width: 1px;
  height: 12px;
  background-color: var(--color-neutral-300);
  margin-left: 24px;
}

.cargo-chip {
  background-color: var(--color-neutral-100);
  padding: var(--space-2) var(--space-3);
  border-radius: var(--radius-md);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
}

.trip-action-buttons {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-3);
  margin-top: var(--space-2);
}

.btn-picked-up, .btn-delivered {
  padding: var(--space-2) var(--space-3);
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
  border: none;
}

.btn-picked-up {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary);
  border: 1px solid var(--color-primary-light);
}

.btn-picked-up.picked-up {
  background-color: var(--color-primary);
  color: var(--color-white);
}

.btn-delivered {
  background-color: var(--color-tertiary);
  color: var(--color-white);
}

.btn-delivered:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.jobs-feed-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
}

.job-card-styled {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-4);
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

.job-header-row {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.produce-badge {
  display: flex;
  flex-direction: column;
}

.produce-name {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-bold);
}

.produce-qty {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

.job-payout-box {
  background-color: var(--color-warning-light);
  padding: 4px var(--space-3);
  border-radius: var(--radius-md);
  text-align: right;
}

.payout-sub {
  display: block;
  font-size: 9px;
  font-weight: var(--font-weight-bold);
  color: var(--color-secondary-dark);
}

.payout-val {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-bold);
  color: var(--color-secondary-dark);
}

.route-preview {
  display: flex;
  flex-direction: column;
  gap: 4px;
  background-color: var(--color-neutral-50);
  padding: var(--space-3);
  border-radius: var(--radius-md);
}

.route-pin-item {
  display: flex;
  align-items: center;
  gap: var(--space-2);
}

.pin-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
}

.pin-dot.green { background-color: var(--color-primary); }
.pin-dot.orange { background-color: var(--color-secondary); }

.pin-text {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
}

.route-dot-connector {
  width: 1px;
  height: 10px;
  background-color: var(--color-neutral-300);
  margin-left: 3px;
}

.driver-payout-line {
  font-size: var(--font-size-sm);
  font-weight: 600;
  color: var(--color-primary);
  background-color: var(--color-primary-subtle);
  padding: var(--space-2) var(--space-3);
  border-radius: var(--radius-md);
  margin-top: var(--space-2);
}

.btn-accept-primary {
  width: 100%;
  background-color: var(--color-primary);
  color: var(--color-white);
  border: none;
  padding: var(--space-3);
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
}

.search-input-wrapper {
  position: relative;
  display: flex;
  align-items: center;
  margin-bottom: var(--space-4);
}

.search-icon {
  position: absolute;
  left: var(--space-3);
  color: var(--color-neutral-400);
}

.search-text-input {
  width: 100%;
  padding: var(--space-3) var(--space-3) var(--space-3) 40px;
  border-radius: var(--radius-md);
  border: 1px solid var(--color-neutral-300);
  background-color: var(--color-white);
  font-size: var(--font-size-sm);
  outline: none;
}

.history-trips-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

.history-item-card {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-4);
}

.history-card-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 4px;
}

.history-date {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

.delivered-status-chip {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary-hover);
  font-size: 9px;
  font-weight: var(--font-weight-bold);
  padding: 2px 6px;
  border-radius: 4px;
}

.history-cargo-title {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
}

.history-card-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: var(--space-3);
  padding-top: var(--space-2);
  border-top: 1px dashed var(--color-border);
}

.history-payout {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-primary);
}

.history-rating-pill {
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
}

.page-main-title {
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-bold);
}

.page-subtitle {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  margin-top: 2px;
  margin-bottom: var(--space-4);
}

.total-payout-hero {
  background: linear-gradient(135deg, #2D6A4F 0%, #1B4332 100%);
  color: var(--color-white);
  padding: var(--space-5);
  border-radius: var(--radius-lg);
  text-align: center;
  margin-bottom: var(--space-4);
}

.payout-hero-label {
  font-size: var(--font-size-xs);
  color: var(--color-primary-lighter);
  font-weight: var(--font-weight-bold);
  letter-spacing: 0.5px;
}

.payout-hero-amount {
  font-size: var(--font-size-3xl);
  font-weight: var(--font-weight-bold);
  color: #FFFFFF !important;
  margin-top: var(--space-2);
}

.metrics-two-col {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-3);
}

.metric-card-box, .profile-metric-box {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-3) var(--space-4);
  display: flex;
  flex-direction: column;
  justify-content: center;
  min-height: 84px;
  box-shadow: var(--shadow-xs);
}

.metric-sub, .profile-metric-label {
  font-size: 11px;
  font-weight: var(--font-weight-medium);
  color: var(--color-neutral-500);
  margin-bottom: 4px;
  line-height: 1.2;
}

.metric-value, .profile-metric-val {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  line-height: 1.2;
  word-break: break-word;
}

.profile-metric-val.green-text {
  color: var(--color-primary);
}

.profile-metric-val.teal-text {
  color: var(--color-tertiary);
}

.driver-profile-hero {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-4);
  display: flex;
  align-items: center;
  gap: var(--space-4);
  box-shadow: var(--shadow-xs);
}

.profile-avatar-circle {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background-color: var(--color-primary);
  color: var(--color-white);
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-bold);
  display: flex;
  align-items: center;
  justify-content: center;
}

.profile-hero-info {
  display: flex;
  flex-direction: column;
}

.driver-full-name {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.driver-vehicle-subtitle {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  margin-top: 2px;
}

.profile-rating-pill {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  background-color: var(--color-warning-light);
  color: var(--color-secondary-dark);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  padding: 2px 8px;
  border-radius: var(--radius-pill);
  width: fit-content;
  margin-top: 6px;
}

.profile-section-card {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-4);
  margin-top: var(--space-4);
  box-shadow: var(--shadow-xs);
}

.card-section-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: var(--space-3);
}

.card-section-title {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.edit-link-btn {
  background: none;
  border: none;
  color: var(--color-primary);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
}

.edit-link-btn:hover {
  text-decoration: underline;
}

.doc-status-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

.doc-item-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: var(--color-bg-page);
  padding: var(--space-3);
  border-radius: var(--radius-md);
  border: 1px solid var(--color-border);
}

.doc-info {
  display: flex;
  align-items: center;
  gap: var(--space-3);
}

.doc-icon-box {
  width: 36px;
  height: 36px;
  border-radius: var(--radius-md);
  background-color: var(--color-neutral-100);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-neutral-700);
}

.doc-text-block {
  display: flex;
  flex-direction: column;
}

.doc-name {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.doc-expiry {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  margin-top: 1px;
}

.status-verified-badge {
  background-color: #1B4332;
  color: var(--color-white);
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  padding: 3px 8px;
  border-radius: 4px;
  letter-spacing: 0.5px;
}

.vehicle-specs-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-3);
}

.spec-cell {
  background-color: var(--color-bg-page);
  padding: var(--space-3);
  border-radius: var(--radius-md);
  border: 1px solid var(--color-border);
  display: flex;
  flex-direction: column;
}

.spec-label {
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-500);
  letter-spacing: 0.5px;
  text-transform: uppercase;
}

.spec-value {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin-top: 3px;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 100;
  padding: var(--space-4);
}

.modal-card {
  background-color: var(--color-white);
  border-radius: var(--radius-lg);
  width: 100%;
  max-width: 480px;
  padding: var(--space-5);
  box-shadow: var(--shadow-lg);
}

.modal-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: var(--space-4);
  border-bottom: 1px solid var(--color-border);
  padding-bottom: var(--space-3);
}

.modal-title {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.btn-close-modal {
  background: none;
  border: none;
  font-size: 24px;
  color: var(--color-neutral-500);
  cursor: pointer;
}

.modal-form {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.form-row-2col {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-3);
}

.form-label {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-700);
}

.form-input {
  width: 100%;
  padding: var(--space-2) var(--space-3);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  outline: none;
}

.form-input:focus {
  border-color: var(--color-primary);
}

.modal-actions {
  display: flex;
  justify-content: flex-end;
  gap: var(--space-3);
  margin-top: var(--space-4);
}

.btn-cancel {
  background-color: var(--color-neutral-100);
  color: var(--color-neutral-700);
  border: none;
  padding: var(--space-2) var(--space-4);
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
}

.btn-save-primary {
  background-color: var(--color-primary);
  color: var(--color-white);
  border: none;
  padding: var(--space-2) var(--space-4);
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
}

.logout-wrapper {
  margin-top: var(--space-6);
}

.btn-logout-account {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
  background-color: #FFF0F0;
  color: var(--color-danger);
  border: 1px solid var(--color-danger-light);
  padding: var(--space-3);
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
}

.version-footer-text {
  text-align: center;
  font-size: var(--font-size-xs);
  color: var(--color-neutral-400);
  margin-top: var(--space-4);
}

.mobile-bottom-nav {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  height: 64px;
  background-color: var(--color-white);
  border-top: 1px solid var(--color-border);
  display: flex;
  align-items: center;
  justify-content: space-around;
  z-index: 50;
}

.mobile-nav-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 2px;
  background: none;
  border: none;
  color: var(--color-neutral-500);
  cursor: pointer;
  padding: 6px var(--space-3);
  border-radius: var(--radius-md);
  flex: 1;
}

.mobile-nav-item.active {
  color: var(--color-primary);
}

.mobile-nav-item.active .nav-icon-wrap {
  background-color: var(--color-primary-subtle);
  color: var(--color-primary);
  padding: 4px 16px;
  border-radius: var(--radius-pill);
}

.nav-label {
  font-size: 10px;
  font-weight: var(--font-weight-bold);
}

@media (min-width: 768px) {
  .dashboard-container {
    flex-direction: row;
    padding-bottom: 0;
  }

  .mobile-header, .mobile-bottom-nav {
    display: none;
  }

  .sidebar-nav {
    display: flex;
    flex-direction: column;
    width: var(--sidebar-width);
    background-color: var(--color-white);
    border-right: 1px solid var(--color-border);
    padding: var(--space-4);
    height: 100vh;
    position: sticky;
    top: 0;
  }

  .sidebar-brand {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    margin-bottom: var(--space-6);
  }

  .sidebar-user {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    padding: var(--space-3);
    background-color: var(--color-neutral-50);
    border-radius: var(--radius-md);
    margin-bottom: var(--space-5);
  }

  .user-avatar.driver {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: var(--color-primary);
    color: var(--color-white);
    font-weight: var(--font-weight-bold);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .user-info {
    display: flex;
    flex-direction: column;
  }

  .user-name {
    font-size: var(--font-size-sm);
    font-weight: var(--font-weight-bold);
  }

  .user-role {
    font-size: var(--font-size-xs);
    color: var(--color-neutral-500);
  }

  .sidebar-menu {
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
    flex: 1;
  }

  .menu-item {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    padding: var(--space-3) var(--space-4);
    border-radius: var(--radius-md);
    border: none;
    background: none;
    color: var(--color-neutral-700);
    font-size: var(--font-size-sm);
    font-weight: var(--font-weight-semibold);
    cursor: pointer;
    text-align: left;
  }

  .menu-item:hover, .menu-item.active {
    background-color: var(--color-primary-subtle);
    color: var(--color-primary);
  }

  .logout-btn-sidebar {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    width: 100%;
    padding: var(--space-3);
    border: none;
    background: none;
    color: var(--color-danger);
    font-size: var(--font-size-sm);
    font-weight: var(--font-weight-bold);
    cursor: pointer;
  }

  .main-layout {
    flex: 1;
    padding: var(--space-6);
  }

  .content-body {
    max-width: 800px;
  }
}
</style>
