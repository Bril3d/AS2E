<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { usePermission } from '@/Composables/permissions'
import AuthanticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import Table from '../../Components/Table.vue';
import TableDataCell from '../../Components/TableDataCell.vue';
import TableHeaderCell from '../../Components/TableHeaderCell.vue';


const { hasRole } = usePermission()

const props = defineProps({
  comments: {
    type: Object,
    required: true
  }
})
</script>

<template>

  <Head title="Comments" />

  <AuthanticatedLayout title="Comments List">
    <div class="mt-6">
      <Table>
        <template #header>
          <tr>
            <TableHeaderCell>ID</TableHeaderCell>
            <TableHeaderCell v-if="hasRole('admin')">User</TableHeaderCell>
            <TableHeaderCell>Post Slug</TableHeaderCell>
            <TableHeaderCell>Content</TableHeaderCell>
            <TableHeaderCell>Action</TableHeaderCell>
          </tr>
        </template>
        <template #default>
          <tr v-for="comment in comments" :key="comment.id">
            <TableDataCell>{{ comment.id }}</TableDataCell>
            <TableDataCell v-if="hasRole('admin')">{{ comment.user.name }}</TableDataCell>
            <TableDataCell>
              <Link :href="route('posts.show', comment.post)">{{ comment.post }}</Link>
            </TableDataCell>
            <TableDataCell>{{ comment.content }}</TableDataCell>
            <TableDataCell class="space-x-4">
              <Link as="button" :href="route('comments.edit', comment.id)"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-250">
              Edit
              </Link>
              <Link as="button" :href="route('comments.destroy', comment.id)" method="delete" preserve-scroll
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