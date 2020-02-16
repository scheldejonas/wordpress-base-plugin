let mix = require('laravel-mix');

const tailwindcss = require('tailwindcss');

mix
    .setPublicPath('assets')
    .sass('resources/admin.scss', 'css')
    .js('resources/admin.js', 'js')
    .webpackConfig({
        resolve: {
            symlinks: false
        }
    })
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    })
    .disableSuccessNotifications();