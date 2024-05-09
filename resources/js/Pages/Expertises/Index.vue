<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthanticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import Table from '../../Components/Table.vue';
import TableDataCell from '../../Components/TableDataCell.vue';
import TableHeaderCell from '../../Components/TableHeaderCell.vue';
import EmptyTable from '@/Components/EmptyTable.vue';
import Pagination from '@/Components/Pagination.vue';
import { usePermission } from '@/Composables/permissions';

const { hasRole } = usePermission()

const props = defineProps({
  expertises: {
    type: Object,
    required: true
  }
})

const openFile = (file) => {
  window.open(file)
}

</script>

<template>

  <Head title="Expertises" />

  <AuthanticatedLayout title="Expertises List">
    <Link as="button" :href="route('expertises.create')"
      class="inline-flex items-center px-4 py-2 bg-main border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-main-dark focus:bg-main-dark active:bg-main-dark focus:outline-none focus:ring-2 focus:ring-main focus:ring-offset-2 transition ease-in-out duration-150">
    New Expertise</Link>
    <div class="mt-6">
      <Table>
        <template #header>
          <tr>
            <TableHeaderCell>ID</TableHeaderCell>
            <TableHeaderCell>Title</TableHeaderCell>
            <TableHeaderCell>User</TableHeaderCell>
            <TableHeaderCell>Image</TableHeaderCell>
            <TableHeaderCell>View</TableHeaderCell>
            <TableHeaderCell>Action</TableHeaderCell>
          </tr>
        </template>
        <template #default>
          <tr v-for="expertise in expertises.data" :key="expertise.id">
            <TableDataCell>{{ expertise.id }}</TableDataCell>
            <TableDataCell class="text-ellipsis overflow-hidden max-w-64">{{ expertise.title }}</TableDataCell>
            <TableDataCell>{{ expertise.user?.name }}</TableDataCell>
            <TableDataCell><img v-if="expertise.image" class="h-16 object-cover cursor-pointer" :src="expertise.image"
                :alt="expertise.title" @click="openFile(expertise.image)" /><span v-else>--</span>
            </TableDataCell>
            <TableDataCell class="text-ellipsis overflow-hidden max-w-64">
              <Link :href="route('expertises.show', expertise)">Click to view</Link>
            </TableDataCell>
            <TableDataCell>
              <div class="flex items-center gap-4 ">
                <Link as="button" :href="route('expertises.edit', expertise.slug)"
                  class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-250">
                Edit
                </Link>
                <Link as="button" :href="route('expertises.destroy', expertise.slug)" method="delete" preserve-scroll
                  class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-250">
                Delete
                </Link>
              </div>
            </TableDataCell>
          </tr>
          <EmptyTable v-if="expertises.data.length < 1" section="expertises" />
        </template>
      </Table>
      <Pagination :links="expertises.meta.links" />
    </div>
  </AuthanticatedLayout>
</template>