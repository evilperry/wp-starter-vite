<?php
use KubAT\PhpSimple\HtmlDomParser;

/**
 * Move Scripts To Footer
 */
add_action('wp_enqueue_scripts', function() {
  remove_action('wp_head', 'wp_print_scripts');
  remove_action('wp_head', 'wp_print_head_scripts', 9);
  remove_action('wp_head', 'wp_enqueue_scripts', 1);
  add_action('wp_footer', 'wp_print_scripts', 5);
  add_action('wp_footer', 'wp_enqueue_scripts', 5);
  add_action('wp_footer', 'wp_print_head_scripts', 5);
});

/**
 * Disable Heartbeat
 */
add_action('init', function() {
  wp_deregister_script('heartbeat');
});

/**
 * Disabled XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Log Mail
 */
add_action('wp_mail_failed', function($wp_error) {
  $fn = WP_CONTENT_DIR . '/mail.log'; // say you've got a mail.log file in your server root
  $fp = fopen($fn, 'a');
  fputs($fp, __("Mailer Error", 'ndh') .": " . $wp_error->get_error_message() ."\n");
  fclose($fp);
}, 10, 1);

/**
 * Allow Form Multiple Upload
 */
add_action('post_edit_form_tag', function() {
  echo ' enctype="multipart/form-data"';
});

/**
 * The Menu
 */
add_filter('wp_get_nav_menu_items', function($items, $menu, $args) {
  _wp_menu_item_classes_by_context($items);
  return $items;
}, 10, 3);

/**
 * The Archive - Title
 */
add_filter('get_the_archive_title', function($title) {    
  if(is_category()) {    
    $title = single_cat_title('', false);    
  } elseif (is_tag()) {    
    $title = single_tag_title('', false);    
  } elseif (is_author()) {    
    $title = '<span class="vcard">' .get_the_author() .'</span>' ;    
  } elseif (is_tax()) { //for custom post types
    $title = sprintf(__('%1$s'), single_term_title('', false));
  } elseif (is_post_type_archive()) {
    $title = post_type_archive_title('', false);
  }
  return $title;    
});

/**
 * The Excerpt
 */
add_filter('excerpt_more', function($dots) {
  return '...';
});

/**
 * The Content - Hash ID For H Tag
 */
if(class_exists('ACF')) {
  add_filter('the_content', function($content) {
    if(!$content) {
      return;
    }
    $toc_settings = get_field('table_of_contents', get_the_ID())['table_of_contents'];
    if(!empty(array_filter($toc_settings))) {
      $content = HtmlDomParser::str_get_html($content);
      foreach($toc_settings as $k => $v) {
        foreach($content->find($v) as $element) {
          $element->setAttribute('id', sanitize_title(trim($element->plaintext)));
        }
      }
    }
    return $content;
  }, 15, 1);
}

?>
