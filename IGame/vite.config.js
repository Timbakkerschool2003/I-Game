import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(), // Add vue plugin
    ],
    css: {
        postcss: {
            plugins: [
                tailwindcss,
                require('autoprefixer'),
            ],
        },
    },
});
