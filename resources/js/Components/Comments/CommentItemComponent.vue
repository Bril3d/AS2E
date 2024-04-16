<template>
  <div class="flex space-x-3">
    <div class="flex-shrink-0">
      <img :src="comment.user.avatar" class="h-8 w-8 object-cover" />
      />
    </div>
    <div>
      <div class="text-sm font-medium text-gray-900">
        <p>{{ comment.user.name }}</p>
      </div>
      <div class="mt-1 overflow-hidden">
        <p class="text-sm text-gray-700 break-words whitespace-pre-wrap">
          {{ comment.body }}
        </p>
      </div>
      <div class="mt-2 text-sm space-x-2">
        <span class="text-gray-500 font-medium">{{ comment.created_at }}</span>
      </div>
    </div>
  </div>
</template>

<script>

</script>

<style scoped></style>
