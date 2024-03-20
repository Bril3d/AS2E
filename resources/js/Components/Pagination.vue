<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
  links: {
    type: Object,
    required: false,
  }
})

</script>
<template>
  <!-- Pagination -->
  <nav class="flex items-center justify-end gap-x-1 mt-4">
    <div class="flex items-center gap-x-1">
      <template v-for=" (link, index) in  links" :key="index">
        <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 rounded"
          v-html="link.label" />
        <Link v-else type="button" :key="index" :href="link.url" v-html="link.label"
          :class="{ 'bg-gray-200 text-gray-800 focus:bg-gray-300 dark:bg-gray-600 dark:text-white dark:focus:bg-gray-500': link.active }"
          class="min-h-[38px] min-w-[38px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
        </Link>
      </template>
    </div>
  </nav>
  <!-- End Pagination -->
</template>