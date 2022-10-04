<?php
  $id = isset($args['id']) && $args['id'] ? $args['id'] : get_the_ID();
  $thumbnail_size = isset($args['thumbnail_size']) && $args['thumbnail_size'] ? $args['thumbnail_size'] : 'medium';
?>

<a 
  href="<?php echo get_the_permalink($id); ?>"
  class="block"
>
  <div class="row -mx-3">
    <div class="col-auto px-3">
      <div class="relative w-[240px] overflow-hidden pt-[100%]">
        <?php if(has_post_thumbnail($id)) : ?>
          <?php 
            echo get_the_post_thumbnail($id, $thumbnail_size, [
              'alt' => get_the_title($id),
              'class' => 'absolute inset-0 w-full h-full object-cover',
            ]); 
          ?>
        <?php else : ?>
          <img  
            data-src="<?php echo PUBLIC_URI .'/assets/images/items/placeholder.jpg'; ?>" 
            alt="placeholder" 
            width="1200" 
            height="800" 
            class="lazy absolute inset-0 w-full h-full object-cover"
          />
        <?php endif; ?>
      </div>
    </div>
    <div class="col px-3">
      <h3 class="font-bold"><?php echo get_the_title($id); ?></h3>
    </div>
  </div>
</a>