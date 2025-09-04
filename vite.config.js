
import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [tailwindcss()],
    server: {
        host: true,
        port: 5173,
        origin: 'http://localhost:5173',
        cors: {
            origin: [
                'http://hom-style.local',
                'https://hom-style.local',
                'http://localhost',
                'https://localhost'
            ],
            credentials: true
        },
        headers: {
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Methods': 'GET,HEAD,PUT,PATCH,POST,DELETE',
            'Access-Control-Allow-Headers': 'Origin, X-Requested-With, Content-Type, Accept'
        }
    },
    build: {
        manifest: true,
        outDir: "dist",
        rollupOptions: {
            input: {
                main: "src/css/main.css",
                script: "src/js/main.js",
            },
        },
    },
});