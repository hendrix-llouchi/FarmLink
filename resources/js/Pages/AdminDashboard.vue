<template>
  <div class="admin-shell">
    <AdminNav :active="tab" />

    <main class="admin-content">
      <section v-if="tab === 'overview'" class="page-section">
        <p class="eyebrow">FarmLink Team</p><h1>Operations overview</h1><p class="muted">A clear view of what needs attention now.</p>
        <div class="stats-grid">
        <div v-for="card in statCards" :key="card.label" class="stat-card"><span>{{ card.label }}</span><strong>{{ card.value }}</strong></div>
        </div>
        <div class="attention"><strong>Needs attention now</strong><span>{{ stats.flagged }} flagged</span><span>{{ stats.in_transit }} in transit</span><span>GH₵ {{ Number(stats.held_amount).toFixed(2) }} escrow held</span></div>
      </section>

      <section v-if="tab === 'live'" class="page-section">
        <h1>Live board</h1><p class="muted">Every order, its evidence, and its current stage.</p>
        <div class="panel filters">
        <div class="filter-row">
          <input v-model="filters.search" placeholder="Search farmer, buyer or driver">
          <select v-model="filters.status"><option value="">All stages</option><option value="pending">Ordered</option><option value="processing">Processing</option><option value="in_transit">In transit</option><option value="delivered">Delivered</option></select>
          <select v-model="filters.verification_status"><option value="">All verification</option><option value="pending">Awaiting verification</option><option value="verified">Verified</option><option value="flagged">Flagged</option></select>
          <button @click="applyFilters">Filter</button>
        </div>
        </div>

        <div class="panel"><h2>Orders and evidence</h2><div class="order-list">
        <article v-for="order in orders.data" :key="order.id" class="order-row">
          <div><strong>Order #{{ order.id }} · {{ order.product?.name || 'Produce' }}</strong><p>{{ order.product?.user?.name }} → {{ order.buyer?.name }} · Driver: {{ order.driver?.name || 'Unassigned' }}</p></div>
          <div class="chips"><span>{{ stage(order) }}</span><span :class="order.verification_status === 'flagged' ? 'danger' : ''">{{ order.verification_status || 'Awaiting verification' }}</span></div>
          <div class="evidence"><span v-if="order.verification">{{ order.verification.pickup_photos?.length || 0 }} pickup photos</span><span v-if="order.delivery_photo_path">Delivery photo</span><span>{{ money(order.adjusted_price ?? order.total_price) }} {{ order.payment_status }}</span></div>
          <Link :href="`/admin/orders/${order.id}`" class="detail-link">View order detail</Link>
        </article>
        </div></div>
      </section>

      <section v-if="tab === 'verification'" class="page-section"><h1>Verification queue</h1><p class="muted">Farm-gate checks, photos, and checklist evidence.</p><div class="panel order-list"><article v-for="order in verificationOrders" :key="order.id" class="order-row"><strong>Order #{{ order.id }} · {{ order.product?.name }}</strong><span>{{ order.verification?.pickup_photos?.length || 0 }} pickup photos · {{ order.verification_status }}</span><Link :href="`/admin/orders/${order.id}`" class="detail-link">View evidence</Link></article><p v-if="!verificationOrders.length" class="muted">No orders are awaiting or recently completed for verification.</p></div></section>
      <section v-if="tab === 'flags'" class="page-section"><h1>Flag centre</h1><p class="muted">Major mismatches and their decision windows.</p><div class="panel order-list"><article v-for="order in flaggedOrders" :key="order.id" class="order-row"><strong>Order #{{ order.id }} · {{ order.product?.name }}</strong><span>{{ countdown(order.flag_deadline_at) }} · {{ order.flag_decision || 'Decision pending' }}</span><Link :href="`/admin/orders/${order.id}`" class="detail-link">View flag</Link></article><p v-if="!flaggedOrders.length" class="muted">No flagged orders right now</p></div></section>
      <section v-if="tab === 'users'" class="page-section"><h1>Users and trust</h1><p class="muted">Review account history and take accountable actions.</p><div class="user-grid"><article v-for="user in users" :key="user.id" class="user-card"><strong>{{ user.name }}</strong><span>{{ user.role }} · {{ user.phone_number }}</span><span>{{ user.orders_count }} buyer orders · {{ user.suspended_at ? 'Suspended' : 'Active' }}</span><button @click="toggleUser(user)">{{ user.suspended_at ? 'Reactivate' : 'Suspend' }}</button></article></div></section>
      <section v-if="tab === 'escrow'" class="page-section"><h1>Escrow</h1><p class="muted">Money held, released, and refunded against real orders.</p><div class="stats-grid"><div class="stat-card"><span>Held</span><strong>GH₵ {{ Number(stats.held_amount).toFixed(2) }}</strong></div><div class="stat-card"><span>Released</span><strong>GH₵ {{ Number(stats.released_amount).toFixed(2) }}</strong></div><div class="stat-card"><span>Refunded orders</span><strong>{{ refundedOrders.length }}</strong></div></div><div class="panel order-list"><article v-for="order in escrowOrders" :key="order.id" class="order-row"><strong>Order #{{ order.id }}</strong><span>GH₵ {{ Number(order.adjusted_price ?? order.total_price).toFixed(2) }} · {{ order.payment_status }}</span><Link :href="`/admin/orders/${order.id}`" class="detail-link">View order</Link></article></div></section>
    </main>
  </div>
</template>

<script setup>
import { computed, reactive } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AdminNav from '../Components/AdminNav.vue';

const props = defineProps({ orders: Object, users: Array, stats: Object });
const tab = new URLSearchParams(window.location.search).get('tab') || 'overview';
const filters = reactive({ search: '', status: '', verification_status: '' });
const statCards = computed(() => [
  { label: 'All orders', value: props.stats.total }, { label: 'Escrow held', value: `GH₵ ${Number(props.stats.held_amount).toFixed(2)}` },
  { label: 'Flagged now', value: props.stats.flagged }, { label: 'In transit', value: props.stats.in_transit }, { label: 'Released', value: props.stats.released },
]);
const applyFilters = () => router.get('/admin/dashboard', { ...filters, tab: 'live' }, { preserveState: true, replace: true });
const toggleUser = (user) => { const reason = window.prompt('Reason for this account action:'); if (reason) router.post(`/admin/users/${user.id}/suspension`, { suspended: !user.suspended_at, reason }); };
const stage = order => order.status === 'pending' ? 'Ordered' : order.workflow_status === 'arrived' ? 'Arrived' : order.status.replace('_', ' ');
const money = value => `GH₵ ${Number(value || 0).toFixed(2)}`;
const formatDate = value => value ? new Date(value).toLocaleString() : '';
const verificationOrders = computed(() => props.orders.data.filter(order => order.verification_status === 'pending' || ['verified', 'verified_minor'].includes(order.verification_status)));
const flaggedOrders = computed(() => props.orders.data.filter(order => order.verification_status === 'flagged'));
const escrowOrders = computed(() => props.orders.data.filter(order => ['escrow_held', 'released', 'refunded'].includes(order.payment_status)));
const refundedOrders = computed(() => props.orders.data.filter(order => order.payment_status === 'refunded'));
const countdown = deadline => { if (!deadline) return 'No active countdown'; const seconds = Math.max(0, Math.ceil((new Date(deadline).getTime() - Date.now()) / 1000)); return `${Math.floor(seconds / 60)}m ${seconds % 60}s left`; };
</script>

<style scoped>
@import "../../css/design-tokens.css";
.admin-shell { min-height: 100vh; background: var(--color-neutral-50); color: var(--color-neutral-900); padding: 28px; font-family: var(--font-family); } .admin-header, .filter-row, .order-row, .user-card { display:flex; gap:16px; align-items:center; } .admin-header { justify-content:space-between; max-width:1280px; margin:auto auto 24px; } h1 { margin:0; font-size:32px; } h2 { margin-top:0; } .eyebrow { color:var(--color-primary); font-weight:700; text-transform:uppercase; } .muted, .order-row p, .user-card span { color:var(--color-neutral-500); } .panel, .stat-card { background:var(--color-white); border:1px solid var(--color-neutral-100); border-radius:12px; box-shadow:var(--shadow-sm); padding:20px; max-width:1280px; margin:0 auto 20px; } .stats-grid { display:grid; grid-template-columns:repeat(5,1fr); gap:14px; max-width:1280px; margin:0 auto 20px; } .stat-card { margin:0; display:flex; flex-direction:column; gap:8px; } .stat-card strong { font-size:24px; } .filter-row input, .filter-row select { flex:1; min-height:44px; border:1px solid var(--color-neutral-300); border-radius:8px; padding:0 12px; } button, .logout { border:0; border-radius:8px; padding:11px 16px; background:var(--color-primary); color:var(--color-white); cursor:pointer; } .logout { background:var(--color-neutral-900); } .order-list { display:grid; gap:12px; } .order-row { align-items:flex-start; flex-wrap:wrap; padding:16px 0; border-top:1px solid var(--color-neutral-100); } .order-row > div:first-child { flex:2; min-width:240px; } .chips, .evidence { display:flex; gap:8px; flex-wrap:wrap; } .chips span { background:var(--color-primary-lighter); border-radius:999px; padding:5px 9px; font-size:12px; } .chips .danger { background:var(--color-danger); color:var(--color-white); } details { width:100%; } .user-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:12px; } .user-card { flex-direction:column; align-items:flex-start; border:1px solid var(--color-neutral-100); border-radius:8px; padding:14px; } @media(max-width:800px){.admin-shell{padding:16px}.stats-grid{grid-template-columns:repeat(2,1fr)}.filter-row{flex-direction:column;align-items:stretch}.admin-header{align-items:flex-start}.admin-header h1{font-size:24px}}
 .page-section{max-width:1280px;margin:0 auto;padding:var(--space-8) var(--space-5);display:flex;flex-direction:column;gap:var(--space-4)}.page-section h1{margin:0;font-size:32px}.attention{display:flex;gap:var(--space-5);align-items:center;flex-wrap:wrap;background:var(--color-primary-lighter);border-radius:var(--radius-lg);padding:var(--space-4)}.detail-link{color:var(--color-primary);font-weight:600}@media(max-width:800px){.page-section{padding:var(--space-5) var(--space-3)}.page-section h1{font-size:26px}}
 .admin-shell{padding:0}.admin-content{margin-left:var(--sidebar-width);width:calc(100% - var(--sidebar-width));box-sizing:border-box}.page-section{max-width:none;width:100%;box-sizing:border-box;margin:0;padding:var(--space-8) clamp(var(--space-5),4vw,var(--space-10))}.page-section>.panel{max-width:none;width:100%}.stats-grid{max-width:none;width:100%;margin:var(--space-5) 0}.panel{max-width:none}.order-row{justify-content:space-between}.attention{width:100%;box-sizing:border-box}@media(max-width:1024px){.admin-content{margin-left:var(--sidebar-width-collapsed);width:calc(100% - var(--sidebar-width-collapsed))}}@media(max-width:767px){.admin-content{margin-left:0;width:100%;padding-bottom:var(--space-8)}.page-section{padding:var(--space-5) var(--space-3)}.stats-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.page-section h1{font-size:26px}}
</style>
