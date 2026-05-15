<template>
  <AppLayout>
  <div class="space-y-8">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 shadow-2xl overflow-hidden">
      <div class="px-6 lg:px-8 py-10 lg:py-12 text-white">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
          <div class="mb-6 lg:mb-0">
            <h1 class="text-4xl font-bold mb-2">Crear Nueva Acta</h1>
            <p class="text-green-100 text-lg">Registra una nueva acta de reunión con toda la información necesaria</p>
          </div>
          <div class="flex flex-col sm:flex-row gap-4">
            <Link href="/actas" class="inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur-sm hover:bg-white/20 border border-white/20 rounded-xl font-semibold text-white shadow-lg hover:shadow-xl transition-all duration-300 group">
              <svg class="w-5 h-5 mr-3 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
              Volver a Actas
            </Link>
          </div>
        </div>
      </div>
    </div>

    <!-- Formulario -->
    <div class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
      <form @submit.prevent="submit" class="p-6 lg:p-8">
        <!-- Información Básica -->
        <div class="mb-8">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Información Básica
          </h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nombre del Acta -->
            <div>
              <label for="nombre_acta" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                Nombre del Acta <span class="text-red-500">*</span>
              </label>
              <input
                v-model="form.nombre_acta"
                type="text"
                id="nombre_acta"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm"
                placeholder="Ingrese el nombre del acta"
                required
              >
              <div v-if="form.errors.nombre_acta" class="text-red-500 text-sm mt-2">{{ form.errors.nombre_acta }}</div>
            </div>

            <!-- Tema -->
            <div>
              <label for="tema" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                Tema <span class="text-red-500">*</span>
              </label>
              <input
                v-model="form.tema"
                type="text"
                id="tema"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm"
                placeholder="Tema principal de la reunión"
                required
              >
              <div v-if="form.errors.tema" class="text-red-500 text-sm mt-2">{{ form.errors.tema }}</div>
            </div>

            <!-- Fecha -->
            <div>
              <label for="fecha" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                Fecha <span class="text-red-500">*</span>
              </label>
              <input
                v-model="form.fecha"
                type="date"
                id="fecha"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm"
                required
              >
              <div v-if="form.errors.fecha" class="text-red-500 text-sm mt-2">{{ form.errors.fecha }}</div>
            </div>

            <!-- Tipo -->
            <div>
              <label for="tipo" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                Tipo <span class="text-red-500">*</span>
              </label>
              <select
                v-model="form.tipo"
                id="tipo"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm"
                required
              >
                <option value="interna">Interna</option>
                <option value="externa">Externa</option>
              </select>
              <div v-if="form.errors.tipo" class="text-red-500 text-sm mt-2">{{ form.errors.tipo }}</div>
            </div>

            <!-- Subproceso (solo interna) -->
            <div v-if="form.tipo === 'interna'">
              <label for="subproceso" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                Subproceso
              </label>
              <input
                v-model="form.subproceso"
                type="text"
                id="subproceso"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm"
                placeholder="Subproceso relacionado"
              >
            </div>

            <!-- Lugar (solo externa) -->
            <div v-if="form.tipo === 'externa'">
              <label for="lugar" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                Lugar
              </label>
              <input
                v-model="form.lugar"
                type="text"
                id="lugar"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm"
                placeholder="Lugar de la reunión externa"
              >
            </div>

            <!-- Responsable (solo externa) -->
            <div v-if="form.tipo === 'externa'">
              <label for="responsable" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                Responsable
              </label>
              <input
                v-model="form.responsable"
                type="text"
                id="responsable"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm"
                placeholder="Persona responsable"
              >
            </div>

            <!-- Número de Acta -->
            <div>
              <label for="numero_acta" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                Número de Acta
              </label>
              <input
                v-model="form.numero_acta"
                type="text"
                id="numero_acta"
                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm"
                placeholder="Número identificador del acta"
              >
            </div>
          </div>
        </div>

        <!-- Nota Informativa -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 mb-8">
          <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
              <h3 class="text-sm font-semibold text-blue-900 dark:text-blue-100 mb-1">Nota Importante</h3>
              <p class="text-sm text-blue-800 dark:text-blue-200">
                Los campos marcados con <span class="text-red-500 font-bold">*</span> son obligatorios.
                La descripción y compromisos se pueden agregar después de crear el acta en la sección de editar.
              </p>
            </div>
          </div>
        </div>

        <!-- Botones de Acción -->
        <div class="flex flex-col sm:flex-row justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
          <Link
            href="/actas"
            class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-xl font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500/50 transition-all duration-300"
          >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            Cancelar
          </Link>

          <button
            type="submit"
            :disabled="form.processing"
            class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 border border-transparent rounded-xl font-semibold text-sm text-white shadow-lg hover:shadow-xl hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500/50 focus:ring-offset-2 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <svg v-if="form.processing" class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            <svg v-else class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            {{ form.processing ? 'Creando...' : 'Crear Acta' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</AppLayout>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from "../../Layouts/AppLayout.vue";

const form = useForm({
  nombre_acta: '',
  tema: '',
  subproceso: '',
  fecha: '',
  numero_acta: '',
  tipo: 'interna',
  lugar: '',
  responsable: '',
});

const submit = () => {
  form.post('/actas', {
    onSuccess: () => {
      // Redirect handled by controller
    },
  });
};
</script>