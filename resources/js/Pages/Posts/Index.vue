<template>
  <NavBar :canLogin="canLogin" :canRegister="canRegister">
    <div class="py-20 sm:max-w-lg mx-auto ">
      <div class="text-2xl dark:text-white text-center">Feed</div>
      <ul class="space-y-4" v-if="posts.length > 0">
        <li v-for="post in posts" :key="post.id">
          <PostCard :post="post" />
        </li>
      </ul>
      <div v-else class="text-center dark:text-gray-400 text-lg">No posts found!</div>
    </div>
  </NavBar>
</template>

<script setup>
import { onMounted } from 'vue'
import PostCard from '@/Components/PostCard.vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import NavBar from '@/Components/Navbar.vue'

const props = defineProps({
  posts: {
    type: Array,
    required: true
  },
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
})

onMounted(() => {
  window.HSStaticMethods.autoInit()
});
</script>
