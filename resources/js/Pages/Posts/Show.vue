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
    <Link :href="route('comments.create')">Add Comment</Link>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
  props: {
    post: Object,
  },
  components:{
    Link
  }
};
</script>
