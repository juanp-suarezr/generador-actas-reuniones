<template>
  <AppLayout>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
                class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl rounded-xl shadow-lg border border-white/20 dark:border-gray-700/50 p-6 hover:shadow-xl transition-all duration-300"
            >
                <div class="flex items-center">
                    <div
                        class="p-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg"
                    >
                        <svg
                            class="w-6 h-6 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                            ></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-gray-600 dark:text-gray-400"
                        >
                            Total Actas
                        </p>
                        <p
                            class="text-2xl font-bold text-gray-900 dark:text-white"
                        >
                            {{ actas.total || 0 }}
                        </p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl rounded-xl shadow-lg border border-white/20 dark:border-gray-700/50 p-6 hover:shadow-xl transition-all duration-300"
            >
                <div class="flex items-center">
                    <div
                        class="p-3 bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg"
                    >
                        <svg
                            class="w-6 h-6 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                            ></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-gray-600 dark:text-gray-400"
                        >
                            Actas Internas
                        </p>
                        <p
                            class="text-2xl font-bold text-gray-900 dark:text-white"
                        >
                            {{
                                actas.data?.filter((a) => a.tipo === "interna")
                                    .length || 0
                            }}
                        </p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl rounded-xl shadow-lg border border-white/20 dark:border-gray-700/50 p-6 hover:shadow-xl transition-all duration-300"
            >
                <div class="flex items-center">
                    <div
                        class="p-3 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-lg"
                    >
                        <svg
                            class="w-6 h-6 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"
                            ></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-gray-600 dark:text-gray-400"
                        >
                            Actas Externas
                        </p>
                        <p
                            class="text-2xl font-bold text-gray-900 dark:text-white"
                        >
                            {{
                                actas.data?.filter((a) => a.tipo === "externa")
                                    .length || 0
                            }}
                        </p>
                    </div>
                </div>
            </div>

            <div
                class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl rounded-xl shadow-lg border border-white/20 dark:border-gray-700/50 p-6 hover:shadow-xl transition-all duration-300"
            >
                <div class="flex items-center">
                    <div
                        class="p-3 bg-gradient-to-r from-amber-500 to-orange-600 rounded-lg shadow-lg"
                    >
                        <svg
                            class="w-6 h-6 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                            ></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p
                            class="text-sm font-medium text-gray-600 dark:text-gray-400"
                        >
                            Actas Recientes
                        </p>
                        <p
                            class="text-2xl font-bold text-gray-900 dark:text-white"
                        >
                            {{
                                actas.data?.filter(
                                    (a) =>
                                        new Date(a.fecha) >=
                                        new Date(
                                            Date.now() -
                                                30 * 24 * 60 * 60 * 1000,
                                        ),
                                ).length || 0
                            }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div
            class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 dark:border-gray-700/50 overflow-hidden"
        >
            <div
                class="px-6 lg:px-8 py-6 bg-gradient-to-r from-white to-gray-50/50 dark:from-gray-900 dark:to-gray-800/50 border-b border-gray-200/50 dark:border-gray-700/50"
            >
                <div
                    class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4"
                >
                    <div>
                        <h2
                            class="text-2xl font-bold text-gray-900 dark:text-white mb-1"
                        >
                            Lista de Actas
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400">
                            Gestiona todas tus actas de reuniones
                        </p>
                    </div>

                    <!-- Quick Actions -->
                    <div class="flex flex-wrap gap-3">
                        <button
                            @click="exportData"
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 hover:from-gray-200 hover:to-gray-300 dark:hover:from-gray-600 dark:hover:to-gray-500 text-gray-700 dark:text-gray-300 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md"
                        >
                            <svg
                                class="w-4 h-4 mr-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                ></path>
                            </svg>
                            Exportar CSV
                        </button>
                        <button
                            @click="refreshData"
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 hover:from-green-200 hover:to-emerald-200 dark:hover:from-green-800/40 dark:hover:to-emerald-800/40 text-green-700 dark:text-green-300 rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md"
                        >
                            <svg
                                class="w-4 h-4 mr-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                                ></path>
                            </svg>
                            Actualizar
                        </button>
                        <Link
                            href="/actas/create"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 border border-transparent rounded-xl font-semibold text-sm text-white shadow-lg hover:shadow-xl hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:ring-offset-2 transition-all duration-300"
                        >
                            <svg
                                class="w-5 h-5 mr-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                ></path>
                            </svg>
                            Nueva Acta
                        </Link>
                    </div>
                </div>

                <!-- Filters -->
                <div class="flex flex-col sm:flex-row gap-4 mt-6">
                    <div class="flex-1">
                        <div class="relative">
                            <svg
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                ></path>
                            </svg>
                            <input
                                v-model="filters.search"
                                @input="debouncedSearch"
                                type="text"
                                placeholder="Buscar actas..."
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm"
                            />
                        </div>
                    </div>
                    <div class="sm:w-48">
                        <select
                            v-model="filters.tipo"
                            @change="fetchActas"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm"
                        >
                            <option value="">Todos los tipos</option>
                            <option value="interna">Interna</option>
                            <option value="externa">Externa</option>
                        </select>
                    </div>
                </div>

                <!-- Table -->
                <div
                    class="overflow-hidden bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700"
                >
                    <table
                        class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
                    >
                        <thead
                            class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700"
                        >
                            <tr>
                                <th
                                    class="px-8 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider"
                                >
                                    Nombre del Acta
                                </th>
                                <th
                                    class="px-8 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider"
                                >
                                    Fecha
                                </th>
                                <th
                                    class="px-8 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider"
                                >
                                    Tipo
                                </th>
                                <th
                                    class="px-8 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider"
                                >
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody
                            class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700"
                        >
                            <tr
                                v-for="acta in actas.data"
                                :key="acta.id"
                                class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200"
                            >
                                <td
                                    class="px-8 py-5 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white"
                                >
                                    {{ acta.nombre_acta }}
                                </td>
                                <td
                                    class="px-8 py-5 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300"
                                >
                                    {{ acta.fecha }}
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span
                                        :class="
                                            acta.tipo === 'interna'
                                                ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300'
                                                : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                                        "
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium"
                                    >
                                        {{ acta.tipo }}
                                    </span>
                                </td>
                                <td
                                    class="px-8 py-5 whitespace-nowrap text-sm font-medium space-x-3"
                                >
                                    <Link
                                        :href="`/actas/${acta.id}`"
                                        class="inline-flex items-center px-3 py-1.5 rounded-lg text-blue-600 hover:text-blue-800 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-900/30 transition-all duration-200"
                                    >
                                        <svg
                                            class="w-4 h-4 mr-1"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            ></path>
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                            ></path>
                                        </svg>
                                        Ver
                                    </Link>
                                    <Link
                                        :href="`/actas/${acta.id}/edit`"
                                        class="inline-flex items-center px-3 py-1.5 rounded-lg text-amber-600 hover:text-amber-800 hover:bg-amber-50 dark:text-amber-400 dark:hover:bg-amber-900/30 transition-all duration-200"
                                    >
                                        <svg
                                            class="w-4 h-4 mr-1"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                            ></path>
                                        </svg>
                                        Editar
                                    </Link>
                                    <button
                                        @click="share(acta.id)"
                                        class="inline-flex items-center px-3 py-1.5 rounded-lg text-emerald-600 hover:text-emerald-800 hover:bg-emerald-50 dark:text-emerald-400 dark:hover:bg-emerald-900/30 transition-all duration-200"
                                    >
                                        <svg
                                            class="w-4 h-4 mr-1"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"
                                            ></path>
                                        </svg>
                                        Compartir
                                    </button>
                                    <Link
                                        :href="`/actas/${acta.id}/download-pdf`"
                                        class="inline-flex items-center px-3 py-1.5 rounded-lg text-red-600 hover:text-red-800 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/30 transition-all duration-200"
                                    >
                                        <svg
                                            class="w-4 h-4 mr-1"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                            ></path>
                                        </svg>
                                        PDF
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Empty State -->
                    <div
                        v-if="!actas.data || actas.data.length === 0"
                        class="text-center py-16"
                    >
                        <div
                            class="mx-auto w-24 h-24 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 rounded-full flex items-center justify-center mb-4"
                        >
                            <svg
                                class="w-12 h-12 text-gray-400 dark:text-gray-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                ></path>
                            </svg>
                        </div>
                        <h3
                            class="text-lg font-medium text-gray-900 dark:text-white mb-2"
                        >
                            No hay actas registradas
                        </h3>
                        <p
                            class="text-gray-500 dark:text-gray-400 mb-6 max-w-sm mx-auto"
                        >
                            Comienza creando tu primera acta de reunión para
                            organizar y documentar tus sesiones de manera
                            efectiva.
                        </p>
                        <Link
                            href="/actas/create"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 border border-transparent rounded-xl font-semibold text-sm text-white shadow-lg hover:shadow-xl hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:ring-offset-2 transition-all duration-300"
                        >
                            <svg
                                class="w-4 h-4 mr-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                ></path>
                            </svg>
                            Crear Primera Acta
                        </Link>
                    </div>

                    <!-- Pagination -->
                    <div
                        v-if="actas.data && actas.data.length > 0"
                        class="mt-8 flex justify-center"
                    >
                        <div class="flex items-center space-x-2">
                            <template
                                v-for="link in actas.links"
                                :key="link.label"
                            >
                                <Link
                                    v-if="link.url"
                                    :href="link.url"
                                    v-html="link.label"
                                    :class="
                                        link.active
                                            ? 'bg-blue-600 text-white shadow-lg'
                                            : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-600'
                                    "
                                    class="px-4 py-2 rounded-lg font-medium transition-all duration-200 hover:shadow-md"
                                ></Link>
                                <span
                                    v-else
                                    v-html="link.label"
                                    :class="
                                        link.active
                                            ? 'bg-blue-600 text-white shadow-lg'
                                            : 'bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 cursor-not-allowed'
                                    "
                                    class="px-4 py-2 rounded-lg font-medium"
                                ></span>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "../../Layouts/AppLayout.vue";

const props = defineProps({
    actas: Object,
    filters: Object,
});

const filters = ref(props.filters);

const debounce = (func, delay) => {
    let timeoutId;
    return (...args) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => func.apply(null, args), delay);
    };
};

const debouncedSearch = debounce(() => {
    fetchActas();
}, 300);

const fetchActas = () => {
    router.get("/actas", filters.value, {
        preserveState: true,
        replace: true,
    });
};

const refreshData = () => {
    router.reload({
        only: ["actas"],
        preserveState: true,
        preserveScroll: true,
    });
};

const exportData = () => {
    // Simple CSV export for now
    if (!actas.data || actas.data.length === 0) {
        alert("No hay datos para exportar");
        return;
    }

    const csvContent =
        "data:text/csv;charset=utf-8," +
        "Nombre,Fecha,Tipo\n" +
        actas.data
            .map(
                (acta) =>
                    `"${acta.nombre_acta}","${acta.fecha}","${acta.tipo}"`,
            )
            .join("\n");

    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute(
        "download",
        `actas_${new Date().toISOString().split("T")[0]}.csv`,
    );
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};

const share = async (id) => {
    try {
        await navigator.clipboard.writeText(
            `${window.location.origin}/actas/shared/${id}`,
        );
        // You could show a toast notification here instead of alert
        alert("Enlace copiado al portapapeles");
    } catch (err) {
        console.error("Failed to copy: ", err);
        alert("Error al copiar el enlace");
    }
};

onMounted(() => {
    // Any init
});
</script>
