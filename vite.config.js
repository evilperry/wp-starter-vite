import liveReload from "vite-plugin-live-reload";
const { resolve } = require("path");

export default {
  plugins: [liveReload(`${__dirname}/**/*.php`)],
  root: "",
  base: "/",
  build: {
    outDir: resolve(__dirname, "./dist"),
    assetsDir: "./build",
    emptyOutDir: true,
    manifest: true,
    target: "es2018",
    rollupOptions: {
      input: {
        main: resolve(`${__dirname}/src/build.js`),
      },
    },
    minify: true,
    write: true,
  },
  server: {
    cors: true,
    strictPort: true,
    port: 3000,
    https: false,
    hmr: {
      host: "localhost",
    },
  },
};
