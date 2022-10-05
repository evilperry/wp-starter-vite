import Lazyload from "./init/lazyload";
// import PopupWindows from "./init/popup-windows";
import Slider from "./init/slider";
import SmoothScroll from "./init/smooth-scroll";
import Tooltip from "./init/tooltip";

const Init = () => {
  SmoothScroll();
  Lazyload();
  // PopupWindows();
  Slider();
  Tooltip();
};

export default Init;
