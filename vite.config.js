import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        tailwindcss(),
    ],
    build: {
        manifest: true,
        outDir: 'dist',
        rollupOptions: {
            input: {
                main: 'src/css/main.css',
                script: 'src/js/main.js'
            }
        }
    }
});