<template x-teleport="body">
  <div
    x-show="open"
    x-cloak
    class="fixed z-modal inset-0 overflow-y-auto"
  >
    <div 
      x-show="open"
      x-cloak
      @click.prevent="open = false"
      x-transition.opacity
      class="fixed z-modal-backdrop inset-0 overflow-y-auto bg-black bg-opacity-30"
    ></div>
    <div
      x-show="open"
      x-cloak
      x-on:click="open = false"
      x-transition
      class="relative z-modal min-h-screen flex items-center justify-center p-5"
    >
      <div
        x-on:click.stop
        x-trap.noscroll.inert="open"
        x-on:keydown.escape.window="open = false"
        class="w-full max-w-sm xl:max-w-xl bg-white"
      >
        <div class="p-6">
          <div class="text-2xl font-bold mb-6">Modal</div>
          <p class="mb-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio ipsa, dolore nihil unde, id doloremque eos vel ab fugit at quasi, ullam sequi! Nam alias eum suscipit? Facere, vero ipsa.</p>
          <button
            class="px-3 py-1.5 bg-black text-white"
            @click.prevent="open = false"
          >
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>