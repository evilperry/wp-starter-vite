<?php
use KubAT\PhpSimple\HtmlDomParser;

/**
 * Require All Files In Folder
 */
if(!function_exists('ndh_require_all_files')) {
  function ndh_require_all_files($path, $excludes = []) {
    foreach(glob(get_template_directory() .$path .'/*.php') as $filename) {
      $explode = explode('/', $filename);
      if(!in_array(str_replace('.php', '', end($explode)), $excludes)) {
        require_once($filename);
      }
    }
  }
}

/**
 * Limit Word
 */
if(!function_exists('ndh_limit_words')) {
  function ndh_limit_words($string, $limit = 25) {
    return preg_replace('/((\w+\W*){'.($limit-1).'}(\w+))(.*)/', '${1}', $string) .((str_word_count($string) > $limit) ? '...' : '');
  }
}

/**
 * Get Nav Menu Items
 */
if(!function_exists('ndh_get_nav_menu_items')) {
  function ndh_get_nav_menu_items(array &$nav_menu_items, $parent_id = 0){
    $result = [];
    foreach($nav_menu_items as &$item) {
      if($item->menu_item_parent == $parent_id) {
        $children = ndh_get_nav_menu_items($nav_menu_items, $item->ID);
        if($children) {
          $item->children = $children;
        }
        $result[$item->ID] = $item;
        unset($item);
      }
    }
    $result = array_values(array_filter($result));
    return $result;
  }
}

/**
 * Get Nav Menu
 */
if(!function_exists('ndh_get_nav_menu')) {
  function ndh_get_nav_menu($theme_location) {
    $items = wp_get_nav_menu_items($theme_location);
    return  $items ? ndh_get_nav_menu_items($items) : [];
  }
}

/**
 * Get Attachment ID By URL
 */
if(!function_exists('ndh_get_attachment_id_by_url')) {
  function ndh_get_attachment_id_by_url($url) {
    $url = preg_replace('/-\d+[Xx]\d+\./', '.', $url);
    return attachment_url_to_postid($url);
  }
}

/**
 * Table Of Contents
 */
if(!function_exists('ndh_get_table_of_contents')) {
  function ndh_get_table_of_contents($post_id) {
    if(!$post_id) {
      return;
    }
    $content = HtmlDomParser::str_get_html(str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content($post_id))));
    $toc_settings = get_field('table_of_contents', $post_id)['table_of_contents'];
    $result = [];
    if(class_exists('ACF') && $content && !empty(array_filter($toc_settings))) {
      $heading_tags = [];
      foreach($toc_settings as $k => $v) {
        if($content->find($v)) {
          array_push($heading_tags, $v);
        }
      }
      if(sizeof($heading_tags) > 0) {
        $heading_tags_shift = $heading_tags;
        array_shift($heading_tags_shift);
        foreach($content->find($heading_tags[0]) as $k => $v) {
          $current[$heading_tags[0]] = $k;
          $parent_id = 0;
          array_push($result, [
            'id' => $v->tag .'-' .$k,
            'tag' => $v->tag,
            'text' => trim($v->plaintext),
            'hash' => '#' .sanitize_title(trim($v->plaintext)),
            'url' => rtrim(get_the_permalink($post_id), '/') .'#' .sanitize_title(trim($v->plaintext)),
            'parent_id' => $parent_id,
          ]);
          if(sizeof($heading_tags) > 1) {
            $prev_tag = $v->tag;
            while(($v = $v->next_sibling()) && strcmp($v->tag, $heading_tags[0]) !== 0) {
              foreach($heading_tags_shift as $key => $value) {
                if(strcmp($v->tag, $value) == 0) {
                  if(strcmp($value, $prev_tag) == 0) {
                    $parent_id = $result[array_key_last($result)]['parent_id'];
                  } else {
                    if(array_search($value, $heading_tags) > array_search($prev_tag, $heading_tags)) {
                      $current[$value] = 0;
                      $parent_id = $result[array_key_last($result)]['id'];
                    } else {
                      $parent_id = $result[array_search($result[array_key_last($result)]['parent_id'], array_column($result, 'id'))]['parent_id'];
                    }
                  }
                  array_push($result, [
                    'id' => $value .'-' .$current[$value],
                    'tag' => $value,
                    'text' => trim($v->plaintext),
                    'hash' => '#' .sanitize_title(trim($v->plaintext)),
                    'url' => rtrim(get_the_permalink($post_id), '/') .'#' .sanitize_title(trim($v->plaintext)),
                    'parent_id' => $parent_id,
                  ]);
                  $current[$value] += 1;
                  $prev_tag = $value;
                }
              }
            }
          }
        }
      }
    }
    return $result;
  }
}

if(!function_exists('ndh_get_toc_items')) {
  function ndh_get_toc_items(array &$toc, $parent_id = 0){
    if(!$toc) {
      return;
    }
    $result = [];
    foreach($toc as $key => &$item) {
      if($item['parent_id'] === $parent_id) {
        $children = ndh_get_toc_items($toc, $item['id']);
        if($children) {
          $item['children'] = $children;
        }
        $result[$key] = $item;
        unset($item);
      }
    }
    $result = array_map(function($item) {
      unset($item['id']);
      unset($item['parent_id']);
      return $item;
    }, array_values(array_filter($result)));
    return $result;
  }
}

if(!function_exists('ndh_get_toc')) {
  function ndh_get_toc($post_id) {
    $items = ndh_get_table_of_contents($post_id);
    return  $items && sizeof($items) > 0 ? ndh_get_toc_items($items) : [];
  }
}

?>
