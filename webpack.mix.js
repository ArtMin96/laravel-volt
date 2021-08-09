const mix = require('laravel-mix');
const argv = require('minimist')(process.argv.splice(2));

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

const src = {
    frontend: {
        sass: 'resources/scss/app.scss',
        js: 'resources/js/app.js'
    },
    admin: {
        sass: 'resources/scss/admin.scss',
        js: 'resources/js/admin.js'
    }
};

const dest = {
    css: 'public/css',
    js: 'public/js',
};

if (argv.frontend) {
    mix.js(src.frontend.js, dest.js)
        .sass(src.frontend.sass, dest.css);
} else if (argv.admin) {
    mix.js(src.admin.js, dest.js)
        .sass(src.admin.sass, dest.css);
} else {
    mix.js(src.frontend.js, dest.js)
        .js(src.admin.js, dest.js)
        .sass(src.frontend.sass, dest.css)
        .sass(src.admin.sass, dest.css);
}

mix.sourceMaps();

if (mix.inProduction()) {
    mix.version();
}
