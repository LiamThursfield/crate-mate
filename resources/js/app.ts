import AppLayout from '@/layouts/AppLayout.vue';
import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { initializeTheme } from './composables/useAppearance';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./pages/**/*.vue'),
        ).then((module) => {
            const page = module.default;

            // For all non-auth pages, use the AppLayout by default
            // setting the breadcrumbs that may have been set via defineOptions
            if (page.layout === undefined && !name.startsWith('auth/')) {
                page.layout = (h: any, p: any) =>
                    h(
                        AppLayout,
                        {
                            breadcrumbs: page.breadcrumbs,
                        },
                        () => p,
                    );
            }

            return page;
        }),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();
