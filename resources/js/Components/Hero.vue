<template>
  <div class="relative h-screen">
    <div v-if="canLogin" class="absolute sm:top-0 sm:right-0 p-6 text-end z-10">
      <Link v-if="$page.props.auth.user" :href="route('logout')" method="post"
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
      Logout</Link>

      <template v-else>
        <Link :href="route('login')"
          class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
        Log in</Link>

        <Link v-if="canRegister" :href="route('register')"
          class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
        Register</Link>
      </template>
    </div>
    <!-- Background Images -->
    <swiper-container slides-per-view="1" speed="500" loop="true" :spaceBetween="30" :effect="'fade'" :autoplay="{
      delay: 2500,
      disableOnInteraction: false,
    }" :pagination="{
      clickable: true,
    }" :modules="modules">
      <swiper-slide v-for="(image, index) in swiperImages" :key="index">
        <div class="swiper-image-overlay"></div>
        <img :src="image.src" :alt="image.alt" class="h-screen object-cover w-full" />
      </swiper-slide>
    </swiper-container>

    <!-- Overlay for Text and Logo -->
    <div class="absolute top-1/2 sm:left-10 max-w-full md:left-20 z-10 sm:mr-2">
      <div class=" text-white text-5xl sm:text-7xl text-center sm:text-left py-4">AS2E</div>
      <div class="bg-white text-3xl sm:text-5xl font-bold text-black mix-blend-screen px-10 py-5 ">Automation Systems
        and
        Energy Efficiency</div>
    </div>
  </div>
</template>



<script setup>
import { Link } from '@inertiajs/vue3';
import { EffectFade, Pagination } from 'swiper/modules';

const modules = [EffectFade, Pagination]
const swiperImages = [
  {
    src: new URL('../../assets/swiper/img1.jpg', import.meta.url), alt: 'Image 1'
  },
  {
    src: new URL('../../assets/swiper/img2.jpg', import.meta.url), alt: 'Image 2'
  },
  {
    src: new URL('../../assets/swiper/img3.jpg', import.meta.url), alt: 'Image 3'
  },
  {
    src: new URL('../../assets/swiper/img4.jpg', import.meta.url), alt: 'Image 4'
  }
];

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
});
</script>
<style scoped>
.swiper-image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1;
}
</style>
