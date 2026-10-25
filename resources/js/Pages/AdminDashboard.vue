<template>
  <div class="admin-shell">
    <header class="admin-header">
      <div><p class="eyebrow">FarmLink team</p><h1>Operations oversight</h1><p class="muted">Evidence, orders and trust — one place.</p></div>
      <Link href="/logout" method="post" as="button" class="logout">Log out</Link>
    </header>

    <main>
      <section class="stats-grid">
        <div v-for="card in statCards" :key="card.label" class="stat-card"><span>{{ card.label }}</span><strong>{{ card.value }}</strong></div>
      </section>

      <section class="panel filters">
        <h2>Live orders board</h2>
        <div class="filter-row">
          <input v-model="filters.search" placeholder="Search farmer, buyer or driver">
          <select v-model="filters.status"><option value="">All stages</option><option value="pending">Ordered</option><option value="processing">Processing</option><option value="in_transit">In transit</option><option value="delivered">Delivered</option></select>
          <select v-model="filters.verification_status"><option value="">All verification</option><option value="pending">Awaiting verification</option><option value="verified">Verified</option><option value="flagged">Flagged</option></select>
          <button @click="applyFilters">Filter</button>
        </div>
      </section>

      <section class="panel"><h2>Orders and evidence</h2><div class="order-list">
        <article v-for="order in orders.data" :key="order.id" class="order-row">
          <div><strong>Order #{{ order.id }} · {{ order.product?.name || 'Produce' }}</strong><p>{{ order.product?.user?.name }} → {{ order.buyer?.name }} · Driver: {{ order.driver?.name || 'Unassigned' }}</p></div>
          <div class="chips"><span>{{ stage(order) }}</span><span :class="order.verification_status === 'flagged' ? 'danger' : ''">{{ order.verification_status || 'Awaiting verification' }}</span></div>
          <div class="evidence"><span v-if="order.verification">{{ order.verification.pickup_photos?.length || 0 }} pickup photos</span><span v-if="order.delivery_photo_path">Delivery photo</span><span>{{ money(order.adjusted_price ?? order.total_price) }} {{ order.payment_status }}</span></div>
          <details><summary>View audit and checklist</summary><p v-if="order.verification">Grade {{ order.verification.claimed_grade }} → {{ order.verification.actual_grade }} · Freshness {{ order.verification.freshness_match ? 'matches' : 'does not match' }} · Packaging {{ order.verification.packaging_ok ? 'OK' : 'not OK' }}</p><p v-else>No farm-gate verification saved yet.</p><ol><li v-for="event in order.events" :key="event.id">{{ event.event }} · {{ event.actor?.name || event.actor_role || 'system' }} · {{ formatDate(event.created_at) }}</li></ol></details>
        </article>
      </div></section>

      <section class="panel"><h2>Users and trust actions</h2><div class="user-grid"><article v-for="user in users" :key="user.id" class="user-card"><strong>{{ user.name }}</strong><span>{{ user.role }} · {{ user.phone_number }}</span><span>{{ user.orders_count }} buyer orders · {{ user.suspended_at ? 'Suspended' : 'Active' }}</span><button @click="toggleUser(user)">{{ user.suspended_at ? 'Reactivate' : 'Suspend' }}</button></article></div></section>
    </main>
  </div>
</template>

<script setup>
import { computed, reactive } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({ orders: Object, users: Array, stats: Object });
const filters = reactive({ search: '', status: '', verification_status: '' });
const statCards = computed(() => [
  { label: 'All orders', value: props.stats.total }, { label: 'Escrow held', value: `GH₵ ${Number(props.stats.held_amount).toFixed(2)}` },
  { label: 'Flagged now', value: props.stats.flagged }, { label: 'In transit', value: props.stats.in_transit }, { label: 'Released', value: props.stats.released },
]);
const applyFilters = () => router.get('/admin/dashboard', filters, { preserveState: true, replace: true });
const toggleUser = (user) => { const reason = window.prompt('Reason for this account action:'); if (reason) router.post(`/admin/users/${user.id}/suspension`, { suspended: !user.suspended_at, reason }); };
const stage = order => order.status === 'pending' ? 'Ordered' : order.workflow_status === 'arrived' ? 'Arrived' : order.status.replace('_', ' ');
const money = value => `GH₵ ${Number(value || 0).toFixed(2)}`;
const formatDate = value => value ? new Date(value).toLocaleString() : '';
</script>

<style scoped>
@import "../../css/design-tokens.css";
.admin-shell { min-height: 100vh; background: var(--color-neutral-50); color: var(--color-neutral-900); padding: 28px; font-family: var(--font-family); } .admin-header, .filter-row, .order-row, .user-card { display:flex; gap:16px; align-items:center; } .admin-header { justify-content:space-between; max-width:1280px; margin:auto auto 24px; } h1 { margin:0; font-size:32px; } h2 { margin-top:0; } .eyebrow { color:var(--color-primary); font-weight:700; text-transform:uppercase; } .muted, .order-row p, .user-card span { color:var(--color-neutral-500); } .panel, .stat-card { background:var(--color-white); border:1px solid var(--color-neutral-100); border-radius:12px; box-shadow:var(--shadow-sm); padding:20px; max-width:1280px; margin:0 auto 20px; } .stats-grid { display:grid; grid-template-columns:repeat(5,1fr); gap:14px; max-width:1280px; margin:0 auto 20px; } .stat-card { margin:0; display:flex; flex-direction:column; gap:8px; } .stat-card strong { font-size:24px; } .filter-row input, .filter-row select { flex:1; min-height:44px; border:1px solid var(--color-neutral-300); border-radius:8px; padding:0 12px; } button, .logout { border:0; border-radius:8px; padding:11px 16px; background:var(--color-primary); color:var(--color-white); cursor:pointer; } .logout { background:var(--color-neutral-900); } .order-list { display:grid; gap:12px; } .order-row { align-items:flex-start; flex-wrap:wrap; padding:16px 0; border-top:1px solid var(--color-neutral-100); } .order-row > div:first-child { flex:2; min-width:240px; } .chips, .evidence { display:flex; gap:8px; flex-wrap:wrap; } .chips span { background:var(--color-primary-lighter); border-radius:999px; padding:5px 9px; font-size:12px; } .chips .danger { background:var(--color-danger); color:var(--color-white); } details { width:100%; } .user-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:12px; } .user-card { flex-direction:column; align-items:flex-start; border:1px solid var(--color-neutral-100); border-radius:8px; padding:14px; } @media(max-width:800px){.admin-shell{padding:16px}.stats-grid{grid-template-columns:repeat(2,1fr)}.filter-row{flex-direction:column;align-items:stretch}.admin-header{align-items:flex-start}.admin-header h1{font-size:24px}}
</style>
