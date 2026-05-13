<template>
  <div class="min-h-screen bg-gray-100">
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
          <h1 class="text-3xl font-bold text-gray-900">Actas</h1>
          <Link href="/actas/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Crear Acta
          </Link>
        </div>
      </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <!-- Filters -->
          <div class="mb-4">
            <input v-model="filters.search" @input="debouncedSearch" type="text" placeholder="Buscar..." class="border border-gray-300 rounded px-3 py-2">
            <select v-model="filters.tipo" @change="fetchActas" class="border border-gray-300 rounded px-3 py-2 ml-2">
              <option value="">Todos los tipos</option>
              <option value="interna">Interna</option>
              <option value="externa">Externa</option>
            </select>
          </div>

          <!-- Table -->
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="acta in actas.data" :key="acta.id">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ acta.nombre_acta }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ acta.fecha }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ acta.tipo }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <Link :href="`/actas/${acta.id}`" class="text-indigo-600 hover:text-indigo-900 mr-2">Ver</Link>
                  <Link :href="`/actas/${acta.id}/edit`" class="text-indigo-600 hover:text-indigo-900 mr-2">Editar</Link>
                  <button @click="share(acta.id)" class="text-green-600 hover:text-green-900 mr-2">Compartir</button>
                  <Link :href="`/actas/${acta.id}/download-pdf`" class="text-blue-600 hover:text-blue-900">PDF</Link>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- Pagination -->
          <div class="mt-4">
            <Link v-for="link in actas.links" :key="link.label" :href="link.url" v-html="link.label" :class="link.active ? 'font-bold' : ''" class="mr-2"></Link>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
  actas: Object,
  filters: Object,
});

const filters = ref(props.filters);

const debouncedSearch = _.debounce(() => {
  fetchActas();
}, 300);

const fetchActas = () => {
  router.get('/actas', filters.value, {
    preserveState: true,
    replace: true,
  });
};

const share = (id) => {
  router.post(`/actas/${id}/share`, {}, {
    onSuccess: () => alert('Enlace copiado al portapapeles'),
  });
};

onMounted(() => {
  // Any init
});
</script>