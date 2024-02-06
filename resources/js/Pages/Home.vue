<script setup>
import { Head } from '@inertiajs/vue3';
import Hero from '../Components/Hero.vue';
import Features from '@/Components/Features.vue';
import Services from '@/Components/Services.vue'
import Faq from '@/Components/Faq.vue';
import Footer from '@/Components/Footer.vue'
</script>

<template>
    <Head title="Welcome" />
    <div>
        <Hero />
        <Features />
        <Services />
        <Faq />
        <Footer />
    </div>
</template>

