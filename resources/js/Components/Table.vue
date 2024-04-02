<template>
  <div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="border rounded-lg shadow overflow-hidden dark:border-gray-700 dark:shadow-gray-900">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <slot name="header"></slot>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 dark:bg-slate-800 dark:border-gray-700">
              <slot></slot>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>