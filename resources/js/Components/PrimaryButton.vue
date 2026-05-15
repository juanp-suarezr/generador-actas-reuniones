<template>
    <button
        :type="type"
        :class="buttonClass"
        v-bind="$attrs"
    >
        <slot />
    </button>
</template>

<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});

const buttonClass = 'inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-wider shadow-lg hover:shadow-xl hover:cursor-pointer hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:ring-offset-2 active:scale-95 transition-all duration-300 backdrop-blur-sm';
</script>