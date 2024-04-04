<script setup>
const props = defineProps({
  permissions: Array,
})

</script>

<template>
  <div class="border flex flex-wrap items-center gap-2 text-white dark:border-gray-700 font-semibold text-sm p-2 rounded-md dark:bg-slate-900 leading-none overflow-y-scroll max-h-10">
    <template v-if="permissions.length > 0">
      <span v-for="permission in permissions" :key="permission.id"
        class="bg-emerald-500 dark:bg-emerald-600 capsule">
        {{ permission.name }}
      </span>
    </template>
    <span v-else class="dark:bg-rose-600 bg-rose-500 capsule">
     No Permissions Found!
    </span>
  </div>
</template>