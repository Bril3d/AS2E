<script setup>
import { Head } from '@inertiajs/vue3';
import AuthanticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import Table from '../../Components/Table.vue';
import TableDataCell from '../../Components/TableDataCell.vue';
import TableHeaderCell from '../../Components/TableHeaderCell.vue';

const props = defineProps({
  permissions: {
    type: Object,
    required: true
  }
})

</script>

<template>

  <Head title="Permissions" />

  <AuthanticatedLayout title="Permissions">
    <div class="flex justify-end mb-5">
      <div class="hidden sm:block">
        <label for="icon" class="sr-only">Search</label>
        <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
            <svg class="flex-shrink-0 size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.3-4.3" />
            </svg>
          </div>
          <input type="text" id="icon" name="icon" v-model="searchQuery" @keydown.enter.prevent="search"
            class="py-2 px-4 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
            placeholder="Search">
        </div>
      </div>
    </div>
    <div class="mt-6">
      <Table>
        <template #header>
          <tr>
            <TableHeaderCell>ID</TableHeaderCell>
            <TableHeaderCell>Name</TableHeaderCell>
            <TableHeaderCell>Action</TableHeaderCell>
          </tr>
        </template>
        <template #default>
          <tr v-for="permission in permissions" :key="permission.id">
            <TableDataCell>{{ permission.id }}</TableDataCell>
            <TableDataCell>{{ permission.name }}</TableDataCell>
            <TableDataCell>Edit/Delete</TableDataCell>
          </tr>
        </template>
      </Table>
    </div>
  </AuthanticatedLayout>
</template>