<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import inputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import VueMultiselect from 'vue-multiselect'

const props = defineProps({
  settings: Object,
})

const form = useForm({
  app_name: props.settings.app_name,
  date_format: props.settings.date_format,
  pagination_limit: props.settings.pagination_limit,
  logo: props.settings.logo,
});

const url = ref('/storage/' + props.settings.logo);

function onFileChange($e) {
  form.logo = $e.target.files[0]
  url.value = URL.createObjectURL(form.logo)
}


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



</script>

<template>

  <Head title="Settings" />
  <AuthenticatedLayout title="Settings">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
      <form @submit.prevent="form.post(route('settings.store'))" class="space-y-3">
        <div class="flex flex-col md:flex-row md:justify-between w-full">
          <div class="md:w-1/2 order-2 md:order-1 space-y-3">
            <div>
              <inputLabel for="name" value="App Name" />
              <TextInput id="name" v-model="form.app_name" class="mt-1 block w-full" />
              <InputError class="mt-2" :message="form.errors.app_name" />
            </div>
            <div>
              <inputLabel for="date" value="Date Format" />
              <VueMultiselect id="date" v-model="form.date_format" :options="dateFormats" :close-on-select="true"
                placeholder="Select a date format" class="mt-1 w-full" />
              <InputError class="mt-2" :message="form.errors.date_format" />
            </div>
            <div>
              <inputLabel for="pagination" value="Pagination Limit" />
              <TextInput id="pagination" type="number" v-model="form.pagination_limit" class="mt-1 block w-full" />
              <InputError class="mt-2" :message="form.errors.pagination_limit" />
            </div>
          </div>
          <div class="flex flex-col gap-4 justify-center items-center md:w-1/2 order-1 md:order-2">
            <input type="file" @input="onFileChange" class="hidden" ref="file" />
            <img
              class="w-32 h-32 rounded-full object-cover hover:opacity-50 cursor-pointer transition-opacity ease-in duration-200"
              :src="url" alt="App Logo" @click="$refs.file.click()">
            <p class="text-center font-bold text-sm text-gray-400">{{ form.logo?.name || 'Update your logo'
              }}
            </p>
            <InputError class="mt-2" :message="form.errors.logo" />
          </div>
        </div>
        <div class="flex items-center gap-4 mt-2">
          <PrimaryButton :disabled="form.processing">Update</PrimaryButton>

          <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
            leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Updated.</p>
          </Transition>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
