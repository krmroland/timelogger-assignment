import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import vuetify from "vite-plugin-vuetify";
import { fileURLToPath } from "node:url";

export default defineConfig({
  define: { "process.env": {} },
  resolve: {
    alias: { "@": fileURLToPath(new URL("./ui", import.meta.url)) },
    extensions: [".js", ".json", ".jsx", ".mjs", ".ts", ".tsx", ".vue"],
  },
  plugins: [
    vue(),

    vuetify({ autoImport: true }),

    laravel({ input: ["ui/main.js"], refresh: true }),
  ],
});
