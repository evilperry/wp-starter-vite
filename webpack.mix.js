let mix = require("laravel-mix");
require("laravel-mix-clean");

mix.setPublicPath("./");

mix
  .postCss("src/styles/bundle.css", "dist/styles", [require("tailwindcss")])
  .js("src/scripts/bundle.js", "dist/scripts")
  .copyDirectory("src/assets", "dist/assets")
  .options({
    processCssUrls: false,
  })
  .clean({
    cleanOnceBeforeBuildPatterns: [
      "dist/assets",
      "dist/styles",
      "dist/scripts",
      "mix-manifest.json",
    ],
  })
  .webpackConfig({
    stats: {
      children: true,
    },
  })
  .browserSync({
    port: process.env.SYNC_PORT,
    proxy: process.env.SYNC_URL,
    files: ["./**/*.php", "./**/*.css", "./**/*.scss", "./**/*.js"],
    notify: false,
  })
  .disableNotifications();

mix.version();
