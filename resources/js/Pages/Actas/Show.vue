<template>
  <div class="min-h-screen bg-gray-100">
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
          <h1 class="text-3xl font-bold text-gray-900">{{ acta.nombre_acta }}</h1>
          <div class="flex space-x-2">
            <Link :href="`/actas/${acta.id}/edit`" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              Editar
            </Link>
            <button @click="share" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
              Compartir
            </button>
            <Link :href="`/actas/${acta.id}/download-pdf`" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
              PDF
            </Link>
            <Link href="/actas" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
              Volver
            </Link>
          </div>
        </div>
      </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h2 class="text-2xl font-semibold mb-4">Información del Acta</h2>
          <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <dt class="font-medium text-gray-500">Tema</dt>
              <dd class="mt-1 text-gray-900">{{ acta.tema }}</dd>
            </div>
            <div>
              <dt class="font-medium text-gray-500">Fecha</dt>
              <dd class="mt-1 text-gray-900">{{ acta.fecha }}</dd>
            </div>
            <div>
              <dt class="font-medium text-gray-500">Tipo</dt>
              <dd class="mt-1 text-gray-900">{{ acta.tipo }}</dd>
            </div>
            <div v-if="acta.numero_acta">
              <dt class="font-medium text-gray-500">Número de Acta</dt>
              <dd class="mt-1 text-gray-900">{{ acta.numero_acta }}</dd>
            </div>
            <div v-if="acta.subproceso">
              <dt class="font-medium text-gray-500">Subproceso</dt>
              <dd class="mt-1 text-gray-900">{{ acta.subproceso }}</dd>
            </div>
            <div v-if="acta.lugar">
              <dt class="font-medium text-gray-500">Lugar</dt>
              <dd class="mt-1 text-gray-900">{{ acta.lugar }}</dd>
            </div>
            <div v-if="acta.responsable">
              <dt class="font-medium text-gray-500">Responsable</dt>
              <dd class="mt-1 text-gray-900">{{ acta.responsable }}</dd>
            </div>
          </dl>

          <div v-if="acta.descripcion" class="mt-6">
            <h3 class="text-lg font-medium text-gray-900">Descripción</h3>
            <p class="mt-2 text-gray-600">{{ acta.descripcion }}</p>
          </div>

          <div v-if="acta.compromisos && acta.compromisos.length" class="mt-6">
            <h3 class="text-lg font-medium text-gray-900">Compromisos</h3>
            <ul class="mt-2 list-disc list-inside text-gray-600">
              <li v-for="compromiso in acta.compromisos" :key="compromiso">{{ compromiso }}</li>
            </ul>
          </div>
        </div>

        <div class="p-6 bg-white border-b border-gray-200">
          <h2 class="text-2xl font-semibold mb-4">Asistentes</h2>
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cédula</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cargo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Firma</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="attendee in acta.attendees" :key="attendee.id">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ attendee.nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ attendee.cedula }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ attendee.cargo }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <span v-if="attendee.firma_path">Firmado</span>
                  <span v-else>No firmado</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
  acta: Object,
});

const share = () => {
  router.post(`/actas/${props.acta.id}/share`, {}, {
    onSuccess: () => alert('Enlace copiado al portapapeles'),
  });
};
</script>