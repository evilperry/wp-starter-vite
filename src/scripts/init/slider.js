import Swiper, { Navigation, FreeMode } from "swiper";

const Slider = () => {
  window.Alpine.data("slider", (ref, options = {}) => ({
    swiper: null,
    init() {
      this.swiper = new Swiper(ref, {
        ...options,
        modules: [Navigation, FreeMode],
      });
    },
  }));
};

export default Slider;
