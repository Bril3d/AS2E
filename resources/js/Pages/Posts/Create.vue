<template>
  <div>
    <h1>Create Post</h1>
    <form @submit.prevent="submitForm">
      <input v-model="form.title" type="text" placeholder="Title" required>
      <textarea v-model="form.content" placeholder="Content" required></textarea>
      <button type="submit">Create Post</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        title: '',
        content: '',
      },
    };
  },
  methods: {
    submitForm() {
      this.$inertia.post(route('posts.store'), this.form);
    },
  },
};
</script>
