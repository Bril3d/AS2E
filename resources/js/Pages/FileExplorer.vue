<template>
  <AuthenticatedLayout>
    <div class="bg-gray-100 p-4">
      <!-- Back Button -->
      <button @click="goBack" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md mb-4">Back</button>

      <!-- File List -->
      <div class="grid grid-cols-3 gap-4">
        <div v-for="folder in folders" :key="folder" class="p-4 bg-white rounded-md shadow">
          <i class="fas fa-folder text-yellow-600"></i>
          <a @click.prevent="navigateToFolder(folder)" class="ml-2">{{ folder }}</a>
        </div>
        <div v-for="file in files" :key="file" class="p-4 bg-white rounded-md shadow flex gap-2 items-center">
          <template v-if="isImage(file)">
            <img :src="`/storage/${file}`" class="w-24 h-24 object-cover" alt="Image">
            <p class="text-gray-600 text-sm">{{ file }}</p>
          </template>
          <template v-else>
            <i class="fas fa-file text-blue-600"></i>
            <span class="ml-2">{{ file }}</span>
          </template>
        </div>
      </div>

      <!-- File Upload Form -->
      <form class="mt-4" @submit.prevent="uploadFile">
        <input type="file" class="p-2 border border-gray-300 rounded-md" @change="onFileChange">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md ml-2">Upload</button>
      </form>
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
  // Implement file upload logic
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

const isImage = (file) => {
  const extensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
  const ext = file.split('.').pop().toLowerCase();
  return extensions.includes(ext);
}
</script>
