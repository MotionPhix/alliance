import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";
import tailwindcss from 'tailwindcss';
import path from "path"

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/js/app.js', 'resources/css/filament/admin/theme.css',],
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    })
  ],
  css: {
    postcss: {
      plugins: [
        tailwindcss(),
      ],
    },
  },
  resolve: {
    alias: {
      vue: 'vue/dist/vue.esm-bundler.js',
      'ziggy-js': path.resolve('vendor/tightenco/ziggy'),
    },
  },
});
