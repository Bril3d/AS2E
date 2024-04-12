<script setup>
import { usePage } from '@inertiajs/vue3';

let { logo, name } = usePage().props.settings;
logo = logo ? '/storage/' + logo : null
name = name ? name : 'AS2E'
</script>


<template>
    <img v-if="logo" :src="logo" :alt="name + ' LOGO'">
    <h1 class="text-2xl uppercase" v-else>{{ name }}</h1>
</template>
