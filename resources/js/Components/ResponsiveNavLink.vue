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
    return active
        ? 'block pl-3 pr-4 py-2 border-l-4 border-primary text-base font-medium text-primary bg-primary-50 dark:bg-primary-900/50 focus:outline-none focus:text-primary focus:bg-primary-100 dark:focus:bg-primary-900 focus:border-primary transition duration-150 ease-in-out'
        : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:bg-gray-50 dark:focus:bg-gray-700 focus:border-gray-300 dark:focus:border-gray-600 transition duration-150 ease-in-out'
})
</script>