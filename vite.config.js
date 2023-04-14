import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import commonjs from '@rollup/plugin-commonjs';
import postcss from 'rollup-plugin-postcss';

export default defineConfig({
    build: {
        outDir: 'public',
    },
    plugins: [
        commonjs(), // Compila los archivos JS
        postcss({ // Compila los archivos CSS
            extract: true,
            minimize: true,
        }),
    ],
});
