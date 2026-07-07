<template>
  <div class="app-card" :class="[variant, paddingSize]">
    <div v-if="$slots.header" class="card-header">
      <slot name="header" />
    </div>
    <div class="card-body">
      <slot />
    </div>
    <div v-if="$slots.footer" class="card-footer">
      <slot name="footer" />
    </div>
  </div>
</template>

<script setup>
defineProps({
  variant: {
    type: String,
    default: 'default' // 'default', 'outlined', 'flat'
  },
  paddingSize: {
    type: String,
    default: 'md' // 'sm', 'md', 'lg'
  }
});
</script>

<style scoped>
.app-card {
  background-color: var(--color-bg-card);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-sm);
  border: 1px solid var(--color-border);
  transition: box-shadow var(--transition-base), transform var(--transition-base);
  overflow: hidden;
}

.app-card:hover {
  box-shadow: var(--shadow-md);
}

.app-card.outlined {
  box-shadow: none;
  border: 1.5px solid var(--color-border);
}

.app-card.flat {
  box-shadow: none;
  border: none;
  background-color: var(--color-white);
}

.card-header {
  padding: var(--space-4);
  border-bottom: 1px solid var(--color-border);
}

.card-body {
  padding: var(--space-4);
}

.card-footer {
  padding: var(--space-4);
  border-top: 1px solid var(--color-border);
  background-color: var(--color-neutral-50);
}

/* Padding Sizes */
.app-card.sm .card-header,
.app-card.sm .card-body,
.app-card.sm .card-footer {
  padding: var(--space-2) var(--space-3);
}

.app-card.md .card-header,
.app-card.md .card-body,
.app-card.md .card-footer {
  padding: var(--space-4);
}

.app-card.lg .card-header,
.app-card.lg .card-body,
.app-card.lg .card-footer {
  padding: var(--space-5) var(--space-6);
}
</style>
