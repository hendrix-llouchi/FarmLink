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
        :type="isPasswordType ? (showPassword ? 'text' : 'password') : type"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="form-input"
        :class="{ 'has-suffix-btn': isPasswordType || $slots.suffix }"
        :placeholder="placeholder"
        :required="required"
        autocomplete="off"
        autocorrect="off"
        autocapitalize="off"
        spellcheck="false"
        data-lpignore="true"
        v-bind="$attrs"
      />

      <button
        v-if="isPasswordType"
        type="button"
        class="password-toggle-btn"
        @click="showPassword = !showPassword"
        aria-label="Toggle password visibility"
      >
        <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
          <circle cx="12" cy="12" r="3"/>
        </svg>
        <svg v-else xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
          <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
          <path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
          <line x1="2" y1="2" x2="22" y2="22"/>
        </svg>
      </button>

      <div v-else-if="$slots.suffix" class="suffix-slot">
        <slot name="suffix" />
      </div>
    </div>

    <span v-if="error" class="error-message">{{ error }}</span>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
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

const showPassword = ref(false);
const isPasswordType = computed(() => props.type === 'password');
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

.form-input.has-suffix-btn {
  padding-right: var(--space-10);
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

/* Slots & Buttons */
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

.password-toggle-btn {
  position: absolute;
  right: var(--space-3);
  background: transparent;
  border: none;
  color: var(--color-neutral-500);
  cursor: pointer;
  padding: 4px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: var(--radius-sm);
  z-index: 5;
  transition: color var(--transition-fast);
}

.password-toggle-btn:hover {
  color: var(--color-neutral-900);
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
