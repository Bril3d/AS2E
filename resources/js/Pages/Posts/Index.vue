<template>
  <AuthenticatedLayout title="Feed">
    <ul class="space-y-4">
      <li v-for="post in posts" :key="post.id">
        <PostCard :post="post" />
      </li>
    </ul>
  </AuthenticatedLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import PostCard from '@/Components/PostCard.vue'

const props = defineProps({
  posts: {
    type: Array,
    required: true
  }
})
</script>
