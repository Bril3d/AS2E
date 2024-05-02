<template>
  <Head title="Saved Posts" />
  <AuthanticatedLayout title="Saved Posts">
    <ul class="space-y-4" v-if="posts.data.length > 0">
      <li v-for="post in posts.data" :key="post.id">
        <PostCard :post="post" />
      </li>
    </ul>
    <div v-else class="text-center dark:text-gray-400 text-lg">No saved posts found!</div>
    <Pagination :links="posts.meta.links" />
  </AuthanticatedLayout>

</template>


<script setup>
import {Head} from '@inertiajs/vue3';
import AuthanticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import PostCard from '@/Components/PostCard.vue';
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
  posts: {
    type: Object,
    required: true
  },
})


</script>