module.exports = {
  content: [
    "./*.php",
    "./inc/**/*.php",
    "./components/**/*.php",
    "./templates/**/*.php",
    "./src/**/*.js",
  ],
  theme: {
    extend: {
      screens: {
        "2xl": "1440px",
      },
      fontFamily: {
        roboto: `"Roboto", sans-serif`,
      },
      colors: {},
      zIndex: {
        dropdown: 1000,
        sticky: 1020,
        fixed: 1030,
        "modal-backdrop": 1040,
        offcanvas: 1050,
        modal: 1060,
        popover: 1070,
        tooltip: 1080,
      },
    },
  },
  plugins: [
    require("tailwind-bootstrap-grid")({
      gridGutterWidth: "0",
      generateContainer: false,
    }),
  ],
};
