<template>
  <!-- Features -->
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <SectionHeader :title="data.section_title"
      :caption="data.section_caption" />
    <!-- Grid -->
    <div class="md:grid md:grid-cols-2 md:items-center md:gap-12 xl:gap-32">
      <div>
        <img class="rounded-xl w-full h-full" :src="data.image.startsWith('http') || data.image.startsWith('/') ? data.image : `/storage/${data.image}`" alt="Features">
      </div>
      <!-- End Col -->

      <div class="mt-5 sm:mt-10 lg:mt-0">
        <div class="space-y-6 sm:space-y-8">
          <!-- Title -->
          <div class="space-y-2 md:space-y-4">
            <h2 class="font-bold text-3xl lg:text-4xl text-gray-800 dark:text-gray-200">
              {{ data.title }}: <p>{{ data.subtitle }}</p>
            </h2>
            <p class="text-gray-500">
              {{ data.description }}
            </p>
          </div>
          <!-- End Title -->

          <!-- List -->
          <ul role="list" class="space-y-2 sm:space-y-4">
            <li v-for="(item, index) in data.items" :key="index" class="flex space-x-3">
              <span
                class="mt-0.5 h-5 w-5 flex justify-center items-center rounded-full bg-blue-50 text-main dark:bg-blue-800/30 dark:text-blue-500">
                <svg class="flex-shrink-0 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12" />
                </svg>
              </span>

              <span class="text-sm sm:text-base text-gray-500">
                {{ item }}
              </span>
            </li>
          </ul>
          <!-- End List -->
        </div>
      </div>
      <!-- End Col -->
    </div>
    <!-- End Grid -->
  </div>
  <!-- End Features -->
</template>
<script setup>
defineProps({
  data: Object
});
</script>