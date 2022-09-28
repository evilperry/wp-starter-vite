<?php

if(!function_exists('load_posts')) {
  $action = 'load_posts';
  $ajax = "wp_ajax_{$action}";
  $ajax_nopriv = "wp_ajax_nopriv_{$action}";

  function load_posts() {
    $res = [
      'success' => false,
    ];
    $data = $_POST;
    if(isset($data['nonce']) && wp_verify_nonce($data['nonce'], $data['action'])) {
      $fields = json_decode(stripslashes($data['fields']), true);
      ob_start();

      // handle here
      $the_query = new WP_Query([
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'ignore_sticky_posts' => true,
        'fields' => 'ids',
        'no_found_rows' => true,
      ]);
      ?>
      <?php if($the_query->have_posts()) : ?>
        <div class="space-y-6">
          <?php while($the_query->have_posts()) : $the_query->the_post(); ?>  
            <?php 
              get_template_part('components/molecules/post', 'card', [
                'id' => get_the_ID(),
              ]);
            ?>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        </div>
      <?php endif; ?>
      <?php

      $res['html'] = ob_get_contents();
      ob_end_clean();
      $res['success'] = true;
    }
    wp_send_json($res);
    wp_die();
  }
  add_action($ajax, $action);
  add_action($ajax_nopriv, $action);
}

?>
