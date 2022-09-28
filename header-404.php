<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<?php
  $body_class = array_merge([], isset($args['body_class']) && !empty(array_filter($args['body_class'])) ? $args['body_class'] : []);
?>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>

<body <?php body_class($body_class); ?>>

<div class="py-6">
  <div class="container">
    <div class="font-bold">Header 404</div>
  </div>
</div>
