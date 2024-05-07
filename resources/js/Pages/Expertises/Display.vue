<script setup>
import { onMounted } from 'vue';
import NavBar from '@/Components/Navbar.vue'
import HomeNavbar from '@/Components/HomeNavbar.vue';
import { Link, Head } from "@inertiajs/vue3"

const props = defineProps({
  expertise: Object,
})

onMounted(() => {
  window.HSStaticMethods.autoInit()
});

</script>

<template>

  <Head :title="`${expertise.title} expertise`" />
  <div>

    <HomeNavbar />
    <NavBar>
      <template #links>
        <Link href="/"
          class="font-semibold  dark:text-white hover:text-white text-gray-400 dark:hover:text-gray-300 focus:outline dark:font-outline-1">
        Home</Link>
        <Link :href="route('login')"
          class="ms-4 font-semibold  dark:text-white hover:text-white text-gray-400 dark:hover:text-gray-300 focus:outline dark:font-outline-1">
        Log in</Link>

        <Link :href="route('register')"
          class="ms-4 font-semibold  dark:text-white hover:text-white text-gray-400 dark:hover:text-gray-300 focus:outline dark:font-outline-1">
        Register</Link>
      </template>
      <template #default>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-24">
          <div class="bg-white dark:bg-slate-700 shadow-sm sm:rounded-lg ">
            <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
              <!-- Hero -->
              <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 rounded-md">
                <!-- Grid -->
                <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
                  <div>
                    <h1
                      class="block text-3xl font-bold text-gray-800 capitalize sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white">
                      {{ expertise.title }} <span class="text-main">expertise</span></h1>
                    <p class="mt-3 text-lg text-gray-800 dark:text-neutral-400">{{ expertise.description }}</p>
                  </div>
                  <!-- End Col -->

                  <div class="relative ms-4 shadow-sm">
                    <img class="w-full h-96 object-cover rounded-md" :src="expertise.image" :alt="expertise.title">
                    <div
                      class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 size-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-neutral-800 dark:via-neutral-900/0 dark:to-neutral-900/0">
                    </div>

                    <!-- SVG-->
                    <div class="absolute bottom-0 start-0">
                      <svg class="w-2/3 ms-auto h-auto text-main dark:text-neutral-900" width="630" height="451"
                        viewBox="0 0 630 451" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="531" y="352" width="99" height="99" fill="currentColor" />
                        <rect x="140" y="352" width="106" height="99" fill="currentColor" />
                        <rect x="482" y="402" width="64" height="49" fill="currentColor" />
                        <rect x="433" y="402" width="63" height="49" fill="currentColor" />
                        <rect x="384" y="352" width="49" height="50" fill="currentColor" />
                        <rect x="531" y="328" width="50" height="50" fill="currentColor" />
                        <rect x="99" y="303" width="49" height="58" fill="currentColor" />
                        <rect x="99" y="352" width="49" height="50" fill="currentColor" />
                        <rect x="99" y="392" width="49" height="59" fill="currentColor" />
                        <rect x="44" y="402" width="66" height="49" fill="currentColor" />
                        <rect x="234" y="402" width="62" height="49" fill="currentColor" />
                        <rect x="334" y="303" width="50" height="49" fill="currentColor" />
                        <rect x="581" width="49" height="49" fill="currentColor" />
                        <rect x="581" width="49" height="64" fill="currentColor" />
                        <rect x="482" y="123" width="49" height="49" fill="currentColor" />
                        <rect x="507" y="124" width="49" height="24" fill="currentColor" />
                        <rect x="531" y="49" width="99" height="99" fill="currentColor" />
                      </svg>
                    </div>
                    <!-- End SVG-->
                  </div>
                  <!-- End Col -->
                </div>
                <!-- End Grid -->
                <div
                  class="py-10 w-full prose prose-dark dark:prose-invert lg:prose-lg prose-table:border prose-th:border prose-td:border prose-tr:border"
                  v-html="expertise.body" />
              </div>
            </div>
            <!-- End Hero -->
          </div>
        </div>
      </template>
    </NavBar>
  </div>
</template>