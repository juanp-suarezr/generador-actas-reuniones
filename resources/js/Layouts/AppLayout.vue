<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-slate-900 to-gray-800">
        <!-- Navigation -->
        <nav class="bg-gray-900/80 backdrop-blur-xl shadow-lg border-b border-gray-700/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <Link href="/" class="flex items-center group">
                                <div class="p-2 shadow-lg group-hover:shadow-xl transition-all duration-300">
                                    <ApplicationLogo origen="navMenu" class="h-6 w-6 text-white" />
                                </div>
                                <span class="ml-3 text-xl font-bold bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">Sistema de Actas</span>
                            </Link>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <NavLink href="/actas" :active="route().current('actas.index')">
                                Actas
                            </NavLink>
                        </div>
                    </div>

                    <!-- Logout Button -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <button
                            @click="logout"
                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 border border-transparent rounded-xl font-semibold text-sm text-white shadow-lg hover:shadow-xl hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:ring-offset-2 transition-all duration-300"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Cerrar Sesión
                        </button>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-flex items-center justify-center p-3 rounded-xl text-gray-400 hover:text-gray-100 hover:bg-gray-800/50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 backdrop-blur-sm transition-all duration-300">
                            <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" class="sm:hidden bg-gray-900/95 backdrop-blur-xl border-t border-gray-700/50">
                <div class="pt-4 pb-3 space-y-2 px-4">
                    <ResponsiveNavLink href="/actas" :active="route().current('actas.index')">
                        Actas
                    </ResponsiveNavLink>
                </div>
                <div class="pt-4 pb-3 border-t border-gray-600/50 px-4">
                    <div class="px-2">
                        <div class="font-semibold text-base text-white">{{ $page.props.auth.user?.name }}</div>
                        <div class="font-medium text-sm text-gray-400">{{ $page.props.auth.user?.email }}</div>
                    </div>
                    <div class="mt-4 space-y-2">
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                            Cerrar Sesión
                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Header/Navigation -->
        <div class="fixed top-20 left-0 right-0 z-[100] bg-gray-900/80 backdrop-blur-xl border-b border-gray-700/30 shadow-2xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Breadcrumb Navigation -->
                    <nav class="flex items-center space-x-4" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-3">
                            <!-- Home Link -->
                            <li>
                                <Link
                                    href="/"
                                    class="inline-flex items-center text-gray-400 hover:text-white transition-colors duration-200 group"
                                >
                                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Inicio</span>
                                </Link>
                            </li>

                            <!-- Separator -->
                            <li v-if="getBreadcrumbItems().length > 0">
                                <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </li>

                            <!-- Dynamic Breadcrumb Items -->
                            <li v-for="(item, index) in getBreadcrumbItems()" :key="item.path" class="flex items-center space-x-3">
                                <!-- Separator for items after first -->
                                <svg v-if="index > 0" class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>

                                <!-- Breadcrumb Link -->
                                <Link
                                    v-if="!item.current"
                                    :href="item.path"
                                    class="text-gray-400 hover:text-white transition-colors duration-200 text-sm font-medium"
                                >
                                    {{ item.label }}
                                </Link>

                                <!-- Current Page (not clickable) -->
                                <span v-else class="text-white font-semibold text-sm">
                                    {{ item.label }}
                                </span>
                            </li>
                        </ol>
                    </nav>

                    <!-- Page Actions -->
                    <div class="flex items-center space-x-3">
                        <!-- Back/Return Button -->
                        <button
                            @click="goBack"
                            class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-800/80 hover:bg-gray-700 border border-gray-700/50 text-gray-400 hover:text-white transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105"
                            :title="getBackButtonTitle()"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>

                        <!-- Refresh Button -->
                        <button
                            @click="refreshPage"
                            class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-800/80 hover:bg-gray-700 border border-gray-700/50 text-gray-400 hover:text-white transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105"
                            title="Actualizar página"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </button>


                    </div>
                </div>
            </div>
        </div>
        

        <!-- Page Content -->
        <main class="flex-1 pt-16">
            <slot />
        </main>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link, usePage, router } from '@inertiajs/vue3'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import NavLink from '@/Components/NavLink.vue'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'

const mobileMenuOpen = ref(false)
const page = usePage()

// Get breadcrumb items based on current route
const getBreadcrumbItems = () => {
    const currentRoute = page.url
    const items = []

    if (currentRoute === '/') {
        return items // Home has no additional breadcrumbs
    }

    if (currentRoute.includes('/actas')) {
        items.push({
            label: 'Actas',
            path: '/actas',
            current: currentRoute === '/actas'
        })

        if (currentRoute.includes('/create')) {
            items.push({
                label: 'Crear Acta',
                path: currentRoute,
                current: true
            })
        } else if (currentRoute.includes('/edit')) {
            items.push({
                label: 'Editar Acta',
                path: currentRoute,
                current: true
            })
        } else if (currentRoute !== '/actas') {
            items.push({
                label: 'Detalle del Acta',
                path: currentRoute,
                current: true
            })
        }
    }

    return items
}

// Get current page name for title
const getCurrentPageName = () => {
    const currentRoute = page.url

    if (currentRoute === '/') return 'Panel Administrativo'
    if (currentRoute === '/actas') return 'Gestión de Actas'
    if (currentRoute.includes('/actas/create')) return 'Crear Nueva Acta'
    if (currentRoute.includes('/actas/') && currentRoute.includes('/edit')) return 'Editar Acta'
    if (currentRoute.includes('/actas/') && !currentRoute.includes('/edit')) return 'Detalle del Acta'

    return 'Panel Administrativo'
}

// Get back button title
const getBackButtonTitle = () => {
    const currentRoute = page.url
    const breadcrumbItems = getBreadcrumbItems()

    if (breadcrumbItems.length > 1) {
        return `Volver a ${breadcrumbItems[breadcrumbItems.length - 2].label}`
    }

    return 'Ir al inicio'
}

// Smart back navigation
const goBack = () => {
    const currentRoute = page.url
    const breadcrumbItems = getBreadcrumbItems()

    // If we have breadcrumb items, go to the parent
    if (breadcrumbItems.length > 1) {
        const parentItem = breadcrumbItems[breadcrumbItems.length - 2]
        if (parentItem.path) {
            router.visit(parentItem.path, { method: 'get' })
            return
        }
    }

    // Otherwise go to home
    router.visit('/', { method: 'get' })
}

// Refresh current page
const refreshPage = () => {
    window.location.reload()
}

// Logout function
const logout = () => {
    if (confirm('¿Estás seguro de que quieres cerrar sesión?')) {
        router.post(route('logout'))
    }
}


</script>