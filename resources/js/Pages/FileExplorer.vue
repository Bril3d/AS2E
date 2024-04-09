<template>
  <AuthenticatedLayout>
    <button @click="goBack" v-if="folderHistory.length > 0" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md mb-4">Back</button>

    <div class="grid grid-cols-3 gap-4">
      <!-- Folders -->
      <div v-for="(item, index) in getCurrentFolderContents()" :key="index"
        class="p-4 bg-white rounded-md shadow flex justify-between items-center cursor-pointer"
        @click="item.type === 'folder' || item.type === 'parentFolder' ? navigateToFolder(item.path) : null">
        <div class="flex items-center w-2/3">
          <AkFolder v-if="item.type === 'folder'" class="w-8 h-8" />
          <AkFile v-else class="w-8 h-8" />
          <span class="w-1/2 ml-2 flex-grow overflow-hidden whitespace-nowrap text-ellipsis">{{ item.name }}</span>
        </div>
        <button v-if="item.type !== 'parentFolder'" @click.stop="deleteItem(item.path)" class="text-red-500">Delete</button>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue'
import { AkFolder,AkFile  } from "@kalimahapps/vue-icons";

const props = defineProps({
  contents: {
    type: Array,
    required: true,
  }
})

const folderHistory = ref([])

const navigateToFolder = (folderPath) => {
  folderHistory.value.push(folderPath)
}

const goBack = () => {
  folderHistory.value.pop()
}

const getCurrentFolderContents = () => {
  const currentFolder = folderHistory.value[folderHistory.value.length - 1];
  if (!currentFolder) return props.contents;

  const folderContents = props.contents.find(item => item.path === currentFolder)?.contents || [];



  return folderContents;
}

const deleteItem = (itemPath) => {
  if (confirm('Are you sure you want to delete this item?')) {
    // Implement delete logic here
    console.log('Delete item:', itemPath);
  }
}
</script>
