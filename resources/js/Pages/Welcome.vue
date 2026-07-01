<template>
  <div class="welcome-container">
    <main class="welcome-card">
      <div class="logo-area">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#2E7D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="logo-icon">
          <path d="m12 3-1.912 5.886a1 1 0 0 1-.95.686H2.929l4.908 3.566a1 1 0 0 1 .364 1.122L6.29 20.147l4.907-3.565a1 1 0 0 1 1.604 0l4.907 3.565-1.91-5.887a1 1 0 0 1 .364-1.122l4.908-3.566h-6.21a1 1 0 0 1-.95-.686z"/>
        </svg>
        <h1 class="title">FarmLink</h1>
      </div>
      <p class="subtitle">Connecting Western Region smallholders directly to vegetable buyers and transport providers.</p>
      
      <div class="status-box">
        <div class="status-indicator"></div>
        <p class="status-text">Scaffolding Setup Successful</p>
      </div>

      <div class="specs">
        <div class="spec-item">
          <span class="spec-label">Backend</span>
          <span class="spec-val">Laravel 10.x</span>
        </div>
        <div class="spec-item">
          <span class="spec-label">Frontend</span>
          <span class="spec-val">Vue 3 (Inertia.js)</span>
        </div>
        <div class="spec-item">
          <span class="spec-label">Environment</span>
          <span class="spec-val">PHP 8.1.25 / Local MySQL</span>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
export default {
  name: 'Welcome'
}
</script>

<style scoped>
.welcome-container {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 16px;
  background-color: #F7F8F5;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  color: #1A1A1A;
}

.welcome-card {
  width: 100%;
  max-width: 400px;
  background-color: #FFFFFF;
  border: 1px solid #E0E0DA;
  border-radius: 12px;
  padding: 32px 24px;
  text-align: center;
  box-shadow: 0 1px 2px rgba(0,0,0,0.06);
}

.logo-area {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 24px;
}

.logo-icon {
  margin-bottom: 12px;
}

.title {
  font-size: 28px;
  font-weight: 500;
  color: #1B5E20;
  margin: 0;
}

.subtitle {
  font-size: 15px;
  font-weight: 400;
  color: #6B6B63;
  line-height: 1.5;
  margin-top: 0;
  margin-bottom: 28px;
}

.status-box {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background-color: #E8F5E9;
  border-radius: 8px;
  padding: 8px 16px;
  margin-bottom: 28px;
}

.status-indicator {
  width: 8px;
  height: 8px;
  background-color: #2E7D32;
  border-radius: 50%;
}

.status-text {
  font-size: 14px;
  font-weight: 500;
  color: #2E7D32;
  margin: 0;
}

.specs {
  display: flex;
  flex-direction: column;
  gap: 12px;
  border-top: 1px solid #E0E0DA;
  padding-top: 20px;
  text-align: left;
}

.spec-item {
  display: flex;
  justify-content: space-between;
  font-size: 14px;
}

.spec-label {
  color: #6B6B63;
  font-weight: 400;
}

.spec-val {
  color: #1A1A1A;
  font-weight: 500;
}
</style>
