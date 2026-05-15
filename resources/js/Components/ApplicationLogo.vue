<template>
    <img class="w-44 h-auto"  :src="logoSrc" alt="Logo Institucional" v-bind="$attrs" />
</template>

<script setup>
import { ref, computed, onMounted, defineProps } from 'vue'

const isDark = ref(false)

const props = defineProps({
    origen: String,
})

const updateIsDark = () => {
    // Check both: system preference and manual toggle
    const hasDarkClass = document.documentElement.classList.contains('dark')
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches

    // // Use manual toggle if set, otherwise use system preference
    isDark.value = hasDarkClass || (!document.documentElement.classList.contains('light') && prefersDark)

    console.log(props.origen)

    if (props.origen === 'navMenu') {
        isDark.value = true
    } else {
        isDark.value = false
    }

    console.log(isDark.value)
}

onMounted(() => {
    updateIsDark()

    // Listen for changes in the dark class
    const observer = new MutationObserver(updateIsDark)
    observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] })

    // // Listen for changes in system color scheme preference
    const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)')
    mediaQuery.addEventListener('change', updateIsDark)
})

const logoSrc = computed(() => isDark.value ? '/assets/img/logo_white.webp' : '/assets/img/logo.webp')
</script>