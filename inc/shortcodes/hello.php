<?php

add_shortcode('hello', function() {
  ob_start();
  ?>
  <div>Hello</div>
  <?php
  $template = ob_get_contents();
  ob_end_clean();
  return $template;
});

?>
