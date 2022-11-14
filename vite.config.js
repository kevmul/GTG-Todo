import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue({
            base: null,
            includeAbsolute: false,
        }),
    ],
    test: {
        globals: true,
        exclude: ["node_modules"],
        include: ["./resources/js/**/__tests__/*.spec.ts"],
        environment: "jsdom",
    },
});
