import { defineConfig, loadEnv } from "vite";
import liveReload from "vite-plugin-live-reload";
const { resolve } = require("path");

export default ({ mode }) => {
  process.env = { ...process.env, ...loadEnv(mode, process.cwd()) };
  return defineConfig({
    plugins: [liveReload(`${__dirname}/**/*.php`)],
    root: "",
    base: "/",
    build: {
      outDir: resolve(__dirname, "./dist"),
      assetsDir: "./build",
      emptyOutDir: false,
      manifest: true,
      target: "es2018",
      rollupOptions: {
        input: {
          main: resolve(`${__dirname}/src/main.js`),
        },
      },
      minify: true,
      write: true,
    },
    server: {
      cors: true,
      strictPort: true,
      port: process.env.VITE_SERVER_PORT ?? 3000,
      https: false,
      hmr: {
        host: process.env.VITE_SERVER_HOST ?? "localhost",
      },
    },
  });
};
