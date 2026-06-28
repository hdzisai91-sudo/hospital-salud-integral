/**
 * router/index.js
 * Definición de rutas y guard global de autenticación.
 *
 * Convención para módulos nuevos:
 * - meta.requiresAuth = true  -> requiere sesión activa
 * - meta.requiresGuest = true -> solo accesible SIN sesión (ej. login)
 */

import { createRouter, createWebHistory } from 'vue-router';
import HelloWorld from '../components/HelloWorld.vue';
import LoginView from '../views/auth/LoginView.vue';
import DashboardView from '../views/dashboard/DashboardView.vue';
import NuevaSolicitudView from '../views/solicitudes/NuevaSolicitudView.vue';
import authService from '../services/authService';

const routes = [
  {
    path: '/',
    name: 'home',
    component: HelloWorld,
    meta: { requiresAuth: false },
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: DashboardView,
    meta: { requiresAuth: true },
  },
  {
    path: '/solicitudes/nueva',
    name: 'nueva-solicitud',
    component: NuevaSolicitudView,
    meta: { requiresAuth: true },
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView,
    meta: { requiresGuest: true },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to) => {
  const isAuthenticated = authService.isAuthenticated();

  if (to.meta.requiresAuth && !isAuthenticated) {
    return { name: 'login' };
  }

  if (to.meta.requiresGuest && isAuthenticated) {
    return { name: 'home' };
  }
});

export default router;