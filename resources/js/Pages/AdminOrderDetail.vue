<template>
  <div class="detail-shell">
    <AdminNav active="live" />
    <main>
      <Link href="/admin/dashboard?tab=live" class="back">← Back to orders</Link>
      <p class="eyebrow">Order #{{ order.id }}</p>
      <h1>{{ order.product?.name || 'Produce order' }}</h1>
      <p class="muted">{{ order.product?.user?.name }} → {{ order.buyer?.name }} · Driver: {{ order.driver?.name || 'Unassigned' }}</p>

      <div class="grid">
        <section class="panel">
          <h2>Load evidence</h2>
          <p v-if="order.verification">Claimed grade {{ order.verification.claimed_grade }} → verified grade {{ order.verification.actual_grade }}</p>
          <p v-if="order.verification">Freshness: {{ order.verification.freshness_match ? 'Matches' : 'Does not match' }} · Packaging: {{ order.verification.packaging_ok ? 'OK' : 'Not OK' }}</p>
          <div class="photos">
            <img v-for="photo in order.verification?.pickup_photos || []" :key="photo" :src="'/storage/' + photo" alt="Pickup evidence">
            <img v-if="order.delivery_photo_path" :src="'/storage/' + order.delivery_photo_path" alt="Delivery evidence">
            <img v-if="order.dispute_photo_path" :src="'/storage/' + order.dispute_photo_path" alt="Dispute evidence">
          </div>
        </section>

        <section class="panel">
          <h2>Parties and money</h2>
          <p>Farmer: {{ order.product?.user?.name }} · {{ order.product?.user?.phone_number }}</p>
          <p>Buyer: {{ order.buyer?.name }} · {{ order.buyer?.phone_number }}</p>
          <p>Driver: {{ order.driver?.name || 'Unassigned' }} · {{ order.driver?.phone_number || '—' }}</p>
          <p>Escrow: {{ order.payment_status }} · GH₵ {{ money(order.adjusted_price ?? order.total_price) }}</p>
        </section>
      </div>

      <section v-if="order.disputed_at" class="panel dispute-panel">
        <h2>Dispute</h2>
        <div class="dispute-summary">
          <p><strong>Status:</strong> {{ order.dispute_status }}</p>
          <p><strong>Reason:</strong> {{ reasonLabel(order.disputed_reason) }}</p>
          <p><strong>Notes:</strong> {{ order.disputed_notes || 'None' }}</p>
          <p><strong>Raised:</strong> Buyer · {{ formatDate(order.disputed_at) }}</p>
        </div>
        <div class="dispute-photo" v-if="order.dispute_photo_path">
          <span>Dispute photo</span>
          <img :src="'/storage/' + order.dispute_photo_path" alt="Buyer dispute evidence">
        </div>
        <div v-if="order.dispute_status === 'open'" class="resolve-box">
          <h3>Resolve dispute</h3>
          <select v-model="resolution">
            <option value="refund_full">Refund in full</option>
            <option value="refund_partial">Refund in part</option>
            <option value="no_refund">No refund</option>
          </select>
          <input v-model="resolutionReason" placeholder="Required decision reason">
          <button :disabled="!resolutionReason.trim() || resolving" @click="resolveDispute">
            {{ resolving ? 'Saving…' : 'Log resolution' }}
          </button>
        </div>
        <div v-else class="resolved-box">
          <p><strong>Resolution:</strong> {{ order.dispute_resolution }}</p>
          <p><strong>Decision reason:</strong> {{ order.dispute_resolution_reason }}</p>
          <p><strong>Resolved:</strong> {{ formatDate(order.dispute_resolved_at) }}</p>
        </div>
      </section>
      <p v-else class="no-dispute">No dispute has been raised for this order.</p>

      <section class="panel">
        <h2>Audit timeline</h2>
        <div class="timeline">
          <div v-for="event in order.events" :key="event.id" class="event">
            <span class="dot"></span>
            <div><strong>{{ event.event }}</strong><p>{{ event.actor?.name || event.actor_role || 'System' }} · {{ formatDate(event.created_at) }}</p></div>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AdminNav from '../Components/AdminNav.vue';

const props = defineProps({ order: Object });
const resolution = ref('refund_full');
const resolutionReason = ref('');
const resolving = ref(false);
const money = value => Number(value || 0).toFixed(2);
const formatDate = value => value ? new Date(value).toLocaleString() : '—';
const reasonLabel = value => ({ damaged_produce: 'Damaged produce', wrong_quantity: 'Wrong quantity', late_delivery: 'Late delivery', quality_mismatch: 'Quality does not match listing', other: 'Other issue' }[value] || value);
const resolveDispute = () => {
  if (!resolutionReason.value.trim()) return;
  resolving.value = true;
  router.post(`/admin/orders/${props.order.id}/dispute-resolution`, { resolution: resolution.value, reason: resolutionReason.value }, { onFinish: () => { resolving.value = false; } });
};
</script>

<style scoped>
@import "../../css/design-tokens.css";
.detail-shell{min-height:100vh;background:var(--color-neutral-50);color:var(--color-neutral-900);font-family:var(--font-family)}main{margin-left:var(--sidebar-width);width:calc(100% - var(--sidebar-width));box-sizing:border-box;padding:var(--space-7) clamp(var(--space-5),4vw,var(--space-10))}.back,.eyebrow{color:var(--color-primary);font-weight:600}.eyebrow{margin-top:var(--space-6);text-transform:uppercase}.muted,.event p{color:var(--color-neutral-500)}h1{font-size:32px;margin:var(--space-2) 0}.grid{display:grid;grid-template-columns:1fr 1fr;gap:var(--space-5)}.panel{background:var(--color-white);border:1px solid var(--color-neutral-100);border-radius:var(--radius-lg);padding:var(--space-5);margin-top:var(--space-5);box-shadow:var(--shadow-sm)}.photos{display:flex;gap:var(--space-3);flex-wrap:wrap}.photos img,.dispute-photo img{width:120px;height:90px;object-fit:cover;border-radius:var(--radius-md)}.dispute-panel{border-left:4px solid var(--color-secondary)}.dispute-summary{display:grid;grid-template-columns:repeat(2,1fr);gap:var(--space-2)}.dispute-photo{display:flex;flex-direction:column;gap:var(--space-2);margin-top:var(--space-3)}.resolve-box{display:flex;gap:var(--space-3);align-items:center;flex-wrap:wrap;border-top:1px solid var(--color-neutral-100);margin-top:var(--space-4);padding-top:var(--space-4)}.resolve-box h3{width:100%;margin:0}.resolve-box select,.resolve-box input{min-height:44px;border:1px solid var(--color-neutral-300);border-radius:var(--radius-md);padding:0 var(--space-3);flex:1}.resolve-box button{min-height:44px;background:var(--color-primary);border:0;border-radius:var(--radius-md);padding:0 var(--space-4);color:var(--color-white)}.resolve-box button:disabled{opacity:.55}.resolved-box{background:var(--color-primary-lighter);padding:var(--space-3);border-radius:var(--radius-md);margin-top:var(--space-4)}.no-dispute{color:var(--color-neutral-500);margin-top:var(--space-5)}.timeline{display:flex;flex-direction:column;gap:var(--space-4)}.event{display:flex;gap:var(--space-3);position:relative}.dot{width:12px;height:12px;background:var(--color-primary);border-radius:50%;margin-top:4px;flex:none}.event p{margin:var(--space-1) 0 0}@media(max-width:1024px){main{margin-left:var(--sidebar-width-collapsed);width:calc(100% - var(--sidebar-width-collapsed))}}@media(max-width:700px){main{margin-left:0;width:100%;padding:var(--space-5) var(--space-3) var(--space-8)}.grid,.dispute-summary{grid-template-columns:1fr}h1{font-size:26px}}
</style>
