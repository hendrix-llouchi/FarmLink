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
          {{ $page.props.auth?.user?.name?.charAt(0).toUpperCase() || 'K' }}
        </div>
        <div class="user-info">
          <span class="user-name">{{ $page.props.auth?.user?.name || 'Kojo Antwi' }}</span>
          <span class="user-role">5-ton Truck • ADG-0922</span>
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
          {{ $page.props.auth?.user?.name || 'Driver Portal' }}
        </span>
      </div>
      <div class="header-actions">
        <!-- Status Switch Pill in Mobile Header -->
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
          <!-- SCREEN 1: JOBS TAB (Available Delivery Jobs)                   -->
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
                <span class="control-sublabel">CURRENT RATING</span>
                <div class="rating-badge-pill">
                  <span class="rating-num">4.9</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#F4A261" stroke="none">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Revenue Today Gradient Banner -->
            <div class="revenue-banner-card">
              <div class="banner-info">
                <span class="banner-subtitle">Earnings Today</span>
                <h1 class="banner-amount">GHS 480.00</h1>
              </div>
              <div class="banner-icon-watermark">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                  <rect x="2" y="6" width="20" height="12" rx="2"/>
                  <circle cx="12" cy="12" r="2"/>
                  <path d="M6 12h.01M18 12h.01"/>
                </svg>
              </div>
            </div>

            <!-- Active Trip Section (If Driver Has In-Progress Order) -->
            <section v-if="activeTrips && activeTrips.length > 0" class="section-block active-section">
              <div class="section-header">
                <h2 class="section-title">Active Delivery</h2>
                <span class="active-pulse-badge">IN TRANSIT</span>
              </div>

              <div v-for="order in activeTrips" :key="order.id" class="active-trip-card">
                <div class="trip-status-row">
                  <div class="payout-col">
                    <span class="payout-label-sm">Estimated Payout</span>
                    <span class="payout-amount">
                      GHS {{ order.estimated_transport_cost ? Number(order.estimated_transport_cost).toFixed(2) : Number(order.total_price).toFixed(2) }}
                    </span>
                  </div>
                </div>

                <!-- Progress Steps -->
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

                <div class="route-info-block">
                  <div class="route-row">
                    <span class="route-type-tag pickup-tag">PICKUP</span>
                    <div class="route-detail">
                      <span class="route-location">{{ order.product?.user?.location || 'Tarkwa Farm Gate' }}</span>
                      <span class="route-party">{{ order.product?.user?.name || 'Farmer' }}</span>
                    </div>
                  </div>
                  <div class="route-connector-line"></div>
                  <div class="route-row">
                    <span class="route-type-tag dropoff-tag">DROP-OFF</span>
                    <div class="route-detail">
                      <span class="route-location">{{ order.buyer?.location || 'Takoradi Market' }}</span>
                      <span class="route-party">{{ order.buyer?.name || 'Buyer' }}</span>
                    </div>
                  </div>
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

            <!-- Available Delivery Jobs List Section -->
            <section class="section-block">
              <div class="section-header-flex">
                <h2 class="section-title">Available Delivery Jobs</h2>
                <button class="btn-filter-icon" @click="toggleFilter">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                  </svg>
                  <span>Filter</span>
                </button>
              </div>

              <!-- Available Job Cards -->
              <div class="jobs-feed-list">
                <!-- Backend Orders List -->
                <div v-for="order in orders" :key="order.id" class="job-card-styled">
                  <div class="job-header-row">
                    <div class="produce-badge">
                      <span class="produce-name">{{ order.product?.name?.toUpperCase() || 'PRODUCE' }}</span>
                      <span class="produce-qty">{{ order.quantity_ordered }} Bags</span>
                    </div>
                    <div class="job-payout-box">
                      <span class="payout-sub">Est. Payout</span>
                      <span class="payout-val">GHS {{ order.estimated_transport_cost ? Number(order.estimated_transport_cost).toFixed(0) : '240' }}</span>
                    </div>
                  </div>

                  <div class="route-preview">
                    <div class="route-pin-item">
                      <span class="pin-dot green"></span>
                      <span class="pin-text">{{ order.product?.user?.location || 'Tarkwa (Farm Gate)' }}</span>
                    </div>
                    <div class="route-dot-connector"></div>
                    <div class="route-pin-item">
                      <span class="pin-dot orange"></span>
                      <span class="pin-text">{{ order.buyer?.location || 'Takoradi (Port Side)' }}</span>
                    </div>
                  </div>

                  <div class="job-meta-row">
                    <span class="meta-item">Pickup in 45m</span>
                    <span class="meta-dot">•</span>
                    <span class="meta-item">32 km</span>
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

                <!-- Fallback / Static Demo Job Cards for Visual Fidelity -->
                <div v-if="!orders || orders.length === 0" class="jobs-demo-container">
                  <!-- Demo Job 1 -->
                  <div class="job-card-styled">
                    <div class="job-header-row">
                      <div class="produce-badge">
                        <span class="produce-name">CASSAVA</span>
                        <span class="produce-qty">20 Bags = 1000kg</span>
                      </div>
                      <div class="job-payout-box">
                        <span class="payout-sub">Est. Payout</span>
                        <span class="payout-val">GHS 240</span>
                      </div>
                    </div>

                    <div class="route-preview">
                      <div class="route-pin-item">
                        <span class="pin-dot green"></span>
                        <span class="pin-text">Tarkwa (Farm Gate)</span>
                      </div>
                      <div class="route-dot-connector"></div>
                      <div class="route-pin-item">
                        <span class="pin-dot orange"></span>
                        <span class="pin-text">Takoradi (Port Side)</span>
                      </div>
                    </div>

                    <div class="job-meta-row">
                      <span class="meta-item">Pickup in 45m</span>
                      <span class="meta-dot">•</span>
                      <span class="meta-item">32 km</span>
                    </div>

                    <button class="btn-accept-primary" @click="triggerDemoAccept('Cassava Transport')">
                      Accept Job
                    </button>
                  </div>

                  <!-- Demo Job 2 -->
                  <div class="job-card-styled">
                    <div class="job-header-row">
                      <div class="produce-badge secondary">
                        <span class="produce-name">COCOA BEANS</span>
                        <span class="produce-qty">35 Crates = 1750kg</span>
                      </div>
                      <div class="job-payout-box">
                        <span class="payout-sub">Est. Payout</span>
                        <span class="payout-val">GHS 550</span>
                      </div>
                    </div>

                    <div class="route-preview">
                      <div class="route-pin-item">
                        <span class="pin-dot green"></span>
                        <span class="pin-text">Prestea District</span>
                      </div>
                      <div class="route-dot-connector"></div>
                      <div class="route-pin-item">
                        <span class="pin-dot orange"></span>
                        <span class="pin-text">Kumasi Depot</span>
                      </div>
                    </div>

                    <div class="job-meta-row">
                      <span class="meta-item">Pickup by 2:00 PM</span>
                      <span class="meta-dot">•</span>
                      <span class="meta-item">114 km</span>
                    </div>

                    <button class="btn-accept-primary" @click="triggerDemoAccept('Cocoa Transport')">
                      Accept Job
                    </button>
                  </div>
                </div>

                <!-- High Demand / Premium Route Feature Card -->
                <div class="premium-route-card">
                  <div class="premium-badge-tag">HIGH DEMAND</div>
                  <div class="premium-card-body">
                    <div class="premium-content">
                      <h3 class="premium-title">Premium Route</h3>
                      <p class="premium-subtitle">YAM • 40 BAGS</p>
                      <p class="premium-route-text">Bibiani to Kejetia Market</p>
                      <div class="premium-payout">GHS 680</div>
                    </div>
                  </div>
                  <button class="btn-accept-primary btn-premium-accept" @click="triggerDemoAccept('Premium Yam Route')">
                    Accept Job
                  </button>
                </div>

                <!-- Market Availability Steps Component -->
                <div class="market-availability-card">
                  <span class="availability-title">Market Availability</span>
                  <div class="availability-tracker">
                    <div class="tracker-step active">
                      <span class="step-dot"></span>
                      <span class="step-label">FARM</span>
                    </div>
                    <div class="tracker-line active"></div>
                    <div class="tracker-step active">
                      <span class="step-dot"></span>
                      <span class="step-label">MARKET</span>
                    </div>
                    <div class="tracker-line"></div>
                    <div class="tracker-step">
                      <span class="step-dot"></span>
                      <span class="step-label">TRANSIT</span>
                    </div>
                  </div>
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
              <button class="btn-filter-icon" @click="toggleFilter">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                <span>Filter</span>
              </button>
            </div>

            <!-- Search Bar -->
            <div class="search-input-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
              </svg>
              <input 
                type="text" 
                v-model="historyQuery" 
                placeholder="Search by route or produce..." 
                class="search-text-input"
              />
            </div>

            <!-- Completed Trips Feed -->
            <div class="history-trips-list">
              <div v-for="(trip, index) in filteredHistory" :key="index" class="history-item-card">
                <div class="history-card-top">
                  <span class="history-date">{{ trip.date }}</span>
                  <span class="delivered-status-chip">DELIVERED</span>
                </div>
                <h3 class="history-cargo-title">{{ trip.cargo }}</h3>

                <div class="route-preview history-route">
                  <div class="route-pin-item">
                    <span class="pin-dot green"></span>
                    <span class="pin-text">{{ trip.pickup }}</span>
                  </div>
                  <div class="route-dot-connector"></div>
                  <div class="route-pin-item">
                    <span class="pin-dot orange"></span>
                    <span class="pin-text">{{ trip.dropoff }}</span>
                  </div>
                </div>

                <div class="history-card-footer">
                  <span class="history-payout">GHS {{ trip.payout }}</span>
                  <div class="history-rating-pill">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="#F4A261" stroke="none">
                      <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                    <span>{{ trip.rating }} (Rating)</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Download Monthly Report Action Button -->
            <div class="monthly-report-wrapper">
              <button class="btn-download-report" @click="downloadMonthlyReport">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                  <polyline points="7 10 12 15 17 10"/>
                  <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
                <span>Download Monthly Report</span>
              </button>
            </div>
          </div>


          <!-- ══════════════════════════════════════════════════════════════ -->
          <!-- SCREEN 3: EARNINGS OVERVIEW TAB                                -->
          <!-- ══════════════════════════════════════════════════════════════ -->
          <div v-else-if="activeTab === 'earnings'" class="tab-content-view">
            <div class="earnings-header-block">
              <h2 class="page-main-title">Earnings Overview</h2>
              <p class="page-subtitle">Track your farm-to-market delivery revenue.</p>
            </div>

            <!-- Total Payout Banner Card -->
            <div class="total-payout-hero">
              <span class="payout-hero-label">TOTAL PAYOUT</span>
              <h1 class="payout-hero-amount">GHS 4,850.00</h1>
              <button class="btn-withdraw-action" @click="openWithdrawModal">
                Withdraw Earnings
              </button>
            </div>

            <!-- Two Metric Stat Cards Grid -->
            <div class="metrics-two-col">
              <div class="metric-card-box">
                <span class="metric-sub">TODAY'S EARNINGS</span>
                <div class="metric-val-row">
                  <span class="metric-value">GHS 240.00</span>
                  <span class="trend-badge positive">↑ 8.2%</span>
                </div>
              </div>

              <div class="metric-card-box">
                <span class="metric-sub">THIS WEEK</span>
                <div class="metric-val-row">
                  <span class="metric-value">GHS 1,120.50</span>
                  <span class="online-hours-tag">45h online</span>
                </div>
              </div>
            </div>

            <!-- Recent Payouts Feed -->
            <section class="section-block margin-top-lg">
              <div class="section-header-flex">
                <h3 class="section-subheading">Recent Payouts</h3>
                <button class="view-all-link" @click="triggerViewAllPayouts">View All</button>
              </div>

              <div class="recent-payouts-list">
                <div v-for="(payout, idx) in recentPayoutsList" :key="idx" class="payout-item-row">
                  <div class="payout-type-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="2" y="5" width="20" height="14" rx="2"/>
                      <line x1="2" y1="10" x2="22" y2="10"/>
                    </svg>
                  </div>
                  <div class="payout-item-details">
                    <span class="payout-trip-id">Trip ID: {{ payout.id }}</span>
                    <span class="payout-date-method">{{ payout.date }} • {{ payout.method }}</span>
                  </div>
                  <div class="payout-item-amount-col">
                    <span class="payout-item-val">GHS {{ payout.amount }}</span>
                    <span class="payout-status-chip" :class="payout.status.toLowerCase()">{{ payout.status }}</span>
                  </div>
                </div>
              </div>
            </section>

            <!-- Performance Bonus Card -->
            <div class="performance-bonus-card">
              <div class="bonus-card-content">
                <h4 class="bonus-title">Performance Bonus</h4>
                <p class="bonus-desc">Reach 50 deliveries this month to unlock a GHS 500.00 extra bonus.</p>
                <div class="bonus-progress-bar-wrap">
                  <div class="progress-bar-fill" style="width: 64%;"></div>
                </div>
                <span class="bonus-progress-label">32 / 50 Completed</span>
              </div>
            </div>
          </div>


          <!-- ══════════════════════════════════════════════════════════════ -->
          <!-- SCREEN 4: DRIVER PROFILE TAB                                   -->
          <!-- ══════════════════════════════════════════════════════════════ -->
          <div v-else-if="activeTab === 'profile'" class="tab-content-view">
            <!-- Driver Header Card -->
            <div class="driver-profile-hero">
              <div class="profile-avatar-wrapper">
                <div class="profile-avatar-circle">
                  {{ $page.props.auth?.user?.name?.charAt(0).toUpperCase() || 'K' }}
                </div>
              </div>
              <div class="profile-hero-info">
                <h2 class="driver-full-name">{{ $page.props.auth?.user?.name || 'Kojo Antwi' }}</h2>
                <span class="driver-vehicle-subtitle">5-ton Truck • ID: ADG-0922</span>
                <div class="profile-rating-pill">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="#F4A261" stroke="none">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                  </svg>
                  <span>4.9</span>
                </div>
              </div>
            </div>

            <!-- Stats Overview 2-Col Grid -->
            <div class="metrics-two-col margin-top-md">
              <div class="profile-metric-box">
                <span class="profile-metric-label">Total Earnings</span>
                <span class="profile-metric-val">GHS 4,820</span>
              </div>
              <div class="profile-metric-box">
                <span class="profile-metric-label">Jobs Done</span>
                <span class="profile-metric-val">124</span>
              </div>
            </div>

            <!-- Document Status Card -->
            <div class="profile-section-card">
              <div class="card-section-header">
                <h3 class="card-section-title">Document Status</h3>
                <button class="edit-link-btn" @click="triggerEditDocs">Edit</button>
              </div>

              <div class="doc-status-list">
                <div class="doc-item-row">
                  <div class="doc-info">
                    <svg xmlns="http://www.w3.org/2000/svg" class="doc-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="3" y="4" width="18" height="16" rx="2"/>
                      <line x1="7" y1="8" x2="17" y2="8"/>
                      <line x1="7" y1="12" x2="13" y2="12"/>
                    </svg>
                    <div>
                      <span class="doc-name">Driver's License</span>
                      <span class="doc-expiry">Exp: 12 Dec 2026</span>
                    </div>
                  </div>
                  <span class="status-verified-badge">VERIFIED</span>
                </div>

                <div class="doc-item-row">
                  <div class="doc-info">
                    <svg xmlns="http://www.w3.org/2000/svg" class="doc-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                    <div>
                      <span class="doc-name">Vehicle Insurance</span>
                      <span class="doc-expiry">Exp: 18 Oct 2026</span>
                    </div>
                  </div>
                  <span class="status-verified-badge">VERIFIED</span>
                </div>
              </div>
            </div>

            <!-- Vehicle Details Grid -->
            <div class="profile-section-card">
              <h3 class="card-section-title">Vehicle Details</h3>
              <div class="vehicle-specs-grid">
                <div class="spec-cell">
                  <span class="spec-label">MODEL</span>
                  <span class="spec-value">Isuzu N-Series</span>
                </div>
                <div class="spec-cell">
                  <span class="spec-label">PLATE</span>
                  <span class="spec-value">GW-492-23</span>
                </div>
                <div class="spec-cell">
                  <span class="spec-label">CAPACITY</span>
                  <span class="spec-value">5,000 KG</span>
                </div>
                <div class="spec-cell">
                  <span class="spec-label">FUEL TYPE</span>
                  <span class="spec-value">Diesel</span>
                </div>
              </div>
            </div>

            <!-- Preferences Settings List -->
            <div class="profile-section-card">
              <h3 class="card-section-title">Preferences</h3>
              <div class="preferences-list">
                <div class="pref-row">
                  <div class="pref-left">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                    <span>Notifications</span>
                  </div>
                  <button class="toggle-switch-sm" :class="{ active: notificationsEnabled }" @click="notificationsEnabled = !notificationsEnabled">
                    <span class="toggle-sm-knob"></span>
                  </button>
                </div>

                <div class="pref-row click-row" @click="triggerLanguageSelect">
                  <div class="pref-left">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="12" cy="12" r="10"/>
                      <line x1="2" y1="12" x2="22" y2="12"/>
                    </svg>
                    <span>Language</span>
                  </div>
                  <span class="pref-value-arrow">English &rsaquo;</span>
                </div>

                <div class="pref-row click-row" @click="triggerSupportCenter">
                  <div class="pref-left">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="12" cy="12" r="10"/>
                      <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                      <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                    <span>Support Center</span>
                  </div>
                  <span class="pref-value-arrow">&rsaquo;</span>
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

            <!-- Version Footer -->
            <div class="version-footer-text">
              Version 2.4.1 (Stable)
            </div>
          </div>

        </div>
      </main>
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
import { Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

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
    }
  },
  setup() {
    const activeTab = ref('jobs');
    const isOnline = ref(true);
    const processingId = ref(null);
    const historyQuery = ref('');
    const notificationsEnabled = ref(true);

    // Sample Trip History dataset matching mockups
    const sampleHistory = ref([
      {
        date: 'Oct 24, 2025 • 08:30 AM',
        cargo: 'Cassava Delivery',
        pickup: 'Sefwi-Wiawso Farm Gate',
        dropoff: 'Kumasi Central Market',
        payout: '1,450',
        rating: '4.8'
      },
      {
        date: 'Oct 21, 2025 • 11:45 AM',
        cargo: 'Bulk Cocoa Transport',
        pickup: 'Bibiani Rural Collective',
        dropoff: 'Takoradi Port Terminal',
        payout: '3,200',
        rating: '5.0'
      },
      {
        date: 'Oct 18, 2025 • 06:15 AM',
        cargo: 'Plantain Dispatch',
        pickup: 'Goaso Green Belt',
        dropoff: 'Accra Agbogbloshie',
        payout: '2,100',
        rating: '4.8'
      }
    ]);

    // Computed filtered history
    const filteredHistory = computed(() => {
      if (!historyQuery.value.trim()) return sampleHistory.value;
      const q = historyQuery.value.toLowerCase();
      return sampleHistory.value.filter(item => 
        item.cargo.toLowerCase().includes(q) ||
        item.pickup.toLowerCase().includes(q) ||
        item.dropoff.toLowerCase().includes(q)
      );
    });

    // Sample Recent Payouts
    const recentPayoutsList = ref([
      { id: '#ADD-8831', date: 'Oct 24, 2025', method: 'Mobile Money', amount: '150.00', status: 'SETTLED' },
      { id: '#ADD-8794', date: 'Oct 22, 2025', method: 'Bank Transfer', amount: '320.00', status: 'SETTLED' },
      { id: '#ADD-8702', date: 'Oct 21, 2025', method: 'Mobile Money', amount: '210.00', status: 'PROCESSING' }
    ]);

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

    const triggerDemoAccept = (title) => {
      alert(`Job accepted: ${title}! Added to your active delivery tasks.`);
    };

    const toggleFilter = () => {
      alert('Filter options: Sort by payout, pickup distance, or produce type.');
    };

    const downloadMonthlyReport = () => {
      alert('Generating monthly transport payout statement PDF...');
    };

    const openWithdrawModal = () => {
      alert('Initiating Mobile Money withdrawal of GHS 4,850.00 to registered MoMo number...');
    };

    const triggerViewAllPayouts = () => {
      alert('Loading complete history of completed MoMo / Bank payouts...');
    };

    const triggerEditDocs = () => {
      alert('Vehicle documents & driver license verification drawer opening...');
    };

    const triggerLanguageSelect = () => {
      alert('Language selected: English (Ghanaian Twi / Fante options available).');
    };

    const triggerSupportCenter = () => {
      alert('Connecting to FarmLink Driver Support Center (Hotline: +233 24 000 0000)');
    };

    return {
      activeTab,
      isOnline,
      processingId,
      historyQuery,
      filteredHistory,
      recentPayoutsList,
      notificationsEnabled,
      acceptJob,
      pickupJob,
      completeJob,
      triggerDemoAccept,
      toggleFilter,
      downloadMonthlyReport,
      openWithdrawModal,
      triggerViewAllPayouts,
      triggerEditDocs,
      triggerLanguageSelect,
      triggerSupportCenter
    };
  }
}
</script>

<style scoped>
@import "../../css/design-tokens.css";

/* Outer Dashboard Wrapper */
.dashboard-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background-color: var(--color-bg-page);
  color: var(--color-neutral-900);
  font-family: var(--font-family);
  padding-bottom: 72px; /* Space for bottom nav on mobile */
}

/* Sidebar Navigation (Tablet / Desktop) */
.sidebar-nav {
  display: none;
}

/* Mobile Header Bar */
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
  letter-spacing: -0.5px;
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
  transition: all 0.2s ease;
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
  box-shadow: 0 0 6px var(--color-primary-light);
}

.toggle-label {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-700);
}

.status-pill-toggle.online .toggle-label {
  color: var(--color-primary-hover);
}

/* Main Layout Area */
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

/* Top Status Bar Controls (Jobs Tab) */
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
  padding: 0;
}

.switch-knob {
  width: 14px;
  height: 14px;
  border-radius: 50%;
  background-color: var(--color-neutral-400);
  transition: all 0.2s ease;
}

.online-switch.is_active .switch-knob {
  background-color: var(--color-primary);
  box-shadow: 0 0 8px var(--color-primary-light);
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

/* Revenue Banner Card */
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
  opacity: 0.85;
  font-weight: var(--font-weight-medium);
  letter-spacing: 0.3px;
}

.banner-amount {
  font-size: var(--font-size-2xl);
  font-weight: var(--font-weight-bold);
  margin-top: 4px;
  letter-spacing: -0.5px;
}

.banner-icon-watermark {
  position: absolute;
  right: var(--space-4);
  bottom: var(--space-3);
  opacity: 0.18;
}

/* Section Formatting */
.section-block {
  margin-bottom: var(--space-5);
}

.section-header-flex {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: var(--space-3);
}

.section-title {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.page-main-title {
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.page-subtitle {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
  margin-top: 2px;
  margin-bottom: var(--space-4);
}

.btn-filter-icon {
  display: flex;
  align-items: center;
  gap: 4px;
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  padding: 4px var(--space-3);
  border-radius: var(--radius-md);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  color: var(--color-neutral-700);
  cursor: pointer;
}

/* Active Trip Card Styling */
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

.trip-status-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.payout-label-sm {
  font-size: 10px;
  color: var(--color-neutral-500);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.payout-amount {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-primary);
}

/* Progress Steps */
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
  box-shadow: 0 0 8px var(--color-secondary-light);
}

.step-name {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-medium);
  color: var(--color-neutral-700);
}

.step-connector {
  flex: 1;
  height: 2px;
  background-color: var(--color-neutral-200);
  margin: 0 4px;
  margin-bottom: 16px;
}

.step-connector.completed {
  background-color: var(--color-primary);
}

/* Route details */
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
  color: var(--color-neutral-900);
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
  transition: all 0.2s ease;
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

/* Job Cards List (Jobs Tab) */
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
  box-shadow: var(--shadow-xs);
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
  color: var(--color-neutral-900);
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
  color: var(--color-neutral-900);
}

.route-dot-connector {
  width: 1px;
  height: 10px;
  background-color: var(--color-neutral-300);
  margin-left: 3px;
}

.job-meta-row {
  display: flex;
  align-items: center;
  gap: var(--space-2);
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
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
  transition: background-color 0.2s ease;
}

.btn-accept-primary:hover {
  background-color: var(--color-primary-hover);
}

/* Premium Route Banner Card */
.premium-route-card {
  position: relative;
  background: linear-gradient(135deg, #2D6A4F 0%, #1B4332 100%);
  border-radius: var(--radius-lg);
  padding: var(--space-4);
  color: var(--color-white);
  box-shadow: var(--shadow-sm);
  overflow: hidden;
}

.premium-badge-tag {
  display: inline-block;
  background-color: var(--color-secondary);
  color: var(--color-neutral-900);
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  padding: 2px 8px;
  border-radius: var(--radius-pill);
  margin-bottom: var(--space-2);
}

.premium-title {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
}

.premium-subtitle {
  font-size: var(--font-size-xs);
  opacity: 0.9;
  letter-spacing: 0.5px;
}

.premium-route-text {
  font-size: var(--font-size-sm);
  margin-top: 4px;
  opacity: 0.95;
}

.premium-payout {
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-bold);
  color: var(--color-secondary-light);
  margin-top: var(--space-2);
  margin-bottom: var(--space-3);
}

.btn-premium-accept {
  background-color: var(--color-secondary);
  color: var(--color-neutral-900);
}

.btn-premium-accept:hover {
  background-color: var(--color-secondary-hover);
  color: var(--color-white);
}

/* Market Availability Card */
.market-availability-card {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-4);
  margin-top: var(--space-2);
}

.availability-title {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-500);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.availability-tracker {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: var(--space-3);
}

.tracker-step {
  display: flex;
  align-items: center;
  gap: 6px;
}

.tracker-step .step-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background-color: var(--color-neutral-300);
}

.tracker-step.active .step-dot {
  background-color: var(--color-primary);
  box-shadow: 0 0 6px var(--color-primary-light);
}

.tracker-step .step-label {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-500);
}

.tracker-step.active .step-label {
  color: var(--color-primary);
}

.tracker-line {
  flex: 1;
  height: 2px;
  background-color: var(--color-neutral-200);
  margin: 0 var(--space-2);
}

.tracker-line.active {
  background-color: var(--color-primary);
}

/* Search Bar (Trip History) */
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

.search-text-input:focus {
  border-color: var(--color-primary);
  box-shadow: 0 0 0 3px var(--color-primary-subtle);
}

/* Trip History List */
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
  box-shadow: var(--shadow-xs);
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
  color: var(--color-neutral-900);
  margin-bottom: var(--space-2);
}

.history-route {
  margin: var(--space-2) 0;
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
  color: var(--color-neutral-700);
}

.monthly-report-wrapper {
  margin-top: var(--space-6);
}

.btn-download-report {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
  background-color: #8B4513; /* Warm Amber/Brown from mock */
  color: var(--color-white);
  border: none;
  padding: var(--space-3) var(--space-4);
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
  transition: opacity 0.2s ease;
}

.btn-download-report:hover {
  opacity: 0.9;
}

/* Earnings Overview Tab */
.total-payout-hero {
  background: linear-gradient(135deg, #2D6A4F 0%, #1B4332 100%);
  color: var(--color-white);
  padding: var(--space-5);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-md);
  margin-bottom: var(--space-4);
  text-align: center;
}

.payout-hero-label {
  font-size: var(--font-size-xs);
  opacity: 0.85;
  font-weight: var(--font-weight-bold);
  letter-spacing: 0.5px;
}

.payout-hero-amount {
  font-size: var(--font-size-3xl);
  font-weight: var(--font-weight-bold);
  margin: var(--space-2) 0 var(--space-4);
}

.btn-withdraw-action {
  width: 100%;
  background-color: var(--color-tertiary);
  color: var(--color-white);
  border: none;
  padding: var(--space-3);
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  cursor: pointer;
}

.metrics-two-col {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-3);
}

.metric-card-box {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-3) var(--space-4);
}

.metric-sub {
  font-size: 10px;
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-500);
  letter-spacing: 0.5px;
}

.metric-val-row {
  display: flex;
  flex-direction: column;
  margin-top: 4px;
}

.metric-value {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.trend-badge {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
}

.trend-badge.positive { color: var(--color-primary); }

.online-hours-tag {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

.section-subheading {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.view-all-link {
  background: none;
  border: none;
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  color: var(--color-primary);
  cursor: pointer;
}

.recent-payouts-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-2);
}

.payout-item-row {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  padding: var(--space-3);
  border-radius: var(--radius-md);
}

.payout-type-icon {
  width: 36px;
  height: 36px;
  border-radius: var(--radius-md);
  background-color: var(--color-neutral-100);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--color-neutral-700);
}

.payout-item-details {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.payout-trip-id {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.payout-date-method {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

.payout-item-amount-col {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}

.payout-item-val {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
}

.payout-status-chip {
  font-size: 9px;
  font-weight: var(--font-weight-bold);
  padding: 1px 5px;
  border-radius: 4px;
}

.payout-status-chip.settled { background-color: var(--color-primary-subtle); color: var(--color-primary); }
.payout-status-chip.processing { background-color: var(--color-warning-light); color: var(--color-secondary-dark); }

.performance-bonus-card {
  background: linear-gradient(135deg, #1B4332 0%, #2D6A4F 100%);
  color: var(--color-white);
  border-radius: var(--radius-lg);
  padding: var(--space-4);
  margin-top: var(--space-5);
}

.bonus-title {
  font-size: var(--font-size-md);
  font-weight: var(--font-weight-bold);
}

.bonus-desc {
  font-size: var(--font-size-xs);
  opacity: 0.9;
  margin: 4px 0 var(--space-3);
}

.bonus-progress-bar-wrap {
  width: 100%;
  height: 8px;
  background-color: rgba(255,255,255,0.2);
  border-radius: var(--radius-pill);
  overflow: hidden;
}

.progress-bar-fill {
  height: 100%;
  background-color: var(--color-secondary);
  border-radius: var(--radius-pill);
}

.bonus-progress-label {
  display: block;
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  margin-top: 6px;
}

/* Driver Profile Tab */
.driver-profile-hero {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-4);
  display: flex;
  align-items: center;
  gap: var(--space-4);
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

}

.profile-rating-pill {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  background-color: var(--color-primary-subtle);
  color: var(--color-primary-hover);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  padding: 2px 8px;
  border-radius: var(--radius-pill);
  width: fit-content;
  margin-top: 4px;
}

.profile-metric-box {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  padding: var(--space-3) var(--space-4);
  border-radius: var(--radius-lg);
  display: flex;
  flex-direction: column;
}

.profile-metric-label {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

.profile-metric-val {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-900);
  margin-top: 2px;
}

.profile-section-card {
  background-color: var(--color-white);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-4);
  margin-top: var(--space-4);
}

.card-section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
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
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-bold);
  color: var(--color-primary);
  cursor: pointer;
}

.doc-status-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

.doc-item-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: var(--color-neutral-50);
  padding: var(--space-3);
  border-radius: var(--radius-md);
}

.doc-info {
  display: flex;
  align-items: center;
  gap: var(--space-3);
}

.doc-icon {
  color: var(--color-neutral-700);
}

.doc-name {
  display: block;
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-semibold);
  color: var(--color-neutral-900);
}

.doc-expiry {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
}

.status-verified-badge {
  background-color: var(--color-primary);
  color: var(--color-white);
  font-size: 9px;
  font-weight: var(--font-weight-bold);
  padding: 2px 6px;
  border-radius: 4px;
}

.vehicle-specs-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-3);
  margin-top: var(--space-3);
}

.spec-cell {
  background-color: var(--color-neutral-50);
  padding: var(--space-2) var(--space-3);
  border-radius: var(--radius-md);
  display: flex;
  flex-direction: column;
}

.spec-label {
  font-size: 9px;
  font-weight: var(--font-weight-bold);
  color: var(--color-neutral-500);
}

.spec-value {
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-semibold);
  color: var(--color-neutral-900);
  margin-top: 2px;
}

.preferences-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-2);
  margin-top: var(--space-2);
}

.pref-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: var(--space-3) 0;
  border-bottom: 1px solid var(--color-border);
}

.pref-row:last-child {
  border-bottom: none;
}

.pref-row.click-row {
  cursor: pointer;
}

.pref-left {
  display: flex;
  align-items: center;
  gap: var(--space-3);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  color: var(--color-neutral-900);
}

.toggle-switch-sm {
  width: 38px;
  height: 20px;
  background-color: var(--color-neutral-300);
  border-radius: var(--radius-pill);
  border: none;
  padding: 2px;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.toggle-switch-sm.active {
  background-color: var(--color-primary);
}

.toggle-sm-knob {
  display: block;
  width: 16px;
  height: 16px;
  background-color: var(--color-white);
  border-radius: 50%;
  transition: transform 0.2s ease;
}

.toggle-switch-sm.active .toggle-sm-knob {
  transform: translateX(18px);
}

.pref-value-arrow {
  font-size: var(--font-size-sm);
  color: var(--color-neutral-500);
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
  margin-bottom: var(--space-2);
}

/* Mobile Bottom Navigation (4-Tab Capsule) */
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
  box-shadow: 0 -2px 10px rgba(0,0,0,0.04);
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
  transition: all 0.2s ease;
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

.nav-icon-wrap {
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
}

.nav-label {
  font-size: 10px;
  font-weight: var(--font-weight-bold);
}

/* Responsive Rules for Desktop / Larger Screens */
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
    color: var(--color-neutral-900);
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
    transition: all 0.2s ease;
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
