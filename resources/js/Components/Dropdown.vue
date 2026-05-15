<template>
    <div class="relative" ref="dropdownRef">
        <div @click="toggleDropdown" ref="triggerRef">
            <slot name="trigger" />
        </div>

        <div
            v-show="open"
            class="fixed z-[9999] rounded-xl shadow-2xl bg-gray-800/95 backdrop-blur-xl border border-gray-700/50 w-56"
            :style="dropdownStyle"
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
const triggerRef = ref(null)
const dropdownStyle = ref({})

const handleClickOutside = (event) => {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        open.value = false
    }
}

const toggleDropdown = () => {
    open.value = !open.value
    if (open.value) {
        calculatePosition()
    }
}

const calculatePosition = () => {
    if (!triggerRef.value) return

    const rect = triggerRef.value.getBoundingClientRect()
    const dropdownHeight = 200 // approximate height

    let top = rect.bottom + 8
    let left = props.align === 'right' ? rect.right - 224 : rect.left // 224px = w-56 width

    // Adjust if dropdown would go off screen
    if (top + dropdownHeight > window.innerHeight) {
        top = rect.top - dropdownHeight - 8
    }

    if (left + 224 > window.innerWidth) {
        left = window.innerWidth - 224 - 16
    }

    if (left < 16) {
        left = 16
    }

    dropdownStyle.value = {
        top: `${top}px`,
        left: `${left}px`
    }
}

onMounted(() => {
    document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside)
})
</script>