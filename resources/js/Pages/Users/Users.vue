<script setup>
import UserCard from '@/Components/UserCard.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, router, Link } from '@inertiajs/vue3';
import { FaUsersSlash } from "@kalimahapps/vue-icons";
import { ref } from 'vue';

const { users } = defineProps({
  users: {
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

const { data } = users
</script>


<template>

  <Head title="Users List" />
  <AuthenticatedLayout title="Users">
    <div class="flex justify-between items-center mb-5">
      <Link as="button" :href="route('users.create')"
        class="inline-flex items-center px-4 py-2 bg-main border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-main-dark focus:bg-main-dark active:bg-main-dark focus:outline-none focus:ring-2 focus:ring-main focus:ring-offset-2 transition ease-in-out duration-150">
      New User</Link>
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
    <div v-if="data.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <UserCard v-for="(user, index) in data" :user="user" :key="index" />
    </div>
    <div v-else class="flex justify-center items-center flex-col gap-2 opacity-50">
      <FaUsersSlash class="text-black dark:text-white w-[200px] h-[200px]" /> <span class="dark:text-white">No Users
        Found</span>
    </div>
    <Pagination :links="users.meta.links" />
  </AuthenticatedLayout>
</template>