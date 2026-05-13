<template>
  <div class="min-h-screen bg-gray-100">
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">Registrarse en Acta: {{ acta.nombre_acta }}</h1>
      </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <form @submit.prevent="submit" class="p-6 bg-white border-b border-gray-200">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nombre -->
            <div>
              <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
              <input v-model="form.nombre" type="text" id="nombre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
              <div v-if="form.errors.nombre" class="text-red-500 text-sm mt-1">{{ form.errors.nombre }}</div>
            </div>

            <!-- Cédula -->
            <div>
              <label for="cedula" class="block text-sm font-medium text-gray-700">Cédula</label>
              <input v-model="form.cedula" type="text" id="cedula" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
              <div v-if="form.errors.cedula" class="text-red-500 text-sm mt-1">{{ form.errors.cedula }}</div>
            </div>

            <!-- Proceso/Entidad -->
            <div>
              <label for="proceso_entidad" class="block text-sm font-medium text-gray-700">Proceso/Entidad</label>
              <input v-model="form.proceso_entidad" type="text" id="proceso_entidad" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
              <div v-if="form.errors.proceso_entidad" class="text-red-500 text-sm mt-1">{{ form.errors.proceso_entidad }}</div>
            </div>

            <!-- Cargo -->
            <div>
              <label for="cargo" class="block text-sm font-medium text-gray-700">Cargo</label>
              <select v-model="form.cargo" id="cargo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="funcionario">Funcionario</option>
                <option value="contratista">Contratista</option>
              </select>
              <div v-if="form.errors.cargo" class="text-red-500 text-sm mt-1">{{ form.errors.cargo }}</div>
            </div>

            <!-- Teléfono -->
            <div>
              <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
              <input v-model="form.telefono" type="text" id="telefono" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Correo -->
            <div>
              <label for="correo" class="block text-sm font-medium text-gray-700">Correo</label>
              <input v-model="form.correo" type="email" id="correo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Dirección (solo externa) -->
            <div v-if="acta.tipo === 'externa'">
              <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
              <input v-model="form.direccion" type="text" id="direccion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Comuna/Corregimiento (solo externa) -->
            <div v-if="acta.tipo === 'externa'">
              <label for="comuna_corregimiento" class="block text-sm font-medium text-gray-700">Comuna/Corregimiento</label>
              <input v-model="form.comuna_corregimiento" type="text" id="comuna_corregimiento" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
          </div>

          <!-- Firma -->
          <div class="mt-6">
            <label for="firma" class="block text-sm font-medium text-gray-700">Firma (Imagen)</label>
            <input @change="handleFileChange" type="file" id="firma" accept="image/*" class="mt-1 block w-full">
          </div>

          <div class="mt-6 flex justify-end">
            <button type="submit" :disabled="form.processing" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              Registrarse
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  acta: Object,
  token: String,
});

const form = useForm({
  nombre: '',
  cedula: '',
  proceso_entidad: '',
  cargo: 'funcionario',
  telefono: '',
  correo: '',
  direccion: '',
  comuna_corregimiento: '',
  firma: null,
});

const handleFileChange = (event) => {
  form.firma = event.target.files[0];
};

const submit = () => {
  form.post(`/actas/shared/${props.token}`, {
    onSuccess: () => {
      // Redirect handled
    },
  });
};
</script>