<script setup>
import { ref, computed } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';


const url = ref(null);

function onFileChange($e) {
    form.avatar = $e.target.files[0]
    url.value = URL.createObjectURL(form.avatar)
}

const avatar = computed(() => {
    return url.value ? url.value : `storage/${user.avatar}`
})

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    avatar: user.avatar,
    email: user.email,
});

function update() {
    form.post('/profile', {
        _method: 'put',
    })
}

</script>

<template>
    <section class="w-full">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="update" class="mt-6 space-y-6">
            <div class="flex justify-between w-full">
                <div class="w-1/2">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                            autofocus autocomplete="name" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div>
                        <InputLabel for="email" value="Email" />

                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div v-if="mustVerifyEmail && user.email_verified_at === null">
                        <p class="text-sm mt-2 text-gray-800">
                            Your email address is unverified.
                            <Link :href="route('verification.send')" method="post" as="button"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Click here to re-send the verification email.
                            </Link>
                        </p>

                        <div v-show="status === 'verification-link-sent'"
                            class="mt-2 font-medium text-sm text-green-600">
                            A new verification link has been sent to your email address.
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-4 justify-center items-center w-1/2">
                    <input type="file" @input="onFileChange" class="hidden" ref="file" />
                    <img class="w-32 h-32 rounded-full" :src="avatar" alt="My Avatar" @click="$refs.file.click()">
                    <p class="text-center font-bold text-sm text-gray-400">{{ form.avatar?.name || 'Edit your avatar' }}
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
