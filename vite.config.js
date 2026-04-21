import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fg from 'fast-glob';

export default defineConfig(async () => {
    // Find all .js and .css files in resources folder
    const files = await fg([
        'resources/**/*.js',
        'resources/**/*.css',
    ]);

    return {
        plugins: [
            laravel({
                input: files,
                refresh: true,
            }),
        ],
        build: {
            target: 'esnext', // Enables top-level await & modern JS syntax
        },
        server: {
            cors: true,
            proxy: {
                '/fonts': 'http://localhost:80',  // Make CSS custom fonts work
                '/storage/': 'http://localhost:80',  // Make CSS iiicons work
            },
        },
    };
});