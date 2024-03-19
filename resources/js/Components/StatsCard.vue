<script setup>
const props = defineProps({
  header: {
    type: String,
    default: false,
    required: true,
  },
  tooltip: {
    type: String,
    required: false
  },
  number: {
    type: Number,
    default: "0",
    required: true
  }

});
</script>

<template>
  <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
    <div class="p-4 md:p-5 flex gap-x-4">
      <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
        <slot />
      </div>

      <div class="grow">
        <div class="flex items-center gap-x-2">
          <p class="text-xs uppercase tracking-wide text-gray-500">
            {{ header }}
          </p>
          <div v-if="tooltip" class="hs-tooltip">
            <div class="hs-tooltip-toggle">
              <svg class="flex-shrink-0 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                <path d="M12 17h.01" />
              </svg>
              <span
                class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-slate-700"
                role="tooltip">
                {{ tooltip }}
              </span>
            </div>
          </div>
        </div>
        <div class="mt-1 flex items-center">
          <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-gray-200">
            {{ number }}
          </h3>
        </div>
      </div>
    </div>
  </div>
</template>