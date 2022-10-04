<div class="py-6">
  <div class="container">
    <h2 class="text-2xl font-bold mb-6">Slider (Swiper)</h2>
    <div
      x-data="slider($refs.sliderRef, {
        slidesPerView: 'auto',
        spaceBetween: 20,
        loop: false,
        freeMode: true,
        grabCursor: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      })"
      x-ref="sliderRef" 
      class="swiper"
    >
      <div class="swiper-wrapper">
        <?php for($i = 1; $i <= 10; $i++) : ?>
          <div class="swiper-slide w-auto">
            <div class="relative overflow-hidden w-[320px] pt-[115%]">
              <img 
                data-src="<?php echo PUBLIC_URI .'/assets/images/items/placeholder.jpg'; ?>" 
                alt="placeholder" 
                width="1200" 
                height="800" 
                class="lazy absolute inset-0 w-full h-full object-cover"
              />
            </div>
          </div>
        <?php endfor; ?>
      </div>
    </div>
    <div class="flex space-x-3 mt-6">
      <button class="swiper-button-prev px-3 py-1.5 bg-black text-white disabled:opacity-70 disabled:cursor-not-allowed">
        Prev
      </button>
      <button class="swiper-button-next px-3 py-1.5 bg-black text-white disabled:opacity-70 disabled:cursor-not-allowed">
        Next
      </button>
    </div>
  </div>
</div>
