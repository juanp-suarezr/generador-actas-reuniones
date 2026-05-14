<template>
    <div class="relative" ref="dropdownRef">
        <div @click="open = !open">
            <slot name="trigger" />
        </div>

        <div
            v-show="open"
            class="absolute z-50 mt-2 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5"
            :class="{ 'right-0': align === 'right', 'left-0': align === 'left', 'w-48': width === '48' }"
            v-bind="$attrs"
        >
            <slot name="content" />
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const props = defineProps({
    align: {
        type: String,
        default: 'right'
    },
    width: {
        type: String,
        default: '48'
    }
})

const open = ref(false)
const dropdownRef = ref(null)

const handleClickOutside = (event) => {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        open.value = false
    }
}

onMounted(() => {
    document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside)
})
</script>