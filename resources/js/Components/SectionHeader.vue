<template>
  <div class="bg-main py-4 mb-12">
    <h2 class="text-3xl font-semibold text-white text-center">{{ title }}</h2>
    <p class="text-lg text-white text-center">{{ caption }}</p>
  </div>
</template>
<script>
export default {
  props: {
    title: {
      type: String,
      required: true
    },
    caption: {
      type: String,
      required: true
    }
  }
}
</script>
<style></style>