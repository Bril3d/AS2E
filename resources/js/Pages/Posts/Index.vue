<template>
  <div>
    <h1>Posts</h1>
    <ul>
      <li v-for="post in posts" :key="post.id">
        <inertia-link :href="route('posts.show', post.id)">{{ post.title }}</inertia-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    posts: Array,
  },
};
</script>
