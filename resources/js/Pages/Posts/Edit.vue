<template>
  <div>
    <h1>Edit Post</h1>
    <form @submit.prevent="submitForm">
      <input v-model="form.title" type="text" placeholder="Title" required>
      <textarea v-model="form.content" placeholder="Content" required></textarea>
      <button type="submit">Update Post</button>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    post: Object,
  },
  data() {
    return {
      form: {
        title: this.post.title,
        content: this.post.content,
      },
    };
  },
  methods: {
    submitForm() {
      this.$inertia.put(route('posts.update', this.post.id), this.form);
    },
  },
};
</script>
