<template>
  <AuthenticatedLayout>
    <div class="bg-gray-100 p-4">
      <!-- Back Button -->
      <button @click="goBack"
        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md mb-4">Back</button>

      <!-- File List -->
      <div class="grid grid-cols-3 gap-4">
        <div v-for="folder in folders" :key="folder"
          class="p-4 bg-white rounded-md shadow flex justify-between items-center">
          <a @click.prevent="navigateToFolder(folder)" class="ml-2 cursor-pointer">{{ folder }}</a>
          <button @click="deleteFolder(folder)">Delete</button>
        </div>
        <div v-for="file in files" :key="file"
          class="p-4 bg-white rounded-md shadow flex items-center justify-between ">
          <template v-if="isImage(file)">
            <div class="flex gap-2 items-center">
              <img :src="`/storage/${file}`" class="w-24 h-24 object-cover" alt="Image">
              <p class="text-gray-600 text-sm">{{ file }}</p>
            </div>
            <button @click="deleteFile(file)">Delete</button>
          </template>
          <template v-else>
            <span class="ml-2">{{ file }}</span>
            <button @click="deleteFile(file)">Delete</button>
          </template>
        </div>
      </div>

      <div class="mt-4">
        <input type="file" class="p-2 border border-gray-300 rounded-md" @change="onFileChange">
        <button @click="uploadFile"
          class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md ml-2">Upload</button>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'

const page = usePage()
const props = defineProps({
  folders: Array,
  files: Array
})

const selectedFile = ref(null)
const folderHistory = ref([])

const uploadFile = () => {
  if (selectedFile.value) {
    const formData = new FormData()
    formData.append('file', selectedFile.value)
    router.post(route('files.upload'), formData)
  }
}

const onFileChange = (event) => {
  selectedFile.value = event.target.files[0];
}

const navigateToFolder = (folder) => {
  folderHistory.value.push(folder)
  router.get(route('files.index', { folder }))
}

const goBack = () => {
  if (folderHistory.value.length > 1) {
    folderHistory.value.pop()
    const previousFolder = folderHistory.value.pop()
    router.get(route('files.index', { folder: previousFolder }))
  } else {
    router.get(route('files.index'))
  }
}

const deleteFile = (file) => {
  if (confirm('Are you sure you want to delete this file?')) {
    router.delete(route('files.delete', { file }))
  }
}

const deleteFolder = (folder) => {
  if (confirm('Are you sure you want to delete this folder and its contents?')) {
    router.delete(route('folders.delete', { folder }))
  }
}

const isImage = (file) => {
  const extensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
  const ext = file.split('.').pop().toLowerCase();
  return extensions.includes(ext);
}
</script>
