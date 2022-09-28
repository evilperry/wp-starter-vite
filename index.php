<?php get_header(); ?>

<div class="py-6">
  <div class="container">
    <h1 class="text-4xl font-bold">Index</h1>
  </div>
</div>

<?php get_template_part('components/organisms/slider', ''); ?>

<?php get_template_part('components/organisms/modal', ''); ?>

<?php get_template_part('components/organisms/contact', ''); ?>

<?php get_template_part('components/organisms/posts', ''); ?>

<?php get_template_part('components/organisms/accordion', ''); ?>

<?php get_footer(); ?>
