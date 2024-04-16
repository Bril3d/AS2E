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
      form.post(route('comments.store'));
    },
  },
};
</script>
