<template>
  <!-- Component Start -->
  <div class="flex flex-col flex-grow bg-white dark:bg-slate-800 rounded-lg overflow-hidden">
    <div class="border-t border-gray-200 dark:border-gray-500 my-1 overflow-auto" />
    <div class="text-sm flex items-center font-medium cursor-default text-gray-600 dark:text-white p-2">Comments</div>
    <div class="flex flex-col flex-grow mt-1 pb-4 overflow-auto border-t dark:border-gray-500 border-gray-200">
      <ul v-if="post?.comments?.length > 0" class="space-y-4 py-2 overflow-auto">
        <li v-for="comment in post.comments" :key="comment.id">
          <div class="flex space-x-3">
            <Link :href="`/profile/${comment.user.id}`" class="flex-shrink-0">
            <img class="size-6 rounded-full" :src="comment.user.avatar" />
            </Link>
            <div class="flex-shrink overflow-hidden flex-1">
              <div class="w-full flex">
                <div>
                  <Link :href="`/profile/${comment.user.id}`" class="text-sm font-medium text-gray-900 dark:text-white">
                  <p class="font-medium text-gray-900 dark:text-white">
                    {{ comment.user.name }}
                  </p>
                  </Link>
                </div>

                <div class="flex flex-1 items-center justify-end text-xs">
                  <span class="text-gray-500   font-medium">
                    {{ comment.created_at }}
                  </span>
                </div>
              </div>
              <div class="mt-1 pr-8">
                <p class="text-sm text-gray-700 dark:text-white break-words whitespace-pre-wrap">
                  {{ comment.content }}
                </p>

                <span class="text-xs text-gray-400">
                  <button v-if="comment?.user?.id === $page.props.auth.user?.id" type="button"
                    @click="deleteComment(comment.id)" preserve-scroll>
                    Delete
                  </button>
                </span>
              </div>
            </div>
          </div>
        </li>
      </ul>
      <div v-else>
        <div class="flex h-10 m-2 justify-center align-center">
          <h3 class="text-sm text-center text-bold text-gray-400">
            There are no comments yet.<br />
            Leave the comment, be the first!
          </h3>
        </div>
      </div>
    </div>
  </div>

  <div class="py-2 sticky bottom-0 bg-white dark:bg-slate-800 border-t dark:border-gray-500 border-gray-200" v-if="$page.props.auth.user">
    <add-comment-component :post_id="post.id" @add="addComment" />
  </div>
  <!-- Component End  -->
</template>

<script setup>
// import CommentItemComponent from './CommentItemComponent.vue'
import { Link, router } from '@inertiajs/vue3';
import AddCommentComponent from './AddCommentComponent.vue'

const props = defineProps({
  post: Object
})

const addComment = (comment) => {
  props.post.comments.push(comment)
}

const deleteComment = (commentId) => {
  router.delete(route('comments.destroy', commentId), {
    preserveScroll: true,
    onSuccess: () => {
      props.post.comments = props.post.comments.filter((comment) => comment.id != commentId)
    }
  })

}

</script>

<style scoped></style>
