<template>
  <div class="nueva-solicitud-page">
    <header class="page-header">
      <div class="header-brand">
        <div class="header-logo">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <rect x="3" y="7" width="18" height="13" rx="2" stroke="white" stroke-width="2"/>
            <path d="M12 11v4M10 13h4" stroke="white" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </div>
        <div>
          <h1 class="header-title">Hospital Salud Integral</h1>
          <p class="header-subtitle">MANTENIMIENTO</p>
        </div>
      </div>

      <nav class="header-nav">
        <router-link to="/dashboard" class="nav-link">Inicio</router-link>
        <a href="#" class="nav-link active">Solicitudes</a>
        <a href="#" class="nav-link">Reportes</a>
        <a href="#" class="nav-link">Configuración</a>
      </nav>

      <div class="user-avatar">{{ userInitial }}</div>
    </header>

    <main class="page-main">
      <h2 class="page-title">Nueva Solicitud de Servicio</h2>
      <p class="page-subtitle">Complete los detalles para reportar una falla o requerimiento técnico.</p>

      <form class="solicitud-form" @submit.prevent="enviarSolicitud">
        <div class="field-group">
          <label>¿Qué tipo de servicio requiere?</label>
          <div class="select-wrapper">
            <span class="field-icon">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.7 6.3a3 3 0 1 0-4.2 4.2L4 17v3h3l6.5-6.5a3 3 0 0 0 4.2-4.2l-2-2-1 1Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
              </svg>
            </span>
            <select v-model="form.tipoServicio" required>
              <option value="" disabled>Seleccione el tipo de servicio</option>
              <option v-for="tipo in tiposServicio" :key="tipo" :value="tipo">{{ tipo }}</option>
            </select>
          </div>
        </div>

        <div class="field-group">
          <label>¿Dónde se encuentra el problema?</label>
          <div class="input-wrapper">
            <span class="field-icon">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 21s-7-6.1-7-11a7 7 0 1 1 14 0c0 4.9-7 11-7 11Z" stroke="currentColor" stroke-width="2"/>
                <circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="2"/>
              </svg>
            </span>
            <input
              v-model="form.ubicacion"
              type="text"
              placeholder="Piso, ala, número de habitación o área"
              required
            />
          </div>
        </div>

        <div class="field-group">
          <label>Descripción detallada del problema</label>
          <textarea
            v-model="form.descripcion"
            rows="4"
            placeholder="Describa brevemente la falla detectada o el requerimiento específico..."
            required
          ></textarea>
        </div>

        <div class="field-group">
          <label>Adjuntar Evidencia Fotográfica (Opcional)</label>
          <div class="upload-box">
            <span class="upload-icon">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="3" y="6" width="18" height="14" rx="2" stroke="currentColor" stroke-width="2"/>
                <circle cx="8.5" cy="11.5" r="1.5" stroke="currentColor" stroke-width="2"/>
                <path d="M21 16l-4.5-4.5a2 2 0 0 0-2.8 0L7 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
            <p class="upload-text"><span class="upload-link">Subir un archivo</span> o arrastrar y soltar</p>
            <p class="upload-hint">PNG, JPG hasta 10MB</p>
          </div>
        </div>

        <p v-if="error" class="form-error">{{ error }}</p>
        <p v-if="exito" class="form-success">{{ exito }}</p>

        <button type="submit" class="submit-btn" :disabled="enviando">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          {{ enviando ? 'Enviando...' : 'Enviar Solicitud' }}
        </button>
        <p class="submit-note">Esta solicitud será asignada automáticamente al equipo técnico de guardia.</p>
      </form>

      <div class="status-bar">
        <div class="status-item">
          <span class="status-icon icon-green">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
              <path d="M8.5 12.5l2.2 2.2L16 9.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <div>
            <p class="status-title">SISTEMA</p>
            <p class="status-value">Operativo</p>
          </div>
        </div>
        <div class="status-item">
          <span class="status-icon icon-blue">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="9" cy="8" r="3" stroke="currentColor" stroke-width="2"/>
              <path d="M3 19c0-3 2.7-5 6-5s6 2 6 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M16 9a2.5 2.5 0 1 0 0-5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </span>
          <div>
            <p class="status-title">TÉCNICOS</p>
            <p class="status-value">12 Disponibles</p>
          </div>
        </div>
        <div class="status-item">
          <span class="status-icon icon-amber">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
              <path d="M12 7v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </span>
          <div>
            <p class="status-title">ESPERA</p>
            <p class="status-value">~15 min</p>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../stores/auth';
import solicitudesService from '../../services/solicitudesService';

const router = useRouter();
const authStore = useAuthStore();

const tiposServicio = ['Eléctrico', 'Plomería', 'Aire Acondicionado', 'Equipo Médico', 'Limpieza', 'Otro'];

const form = ref({
  tipoServicio: '',
  ubicacion: '',
  descripcion: '',
});

const enviando = ref(false);
const error = ref('');
const exito = ref('');

const userInitial = computed(() => {
  const nombre = authStore.user?.name ?? 'U';
  return nombre.charAt(0).toUpperCase();
});

async function enviarSolicitud() {
  enviando.value = true;
  error.value = '';
  exito.value = '';

  try {
    await solicitudesService.crear({
      titulo: form.value.tipoServicio,
      subtitulo: form.value.descripcion,
      ubicacion: form.value.ubicacion,
      fecha: new Date().toISOString().slice(0, 10),
      prioridad: 'Media',
      estado: 'Pendiente',
    });

    exito.value = 'Solicitud enviada correctamente.';
    setTimeout(() => router.push('/dashboard'), 1200);
  } catch (e) {
    error.value = 'No se pudo enviar la solicitud. Intenta de nuevo.';
  } finally {
    enviando.value = false;
  }
}
</script>

<style scoped>
.nueva-solicitud-page {
  min-height: 100vh;
  background: #f4f6fa;
  font-family: system-ui, -apple-system, sans-serif;
  color: #1e293b;
}

.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #fff;
  padding: 1rem 2rem;
  border-bottom: 1px solid #e5e9f0;
  flex-wrap: wrap;
  gap: 1rem;
}
.header-brand { display: flex; align-items: center; gap: 0.75rem; }
.header-logo {
  width: 36px; height: 36px; border-radius: 9px; background: #2563eb;
  display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.header-logo svg { width: 18px; height: 18px; }
.header-title { font-size: 0.95rem; font-weight: 700; margin: 0; }
.header-subtitle { font-size: 0.68rem; font-weight: 700; color: #2563eb; margin: 0; letter-spacing: 0.05em; }

.header-nav { display: flex; gap: 1.5rem; }
.nav-link { color: #64748b; text-decoration: none; font-size: 0.9rem; font-weight: 600; }
.nav-link.active { color: #2563eb; }

.user-avatar {
  width: 34px; height: 34px; border-radius: 50%; background: #2563eb;
  color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700;
}

.page-main { max-width: 700px; margin: 0 auto; padding: 2.5rem 1.5rem; }
.page-title { font-size: 1.7rem; font-weight: 800; margin: 0 0 0.4rem; }
.page-subtitle { color: #64748b; margin: 0 0 1.5rem; }

.solicitud-form {
  background: #fff; border-radius: 14px; padding: 1.75rem;
  box-shadow: 0 1px 3px rgba(0,0,0,0.05); display: flex; flex-direction: column; gap: 1.25rem;
}

.field-group label { display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem; }

.input-wrapper, .select-wrapper { position: relative; display: flex; align-items: center; }
.field-icon { position: absolute; left: 0.85rem; color: #94a3b8; display: flex; }
.field-icon svg { width: 18px; height: 18px; }

.input-wrapper input, .select-wrapper select {
  width: 100%; padding: 0.75rem 0.9rem 0.75rem 2.5rem;
  border: 1px solid #e2e8f0; border-radius: 10px; font-size: 0.95rem;
  background: #f8fafc; box-sizing: border-box; appearance: none;
}
.select-wrapper select { cursor: pointer; }
.input-wrapper input:focus, .select-wrapper select:focus { outline: none; border-color: #2563eb; background: #fff; }

textarea {
  width: 100%; padding: 0.75rem 0.9rem; border: 1px solid #e2e8f0;
  border-radius: 10px; font-size: 0.95rem; background: #f8fafc;
  box-sizing: border-box; font-family: inherit; resize: vertical;
}
textarea:focus { outline: none; border-color: #2563eb; background: #fff; }

.upload-box {
  border: 2px dashed #cbd5e1; border-radius: 12px; padding: 1.75rem;
  text-align: center; background: #f8fafc;
}
.upload-icon { color: #94a3b8; display: inline-flex; margin-bottom: 0.5rem; }
.upload-icon svg { width: 28px; height: 28px; }
.upload-text { margin: 0; font-size: 0.9rem; color: #475569; }
.upload-link { color: #2563eb; font-weight: 600; }
.upload-hint { margin: 0.25rem 0 0; font-size: 0.78rem; color: #94a3b8; }

.form-error { background: #fef2f2; color: #dc2626; font-size: 0.85rem; padding: 0.6rem 0.8rem; border-radius: 8px; margin: 0; }
.form-success { background: #f0fdf4; color: #16a34a; font-size: 0.85rem; padding: 0.6rem 0.8rem; border-radius: 8px; margin: 0; }

.submit-btn {
  display: flex; align-items: center; justify-content: center; gap: 0.5rem;
  background: #2563eb; color: #fff; border: none; padding: 0.85rem;
  border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer;
}
.submit-btn:hover { background: #1d4ed8; }
.submit-btn:disabled { opacity: 0.6; cursor: not-allowed; }
.submit-btn svg { width: 18px; height: 18px; }
.submit-note { text-align: center; font-size: 0.8rem; color: #94a3b8; margin: 0; }

.status-bar {
  display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;
  margin-top: 1.5rem; background: #fff; border-radius: 14px;
  padding: 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.status-item { display: flex; align-items: center; gap: 0.75rem; }
.status-icon { width: 34px; height: 34px; border-radius: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.status-icon svg { width: 18px; height: 18px; }
.icon-green { background: #dcfce7; color: #16a34a; }
.icon-blue { background: #dbeafe; color: #2563eb; }
.icon-amber { background: #fef3c7; color: #d97706; }
.status-title { font-size: 0.7rem; color: #94a3b8; font-weight: 700; letter-spacing: 0.04em; margin: 0; }
.status-value { font-size: 0.9rem; font-weight: 700; margin: 0.1rem 0 0; }

@media (max-width: 768px) {
  .header-nav { display: none; }
  .status-bar { grid-template-columns: 1fr; }
}
</style>