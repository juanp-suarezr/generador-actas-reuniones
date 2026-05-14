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

const buttonClass = 'inline-flex items-center px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary hover:cursor-pointer hover:scale-105 focus:bg-secondary active:bg-secondary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150';
</script>