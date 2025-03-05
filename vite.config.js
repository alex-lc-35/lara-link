import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // utilisé pour l'authentification
                'resources/js/app.js',
                'resources/css/main.css', // utilisé pour le reste de l'application
                'resources/js/main.js'
            ],
            refresh: true,
        }),
    ],
});
