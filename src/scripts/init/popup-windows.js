const PopupWindows = () => {
  window.Alpine.data("popupWindows", () => ({
    open({ url, title = null, w = 640, h = 480 }) {
      if (!url) {
        return;
      }

      let dualScreenLeft =
        window.screenLeft != undefined ? window.screenLeft : screen.left;
      let dualScreenTop =
        window.screenTop != undefined ? window.screenTop : screen.top;

      let width = window.innerWidth
        ? window.innerWidth
        : document.documentElement.clientWidth
        ? document.documentElement.clientWidth
        : screen.width;
      let height = window.innerHeight
        ? window.innerHeight
        : document.documentElement.clientHeight
        ? document.documentElement.clientHeight
        : screen.height;

      let left = width / 2 - w / 2 + dualScreenLeft;
      let top = height / 2 - h / 2 + dualScreenTop;
      let newWindow = window.open(
        url,
        title,
        "scrollbars=yes, width=" +
          w +
          ", height=" +
          h +
          ", top=" +
          top +
          ", left=" +
          left
      );

      if (window.focus) {
        newWindow.focus();
      }
    },
  }));
};

export default PopupWindows;
