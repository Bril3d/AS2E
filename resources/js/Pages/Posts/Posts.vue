<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthanticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import Table from '../../Components/Table.vue';
import TableDataCell from '../../Components/TableDataCell.vue';
import TableHeaderCell from '../../Components/TableHeaderCell.vue';
import EmptyTable from '@/Components/EmptyTable.vue';

const props = defineProps({
  posts: {
    type: Object,
    required: true
  }
})

const openFile = (file) => {
  window.open(file)
}

</script>

<template>

  <Head title="Posts" />

  <AuthanticatedLayout title="Posts List">
    <Link as="button" :href="route('posts.create')"
      class="inline-flex items-center px-4 py-2 bg-main border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-main-dark focus:bg-main-dark active:bg-main-dark focus:outline-none focus:ring-2 focus:ring-main focus:ring-offset-2 transition ease-in-out duration-150">
    New Post</Link>
    <div class="mt-6">
      <Table>
        <template #header>
          <tr>
            <TableHeaderCell>ID</TableHeaderCell>
            <TableHeaderCell>Title</TableHeaderCell>
            <TableHeaderCell>User</TableHeaderCell>
            <TableHeaderCell>Content</TableHeaderCell>
            <TableHeaderCell>Image</TableHeaderCell>
            <TableHeaderCell>Likes</TableHeaderCell>
            <TableHeaderCell>Comments</TableHeaderCell>
            <TableHeaderCell>Action</TableHeaderCell>
          </tr>
        </template>
        <template #default>
          <tr v-for="post in posts" :key="post.id">
            <TableDataCell>{{ post.id }}</TableDataCell>
            <TableDataCell>{{ post.title }}</TableDataCell>
            <TableDataCell>{{ post.user?.name }}</TableDataCell>
            <TableDataCell>{{ post.content }}</TableDataCell>
            <TableDataCell><img v-if="post.image" class="h-16 object-cover cursor-pointer" :src="post.image"
                :alt="post.title" @click="openFile(post.image)" /><span v-else>--</span>
            </TableDataCell>
            <TableDataCell>{{ post.likes }}</TableDataCell>
            <TableDataCell>{{ post.comments.length }}</TableDataCell>
            <TableDataCell class="space-x-4">
              <Link as="button" :href="route('posts.edit', post.slug)"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-250">
              Edit
              </Link>
              <Link as="button" :href="route('posts.destroy', post.slug)" method="delete" preserve-scroll
                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-250">
              Delete
              </Link>
            </TableDataCell>
          </tr>
          <EmptyTable v-if="posts.length < 1" section="posts" />
        </template>
      </Table>
    </div>
  </AuthanticatedLayout>
</template>