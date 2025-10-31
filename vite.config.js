import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/auth.css',
                'resources/css/welcome.css',
                'resources/js/app.js',
                'resources/js/auth.js',
                'resources/js/main.js',
                'resources/css/sidebar.css',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
