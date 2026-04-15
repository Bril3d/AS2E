<script setup>
import { usePage } from '@inertiajs/vue3';

let { logo, app_name } = usePage().props.settings;
logo = logo ? '/storage/' + logo : null
const name = app_name ? app_name : 'AS2E'
</script>


<template>
    <img v-if="logo" :src="logo" :alt="name + ' LOGO'">
    <h1 class="text-2xl uppercase" v-else>{{ name }}</h1>
</template>
