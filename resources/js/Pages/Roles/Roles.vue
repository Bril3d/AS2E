<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AuthanticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import Table from '../../Components/Table.vue';
import TableDataCell from '../../Components/TableDataCell.vue';
import TableHeaderCell from '../../Components/TableHeaderCell.vue';

const props = defineProps({
  roles: {
    type: Object,
    required: true
  }
})

const searchQuery = ref('');

function search() {
  const route = searchQuery.value.trim() !== '' ? '/users?search=' + searchQuery.value.trim() : '/users';
  router.get(route);
  searchQuery.value = '';
}


</script>

<template>

  <Head title="Roles" />
  <AuthanticatedLayout title="Roles">
    <Link as="button" :href="route('roles.create')"
      class="inline-flex items-center px-4 py-2 bg-main border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-main-dark focus:bg-main-dark active:bg-main-dark focus:outline-none focus:ring-2 focus:ring-main focus:ring-offset-2 transition ease-in-out duration-150">
    New Role</Link>
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
          <tr v-for="role in roles" :key="role.id">
            <TableDataCell>{{ role.id }}</TableDataCell>
            <TableDataCell>{{ role.name }}</TableDataCell>
            <TableDataCell class="space-x-4">
              <Link as="button" :href="route('roles.edit', role.id)"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-250">
              Edit
              </Link>
              <Link as="button" :href="route('roles.destroy', role.id)" method="delete" preserve-scroll
                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-250">
              Delete
              </Link>
            </TableDataCell>
          </tr>
        </template>
      </Table>
    </div>
  </AuthanticatedLayout>
</template>