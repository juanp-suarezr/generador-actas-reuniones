<template>
    <img class="w-44 h-auto" :src="logoSrc" alt="Logo Institucional" v-bind="$attrs" />
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

const isDark = ref(false)

const updateIsDark = () => {
    isDark.value = document.documentElement.classList.contains('dark')
}

onMounted(() => {
    updateIsDark()
    const observer = new MutationObserver(updateIsDark)
    observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] })
})

const logoSrc = computed(() => isDark.value ? '/assets/img/logo_white.webp' : '/assets/img/logo.webp')
</script>