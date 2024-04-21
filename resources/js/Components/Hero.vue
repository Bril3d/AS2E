<template>
  <NavBar :canRegister="canRegister" :canLogin="canLogin">
    <div>
      <!-- Background Images -->
      <div>
        <swiper-container slides-per-view="1" speed="500" loop="true" :spaceBetween="30" :effect="'fade'" :autoplay="{
          delay: 2500,
          disableOnInteraction: false,
        }" :pagination="{
        clickable: true,
      }" :modules="modules">
          <swiper-slide v-for="(image, index) in carousel" :key="index">
            <div class="swiper-image-overlay"></div>
            <img :src="`storage/${image}`" :alt="image.alt" class="h-screen object-cover w-full" />
          </swiper-slide>
        </swiper-container>

        <!-- Overlay for Text and Logo -->
        <div class="absolute top-1/2 sm:left-10 max-w-full md:left-20 z-10 sm:mr-2">
          <div class="text-white text-5xl sm:text-7xl text-center sm:text-left py-4">{{ appName }}</div>
          <div class="bg-white text-3xl sm:text-5xl font-bold text-black mix-blend-screen px-10 py-5 ">Automation
            Systems
            and
            Energy Efficiency</div>
        </div>
      </div>
    </div>
  </NavBar>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { EffectFade, Pagination } from 'swiper/modules';
import NavBar from '@/Components/Navbar.vue';

const appName = usePage().props.settings.app_name;
const modules = [EffectFade, Pagination]

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  carousel: Array
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
