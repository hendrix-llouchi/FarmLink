import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';

// Bridge: inertia/laravel v2 renders page data on the div's dataset,
// but @inertiajs/core v3 expects a <script type="application/json"> tag.
// Passing `page` explicitly bypasses the broken getInitialPageFromDOM lookup.
const appEl = document.getElementById('app');

createInertiaApp({
    page: JSON.parse(appEl?.dataset.page || 'null'),
    title: (title) => title ? `${title} - FarmLink` : 'FarmLink',
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
    progress: {
        color: '#2D6A4F',
    },
});

