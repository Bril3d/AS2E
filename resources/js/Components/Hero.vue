<template>
  <div class="relative h-screen">
    <DarkModeSwitcher class="absolute left-8 mt-6 z-10 bg-white hover:bg-gray-300 dark:text-slate-300 dark:bg-slate-600 " />
    <div v-if="canLogin" class="absolute top-0 right-8 pt-6 text-end z-10">
      <template v-if="$page.props.auth.user">
        <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
          <button id="hs-dropdown-with-header" type="button"
            class="w-12 h-12 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
            <img class="inline-block size-12 rounded-full ring-2 ring-white dark:ring-cyan-700 object-cover"
              :src="$page.props.auth.user.avatar" alt="My Avatar">
          </button>

          <div
            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 dark:bg-gray-800 dark:border dark:border-gray-700"
            aria-labelledby="hs-dropdown-with-header">
            <div class="py-3 px-5 -m-2 bg-gray-100 rounded-t-lg dark:bg-gray-700 text-left">
              <p class="text-sm text-gray-500 dark:text-gray-400">Signed in as</p>
              <p class="text-sm font-medium text-gray-800 dark:text-gray-300">{{
                $page.props.auth.user.name }}</p>
            </div>
            <div class="mt-2 py-2 first:pt-0 last:pb-0">
              <Link
                class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                :href="route('dashboard.index')">
              <AnOutlinedDashboard />
              Dashboard
              </Link>
              <Link
                class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                :href="route('profile.edit')">
              <AnOutlinedUser />
              Profile
              </Link>
              <Link
                class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 w-full"
                :href="route('logout')" method="post" as="button">
              <BxLogOut class="size-4" />
              Logout
              </Link>
            </div>
          </div>
        </div>
      </template>


      <template v-else>
        <Link :href="route('login')" class="font-semibold  text-white hover:text-gray-300 focus:outline font-outline-1">
        Log in</Link>

        <Link v-if="canRegister" :href="route('register')"
          class="ms-4 font-semibold  text-white hover:text-gray-300 focus:outline font-outline-1">
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
      <div class=" text-white text-5xl sm:text-7xl text-center sm:text-left py-4">{{ appName }}</div>
      <div class="bg-white text-3xl sm:text-5xl font-bold text-black mix-blend-screen px-10 py-5 ">Automation Systems
        and
        Energy Efficiency</div>
    </div>
  </div>
</template>



<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { usePermission } from "@/Composables/permissions.js"
import { EffectFade, Pagination } from 'swiper/modules';
import { AnOutlinedUser, BxLogOut, AnOutlinedDashboard } from "@kalimahapps/vue-icons";
import DarkModeSwitcher from './DarkModeSwitcher.vue';

const appName = usePage().props.settings.app_name;
const modules = [EffectFade, Pagination]
const { hasRole } = usePermission();
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
