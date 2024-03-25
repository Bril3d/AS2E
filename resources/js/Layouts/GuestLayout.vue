<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex sm:flex-col sm:justify-center items-center py-6 dark:bg-slate-900 bg-gray-100">
        <transition name="route" mode="out-in" appear>
            <div :key="$page.url"
                class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-700 shadow-md overflow-hidden sm:rounded-lg">
                <slot />
            </div>
        </transition>
    </div>
</template>


