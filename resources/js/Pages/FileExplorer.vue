<template>
  <AuthenticatedLayout>
    <button @click="goBack" v-if="folderHistory.length > 0"
      class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md mb-4">Back</button>

    <div class="grid grid-cols-3 gap-4">
      <!-- Folders -->
      <div v-for="(item, index) in getCurrentFolderContents()" :key="index"
        class="p-4 bg-white rounded-md shadow flex justify-between items-center cursor-pointer"
        @click="item.type === 'folder' || item.type === 'parentFolder' ? navigateToFolder(item.path) : openFile(item.path)">
        <div class="flex items-center w-2/3">
          <AkFolder v-if="item.type === 'folder'" class="w-8 h-8" />
          <AkFile v-else class="w-8 h-8" />
          <span class="w-1/2 ml-2 flex-grow overflow-hidden whitespace-nowrap text-ellipsis">{{ item.name }}</span>
        </div>
        <button v-if="item.type !== 'parentFolder'" @click.stop="deleteItem(item.path)"
          class="text-red-500">Delete</button>
      </div>
    </div>
    <div class="mt-2">
      <file-pond name="test" ref="pond" class-name="my-pond" label-idle="Drop files here..." allow-multiple="true"
        accepted-file-types="image/jpeg, image/png" :server="{
          url: '', process: {
            url: `/files/process?folder=${currentFolder}`, method: 'POST', onload:
              handleFilePondLoad
          }, revert: handleFilePondRevert, headers: { 'X-CSRF-TOKEN': $page.props.csrf_token }
        }" />
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue'
import { AkFolder, AkFile } from "@kalimahapps/vue-icons";
import { useForm, router } from "@inertiajs/vue3";
import vueFilePond from 'vue-filepond';


import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';

import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

// Create FilePond component
const FilePond = vueFilePond(FilePondPluginImagePreview);

const form = useForm({
  files: [],
})

const props = defineProps({
  contents: {
    type: Array,
    required: true,
  }
})

const folderHistory = ref([])
const currentFolder = ref('/');

const navigateToFolder = (folderPath) => {
  folderHistory.value.push(folderPath)
}

const openFile = (filePath) => {
  window.open(`/storage/${filePath}`);
}

const goBack = () => {
  folderHistory.value.pop()
}

const getCurrentFolderContents = () => {
  currentFolder.value = folderHistory.value[folderHistory.value.length - 1] || '/';
  if (currentFolder.value === '/') return props.contents;

  const findFolderContents = (contents, folderPath) => {
    const parts = folderPath.split('/').filter(part => part !== '');


    const findContentsRecursively = (items, folderName) => {
      const folder = items.find(item => item.name === folderName);
      if (!folder || !folder.contents) return [];
      return folder.contents;
    };

    let currentContents = contents;
    for (const part of parts) {
      currentContents = findContentsRecursively(currentContents, part);
      if (currentContents.length === 0) return [];
    }

    return currentContents;
  };

  return findFolderContents(props.contents, currentFolder.value);
};


const deleteItem = (path) => {
  if (confirm('Are you sure you want to delete this item?')) {
    // Implement delete logic here
    router.delete(`/files?path=${path}`);
  }
}

const handleFilePondLoad = (response) => {
  form.files.push(response);
  return response;
}

const handleFilePondRevert = (uniqueId, load, error) => {
  form.files = form.files.filter((image) => image !== uniqueId);
  router.delete(`/files/revert/${uniqueId}?folder=${currentFolder.value}`);
  load();
}
</script>
