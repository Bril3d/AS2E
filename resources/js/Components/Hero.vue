<template>
  <div class="relative h-screen">
    <!-- Background Images -->
    <swiper-container slides-per-view="1" speed="500" loop="true" :autoplay="{
      delay: 2500,
      disableOnInteraction: false,
    }" :pagination="{
      clickable: true,
    }" css-mode="true">
      <swiper-slide>
        <div class="swiper-image-overlay"></div>
        <img src="../../assets/swiper/img1.jpg" alt="Image 1" class="h-screen object-cover w-full" />
      </swiper-slide>
      <swiper-slide>
        <div class="swiper-image-overlay"></div>
        <img src="../../assets/swiper/img2.jpg" alt="Image 2" class="h-screen object-cover w-full" />
      </swiper-slide>
      <swiper-slide>
        <div class="swiper-image-overlay"></div>
        <img src="../../assets/swiper/img3.jpg" alt="Image 3" class="h-screen object-cover w-full" />
      </swiper-slide>
      <swiper-slide>
        <div class="swiper-image-overlay"></div>
        <img src="../../assets/swiper/img4.jpg" alt="Image 4" class="h-screen object-cover w-full" />
      </swiper-slide>
    </swiper-container>

    <!-- Overlay for Text and Logo -->
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-30 text-center text-white">
      <!-- Your logo image -->
      <img src="../../assets/as2e.png" alt="Logo" class="h-80 mx-auto mb-4" />

      <!-- Your text -->
      <p class="text-4xl font-bold leading-tight">
        AUTOMATION SYSTEMS AND ENERGY EFFICIENCY
      </p>
    </div>
</div>

</template>



<script>
export default {
}
</script>
<style scoped>
.swiper-image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  /* Adjust the alpha channel for the desired darkness */
  z-index: 1;
}
</style>
