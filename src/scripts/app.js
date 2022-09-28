import contactForm from "./app/ajax/contact-form";
import loadPosts from "./app/ajax/load-posts";

/**
 * This way is how to use jQuery
 */
// import jQuery from "jquery";
// window.$ = window.jQuery = jQuery;
// (($) => {
//   $('html').css({ backgroundColor: "gray" })
// })(jQuery);

const App = () => {
  contactForm();
  loadPosts();
};

export default App;
