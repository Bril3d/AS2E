<script setup>
import ApplicationLogo from './ApplicationLogo.vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();

const onPage = (component) => {
  return page.component === component
}

</script>

<template>
  <!-- ========== HEADER ========== -->
  <header class="flex flex-wrap sm:justify-start sm:flex-nowrap shadow-md z-50 w-full text-sm py-3 sm:py-0">
    <nav class="relative  w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between sm:pr-8" aria-label="Global">
      <div class="flex items-center justify-between">
        <Link class="flex-none text-xl font-semibold text-white" href="/" aria-label="Brand">
        <ApplicationLogo class="w-20" />
        </Link>
        <div class="sm:hidden">
          <button type="button"
            class="hs-collapse-toggle size-9 flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-white/20 text-white hover:border-white/40 disabled:opacity-50 disabled:pointer-events-none"
            data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation"
            aria-label="Toggle navigation">
            <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round">
              <line x1="3" x2="21" y1="6" y2="6" />
              <line x1="3" x2="21" y1="12" y2="12" />
              <line x1="3" x2="21" y1="18" y2="18" />
            </svg>
            <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
              width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 6 6 18" />
              <path d="m6 6 12 12" />
            </svg>
          </button>
        </div>
      </div>
      <div id="navbar-collapse-with-animation"
        class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
        <div
          class="flex flex-col gap-y-4 gap-x-0 mt-5 sm:flex-row sm:items-center sm:justify-end sm:gap-y-0 sm:gap-x-7 sm:mt-0 sm:ps-7">
          <Link :href="route('feed.list')"
            :class="onPage('Posts/Index') ? 'before:absolute before:top-0 before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-main' : null"
            class="font-medium  dark:text-white/80 relative inline-block dark:hover:text-white sm:py-6">
          Feed</Link>
          <Link :href="route('feed.list')"
            :class="onPage('Posts/Index') ? 'before:absolute before:top-0 before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-main' : null"
            class="font-medium  dark:text-white/80 dark:hover:text-white sm:py-6" href="#">Process Control</Link>
          <Link :href="route('feed.list')" class="font-medium  dark:text-white/80 dark:hover:text-white sm:py-6"
            href="#">Process Improvement</Link>
        </div>
      </div>
    </nav>
  </header>
  <!-- ========== END HEADER ========== -->
</template>