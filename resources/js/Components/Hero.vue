<template>
  <NavBar :canRegister="canRegister" :canLogin="canLogin">

    <template #links>

      <Link :href="route('login')"
        class="ms-4 font-semibold  dark:text-white hover:text-white text-gray-400 dark:hover:text-gray-300 focus:outline dark:font-outline-1">
      Log in</Link>

      <Link v-if="canRegister" :href="route('register')"
        class="ms-4 font-semibold  dark:text-white hover:text-white text-gray-400 dark:hover:text-gray-300 focus:outline dark:font-outline-1">
      Register</Link>
    </template>
    <!-- Background Images -->
    <template #default>
      <div>
        <swiper-container slides-per-view="1" speed="500" loop="true" :spaceBetween="30" :effect="'fade'" :autoplay="{
          delay: 2500,
          disableOnInteraction: false,
        }" :pagination="{
        clickable: true,
      }" :modules="modules">
          <swiper-slide v-for="(image, index) in carousel" :key="index">
            <div class="swiper-image-overlay"></div>
            <img :src="`storage/${image}`" :alt="image" class="h-screen object-cover w-full"  />
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
    </template>

  </NavBar>
</template>

<script setup>
import { usePage, Link } from '@inertiajs/vue3';
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
