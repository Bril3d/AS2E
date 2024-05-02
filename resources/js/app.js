import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { register } from 'swiper/element/bundle';
import { router, usePage } from '@inertiajs/vue3'
import "preline";
import Toast, { POSITION } from "vue-toastification";
import "vue-toastification/dist/index.css";
import { toastCall } from './Composables/toast.js';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import SectionHeader from './Components/SectionHeader.vue'
import PrimaryButton from './Components/PrimaryButton.vue'
import DangerButton from './Components/DangerButton.vue'
import CKEditor from '@ckeditor/ckeditor5-vue';

router.on('finish', (event) => {
    window.HSStaticMethods.autoInit();
})

register();

toastCall();

createInertiaApp({
    title: (title) => `${title} - ${usePage().props?.settings.app_name}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .mixin({ components: { SectionHeader, PrimaryButton, DangerButton, AuthenticatedLayout } })
            .use(plugin)
            .use(ZiggyVue)
            .use(Toast, {
                position: POSITION.BOTTOM_RIGHT
            })
            .use(CKEditor)
            .mount(el);
    },
    progress: {
        color: '#00acba',
    },
});
