<template>
  <Head title="Post" />
  <AuthenticatedLayout>
    <PostCard :post="post" />
  </AuthenticatedLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import PostCard from '@/Components/PostCard.vue'

const props = defineProps({
  post: Object
})
</script>
