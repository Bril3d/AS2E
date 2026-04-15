<script setup>
import { onMounted } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import VueMultiselect from 'vue-multiselect'

const props = defineProps({
  role: {
    type: Object,
    required: true,
  },
  permissions: Array,
})

const form = useForm({
  name: props.role.name,
  permissions: props.role.permissions
})


onMounted(() => {
  form.permissions = props.role?.permissions
})

</script>

<template>

  <Head title="Role Update" />
  <AuthenticatedLayout title="Update Role">
    <Link as="button" :href="route('roles.index')"
      class="inline-flex cursor-pointer items-center px-4 py-2 bg-main border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-main-dark focus:bg-main-dark active:bg-main-dark focus:outline-none focus:ring-2 focus:ring-main focus:ring-offset-2 transition ease-in-out duration-150">
    Back</Link>
    <div class="mt-4">
      <form @submit.prevent="form.put(route('roles.update', role.id))">
        <div>
          <InputLabel for="name" value="Name" />
          <TextInput id="name" class="w-full" v-model="form.name" />
          <InputError class="mt-2" :message="form.errors.name" />
        </div>
        <div class="mt-4">
          <InputLabel for="permissions" value="Permissions" />
          <VueMultiselect id="permissions" v-model="form.permissions" :options="permissions" :multiple="true"
            :close-on-select="true" placeholder="Select Permissions" label="name" track-by="name" />
        </div>
        <div class="flex justify-end">
          <PrimaryButton type="submit" class="mt-4" :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing">
            Update
          </PrimaryButton>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
