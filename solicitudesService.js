/**
 * resources/js/services/solicitudesService.js
 * Lógica de negocio para solicitudes de mantenimiento.
 * Usa el cliente Axios centralizado de api.js.
 */

import api from './api';

export default {
    async resumen() {
        const response = await api.get('/solicitudes/resumen');
        return response.data;
    },

    async listar(params = {}) {
        const response = await api.get('/solicitudes', { params });
        return response.data;
    },

    async crear(datos) {
        const response = await api.post('/solicitudes', datos);
        return response.data;
    },

    async actualizar(id, datos) {
        const response = await api.put(`/solicitudes/${id}`, datos);
        return response.data;
    },

    async eliminar(id) {
        await api.delete(`/solicitudes/${id}`);
    },
};