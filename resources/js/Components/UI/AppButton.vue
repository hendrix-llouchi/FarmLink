<template>
  <button
    :type="type"
    class="app-btn"
    :class="[variant, size, { 'is-loading': loading }]"
    :disabled="disabled || loading"
  >
    <span v-if="loading" class="spinner" />
    <span class="btn-content" :class="{ 'opacity-0': loading }">
      <slot name="icon-left" />
      <slot />
      <slot name="icon-right" />
    </span>
  </button>
</template>

<script setup>
defineProps({
  type: {
    type: String,
    default: 'button'
  },
  variant: {
    type: String,
    default: 'primary' // 'primary', 'secondary', 'inverted', 'outlined', 'danger'
  },
  size: {
    type: String,
    default: 'md' // 'sm', 'md', 'lg'
  },
  disabled: {
    type: Boolean,
    default: false
  },
  loading: {
    type: Boolean,
    default: false
  }
});
</script>

<style scoped>
.app-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-family: var(--font-family);
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-medium);
  border-radius: var(--radius-md);
  border: 1.5px solid transparent;
  cursor: pointer;
  position: relative;
  transition: all var(--transition-fast);
  white-space: nowrap;
}

.btn-content {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
}

/* Variants */
.app-btn.primary {
  background-color: var(--color-primary);
  color: var(--color-white);
}
.app-btn.primary:hover:not(:disabled) {
  background-color: var(--color-primary-hover);
}

.app-btn.secondary {
  background-color: transparent;
  border-color: var(--color-primary);
  color: var(--color-primary);
}
.app-btn.secondary:hover:not(:disabled) {
  background-color: var(--color-primary-subtle);
}

.app-btn.inverted {
  background-color: var(--color-white);
  color: var(--color-neutral-900);
  border-color: var(--color-border);
}
.app-btn.inverted:hover:not(:disabled) {
  background-color: var(--color-neutral-50);
}

.app-btn.outlined {
  background-color: transparent;
  border-color: var(--color-neutral-300);
  color: var(--color-neutral-700);
}
.app-btn.outlined:hover:not(:disabled) {
  border-color: var(--color-neutral-500);
  color: var(--color-neutral-900);
  background-color: var(--color-neutral-50);
}

.app-btn.danger {
  background-color: var(--color-danger);
  color: var(--color-white);
}
.app-btn.danger:hover:not(:disabled) {
  background-color: #BD2130;
}

/* Sizes */
.app-btn.sm {
  height: var(--input-height-sm);
  padding: 0 var(--space-3);
  font-size: var(--font-size-sm);
}

.app-btn.md {
  height: var(--input-height);
  padding: 0 var(--space-4);
  font-size: var(--font-size-base);
}

.app-btn.lg {
  height: 52px;
  padding: 0 var(--space-6);
  font-size: var(--font-size-md);
}

/* Disabled */
.app-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  box-shadow: none;
}

/* Loading state */
.spinner {
  position: absolute;
  width: 18px;
  height: 18px;
  border: 2px solid rgba(255,255,255,0.3);
  border-top-color: currentColor;
  border-radius: var(--radius-full);
  animation: spin 0.8s linear infinite;
}

.app-btn.secondary .spinner,
.app-btn.outlined .spinner {
  border-color: rgba(45, 106, 79, 0.3);
  border-top-color: var(--color-primary);
}

.opacity-0 {
  opacity: 0;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}
</style>
