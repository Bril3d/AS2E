<template>
<!-- Features -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <SectionHeader :title="data.section_title" :caption="data.section_caption" />
  <!-- Grid -->
  <div class="mt-20 grid gap-6 grid-cols-2 sm:gap-12 lg:grid-cols-3 lg:gap-8 text-center">
    <!-- Stats -->
    <div v-for="(stat, index) in data.items" :key="index">
      <h4 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-gray-200">{{ stat.title }}</h4>
      <p class="mt-2 sm:mt-3 text-4xl sm:text-6xl font-bold text-main">{{ stat.value }}</p>
      <p class="mt-1 text-gray-500">{{ stat.description }}</p>
    </div>
    <!-- End Stats -->
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
