<template>
  <!-- Icon Blocks -->
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <SectionHeader :title="data.section_title" :caption="data.section_caption" />
    <!-- Grid -->
    <div class="grid md:grid-cols-2 gap-12">
      <div class="lg:w-3/4">
        <h2 class="text-3xl text-gray-800 font-bold lg:text-4xl dark:text-white">
          {{ data.main_title }}
        </h2>
        <p class="mt-3 text-gray-800 dark:text-gray-400">
          {{ data.description }}
        </p>
        <p class="mt-5">
          <a class="inline-flex items-center gap-x-1 font-medium text-main dark:text-blue-500" href="mailto:commercial@as2e-automation.com">
            Contact us to explore our services
            <svg class="flex-shrink-0 w-4 h-4 transition ease-in-out group-hover:translate-x-1"
              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m9 18 6-6-6-6" />
            </svg>
          </a>
        </p>
      </div>
      <!-- End Col -->

      <div class="space-y-6 lg:space-y-10">
        <!-- Icon Block -->
        <div v-for="(item, index) in data.items" :key="index" class="flex">
          <!-- Icon -->
          <span
            class="flex-shrink-0 inline-flex justify-center items-center w-[46px] h-[46px] rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm mx-auto dark:bg-slate-900 dark:border-gray-700 dark:text-gray-200">
            <component :is="getIcon(item.icon)" class="flex-shrink-0 w-5 h-5" />
          </span>
          <div class="ms-5 sm:ms-8">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-gray-200">
              {{ item.title }}
            </h3>
            <p class="mt-1 text-gray-600 dark:text-gray-400">
              {{ item.description }}
            </p>
          </div>
        </div>
        <!-- End Icon Block -->
      </div>
      <!-- End Col -->
    </div>
    <!-- End Grid -->
  </div>
  <!-- End Icon Blocks -->
</template>

<script setup>
import * as AkIcons from "@kalimahapps/vue-icons";

defineProps({
  data: Object
});

const getIcon = (iconName) => {
  // Map icon name to AkIcon component, e.g., "Book" -> AkBook
  const componentName = `Ak${iconName}`;
  return AkIcons[componentName] || AkIcons.AkQuestion;
};
</script>
