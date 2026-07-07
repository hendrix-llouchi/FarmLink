<template>
  <div class="app-input-group" :class="{ 'has-error': error }">
    <label v-if="label" :for="id" class="input-label">
      {{ label }}
      <span v-if="required" class="required-indicator">*</span>
    </label>

    <div class="input-container">
      <div v-if="$slots.prefix" class="prefix-slot">
        <slot name="prefix" />
      </div>

      <!-- Textarea -->
      <textarea
        v-if="type === 'textarea'"
        :id="id"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="form-input form-textarea"
        :placeholder="placeholder"
        :required="required"
        v-bind="$attrs"
      ></textarea>

      <!-- Select -->
      <select
        v-else-if="type === 'select'"
        :id="id"
        :value="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
        class="form-input form-select"
        :required="required"
        v-bind="$attrs"
      >
        <slot />
      </select>

      <!-- Standard Input -->
      <input
        v-else
        :id="id"
        :type="type"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="form-input"
        :placeholder="placeholder"
        :required="required"
        v-bind="$attrs"
      />

      <div v-if="$slots.suffix" class="suffix-slot">
        <slot name="suffix" />
      </div>
    </div>

    <span v-if="error" class="error-message">{{ error }}</span>
  </div>
</template>

<script setup>
defineProps({
  modelValue: [String, Number],
  type: {
    type: String,
    default: 'text'
  },
  label: String,
  error: String,
  id: String,
  required: Boolean,
  placeholder: String
});

defineEmits(['update:modelValue']);
</script>

<style scoped>
.app-input-group {
  display: flex;
  flex-direction: column;
  gap: var(--space-1);
  width: 100%;
}

.input-label {
  font-family: var(--font-family);
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  color: var(--color-neutral-900);
}

.required-indicator {
  color: var(--color-danger);
  margin-left: 2px;
}

.input-container {
  display: flex;
  position: relative;
  align-items: center;
}

.form-input {
  width: 100%;
  height: var(--input-height);
  padding: 0 var(--space-3);
  background-color: var(--color-white);
  border: 1.5px solid var(--color-neutral-300);
  border-radius: var(--radius-md);
  font-family: var(--font-family);
  font-size: var(--font-size-base);
  color: var(--color-neutral-900);
  transition: all var(--transition-fast);
}

.form-input::placeholder {
  color: var(--color-neutral-500);
}

.form-input:focus {
  border-color: var(--color-primary);
  box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.15);
}

.form-textarea {
  height: auto;
  min-height: 100px;
  padding: var(--space-3);
  resize: vertical;
}

.form-select {
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23495057' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right var(--space-3) center;
  background-size: 16px;
  padding-right: var(--space-10);
}

/* Slots support */
.prefix-slot {
  position: absolute;
  left: var(--space-3);
  display: flex;
  align-items: center;
  color: var(--color-neutral-500);
  z-index: 2;
}

.prefix-slot + .form-input {
  padding-left: var(--space-10);
}

.suffix-slot {
  position: absolute;
  right: var(--space-3);
  display: flex;
  align-items: center;
  color: var(--color-neutral-500);
  z-index: 2;
}

.form-input:has(+ .suffix-slot) {
  padding-right: var(--space-10);
}

/* Error State */
.app-input-group.has-error .form-input {
  border-color: var(--color-danger);
}

.app-input-group.has-error .form-input:focus {
  box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.15);
}

.error-message {
  font-family: var(--font-family);
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-medium);
  color: var(--color-danger);
  margin-top: 2px;
}
</style>
