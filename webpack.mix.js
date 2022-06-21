const mix = require('laravel-mix');
const path = require('path');
const tailwindcss = require('tailwindcss')

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

// mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
//     require('tailwindcss'),
//     require('autoprefixer'),
// ]);


mix
.js('resources/js/app.js', 'public/js').vue()
.sass('resources/sass/app.scss', 'public/css').options({
  postCss: [tailwindcss('./tailwind.config.js')],
  processCssUrls: false,
})

mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      '@': path.resolve(__dirname, 'resources/js/')
    },
  },
})