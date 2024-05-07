<script setup>
import { computed } from "vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const expertise = computed(() => usePage().props.expertise);
</script>

<template>

    <Head :title="'expertise | ' + expertise.title" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col justify-center">
                    <div
                        class="grid grid-cols-1 gap-6 p-6 overflow-hidden bg-white rounded-lg shadow-md sm:grid-cols-3 dark:bg-gray-800">
                        <img v-if="expertise.image !== '' && expertise.image !== null" :src="expertise.image"
                            class="object-cover w-full rounded-md" :alt="expertise.title" />

                        <div class="capitalize">
                            <div class="italic text-gray-500 dark:text-gray-300">
                                Title
                            </div>
                            <h1
                                class="block text-gray-800 transition-colors duration-300 transform dark:text-white hover:text-gray-600 max-w-max">
                                {{ expertise.title }}
                            </h1>
                            <div class="mt-4">
                                <div class="italic text-gray-500 dark:text-gray-300">
                                    Slug
                                </div>
                                <h1
                                    class="block text-gray-800 normal-case transition-colors duration-300 transform dark:text-white hover:text-gray-600 max-w-max">
                                    {{ expertise.slug }}
                                </h1>
                            </div>
                        </div>

                        <div class="capitalize">
                            <div class="italic text-gray-500 dark:text-gray-300">
                                Author
                            </div>
                            <h1
                                class="block text-gray-800 transition-colors duration-300 transform dark:text-white hover:text-gray-600 max-w-max">
                                {{ expertise.user.name }}
                            </h1>
                            <div class="mt-4 italic text-gray-500 dark:text-gray-300">
                                Created At
                            </div>
                            <div
                                class="block text-gray-800 transition-colors duration-300 transform dark:text-white hover:text-gray-600 max-w-max">
                                {{ expertise.created_at }}
                            </div>
                        </div>
                    </div>

                    <div class="p-5 mt-5 bg-white rounded-lg shadow-md dark:border-gray-700 dark:bg-gray-800">
                        <div
                            class="mb-3 text-2xl font-semibold capitalize border-b-4 border-gray-800 dark:border-b-gray-200 dark:text-gray-300">
                            Content
                        </div>
                        <div class="flex justify-center mt-5">
                            <div class="w-full prose prose-dark dark:prose-invert lg:prose-lg prose-table:border prose-th:border prose-td:border prose-tr:border" v-html="expertise.body" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>