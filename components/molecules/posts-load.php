<?php 
  $action = 'load_posts';
  $action_url = admin_url('admin-ajax.php');
  $referer = wp_get_referer();
  $nonce = wp_create_nonce($action);
?>

<div 
  x-data="loadPosts($refs.loadPostsRef)"
  x-ref="loadPostsRef"
  data-action="<?php echo $action; ?>"
  data-action-url="<?php echo $action_url; ?>"
  data-referer="<?php echo $referer; ?>"
  data-nonce="<?php echo $nonce; ?>"
>
  <div class="dom-html" x-show="!loading" x-cloak>
    <button @click="load()" class="px-3 py-1.5 bg-black text-white">Load</button>
  </div>
  <div x-show="loading" x-cloak>
    <svg class="animate-spin h-6 w-6 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
  </div>
</div>