<template>
  <div class="freshness-bar-wrapper">
    <!-- Label row -->
    <div class="freshness-label-row">
      <span class="harvest-age-text">
        <template v-if="harvestDate">
          Harvested {{ daysElapsed }} day{{ daysElapsed !== 1 ? 's' : '' }} ago
        </template>
        <template v-else>
          Harvest date not specified
        </template>
      </span>
      <span class="freshness-status-label" :class="statusClass">
        {{ statusLabel }}
      </span>
    </div>

    <!-- Progress bar track -->
    <div class="freshness-track">
      <div
        class="freshness-fill"
        :style="{ width: fillPercent + '%', backgroundColor: fillColor }"
      ></div>
    </div>

    <!-- Best Before plain-language line -->
    <div v-if="harvestDate" class="best-before-line" :class="statusClass">
      <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
      <span v-if="daysRemaining > 0">Best before: {{ bestBeforeDate }} — {{ daysRemaining }} day{{ daysRemaining !== 1 ? 's' : '' }} left</span>
      <span v-else>Past recommended sell date — sell immediately</span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FreshnessBar',
  props: {
    harvestDate: {
      type: String,
      default: null
    },
    shelfLifeDays: {
      type: Number,
      default: 4
    }
  },
  computed: {
    daysElapsed() {
      if (!this.harvestDate) return 0;
      const harvest = new Date(this.harvestDate);
      harvest.setHours(0, 0, 0, 0);
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      const diff = Math.floor((today - harvest) / (1000 * 60 * 60 * 24));
      return Math.max(0, diff);
    },
    percentElapsed() {
      if (!this.harvestDate) return 0;
      return Math.min(100, (this.daysElapsed / this.shelfLifeDays) * 100);
    },
    fillPercent() {
      if (!this.harvestDate) return 100;
      return this.percentElapsed;
    },
    fillColor() {
      if (!this.harvestDate) return 'var(--color-neutral-300)';
      if (this.percentElapsed <= 40) return 'var(--color-primary)';
      if (this.percentElapsed <= 75) return 'var(--color-secondary)';
      return 'var(--color-danger)';
    },
    statusLabel() {
      if (!this.harvestDate) return '—';
      if (this.percentElapsed <= 40) return 'Fresh Harvest';
      if (this.percentElapsed <= 75) return 'Good Condition';
      return 'Fast Sale';
    },
    statusClass() {
      if (!this.harvestDate) return 'status-neutral';
      if (this.percentElapsed <= 40) return 'status-fresh';
      if (this.percentElapsed <= 75) return 'status-soon';
      return 'status-expiry';
    },
    bestBeforeDate() {
      if (!this.harvestDate) return null;
      const harvest = new Date(this.harvestDate);
      harvest.setHours(0, 0, 0, 0);
      const bestBefore = new Date(harvest);
      bestBefore.setDate(bestBefore.getDate() + this.shelfLifeDays);
      return bestBefore.toLocaleDateString('en-GB', { day: 'numeric', month: 'short' });
    },
    daysRemaining() {
      if (!this.harvestDate) return 0;
      return Math.max(0, this.shelfLifeDays - this.daysElapsed);
    }
  }
}
</script>

<style scoped>
@import "../../../css/design-tokens.css";

.freshness-bar-wrapper {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.freshness-label-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.harvest-age-text {
  font-size: var(--font-size-xs);
  color: var(--color-neutral-500);
  font-weight: var(--font-weight-regular);
}

.freshness-status-label {
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  padding: 1px 8px;
  border-radius: var(--radius-pill);
}

.status-fresh {
  background-color: var(--color-primary-lighter);
  color: var(--color-primary);
}

.status-soon {
  background-color: #FFF3E0;
  color: #E65100;
}

.status-expiry {
  background-color: #FDECEA;
  color: var(--color-danger);
}

.status-neutral {
  background-color: var(--color-neutral-100);
  color: var(--color-neutral-500);
}

.freshness-track {
  width: 100%;
  height: 6px;
  background-color: var(--color-neutral-100);
  border-radius: var(--radius-pill);
  overflow: hidden;
}

.freshness-fill {
  height: 100%;
  border-radius: var(--radius-pill);
  transition: width 0.4s ease, background-color 0.4s ease;
}

.best-before-line {
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: 10px;
  font-weight: var(--font-weight-medium);
  margin-top: 2px;
}

.best-before-line.status-fresh {
  color: var(--color-primary);
}
.best-before-line.status-soon {
  color: #E65100;
}
.best-before-line.status-expiry {
  color: var(--color-danger);
}
</style>
