<template>

  <Head title="File Explorer" />
  <AuthenticatedLayout>
    <Modal :show="show" @close="show = false">
      <div class="p-6 space-y-3">
        <inputLabel for="name" value="Insert Folder Name" />
        <TextInput id="name" v-model="folderName" placeholder="Folder Name" class="mt-1 block w-full" />
        <PrimaryButton @click="createFolder">Create</PrimaryButton>
      </div>
    </Modal>
    <div class="sm:space-x-6 space-x-3 mb-5">
      <SecondaryButton @click="goBack" v-if="folderHistory.length > 0">Back</SecondaryButton>

      <PrimaryButton @click="show = true">Create
        Folder</PrimaryButton>
    </div>
    <div class="p-4 md:p-6 bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
      <div class="flex gap-2 items-center mb-5">
        <BxHomeAlt class="size-6 cursor-pointer dark:text-white" @click="navigateToFolder('/')" />
        <span v-if="currentFolder != '/'" class="dark:text-white cursor-pointer"
          @click="navigateToFolder(folderHistory[index])" v-for="(folder, index) in currentFolder.split('/')"
          :key="index">
          {{ index > 0 ? '/' : '' }} {{ folder }}
        </span>

      </div>
      <div class="grid sm:grid-cols-3 grid-cols-1 gap-4">
        <!-- Folders -->
        <div v-for="(item, index) in getCurrentFolderContents()" :key="index"
          class="p-4 bg-white rounded-md shadow flex justify-between items-center cursor-pointer dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
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
      <div class="mt-4">
        <file-pond class="dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
          credits="false" name="test" ref="pond" class-name="my-pond" label-idle="Drop files here..."
          allow-multiple="true" accepted-file-types="image/jpeg, image/png" :allowFileTypeValidation="false" :server="{
            url: '', process: {
              url: `/files/process?folder=${currentFolder}`, method: 'POST', onload:
                handleFilePondLoad
            }, revert: handleFilePondRevert, headers: { 'X-CSRF-TOKEN': $page.props.csrf_token }
          }" />
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue'
import { AkFolder, AkFile, BxHomeAlt } from "@kalimahapps/vue-icons";
import { useForm, router, Head } from "@inertiajs/vue3";
import vueFilePond from 'vue-filepond';
import Modal from '@/Components/Modal.vue';
import inputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';

import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

// Create FilePond component
const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginImagePreview);

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
const folderName = ref('');
const show = ref(false);

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

const createFolder = () => {
  router.post(`/files/${folderName.value}`, { path: currentFolder.value }, {
    onSuccess: () => {
      show.value = false
    }
  })
}
</script>
