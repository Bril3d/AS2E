<template>
  <div>
    <h1>{{ post.title }}</h1>
    <p>{{ post.content }}</p>
    <h2>Comments</h2>
    <ul>
      <li v-for="comment in post.comments" :key="comment.id">
        {{ comment.content }}
      </li>
    </ul>
    <inertia-link :href="route('comments.create')">Add Comment</inertia-link>
  </div>
</template>

<script>
export default {
  props: {
    post: Object,
  },
};
</script>
