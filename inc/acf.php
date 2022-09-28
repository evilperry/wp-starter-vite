<?php

/**
 * Theme Options
 */
if(class_exists('ACF')) {
  if(function_exists('acf_add_options_page')) {
    acf_add_options_page([
      'page_title' => 'Options',
      'menu_title' => 'Options',
      'menu_slug' => 'acf-options',
    ]);  
  }
}

/**
 * Theme Options Capability
 */
if(class_exists('ACF')) {
  if(function_exists('acf_set_options_page_capability')) {
    acf_set_options_page_capability('manage_options');
  }
}

/**
 * Get User Fields
 */
if(class_exists('ACF')) {
  if(!function_exists('ndh_acf_get_user_fields')) {
    function ndh_acf_get_user_fields($user_id) {
      return get_fields("user_{$user_id}");
    }
  }
}

/**
 * Get User Field
 */
if(class_exists('ACF')) {
  if(!function_exists('ndh_acf_get_user_field')) {
    function ndh_acf_get_user_field($user_id, $field_name) {
      $user_fields = ndh_acf_get_user_fields($user_id);
      return (isset($user_fields[$field_name])) ? $user_fields[$field_name] : false;
    }
  }
}

?>
