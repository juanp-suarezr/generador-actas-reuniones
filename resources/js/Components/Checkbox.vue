<template>
    <input
        type="checkbox"
        :checked="checked"
        @change="$emit('update:checked', $event.target.checked)"
        v-bind="$attrs"
    >
</template>

<script setup>
defineProps({
    checked: Boolean,
});

defineEmits(['update:checked']);
</script>