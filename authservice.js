/**
 * resources/js/services/authService.js
 * Lógica de negocio de autenticación. Usa el cliente Axios
 * centralizado de api.js — no configura nada de HTTP aquí.
 */

import api from './api';

export default {
    api, // se mantiene por compatibilidad con código que ya lo usa (ej. LoginView)

    async login(credentials) {
        const response = await api.post('/login', credentials);
        localStorage.setItem('auth_token', response.data.token);
        localStorage.setItem('auth_user', JSON.stringify(response.data.user));
        return response.data.user;
    },

    async logout() {
        await api.post('/logout');
        localStorage.removeItem('auth_token');
        localStorage.removeItem('auth_user');
    },

    async fetchCurrentUser() {
        const response = await api.get('/user');
        localStorage.setItem('auth_user', JSON.stringify(response.data));
        return response.data;
    },

    getUser() {
        const user = localStorage.getItem('auth_user');
        return user ? JSON.parse(user) : null;
    },

    isAuthenticated() {
        return !!localStorage.getItem('auth_token');
    },
};