<template>
  <div class="bg-white dark:bg-slate-800 dark:text-white shadow sm:rounded-lg px-4 py-4 sm:px-6">
    <div>
      <div class="flex space-x-3 pt-2">
        <Link :href="route('profile.edit', { id: post.user.id })" class="flex-shrink-0">
        <img class="h-8 w-8 object-cover rounded-full" alt="Avatar" :src="post?.user?.avatar" />
        </Link>

        <div class="min-w-0 h-10 flex-1 flex flex-col justify-center">
          <Link :href="route('profile.edit', { id: post.user.id })" class="text-sm font-medium dark:text-white text-gray-900">
          {{ post?.user?.name }}
          </Link>

          <p class="text-xs text-gray-500 dark:text-gray-400 cursor-default">
            <time :datetime="post.created_at">{{ post.created_at }}</time>
          </p>
        </div>
      </div>

      <div class="border-t border-gray-200 dark:border-gray-500 mt-2" />

      <h2 class="py-2 text-lg leading-6 font-medium text-gray-900 dark:text-white cursor-default">
        {{ post.title }}
      </h2>
    </div>

    <div>
      <p class="text-sm text-gray-900 dark:text-gray-400 break-words">{{ post.content }}</p>


      <div v-if="post?.image" class="sm:col-span-2 w-full flex justify-center align-center overflow-hidden rounded-sm">
        <img class="h-64 w-auto object-cover" :src="post?.image" :alt="post.title" />
      </div>
    </div>

    <div>
      <div class="flex justify-between space-x-8 pt-2">
        <div class="flex space-x-6">
          <span class="inline-flex items-center text-sm space-x-2">
            <Link class="inline-flex items-center justify-center text-gray-400 py-1"
              :href="route('posts.toggle', post.id)" as="button" type="button" method="POST" preserve-scroll>
            <span>
              <AnOutlinedHeart v-show="!post.liked" class="text-gray-400 h-4 w-4" aria-hidden="true" />
              <AnFilledHeart v-show="post.liked" class="text-rose-500 h-4 w-4" aria-hidden="true" />
            </span>

            <span class="pl-1 font-medium text-xs text-gray-900 dark:text-white cursor-default">
              {{ post?.likes }}
            </span>
            </Link>
            <span class="inline-flex items-center justify-center text-gray-400 dark:text-white">
              <FaRegComments class="h-4 w-4 text-gray-400" aria-hidden="true" />
              <span class="pl-1 font-medium text-xs text-gray-900 dark:text-white cursor-default">
                {{ post?.comments?.length }}
              </span>
            </span>
          </span>
        </div>
      </div>
      <div>
        <comment-list-component :post="post" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import CommentListComponent from './Comments/CommentListComponent.vue';
import { AnOutlinedHeart, AnFilledHeart, FaRegComments } from "@kalimahapps/vue-icons";

const props = defineProps({
  post: {
    type: Object,
    required: true
  }
})

</script>

<style scoped>
.post-content-body p {
  margin-bottom: 2rem;
}
</style>
