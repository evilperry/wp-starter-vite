<div 
  x-data="{ open: false }"  
  class="py-6"
>
  <div class="container px-5">
    <h2 class="text-2xl font-bold mb-6">Modal</h2>
    <button
      class="px-3 py-1.5 bg-black text-white"
      @click.prevent="open = true"
    >
      Open
    </button>
  </div>
  <?php get_template_part('components/molecules/modal', ''); ?>
</div>
