<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import PermissionsView from "@/Components/PermissionsView.vue";
import { AkEdit } from "@kalimahapps/vue-icons";

const props = defineProps({
  user: {
    type: Object,
    required: true
  }
})

const userRoles = computed(() => {
  return props.user.roles.length ? props.user.roles.map(role => role.name).join(', ') : 'User'
})

</script>

<template>
  <div
    class="flex flex-col rounded-xl p-4 md:p-6 bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center gap-x-4">
      <img class="rounded-full size-20 object-cover" :src="user.avatar" alt="User Avatar">
      <div class="grow">
        <div class="flex items-center justify-between">
          <h3 class="font-medium text-gray-800 dark:text-gray-200">
            {{ user.name }}
          </h3>
          <Link :href="route('users.edit', user.id)">
          <AkEdit class="text-main hover:text-main-dark transition-colors ease-in duration-200 size-6 cursor-pointer" />
          </Link>
        </div>
        <p class="text-xs uppercase text-gray-500">
          {{ userRoles }}
        </p>
      </div>
    </div>

    <p class="mt-3 text-gray-500">
      {{ user.email }}
    </p>

    <PermissionsView class="mt-3" :permissions="user.permissions" />
  </div>
  <!-- End Col -->
</template>