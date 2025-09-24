import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vueDevTools from 'vite-plugin-vue-devtools';

export default defineConfig({
    plugins: [
    vueDevTools(),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});