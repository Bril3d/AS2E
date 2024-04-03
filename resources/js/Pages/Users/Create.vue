<script setup>
import { ref, computed } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import VueMultiselect from 'vue-multiselect'
import { Head, useForm } from '@inertiajs/vue3';


const props = defineProps({
  roles: Array
})


const url = ref(null);
const passwordInput = ref(null);

function onFileChange($e) {
  form.avatar = $e.target.files[0]
  url.value = URL.createObjectURL(form.avatar)
}

const avatar = computed(() => {
  const avatar = `https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80`
  return url.value ? url.value : avatar
})

const form = useForm({
  id: '',
  name: '',
  avatar: null,
  email: '',
  password: '',
  password_confirmation: '',
  role: { name: 'user' }
});

const submit = () => {
  form.post(route('users.store'), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onError: () => {
      if (form.errors.password) {
        form.reset('password', 'password_confirmation');
        passwordInput.value.focus();
      }
    },
  });
}

</script>

<template>

  <Head title="New User" />

  <AuthenticatedLayout title="New User">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
          <section class="w-full">
            <header>
              <h2 class="text-lg font-medium text-gray-900 dark:text-white">Profile Information</h2>

              <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Insert your account's profile information and email address.
              </p>
            </header>

            <form @submit.prevent="submit" class="mt-6 space-y-6">
              <div class="flex justify-between w-full">
                <div class="w-1/2 space-y-2">
                  <div>
                    <InputLabel for="name" value="Name" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                      autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.name" />
                  </div>

                  <div>
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                      autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                  </div>
                  <div>
                    <InputLabel for="password" value="New Password" />

                    <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                      class="mt-1 block w-full" autocomplete="new-password" />

                    <InputError :message="form.errors.password" class="mt-2" />
                  </div>

                  <div>
                    <InputLabel for="password_confirmation" value="Confirm Password" />

                    <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                      class="mt-1 block w-full" autocomplete="new-password" />

                    <InputError :message="form.errors.password_confirmation" class="mt-2" />
                  </div>
                  <div>
                    <InputLabel for="roles" value="Roles" />
                    <VueMultiselect class="dark:bg-slate-600" id="roles" v-model="form.role" :options="roles"
                      :close-on-select="true" placeholder="Select a role" label="name" track-by="name" />
                  </div>
                </div>
                <div class="flex flex-col gap-4 justify-center items-center w-1/2">
                  <input type="file" @input="onFileChange" class="hidden" ref="file" />
                  <img
                    class="w-32 h-32 rounded-full object-cover hover:opacity-50 cursor-pointer transition-opacity ease-in duration-200"
                    :src="avatar" alt="My Avatar" @click="$refs.file.click()">
                  <p class="text-center font-bold text-sm text-gray-400">{{ form.avatar?.name || 'Upload your avatar' }}
                  </p>
                </div>
              </div>
              <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Create</PrimaryButton>

                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                  leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                  <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Created.</p>
                </Transition>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>