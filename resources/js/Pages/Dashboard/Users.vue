<script setup>
import { Head } from '@inertiajs/vue3';
import { BsPostcardHeart, AkCalendar } from "@kalimahapps/vue-icons";
import StatsCard from '@/Components/StatsCard.vue';
import NewLikesChart from '@/Components/NewLikesChart.vue'


const props = defineProps({
  stats: {
    type: Object,
    required: true,
  },
  likes: {
    type: Object,
    required: true
  }
})

</script>

<template>

  <Head title="Dashboard" />

  <AuthenticatedLayout title="Stats">
    <div class="space-y-7">
      <!-- Grid -->
      <div class="grid sm:grid-cols-2 gap-4 sm:gap-6">

        <!-- Card -->
        <StatsCard header="Total Posts" tooltip="The number of posts" :number="stats.posts">
          <BsPostcardHeart class="text-gray-600 dark:text-gray-400 size-5" />
        </StatsCard>
        <!-- End Card -->

        <!-- Card -->
        <StatsCard header="Total Comments" tooltip="The number of comments" :number="stats.comments">
          <AkCalendar class="text-gray-600 dark:text-gray-400 size-5" />
        </StatsCard>
        <!-- End Card -->
      </div>
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-3">
        <h1 class="text-black font-semibold text-center text-2xl font-outline-1 dark:text-white">New Likes Per Month
        </h1>
        <NewLikesChart class="h-64" :chartData="likes" />
      </div>
    </div>

    <!-- End Grid -->
  </AuthenticatedLayout>
</template>
