import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/css/styles.css',
                'resources/css/welcomeStyles.css',
                'resources/css/responsive.css',
            ],
            refresh: true,
        }),
    ],
});
