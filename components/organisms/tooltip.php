<div class="py-6">
  <div class="container px-5">
    <h2 class="text-2xl font-bold mb-6">Tooltip</h2>
    <div class="row -m-3">
      <div class="col-auto p-3">
        <div 
          x-data="tooltip($refs.tooltip)"
          class="relative"
        >
          <div class="px-3 py-1.5 bg-gray-100">Tooltip top</div>
          <div  
            x-ref="tooltip"
            x-show="show"
            x-cloak
          >
            <div
              x-show="show"
              x-cloak
              x-transition
              class="px-5 py-2 bg-black/80 text-white"
            >
              Top
            </div>
          </div>
        </div>
      </div>
      <div class="col-auto p-3">
        <div 
          x-data="tooltip($refs.tooltip, { placement: 'bottom' })"
          class="relative"
        >
          <div class="px-3 py-1.5 bg-gray-100">Tooltip bottom</div>
          <div  
            x-ref="tooltip"
            x-show="show"
            x-cloak
          >
            <div
              x-show="show"
              x-cloak
              x-transition
              class="px-5 py-2 bg-black/80 text-white"
            >
              Bottom
            </div>
          </div>
        </div>
      </div>
      <div class="col-auto p-3">
        <div 
          x-data="tooltip($refs.tooltip, { placement: 'left' })"
          class="relative"  
        >
          <div class="px-3 py-1.5 bg-gray-100">Tooltip left</div>
          <div  
            x-ref="tooltip"
            x-show="show"
            x-cloak
          >
            <div
              x-show="show"
              x-cloak
              x-transition
              class="px-5 py-2 bg-black/80 text-white"
            >
              Left
            </div>
          </div>
        </div>
      </div>
      <div class="col-auto p-3">
        <div 
          x-data="tooltip($refs.tooltip, { placement: 'right' })"
          class="relative"
        >
          <div class="px-3 py-1.5 bg-gray-100">Tooltip right</div>
          <div  
            x-ref="tooltip"
            x-show="show"
            x-cloak
          >
            <div
              x-show="show"
              x-cloak
              x-transition
              class="px-5 py-2 bg-black/80 text-white min-w-[240px]"
            >
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum magni culpa placeat non tempora commodi a. Autem dolorum saepe, odit nesciunt quas reprehenderit beatae vel, minus consectetur porro natus hic.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>