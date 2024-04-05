<script setup>
import { usePage } from '@inertiajs/vue3';

let { logo, name } = usePage().props.settings;
logo = '/storage/' + logo
</script>


<template>
    <img :src="logo" :alt="name + ' LOGO'">
</template>
