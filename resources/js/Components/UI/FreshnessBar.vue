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
      if (this.percentElapsed <= 40) return 'Fresh';
      if (this.percentElapsed <= 75) return 'Use Soon';
      return 'Near Expiry';
    },
    statusClass() {
      if (!this.harvestDate) return 'status-neutral';
      if (this.percentElapsed <= 40) return 'status-fresh';
      if (this.percentElapsed <= 75) return 'status-soon';
      return 'status-expiry';
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
</style>
