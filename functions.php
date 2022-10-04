<?php

require_once('vendor/autoload.php');
require_once('inc/index.php');

add_action('after_setup_theme', function() {
  add_theme_support('post-thumbnails');
  register_nav_menus([
    'primary' => __('primary', 'ndh'),
  ]);
  add_filter('rss_widget_feed_link', '__return_false');
  add_post_type_support('page', 'excerpt');
});

add_action('wp_enqueue_scripts', function() {
  if(ndh_is_vite_development()) {
    add_action('wp_head', function() {
      echo '<script type="module" crossorigin src="' .PUBLIC_URI .'/main.js"></script>';
    });
  } else {
    $manifest = json_decode(file_get_contents(PUBLIC_URI .'/manifest.json'), true);
    if(is_array($manifest)) {
      $manifest_key = array_keys($manifest);
      if(isset($manifest_key[0])) {
        foreach(@$manifest[$manifest_key[0]]['css'] as $css_file) {
          wp_enqueue_style('main', PUBLIC_URI .'/' .$css_file, [], false, 'all');
        }
        wp_dequeue_style('wp-block-library');
        $js_file = @$manifest[$manifest_key[0]]['file'];
        if(!empty($js_file)) {
          wp_enqueue_script('main', PUBLIC_URI .'/' .$js_file, [], false, true);
        }
      }
    }
  }
});

?>
