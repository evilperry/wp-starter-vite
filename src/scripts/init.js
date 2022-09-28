import Lazyload from "./init/lazyload";
// import PopupCenter from "./init/popup-center";
import Slider from "./init/slider";
import SmoothScroll from "./init/smooth-scroll";
import Tooltip from "./init/tooltip";

const Init = () => {
  SmoothScroll();
  Lazyload();
  // PopupCenter();
  Slider();
  Tooltip();
};

export default Init;
