<template>
  <span class="app-badge" :class="[variant, size]">
    <slot />
  </span>
</template>

<script setup>
defineProps({
  variant: {
    type: String,
    default: 'default' // 'default', 'primary', 'secondary', 'tertiary', 'success', 'warning', 'danger'
  },
  size: {
    type: String,
    default: 'md' // 'sm', 'md'
  }
});
</script>

<style scoped>
.app-badge {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-family: var(--font-family);
  font-weight: var(--font-weight-semibold);
  border-radius: var(--radius-pill);
  white-space: nowrap;
}

/* Sizes */
.app-badge.sm {
  font-size: 10px;
  padding: 2px 6px;
  height: 18px;
}

.app-badge.md {
  font-size: var(--font-size-xs);
  padding: 4px 10px;
  height: 24px;
}

/* Variants */
.app-badge.default {
  background-color: var(--color-neutral-100);
  color: var(--color-neutral-700);
}

.app-badge.primary {
  background-color: var(--color-primary-lighter);
  color: var(--color-primary-hover);
}

.app-badge.secondary {
  background-color: var(--color-secondary-light);
  color: var(--color-secondary-dark);
}

.app-badge.tertiary {
  background-color: var(--color-tertiary-subtle);
  color: var(--color-tertiary-hover);
}

.app-badge.success {
  background-color: var(--color-success-light);
  color: var(--color-success);
}

.app-badge.warning {
  background-color: var(--color-warning-light);
  color: var(--color-secondary-dark);
}

.app-badge.danger {
  background-color: var(--color-danger-light);
  color: var(--color-danger);
}
</style>
