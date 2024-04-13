<template>
  <div>
    <h1>Edit Comment</h1>
    <form @submit.prevent="submitForm">
      <textarea v-model="form.content" placeholder="Content" required></textarea>
      <button type="submit">Update Comment</button>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    comment: Object,
  },
  data() {
    return {
      form: {
        content: this.comment.content,
      },
    };
  },
  methods: {
    submitForm() {
      this.$inertia.put(route('comments.update', this.comment.id), this.form);
    },
  },
};
</script>
