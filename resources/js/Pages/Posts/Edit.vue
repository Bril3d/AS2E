<template>

  <Head title="Post Update" />
  <AuthenticatedLayout title="Edit Post">
    <form @submit.prevent="submit" class="space-y-3 px-20">
      <TextInput v-model="form.title" type="text" placeholder="Title" required class="block w-full" />
      <textarea v-model="form.content" placeholder="Content"
        class="w-full dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
        required></textarea>
      <file-pond class="dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
        credits="false" name="test" ref="pond" @init="init" class-name="my-pond" label-idle="Drop an Image here..."
        allow-multiple="false" accepted-file-types="image/jpeg, image/png" :allowFileTypeValidation="false" :server="{
          url: '', process: {
            url: `/files/process?folder=feed`, method: 'POST', onload:
              handleFilePondLoad
          }, revert: handleFilePondRevert, headers: { 'X-CSRF-TOKEN': $page.props.csrf_token }
        }" />
      <VueMultiselect v-if="hasRole('admin')" id="date" v-model="form.user_id" :options="users" :close-on-select="true" label="name"
        track-by="name" placeholder="Select a user" class="mt-1 w-full" />
      <PrimaryButton type="submit">Update Post</PrimaryButton>
    </form>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue'
import { useForm, router, Head } from '@inertiajs/vue3';
import VueMultiselect from 'vue-multiselect'
import vueFilePond from 'vue-filepond';
import { usePermission } from '@/Composables/permissions';


import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';

import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import TextInput from '@/Components/TextInput.vue';

// Create FilePond component
const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);


const pond = ref(null);

const { hasRole } = usePermission();

const props = defineProps({
  users: Array,
  post: Object,
})

function init() {
  pond.value.addFile(props.post.image);
}

const form = useForm({
  id: props.post.id,
  slug: props.post.slug,
  title: props.post.title,
  content: props.post.content,
  image: props.post.image,
  user_id: props.post.user,
})

const handleFilePondLoad = (response) => {
  form.image = response;
  return response;
}

const handleFilePondRevert = (uniqueId, load, error) => {
  form.image = '';
  router.delete(`/files/revert/${uniqueId}?folder=feed`);
  load();
}

const submit = () => {
  form.post(route('posts.update'));
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>