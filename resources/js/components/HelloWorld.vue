<template>
  <div class="hello-world">
    <h1>{{ title }}</h1>
    <p>Vue 3 + Vite + Laravel está funcionando correctamente.</p>

    <p v-if="isAuthenticated">
      Sesión activa como: <strong>{{ user?.name ?? user?.email }}</strong>
    </p>
    <p v-else>No hay sesión activa.</p>

    <button @click="count++">
      Contador de prueba: {{ count }}
    </button>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import authService from '../services/authService';

const title = ref('¡Hola desde Vue 3!');
const count = ref(0);

const user = ref(authService.getUser());
const isAuthenticated = computed(() => authService.isAuthenticated());

onMounted(() => {
  window.addEventListener('auth:logout', () => {
    user.value = null;
  });
});
</script>