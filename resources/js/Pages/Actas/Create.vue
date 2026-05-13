<template>
  <div class="min-h-screen bg-gray-100">
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
          <h1 class="text-3xl font-bold text-gray-900">Crear Acta</h1>
          <Link href="/actas" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Volver
          </Link>
        </div>
      </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <form @submit.prevent="submit" class="p-6 bg-white border-b border-gray-200">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nombre del Acta -->
            <div>
              <label for="nombre_acta" class="block text-sm font-medium text-gray-700">Nombre del Acta</label>
              <input v-model="form.nombre_acta" type="text" id="nombre_acta" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
              <div v-if="form.errors.nombre_acta" class="text-red-500 text-sm mt-1">{{ form.errors.nombre_acta }}</div>
            </div>

            <!-- Tema -->
            <div>
              <label for="tema" class="block text-sm font-medium text-gray-700">Tema</label>
              <input v-model="form.tema" type="text" id="tema" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
              <div v-if="form.errors.tema" class="text-red-500 text-sm mt-1">{{ form.errors.tema }}</div>
            </div>

            <!-- Fecha -->
            <div>
              <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
              <input v-model="form.fecha" type="date" id="fecha" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
              <div v-if="form.errors.fecha" class="text-red-500 text-sm mt-1">{{ form.errors.fecha }}</div>
            </div>

            <!-- Tipo -->
            <div>
              <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo</label>
              <select v-model="form.tipo" id="tipo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="interna">Interna</option>
                <option value="externa">Externa</option>
              </select>
              <div v-if="form.errors.tipo" class="text-red-500 text-sm mt-1">{{ form.errors.tipo }}</div>
            </div>

            <!-- Subproceso (solo interna) -->
            <div v-if="form.tipo === 'interna'">
              <label for="subproceso" class="block text-sm font-medium text-gray-700">Subproceso</label>
              <input v-model="form.subproceso" type="text" id="subproceso" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Lugar (solo externa) -->
            <div v-if="form.tipo === 'externa'">
              <label for="lugar" class="block text-sm font-medium text-gray-700">Lugar</label>
              <input v-model="form.lugar" type="text" id="lugar" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Responsable (solo externa) -->
            <div v-if="form.tipo === 'externa'">
              <label for="responsable" class="block text-sm font-medium text-gray-700">Responsable</label>
              <input v-model="form.responsable" type="text" id="responsable" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Número de Acta -->
            <div>
              <label for="numero_acta" class="block text-sm font-medium text-gray-700">Número de Acta</label>
              <input v-model="form.numero_acta" type="text" id="numero_acta" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
          </div>

          <!-- Descripción -->
          <div class="mt-6">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea v-model="form.descripcion" id="descripcion" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
          </div>

          <!-- Compromisos -->
          <div class="mt-6">
            <label for="compromisos" class="block text-sm font-medium text-gray-700">Compromisos</label>
            <textarea v-model="compromisosText" @input="updateCompromisos" id="compromisos" rows="4" placeholder="Uno por línea" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
          </div>

          <div class="mt-6 flex justify-end">
            <button type="submit" :disabled="form.processing" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              Crear Acta
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
  nombre_acta: '',
  tema: '',
  subproceso: '',
  fecha: '',
  numero_acta: '',
  tipo: 'interna',
  lugar: '',
  responsable: '',
  descripcion: '',
  compromisos: [],
});

const compromisosText = computed({
  get: () => form.compromisos.join('\n'),
  set: (value) => form.compromisos = value.split('\n').filter(line => line.trim()),
});

const updateCompromisos = () => {
  // Already handled by computed
};

const submit = () => {
  form.post('/actas', {
    onSuccess: () => {
      // Redirect handled by controller
    },
  });
};
</script>