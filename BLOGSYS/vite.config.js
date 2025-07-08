import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "tailwindcss";

export default defineConfig({
    base: "/",
    build: {
        outDir: "../public_html/build",
        emptyOutDir: false,
        rollupOptions: {
            output: {
                entryFileNames: `assets/js/main.js`,
                assetFileNames: `assets/css/main.[ext]`,
            },
        },
    },
    plugins: [
        laravel({
            publicDirectory: "../public_html",
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss({
            refresh: false,
        }),
    ],
});
