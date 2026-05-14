<template>
    <input
        :type="type"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :class="inputClass"
        v-bind="$attrs"
    >
</template>

<script setup>
import { computed, useAttrs } from 'vue';

const props = defineProps({
    modelValue: String,
    type: {
        type: String,
        default: 'text',
    },
});

const emit = defineEmits(['update:modelValue']);
const attrs = useAttrs();

const inputClass = computed(() => [
    'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
    attrs.class || '',
]);
</script>