import './bootstrap';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/index.esm.js';

const el = document.getElementById('app');
const pageData = JSON.parse(el?.dataset?.page || 'null');
console.log('Parsed Page Data:', pageData);

try {
    createInertiaApp({
        page: pageData,
        title: (title) => `${title} - ${import.meta.env.VITE_APP_NAME}`,
        resolve: (name) => {
            console.log('Resolving:', name);
            return resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'));
        },
        setup({ el, App, props, plugin }) {
            console.log('Setup called with App:', App);
            return createApp({ render: () => h(App, props) })
                .use(plugin)
                .use(ZiggyVue)
                .mount(el);
        },
        progress: {
            color: '#4B5563',
        },
    });
} catch (e) {
    console.error('Error starting Inertia:', e);
}
