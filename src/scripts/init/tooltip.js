import { createPopper } from "@popperjs/core";

const Tooltip = () => {
  window.Alpine.data("tooltip", (tooltip, options = {}) => ({
    show: false,
    popperInstance: null,
    init() {
      this.$el.addEventListener("mouseover", () => {
        this.show = true;
        this.$nextTick(() => {
          if (!this.popperInstance) {
            this.popperInstance = createPopper(this.$el, tooltip, {
              placement: "top",
              modifiers: [
                {
                  name: "offset",
                  options: {
                    offset: [0, 0],
                  },
                },
              ],
              ...options,
            });
          } else {
            this.popperInstance.update();
          }
        });
      });
      this.$el.addEventListener("mouseleave", () => {
        this.show = false;
      });
    },
  }));
};

export default Tooltip;
