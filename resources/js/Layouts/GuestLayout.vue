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


<style>
.route-enter-from {
    opacity: 0;
    transform: translateY(-30px);
}

.route-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}

.route-enter-active {
    transition: all 0.5s ease-out;
}

.route-leave-active {
    transition: all 0.3s ease-in;
}

.route-enter-to,
.route-leave-from {
    opacity: 1;
    transform: translateY(0);
}
</style>