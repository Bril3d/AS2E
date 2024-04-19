<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
  comment: {
    type: Object,
    required: true
  }
})

const form = useForm({
  content: props.comment.content
})

</script>

<template>

  <Head title="Comment Update" />
  <AuthenticatedLayout title="Update Comment">
    <Link as="button" :href="route('comments.index')"
      class="inline-flex cursor-pointer items-center px-4 py-2 bg-main border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-main-dark focus:bg-main-dark active:bg-main-dark focus:outline-none focus:ring-2 focus:ring-main focus:ring-offset-2 transition ease-in-out duration-150">
    Back</Link>
    <div class="mt-4">
      <form @submit.prevent="form.put(route('comments.update', comment.id))">
        <div>
          <InputLabel for="content" value="Content" />
          <TextInput id="content" class="w-full" v-model="form.content" />
          <InputError class="mt-2" :message="form.errors.content" />
        </div>
        <div class="flex justify-end">
          <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Update
          </PrimaryButton>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>