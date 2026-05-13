<template>
  <div class="min-h-screen bg-gray-100">
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ acta.nombre_acta }}</h1>
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
          <h2 class="text-2xl font-semibold mb-4">Asistentes Registrados</h2>
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cédula</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cargo</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="attendee in acta.attendees" :key="attendee.id">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ attendee.nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ attendee.cedula }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ attendee.cargo }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
const props = defineProps({
  acta: Object,
});
</script>