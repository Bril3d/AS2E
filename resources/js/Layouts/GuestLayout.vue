<script setup>
import { onMounted } from 'vue';
import HomeNavbar from '@/Components/HomeNavbar.vue';



onMounted(() => {
    window.HSStaticMethods.autoInit()
});
</script>

<template>
    <div>
        <HomeNavbar />
        <div class="min-h-screen flex sm:flex-col sm:justify-center items-center py-6 dark:bg-slate-900 bg-gray-100">

            <transition name="route" mode="out-in" appear>
                <div :key="$page.url"
                    class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-700 shadow-md overflow-hidden sm:rounded-lg">
                    <slot />
                </div>
            </transition>
        </div>
    </div>
</template>
