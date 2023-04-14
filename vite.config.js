import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    base: '/',
    build: {
        outDir: 'public/build',
        manifest: true,
        rollupOptions: {
            input: '/public/css/app.css',
        },
    },
    plugins: [
        laravel({
            input: ['public/css/app.css', 'public/js/app.js'],
            refresh: true,
        }),
    ],
});
