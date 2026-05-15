<template>
    <component
        :is="as"
        :href="href"
        :method="method"
        class="block w-full px-4 py-3 text-left text-sm text-gray-200 hover:bg-gradient-to-r hover:from-blue-900/30 hover:to-indigo-900/30 hover:text-blue-300 rounded-lg mx-2 my-1 transition-all duration-200"
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