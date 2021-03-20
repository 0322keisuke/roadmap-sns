const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// ESLintに関する設定
if (!mix.inProduction()) {
    // 本番環境ではESLintは使用しない
    mix.webpackConfig({
        module: {
            rules: [
                {
                    enforce: "pre",
                    exclude: /node_modules/,
                    loader: "eslint-loader",
                    test: /\.(js|vue)?$/
                }
            ]
        }
    });
}

// watchするファイルやポート番号などに関する設定
mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .browserSync({
        // browserSyncの設定
        files: [
            "resources/js/**/*",
            "resources/sass/**/*",
            "resources/views/**/*",
            "public/css/**/*"
        ],
        port: 3000,
        ui: {
            port: 3001
        },
        proxy: "localhost:8000" //php artisan serveで立ち上げた8000番をProxyする
    });

if (mix.inProduction()) {
    mix.version();
}
