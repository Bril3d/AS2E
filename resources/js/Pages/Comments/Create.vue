<template>
  <div>
    <h1>Add Comment</h1>
    <form @submit.prevent="submitForm">
      <textarea v-model="form.content" placeholder="Content" required></textarea>
      <button type="submit">Add Comment</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        content: '',
      },
    };
  },
  methods: {
    submitForm() {
      this.$inertia.post(route('comments.store'), this.form);
    },
  },
};
</script>
