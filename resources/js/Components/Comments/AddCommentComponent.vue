<template>
  <div class="flex space-x-3">
    <div class="min-w-0 flex-1 mx-1">
      <form method="POST" @submit.prevent="submit">
        <textarea id="comment" name="comment" v-model="form.content"
          class="shadow-sm block w-full focus:ring-rose-500 focus:border-rose-500 sm:text-sm border border-gray-300 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 rounded-md"
          placeholder="Leave a comment..." />
        <div class="mt-2 flex items-center justify-end">
          <button :disabled="form.content.length == 0" type="submit"
            class="inline-flex items-center justify-center px-2 py-1 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 disabled:opacity-50">
            Comment
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import axios from 'axios';


const emit = defineEmits(['add'])

const props = defineProps({
  post_id: Number
})

const form = useForm({
  content: '',
  post_id: props.post_id
});


const submit = () => {
  axios.post('/comments', form).then((response) => {
    emit('add', response.data)
    form.content = ''
  })


}
</script>

<style scoped></style>
