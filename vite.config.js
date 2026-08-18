import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Frontend CSS
                'resources/css/style.css',
                'resources/css/berita.css',
                'resources/css/profil.css',
                'resources/css/tentang-kami.css',
                'resources/css/kontak.css',
                'resources/css/ppdb.css',
                'resources/css/skill.css',
                'resources/css/vision-mission.css',
                'resources/css/jurusan1.css',
                'resources/css/podcast.css',
                'resources/css/lab.css',
                'resources/css/safety.css',

                // Admin / login CSS
                'resources/css/login-admin-style.css',
                'resources/css/vendor/driver.css',

                // JS Entrypoints
                'resources/js/main.js',
                'resources/js/admin.js',
                'resources/js/admin-alerts.js',
                'resources/js/image-modal.js',
                'resources/js/vision-mission.js'
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
