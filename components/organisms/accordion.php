<div class="py-6">
  <div class="container">
    <h2 class="text-2xl font-bold mb-6">Accordion</h2>
    <div class="row -mx-3">
      <div class="col-6 px-3">
        <div class="text-sm mb-6">Single</div>
        <div 
          x-data="{ open: 1 }" 
          class="space-y-2"
        >
          <?php for($i = 1; $i <= 3; $i++) : ?>
            <div>
              <button
                type="button"
                x-on:click="open !== <?php echo $i; ?> ? open = <?php echo $i; ?> : open = null"
                class="block w-full text-left p-3"
                :class="open === <?php echo $i; ?> ? 'bg-black text-white' : 'bg-gray-100'"
              >
                Item <?php echo $i; ?>
              </button>
              <div
                x-show="open === <?php echo $i; ?> ? true : false"
                x-cloak
                x-collapse
              >
                <div class="p-3">
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam veniam suscipit facere nulla eveniet libero in quibusdam alias eos blanditiis, facilis minima debitis quaerat molestiae numquam sapiente consectetur explicabo nisi.</p>
                </div>
              </div>
            </div>
          <?php endfor; ?>
        </div>
      </div>
      <div class="col-6 px-3">
        <div class="text-sm mb-6">Multiple</div>
        <div class="space-y-2">
          <?php for($i = 1; $i <= 3; $i++) : ?>
            <div x-data="{ open: <?php echo $i; ?> === 1 ? true : false }">
              <button
                type="button"
                x-on:click="open = !open"
                class="block w-full text-left p-3"
                :class="open ? 'bg-black text-white' : 'bg-gray-100'"
              >
                Item <?php echo $i; ?>
              </button>
              <div
                x-show="open ? true : false"
                x-cloak
                x-collapse
              >
                <div class="p-3">
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam veniam suscipit facere nulla eveniet libero in quibusdam alias eos blanditiis, facilis minima debitis quaerat molestiae numquam sapiente consectetur explicabo nisi.</p>
                </div>
              </div>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </div>
</div>