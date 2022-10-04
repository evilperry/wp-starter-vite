<?php

/**
 * Check Vite Dev Mode
 */
if(!function_exists('ndh_is_vite_development')) {
  function ndh_is_vite_development() {
    return !file_exists(get_template_directory() .'/dist/manifest.json');
  }
}

?>