<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { AkLinkedinBoxFill, AkGithubFill, AkGoogleContainedFill } from "@kalimahapps/vue-icons";
import { useToggle } from '@vueuse/core';

const [developer, toggle] = useToggle()

const appName = usePage().props.settings.app_name;

toggle
</script>

<template>
  <footer class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto border-t">
    <!-- Grid -->
    <div class="text-center">
      <div>
        <Link class="flex-none text-xl font-semibold text-main hover:text-main-dark " href="/" aria-label="Brand">{{
          appName }}</Link>
      </div>
      <!-- End Col -->

      <div class="mt-3">
        <p class="text-gray-500">Tunis, Centre Urbain Nord</p>
        <p class="text-gray-500">© All rights reserved.</p>
      </div>
      <div @click="toggle()">
        <transition name="fade" mode="out-in">
          <p class="text-secondary font-semibold mt-3 cursor-pointer" v-if="!developer">Developed by</p>
          <!-- Social Brands -->
          <div class="mt-3 space-x-2" v-else>

            <a class="inline-flex justify-center items-center w-10 h-10 text-center text-gray-500 hover:bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white transition dark:text-gray-500 dark:hover:text-gray-200 dark:hover:bg-gray-800"
              href="https://www.linkedin.com/in/khaled-briki/" target="_blank"> 
              <AkLinkedinBoxFill class="flex-shrink-0 w-3.5 h-3.5" />
            </a>
            <a class="inline-flex justify-center items-center w-10 h-10 text-center text-gray-500 hover:bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white transition dark:text-gray-500 dark:hover:text-gray-200 dark:hover:bg-gray-800"
              href="https://github.com/Bril3d" target="_blank">
              <AkGithubFill class="flex-shrink-0 w-3.5 h-3.5" />
            </a>
            <a class="inline-flex justify-center items-center w-10 h-10 text-center text-gray-500 hover:bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white transition dark:text-gray-500 dark:hover:text-gray-200 dark:hover:bg-gray-800"
              href="mailto:khaledtbk@gmail.com" >
              <AkGoogleContainedFill class="flex-shrink-0 w-3.5 h-3.5" />
            </a>
          </div>
        </transition>
      </div>
      <!-- End Social Brands -->
    </div>
    <!-- End Grid -->
  </footer>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>