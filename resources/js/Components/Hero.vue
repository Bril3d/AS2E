<template>
  <div class="relative">
    <!-- Centered container for logo and text -->
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-30 text-center bg-white rounded-md p-3">
      <!-- Your logo image -->
      <img src="../../assets/as2e.png" alt="Logo" class="h-64 mx-auto" />

      <!-- Your text -->
      <p class="text-xl font-bold">AUTOMATION SYSTEMS AND ENERGY EFFICIENCY</p>
    </div>

    <!-- Swiper container -->
    <swiper-container slides-per-view="1" speed="500" loop="true" :autoplay="{
      delay: 2500,
      disableOnInteraction: false,
    }" :pagination="{
  clickable: true,
}" css-mode="true">
      <swiper-slide>
        <img src="../../assets/swiper/img1.jpg" alt="Image 1" class="h-screen object-cover w-full" />
      </swiper-slide>
      <swiper-slide>
        <img src="../../assets/swiper/img2.jpg" alt="Image 2" class="h-screen object-cover w-full" />
      </swiper-slide>
      <swiper-slide>
        <img src="../../assets/swiper/img3.jpg" alt="Image 3" class="h-screen object-cover w-full" />
      </swiper-slide>
      <swiper-slide>
        <img src="../../assets/swiper/img4.jpg" alt="Image 4" class="h-screen object-cover w-full" />
      </swiper-slide>
    </swiper-container>
  </div>
</template>

<script>
export default {
}
</script>
