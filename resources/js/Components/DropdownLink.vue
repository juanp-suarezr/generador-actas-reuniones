<template>
    <component
        :is="as"
        :href="href"
        :method="method"
        class="block w-full px-4 py-2 text-left text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-gray-900 dark:hover:text-gray-100"
        v-bind="$attrs"
    >
        <slot />
    </component>
</template>

<script setup>
defineProps({
    href: String,
    method: {
        type: String,
        default: 'get'
    },
    as: {
        type: String,
        default: 'a'
    }
})
</script>