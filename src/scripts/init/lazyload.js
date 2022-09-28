import LazyLoad from "vanilla-lazyload";

const Lazyload = () => {
  window.lazyLoadInstance = new LazyLoad({
    threshold: 0,
  });
  window.Alpine.nextTick(() => {
    window.lazyLoadInstance.update();
  });
};

export default Lazyload;
