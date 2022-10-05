<?php get_header(); ?>

<div class="py-6">
  <div class="container px-5">
    <h1 class="text-4xl font-bold">Index</h1>
    <p>Example Components</p>
  </div>
</div>

<?php get_template_part('components/organisms/slider', ''); ?>

<?php get_template_part('components/organisms/modal', ''); ?>

<?php get_template_part('components/organisms/contact', ''); ?>

<?php get_template_part('components/organisms/posts', ''); ?>

<?php get_template_part('components/organisms/accordion', ''); ?>

<?php get_template_part('components/organisms/tooltip', ''); ?>

<?php get_footer(); ?>
