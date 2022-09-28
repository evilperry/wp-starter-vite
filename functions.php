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
  $mix_manifest = json_decode(file_get_contents(get_template_directory() .'/mix-manifest.json'), true);
  if($mix_manifest) {
    $parse_css_version = parse_url($mix_manifest['/dist/styles/bundle.css'], PHP_URL_QUERY);
    parse_str($parse_css_version, $css_version);
    $parse_js_version = parse_url($mix_manifest['/dist/scripts/bundle.js'], PHP_URL_QUERY);
    parse_str($parse_js_version, $js_version);
    wp_enqueue_style('bundle', DIST_URI .'/styles/bundle.css', [], $css_version['id'], 'all');
    wp_dequeue_style('wp-block-library');
    wp_enqueue_script('bundle', DIST_URI .'/scripts/bundle.js', [], $js_version['id'], true);
  }
});

?>
