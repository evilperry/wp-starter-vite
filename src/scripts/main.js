import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";
import focus from "@alpinejs/focus";
import mask from "@alpinejs/mask";
import Init from "./init";
import App from "./app";

/**
 * Alpinejs Safari fix: https://github.com/alpinejs/alpine/discussions/1964
 */
if (typeof window.queueMicrotask !== "function") {
  window.queueMicrotask = function (callback) {
    Promise.resolve()
      .then(callback)
      .catch((e) =>
        setTimeout(() => {
          throw e;
        })
      );
  };
}

window.Alpine = Alpine;
Alpine.plugin(collapse);
Alpine.plugin(focus);
Alpine.plugin(mask);

Init();
App();

Alpine.start();
