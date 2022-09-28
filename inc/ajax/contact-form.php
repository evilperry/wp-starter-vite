<?php

if(!function_exists('contact_form')) {
  $action = 'contact_form';
  $ajax = "wp_ajax_{$action}";
  $ajax_nopriv = "wp_ajax_nopriv_{$action}";

  function contact_form() {
    $res = [
      'success' => false,
      'alert' => [
        'type' => 'error',
        'name' => 'Error',
        'message' => 'Error message',
      ],
    ];
    $data = $_POST;
    if(isset($data['nonce']) && wp_verify_nonce($data['nonce'], $data['action'])) {
      $fields = json_decode(stripslashes($data['fields']), true);
      $res['fields'] = $fields;

      // hanle here

      $res = [
        'success' => true,
        'alert' => [
          'type' => 'success',
          'name' => 'Success',
          'message' => 'Success message',
        ],
      ];
    }
    wp_send_json($res);
    wp_die();
  }
  add_action($ajax, $action);
  add_action($ajax_nopriv, $action);
}

?>
