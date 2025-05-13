import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        manifest: true,
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/general.scss',
                'resources/sass/form.scss',
                'resources/sass/home.scss',
                'resources/sass/index.scss',
                'resources/sass/show.scss',
                'resources/js/show.js',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
