<script setup>
import { ref } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { CaUserAvatar, DeGoogleOriginal } from "@kalimahapps/vue-icons";

const url = ref(null);

function onFileChange($e) {
    form.avatar = $e.target.files[0]
    url.value = URL.createObjectURL(form.avatar)
}

const form = useForm({
    name: '',
    email: '',
    avatar: null,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <div class="text-center">
            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sign up</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Already have an account?
                <Link
                    class="text-blue-600 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    :href="route('login')">
                Sign in here
                </Link>
            </p>
        </div>
        <div class="mt-5">
            <a href="/auth/google/redirect"
                class="w-full cursor-pointer py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                <DeGoogleOriginal class="w-4 h-auto" />
                Sign up with Google
            </a>

            <div
                class="py-3 flex items-center text-xs text-gray-400 uppercase before:flex-[1_1_0%] before:border-t before:border-gray-200 before:me-6 after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:text-gray-500 dark:before:border-gray-600 dark:after:border-gray-600">
                Or</div>
        </div>
        <form @submit.prevent="submit">
            <div>
                <input type="file" @input="onFileChange" class="hidden" ref="file" />
                <div class="h-32 w-32 rounded-full bg-slate-600 my-4 mx-auto flex justify-center items-center cursor-pointer"
                    @click="$refs.file.click()">
                    <img v-if="url" :src="url" class="w-full h-full rounded-full object-cover" alt="Avatar Preview">
                    <CaUserAvatar v-else
                        class="fill-white w-24 h-24 hover:opacity-50 transition-opacity ease-in duration-200" />
                </div>
                <p class="text-center font-bold text-sm text-gray-400">{{ form.avatar?.name || 'Import an avatar' }}</p>

                <InputLabel for="name" value="Name" class="dark:text-white" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" class="dark:text-white" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" class="dark:text-white" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" class="dark:text-white" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
