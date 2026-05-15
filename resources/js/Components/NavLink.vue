<template>
    <Link
        :href="href"
        :class="classes"
        v-bind="$attrs"
    >
        <slot />
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue';

const props = defineProps({
    href: String,
    active: Boolean
})

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-4 py-2 mx-1 bg-gradient-to-r from-blue-900/20 to-indigo-900/20 text-sm font-semibold leading-5 text-blue-300 border border-blue-800 shadow-sm transition-all duration-300'
        : 'inline-flex items-center px-4 py-2 mx-1 text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-800/60 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:bg-gray-800/80 transition-all duration-300 hover:shadow-md'
})
</script>