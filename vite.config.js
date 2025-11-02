import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/welcome.css',
                'resources/css/auth.css',
                'resources/css/custom-notifications.css',
                'resources/js/app.js',
                'resources/js/welcome.js',
                'resources/js/auth.js',
                'resources/js/custom-notifications.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
