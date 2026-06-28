<template>
  <div class="login-view">
    <h2>Iniciar sesión</h2>

    <form @submit.prevent="handleSubmit">
      <input v-model="email" type="email" placeholder="Correo" required />
      <input v-model="password" type="password" placeholder="Contraseña" required />
      <button type="submit" :disabled="authStore.loading">
        {{ authStore.loading ? 'Ingresando...' : 'Ingresar' }}
      </button>
    </form>

    <p v-if="authStore.error" class="error">{{ authStore.error }}</p>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../stores/auth';

const email = ref('');
const password = ref('');
const router = useRouter();
const authStore = useAuthStore();

async function handleSubmit() {
  try {
    await authStore.login({ email: email.value, password: password.value });
    router.push('/');
  } catch (e) {
    // El error ya queda reflejado en authStore.error
  }
}
</script>

<style scoped>
.login-view {
  max-width: 360px;
  margin: 4rem auto;
  font-family: system-ui, sans-serif;
}
form {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}
input {
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 6px;
}
button {
  padding: 0.5rem;
  border-radius: 6px;
  border: none;
  background: #2563eb;
  color: white;
  cursor: pointer;
}
.error {
  color: #dc2626;
  margin-top: 1rem;
}
</style>
