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
 * Attachment Image: Enable WebP
 */
if(class_exists('ACF') && get_option('options_webp_enable')) {
  add_filter('wp_get_attachment_image', function($html, $attachment_id, $size, $icon, $attr) {
    $extension = (new SplFileInfo($attr['src']))->getExtension();
    $html = HtmlDomParser::str_get_html($html);
    foreach($html->find('img') as $img) {
      $img->addClass('lazy');
      $img->setAttribute('data-src', $attr['src']);
      $img->setAttribute('data-srcset', $attr['srcset']);
      $img->setAttribute('data-sizes', $attr['sizes']);
      $img->removeAttribute('src');
      $img->removeAttribute('data-srcset');
      $img->removeAttribute('data-sizes');
    }
    if(strcmp($extension, 'svg') !== 0) {
      $result = '<picture>';
      $result .= '<source';
      $result .= ' data-srcset="' .str_replace('.' .$extension .' ', '.' .$extension .'.webp ', $attr['srcset']) .'"';
      $result .= ' data-sizes="' .$attr['sizes'] .'"';
      $result .= ' type="image/webp" />';
      $result = (get_option('options_webp_separate_folder') && !empty(get_option('options_webp_separate_folder'))) ? str_replace('/wp-content/uploads', get_option('options_webp_separate_folder'), $result) : $result;
      $result .= $html;
      $result .= '</picture>';
      return $result;
    } else {
      return $html;
    }  
  }, 15, 5);
}

?>
