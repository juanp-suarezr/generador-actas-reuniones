<template>
    <Link
        :href="href"
        :method="method"
        :as="as"
        :class="classes"
        v-bind="$attrs"
    >
        <slot />
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
    href: String,
    active: Boolean,
    method: {
        type: String,
        default: 'get'
    },
    as: {
        type: String,
        default: 'a'
    }
})

const classes = computed(() => {
    return props.active
        ? 'block pl-4 pr-6 py-3 ml-2 mr-2 rounded-lg bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 text-base font-semibold text-blue-700 dark:text-blue-300 border-l-4 border-blue-500 shadow-sm transition-all duration-300'
        : 'block pl-4 pr-6 py-3 ml-2 mr-2 rounded-lg text-base font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-white/70 dark:hover:bg-gray-700/70 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:bg-white/90 dark:focus:bg-gray-700/90 transition-all duration-300'
})
</script>