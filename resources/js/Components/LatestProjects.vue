<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
  projects: Array,
})

</script>

<template>
  <!-- Card Blog -->
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Title -->
    <SectionHeader title="Our Latest Projects"
      caption="Discover Our Latest Innovations: Elevating Experiences, Empowering Futures." />
    <!-- End Title -->

    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Card -->
      <template v-for="project in projects" :key="project.id">
        <Link class="group hover:bg-gray-100 rounded-xl p-5 transition-all dark:hover:bg-white/10 shadow"
          :href="route('project.display', project.slug)">
        <div class="aspect-w-16 aspect-h-10">
          <img class="w-full object-cover rounded-xl" :src="project.image" :alt="project.title">
        </div>
        <h3 class="mt-5 text-xl text-gray-800 dark:text-neutral-300 dark:hover:text-white">
          {{ project.title }}
        </h3>
        <p class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold text-gray-800 dark:text-neutral-200">
          Learn more
          <svg class="flex-shrink-0 size-4 transition ease-in-out group-hover:translate-x-1"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6" />
          </svg>
        </p>
        </Link>
      </template>
      <!-- End Card -->
    </div>
    <!-- End Grid -->
  </div>
  <!-- End Card Blog -->
</template>