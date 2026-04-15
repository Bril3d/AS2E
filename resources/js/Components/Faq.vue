<template>
  <!-- FAQ -->
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <SectionHeader :title="data.section_title" :caption="data.section_caption" />
    <!-- Grid -->
    <div class="grid md:grid-cols-5 gap-10">
      <div class="md:col-span-2">
        <div class="max-w-xs">
          <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">{{ data.title }}</h2>
          <p class="mt-1 hidden md:block text-gray-600 dark:text-gray-400">{{ data.description }}</p>
        </div>
      </div>
      <!-- End Col -->

      <div class="md:col-span-3">
        <!-- Accordion -->
        <div class="hs-accordion-group divide-y divide-gray-200 dark:divide-gray-700">
          <div v-for="(item, index) in data.items" :key="index"
            :class="['hs-accordion pb-3', index === 0 ? 'active' : 'pt-6']" :id="'faq-heading-' + index">
            <button
              class="hs-accordion-toggle group pb-3 inline-flex items-center justify-between gap-x-3 w-full md:text-lg font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
              :aria-controls="'faq-collapse-' + index">
              {{ item.question }}
              <svg
                class="hs-accordion-active:hidden block flex-shrink-0 w-5 h-5 text-gray-600 group-hover:text-gray-500 dark:text-gray-400"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6" />
              </svg>
              <svg
                class="hs-accordion-active:block hidden flex-shrink-0 w-5 h-5 text-gray-600 group-hover:text-gray-500 dark:text-gray-400"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m18 15-6-6-6 6" />
              </svg>
            </button>
            <div :id="'faq-collapse-' + index"
              :class="['hs-accordion-content w-full overflow-hidden transition-[height] duration-300', index === 0 ? '' : 'hidden']"
              :aria-labelledby="'faq-heading-' + index">
              <p class="text-gray-600 dark:text-gray-400">
                {{ item.answer }}
              </p>
            </div>
          </div>
        </div>
        <!-- End Accordion -->
      </div>
      <!-- End Col -->
    </div>
    <!-- End Grid -->
  </div>
  <!-- End FAQ -->
</template>

<script setup>
defineProps({
  data: Object
});
</script>