<script setup>
import { useDark, useToggle } from '@vueuse/core'
import { MdOutlinedDarkMode, CaLight } from "@kalimahapps/vue-icons";
let isDark = useDark();
const toggleDark = useToggle(isDark);
</script>


<template>

  <button type="button" @click="toggleDark()"
    class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 transition-all ease-in">
    <MdOutlinedDarkMode v-if="isDark" class="flex-shrink-0 size-4" key="dark" />
    <CaLight v-else class="flex-shrink-0 size-4" key="light" />
  </button>

</template>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to .fade-leave-active {
  opacity: 0;
}
</style>