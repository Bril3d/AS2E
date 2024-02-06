<script setup>
import { Head } from '@inertiajs/vue3';
import Hero from '../Components/Hero.vue';
import Features from '@/Components/Features.vue';
import Services from '@/Components/Services.vue'
</script>

<template>
    <Head title="Welcome" />
    <div>
        <Hero />
        <Features />
        <Services />
    </div>
</template>

