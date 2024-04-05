<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import inputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import VueMultiselect from 'vue-multiselect'

const props = defineProps({
  settings: Object,
})

const dateFormats = [
  'YYYY-MM-DD', // 2024-04-05
  'DD/MM/YYYY', // 05/04/2024
  'MM/DD/YYYY', // 04/05/2024
  'YYYY/MM/DD', // 2024/04/05
  'DD MMM YYYY', // 05 Apr 2024
  'MMM DD, YYYY', // Apr 05, 2024
  'YYYY MMM DD', // 2024 Apr 05
  'DD/MM/YY', // 05/04/24
  'MM/DD/YY', // 04/05/24
  'YY/MM/DD' // 24/04/05
];
console.log(dateFormats);

const form = useForm({
  app_name: props.settings.app_name,
  date_format: props.settings.date_format,
  pagination_limit: props.settings.pagination_limit,
});
</script>

<template>

  <Head title="Settings" />
  <AuthenticatedLayout title="Settings">
    <form @submit.prevent="form.post(route('settings.store'))" class="space-y-3">
      <div class="w-1/2">
        <inputLabel for="name" value="App Name" />
        <TextInput id="name" v-model="form.app_name" class="w-full" />
        <InputError class="mt-2" :message="form.errors.app_name" />
      </div>
      <div class="w-1/2">
        <inputLabel for="date" value="Date Format" />
        <VueMultiselect id="date" v-model="form.date_format" :options="dateFormats" :close-on-select="true"
          placeholder="Select a date format" class="w-full" />
          <InputError class="mt-2" :message="form.errors.date_format" />
      </div>
      <div class="w-1/2">
        <inputLabel for="pagination" value="Pagination Limit" />
        <TextInput id="pagination" type="number" v-model="form.pagination_limit" class="w-full" />
        <InputError class="mt-2" :message="form.errors.pagination_limit" />
      </div>
      <div class="flex items-center gap-4 mt-2">
        <PrimaryButton :disabled="form.processing">Update</PrimaryButton>

        <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
          leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
          <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Updated.</p>
        </Transition>
      </div>
    </form>
  </AuthenticatedLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>