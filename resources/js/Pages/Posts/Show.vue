<template>

  <Head title="Post" />
  <AuthenticatedLayout>
    <SecondaryButton class="mb-4" @click="goBack">Back</SecondaryButton>
    <PostCard :post="post" />
  </AuthenticatedLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import PostCard from '@/Components/PostCard.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue';


const props = defineProps({
  post: Object
})

const goBack = () => {
  window.history.back();
}

</script>
