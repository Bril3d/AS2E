<template>

  <Head title="Feed" />
  <NavBar :canLogin="canLogin" :canRegister="canRegister">
    <template #links>
      <Link href="/"
        class="font-semibold  dark:text-white hover:text-white text-gray-400 dark:hover:text-gray-300 focus:outline dark:font-outline-1">
      Home</Link>

      <Link :href="route('login')"
        class="ms-4 font-semibold  dark:text-white hover:text-white text-gray-400 dark:hover:text-gray-300 focus:outline dark:font-outline-1">
      Log in</Link>

      <Link v-if="canRegister" :href="route('register')"
        class="ms-4 font-semibold  dark:text-white hover:text-white text-gray-400 dark:hover:text-gray-300 focus:outline dark:font-outline-1">
      Register</Link>
    </template>
    <template #default>
      <div class="py-20 sm:max-w-2xl mx-auto ">
        <div class="text-2xl dark:text-white flex justify-between my-3"><span>Feed</span>
          <Link :href="route('posts.create')" as="button" type="button">
          <AkEdit class="text-main hover:text-main-dark transition-colors ease-in duration-200 size-6 cursor-pointer" />
          </Link>
        </div>
        <ul class="space-y-4" v-if="allPosts.data.length > 0">
          <li v-for="post in allPosts.data" :key="post.id">
            <PostCard :post="post" />
          </li>
        </ul>
        <div v-else class="text-center dark:text-gray-400 text-lg">No posts found!</div>
      </div>
      <div ref="last" class="-translate-y-32" />
    </template>
  </NavBar>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { Head, Link } from '@inertiajs/vue3';
import PostCard from '@/Components/PostCard.vue'
import { AkEdit } from "@kalimahapps/vue-icons";
import NavBar from '@/Components/Navbar.vue'
import { useIntersectionObserver } from '@vueuse/core';
import axios from 'axios';


const props = defineProps({
  posts: {
    type: Object,
    required: true
  },
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
})

const last = ref(null);

const allPosts = ref(JSON.parse(JSON.stringify(props.posts)))

const loadMorePosts = () => {

  axios.get(`${allPosts.value.meta.path}?cursor=${allPosts.value.meta.next_cursor}`).then((response) => {

    allPosts.value.data = [...allPosts.value.data, ...response.data.data]
    allPosts.value.meta = response.data.meta

    if (!response.data.meta.next_cursor) {
      stop()
    }

  })


}

const { stop } = useIntersectionObserver(last, ([{ isIntersecting }]) => {
  if (!isIntersecting) {
    return
  }
  if (props.posts.meta.next_cursor) {
    loadMorePosts()
  }
})

onMounted(() => {
  window.HSStaticMethods.autoInit()
});
</script>
