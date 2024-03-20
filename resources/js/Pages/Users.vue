<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UserCard from '@/Components/UserCard.vue';
import Pagination from '@/Components/Pagination.vue';

const { users } = defineProps({
  users: {
    type: Object,
    required: true
  }
})

const { data } = users
</script>


<template>
  <AuthenticatedLayout>
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Users</h2>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <UserCard v-for="(user, index) in data" :user="user" :key="index" />
      </div>
      <Pagination :links="users.links" />
    </div>
  </AuthenticatedLayout>
</template>